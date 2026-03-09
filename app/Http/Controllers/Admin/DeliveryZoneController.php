<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DeliveryZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class DeliveryZoneController extends Controller
{
    /**
     * Display a listing of the delivery zones.
     */
    public function index()
    {
        $deliveryZones = DeliveryZone::orderBy('min_distance', 'asc')->paginate(10);
        return view('admin.delivery-zones.index', compact('deliveryZones'));
    }

    /**
     * Show the form for creating a new delivery zone.
     */
    public function create()
    {
        return view('admin.delivery-zones.create');
    }

    /**
     * Store a newly created delivery zone in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'nullable|string|max:255',
            'min_distance' => 'nullable|numeric|min:0',
            'max_distance' => 'nullable|numeric',
            'delivery_fee' => 'nullable|numeric|min:0',
            'minimum_order_amount' => 'nullable|numeric|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DeliveryZone::create($request->all());

        return redirect()->route('admin.delivery-zones.index')->with('success', 'Delivery zone created successfully.');
    }

    /**
     * Show the form for editing the specified delivery zone.
     */
    public function edit(string $id)
    {
        $deliveryZone = DeliveryZone::findOrFail($id);
        return view('admin.delivery-zones.edit', compact('deliveryZone'));
    }

    /**
     * Update the specified delivery zone in storage.
     */
    public function update(Request $request, string $id)
    {
        $deliveryZone = DeliveryZone::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'nullable|string|max:255',
            'min_distance' => 'nullable|numeric|min:0',
            'max_distance' => 'nullable|numeric',
            'delivery_fee' => 'nullable|numeric|min:0',
            'minimum_order_amount' => 'nullable|numeric|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $deliveryZone->update($request->all());

        return redirect()->route('admin.delivery-zones.index')->with('success', 'Delivery zone updated successfully.');
    }

    /**
     * Remove the specified delivery zone from storage.
     */
    public function destroy(string $id)
    {
        $deliveryZone = DeliveryZone::findOrFail($id);
        $deliveryZone->delete();
        return redirect()->route('admin.delivery-zones.index')->with('success', 'Delivery zone deleted successfully.');
    }

    /**
     * Frontend API - Get all active delivery zones.
     */
    public function getDeliveryZones()
    {
        $zones = DeliveryZone::where('is_active', true)
            ->orderBy('min_distance', 'asc')
            ->get()
            ->map(function ($zone) {
                return [
                    'id' => $zone->id,
                    'name' => $zone->name,
                    'min_distance' => (float) $zone->min_distance,
                    'max_distance' => (float) $zone->max_distance,
                    'delivery_fee' => (float) $zone->delivery_fee,
                    'minimum_order_amount' => (float) $zone->minimum_order_amount,
                ];
            });

        return response()->json([
            'success' => true,
            'data' => $zones,
        ]);
    }

    /**
     * Postcoder API: Search for postcodes / addresses.
     * Returns a list of matching postcodes with lat/lng for the frontend dropdown.
     */
    public function searchPostcodes(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'query' => 'required|string|min:2|max:50',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Please enter at least 2 characters.',
            ], 422);
        }

        $query = $request->input('query');
        $apiKey = config('services.postcoder.key');

        if (!$apiKey) {
            return response()->json([
                'success' => false,
                'message' => 'Postcoder API key not configured.',
            ], 500);
        }

        try {
            $encodedQuery = urlencode(trim($query));
            $url = "https://ws.postcoder.com/pcw/{$apiKey}/address/uk/{$encodedQuery}?format=json&addtags=latitude,longitude";

            $httpResponse = Http::timeout(10)->get($url);

            if ($httpResponse->failed()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to connect to postcode service.',
                ], 500);
            }

            $results = $httpResponse->json();

            if (!is_array($results) || empty($results)) {
                return response()->json([
                    'success' => true,
                    'data' => [],
                    'message' => 'No postcodes found.',
                ]);
            }

            // Group by postcode to deduplicate and get unique postcodes
            $postcodeMap = [];
            foreach ($results as $result) {
                $postcode = $result['postcode'] ?? null;
                if (!$postcode) continue;

                if (!isset($postcodeMap[$postcode])) {
                    $postcodeMap[$postcode] = [
                        'postcode' => $postcode,
                        'lat' => (float) ($result['latitude'] ?? 0),
                        'lng' => (float) ($result['longitude'] ?? 0),
                        'district' => $result['posttown'] ?? ($result['county'] ?? ''),
                        'ward' => $result['organisation'] ?? '',
                    ];
                }
            }

            return response()->json([
                'success' => true,
                'data' => array_values($postcodeMap),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error searching postcodes: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Postcoder API: Get lat/lng position for a single postcode.
     * Caches successful results for 24 hours to reduce API calls.
     */
    private function getPostcodePosition(string $postcode, string $apiKey): ?array
    {
        $cleanPostcode = str_replace(' ', '', trim(strtoupper($postcode)));
        $cacheKey = 'postcoder_position_' . $cleanPostcode;

        // Check cache first
        $cached = Cache::get($cacheKey);
        if ($cached !== null) {
            return $cached;
        }

        $encodedPostcode = urlencode($cleanPostcode);
        $url = "https://ws.postcoder.com/pcw/{$apiKey}/position/uk/{$encodedPostcode}?format=json";

        $httpResponse = Http::timeout(10)->get($url);

        if ($httpResponse->failed()) {
            return null;
        }

        $data = $httpResponse->json();

        if (!is_array($data) || empty($data)) {
            return null;
        }

        // The position endpoint returns an array with latitude/longitude
        $first = $data[0] ?? null;
        if (!$first || !isset($first['latitude']) || !isset($first['longitude'])) {
            return null;
        }

        $result = [
            'lat' => (float) $first['latitude'],
            'lng' => (float) $first['longitude'],
        ];

        // Only cache successful results
        Cache::put($cacheKey, $result, 86400);

        return $result;
    }

    /**
     * Haversine formula to calculate distance between two lat/lng points in miles.
     */
    private function haversineDistance(float $lat1, float $lon1, float $lat2, float $lon2): float
    {
        $earthRadiusMiles = 3958.8;

        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);

        $a = sin($dLat / 2) * sin($dLat / 2) +
            cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
            sin($dLon / 2) * sin($dLon / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return $earthRadiusMiles * $c;
    }

    /**
     * Frontend API - Check delivery availability for a given customer postcode.
     * Uses Postcoder API's /position endpoint to geocode both the store and customer
     * postcodes, then calculates Haversine distance and matches against delivery zones.
     */
    public function checkDelivery(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_postcode' => 'required|string|min:2|max:10',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Please provide a valid postcode.',
            ], 422);
        }

        $customerPostcode = $request->input('customer_postcode');
        $apiKey = config('services.postcoder.key');

        if (!$apiKey) {
            return response()->json([
                'success' => false,
                'message' => 'Postcoder API key not configured.',
            ], 500);
        }

        try {
            // Hardcoded store coordinates (OL9 0HW)
            $storeLat = 53.5476124900381;
            $storeLng = -2.1378681060330367;

            // Geocode customer postcode using Postcoder /position endpoint
            $customerGeo = $this->getPostcodePosition($customerPostcode, $apiKey);

            if (!$customerGeo) {
                return response()->json([
                    'success' => false,
                    'message' => 'Could not find your postcode. Please check and try again.',
                ], 422);
            }

            // Calculate Haversine (straight-line) distance
            $straightLineDistance = $this->haversineDistance(
                $storeLat,
                $storeLng,
                $customerGeo['lat'],
                $customerGeo['lng']
            );

            // Apply road distance correction factor (urban UK areas typically 1.2-1.4x)
            // This converts "as the crow flies" distance to approximate driving distance
            $roadCorrectionFactor = 1.3;
            $estimatedRoadDistance = $straightLineDistance * $roadCorrectionFactor;

            $roundedDistance = round($estimatedRoadDistance, 1);

            // Find matching delivery zone
            $zone = DeliveryZone::getZoneForDistance($roundedDistance);

            if ($zone) {
                return response()->json([
                    'success' => true,
                    'can_deliver' => true,
                    'data' => [
                        'zone_name' => $zone->name,
                        'delivery_fee' => (float) $zone->delivery_fee,
                        'minimum_order_amount' => (float) $zone->minimum_order_amount,
                        'distance' => $roundedDistance,
                        'zone_id' => $zone->id,
                    ],
                ]);
            }

            return response()->json([
                'success' => true,
                'can_deliver' => false,
                'distance' => $roundedDistance,
                'message' => 'Sorry, we cannot deliver to your location. It is ' . $roundedDistance . ' miles away. We only deliver within 3.5 miles.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error checking delivery: ' . $e->getMessage(),
            ], 500);
        }
    }
}
