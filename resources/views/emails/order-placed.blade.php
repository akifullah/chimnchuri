<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation - #{{ $order->order_number }}</title>
    <style>
        /* === RESET === */
        body {
            margin: 0;
            padding: 0;
            width: 100% !important;
            background-color: #f0f4f0;
            font-family: 'Segoe UI', 'Helvetica Neue', Arial, sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        table {
            border-spacing: 0;
            border-collapse: collapse;
        }

        img {
            border: 0;
            outline: none;
        }

        /* === WRAPPER === */
        .wrapper {
            width: 100%;
            table-layout: fixed;
            background-color: #f0f4f0;
            padding: 24px 0;
        }

        /* === MAIN CARD === */
        .main {
            background-color: #ffffff;
            margin: 0 auto;
            width: 100%;
            max-width: 580px;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.08);
        }

        /* === HEADER === */
        .header-banner {
            background: linear-gradient(135deg, #396430 0%, #4a7a3e 50%, #2d5026 100%);
            padding: 28px 20px 22px;
            text-align: center;
        }

        .header-banner img {
            height: 56px;
            margin-bottom: 12px;
        }

        .header-banner h1 {
            font-size: 22px;
            font-weight: 700;
            color: #ffffff;
            margin: 0 0 4px;
            letter-spacing: -0.3px;
        }

        .header-banner p {
            font-size: 13px;
            color: rgba(255, 255, 255, 0.85);
            margin: 0;
        }

        /* === CONTENT === */
        .content {
            padding: 24px 22px;
        }

        /* === ORDER META STRIP === */
        .order-strip {
            background-color: #fafcfa;
            border: 1px solid #e5ede3;
            border-radius: 10px;
            padding: 14px 16px;
            margin-bottom: 20px;
        }

        .order-strip td {
            font-size: 12px;
            color: #64748b;
            padding: 3px 4px;
        }

        .order-strip b {
            color: #1e293b;
            font-weight: 600;
        }

        .badge {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .badge-delivery {
            background-color: #dbeafe;
            color: #1d4ed8;
        }

        .badge-collection {
            background-color: #d1fae5;
            color: #047857;
        }

        /* === CUSTOMER INFO === */
        .customer-card {
            background-color: #fafcfa;
            border: 1px solid #e5ede3;
            border-radius: 10px;
            padding: 14px 16px;
            margin-bottom: 20px;
        }

        .customer-card-title {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: #396430;
            margin: 0 0 10px;
        }

        .customer-card td {
            font-size: 12px;
            color: #475569;
            padding: 2px 0;
        }

        .customer-card b {
            color: #1e293b;
        }

        /* === SECTION TITLES === */
        .section-title {
            font-size: 14px;
            font-weight: 700;
            color: #1e293b;
            margin: 0 0 10px;
            padding-bottom: 8px;
            border-bottom: 2px solid #e5ede3;
            display: flex;
            align-items: center;
        }

        /* === ITEMS TABLE === */
        .item-table {
            width: 100%;
            margin-bottom: 16px;
        }

        .item-table th {
            text-align: left;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 0.6px;
            color: #94a3b8;
            border-bottom: 2px solid #e5ede3;
            padding: 6px 0;
            font-weight: 600;
        }

        .item-table td {
            padding: 10px 0;
            border-bottom: 1px solid #f1f5f9;
            vertical-align: top;
        }

        .item-name {
            font-size: 13px;
            font-weight: 600;
            color: #1e293b;
            margin: 0;
        }

        .item-desc {
            font-size: 11px;
            color: #64748b;
            margin: 2px 0 0;
        }

        .addon-list {
            font-size: 11px;
            color: #64748b;
            margin: 4px 0 0;
            padding-left: 10px;
            border-left: 2px solid #396430;
        }

        .addon-list div {
            margin: 2px 0;
        }

        .price {
            font-size: 13px;
            font-weight: 600;
            color: #1e293b;
            text-align: right;
        }

        /* === SUMMARY TABLE === */
        .summary-table {
            width: 100%;
            margin-top: 8px;
            border-top: 2px solid #e5ede3;
            padding-top: 8px;
        }

        .summary-table td {
            font-size: 13px;
            color: #64748b;
            padding: 4px 0;
        }

        .summary-table .total-row td {
            font-size: 16px;
            font-weight: 700;
            color: #396430;
            padding-top: 8px;
            border-top: 2px solid #e5ede3;
        }

        /* === TIME SLOT TABLE === */
        .slot-table {
            width: 100%;
            margin-bottom: 16px;
        }

        .slot-table th {
            text-align: left;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 0.6px;
            color: #94a3b8;
            padding: 4px 0;
            border-bottom: 2px solid #e5ede3;
            font-weight: 600;
        }

        .slot-table td {
            font-size: 12px;
            color: #475569;
            padding: 6px 0;
            border-bottom: 1px solid #f1f5f9;
        }

        /* === INSTRUCTIONS SECTION === */
        .instructions-box {
            background: linear-gradient(135deg, #fafcfa 0%, #f0f7ef 100%);
            border: 1px solid #d4e5d0;
            border-left: 4px solid #396430;
            border-radius: 0 10px 10px 0;
            padding: 18px 16px;
            margin: 20px 0;
        }

        .instructions-box h3 {
            font-size: 14px;
            font-weight: 700;
            color: #2d5026;
            margin: 0 0 14px;
        }

        .instructions-box p,
        .instructions-box li {
            font-size: 12px;
            color: #475569;
            line-height: 1.6;
            margin: 0 0 6px;
        }

        .instructions-box a {
            color: #1d4ed8;
            text-decoration: underline;
        }

        .instructions-box ul {
            padding-left: 18px;
            margin: 6px 0 12px;
        }

        .instructions-box li {
            margin-bottom: 4px;
        }

        .instructions-box .sub-heading {
            font-size: 12px;
            font-weight: 700;
            color: #1e293b;
            margin: 12px 0 4px;
        }

        /* === WARNING BOX === */
        .warning-box {
            background-color: #fef3c7;
            border: 1px solid #fcd34d;
            border-radius: 8px;
            padding: 12px 14px;
            margin: 10px 0;
        }

        .warning-box p,
        .warning-box li {
            font-size: 12px;
            color: #92400e;
            line-height: 1.5;
            margin: 0 0 4px;
        }

        .warning-box b {
            color: #78350f;
        }

        .warning-box ul {
            padding-left: 18px;
            margin: 4px 0;
        }

        /* === ORDER INSTRUCTIONS === */
        .order-notes {
            background-color: #f8fafc;
            border: 1px dashed #cbd5e1;
            border-radius: 8px;
            padding: 12px 14px;
            margin-top: 16px;
        }

        .order-notes p {
            font-size: 12px;
            color: #64748b;
            font-style: italic;
            margin: 0;
            line-height: 1.5;
        }

        /* === CTA BUTTON === */
        .btn {
            background: linear-gradient(135deg, #396430 0%, #4a7a3e 100%);
            color: #ffffff !important;
            padding: 12px 28px;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 700;
            font-size: 13px;
            display: inline-block;
            margin-top: 8px;
            letter-spacing: 0.3px;
        }

        /* === SIGN-OFF === */
        .sign-off {
            text-align: center;
            padding: 20px 0 4px;
            border-top: 1px solid #f1f5f9;
            margin-top: 20px;
        }

        .sign-off p {
            font-size: 13px;
            color: #475569;
            margin: 0 0 2px;
            line-height: 1.5;
        }

        .sign-off .team-name {
            font-size: 15px;
            font-weight: 700;
            color: #396430;
            margin-top: 4px;
        }

        /* === FOOTER === */
        .footer {
            background-color: #fafcfa;
            padding: 16px 20px;
            text-align: center;
            border-top: 1px solid #e5ede3;
        }

        .footer p {
            font-size: 10px;
            color: #94a3b8;
            margin: 2px 0;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <center>
            <table class="main" width="100%">
                {{-- ===== HEADER BANNER ===== --}}
                <tr>
                    <td class="header-banner">
                        <img src="{{ $message->embed(public_path('admin/assets/images/chimnchurri.png')) }}"
                            height="56" alt="{{ config('app.name') }}">
                        <h1>Order Confirmed! 🎉</h1>
                        <p>Thank you for your order, {{ $order->customer_name }}!</p>
                    </td>
                </tr>
                <tr>
                    <td class="content">

                        {{-- ===== ORDER META STRIP ===== --}}
                        <table class="order-strip" width="100%">
                            <tr>
                                <td>Order No.</td>
                                <td align="right"><b>#{{ $order->order_number }}</b></td>
                            </tr>
                            <tr>
                                <td>Date</td>
                                <td align="right"><b>{{ $order->created_at->format('D, j M Y') }}</b></td>
                            </tr>
                            <tr>
                                <td>Payment</td>
                                <td align="right">
                                    <b>{{ ucfirst($order->payment_status) }}</b>
                                    &middot;
                                    {{ $order->payment_method == 'cod' ? ($order->order_type == 'collection' ? 'Pay on Pickup' : 'Cash on Delivery') : 'Online Payment' }}
                                </td>
                            </tr>
                            <tr>
                                <td>Type</td>
                                <td align="right">
                                    @if ($order->order_type == 'collection')
                                        <span class="badge badge-collection">Collection</span>
                                    @else
                                        <span class="badge badge-delivery">Delivery</span>
                                    @endif
                                </td>
                            </tr>
                        </table>

                        {{-- ===== CUSTOMER DETAILS ===== --}}
                        <table class="customer-card" width="100%">
                            <tr>
                                <td colspan="2">
                                    <p class="customer-card-title">👤 Your Details</p>
                                </td>
                            </tr>
                            <tr>
                                <td>Name</td>
                                <td align="right"><b>{{ $order->customer_name }}</b></td>
                            </tr>
                            <tr>
                                <td>Phone</td>
                                <td align="right"><b>{{ $order->customer_phone }}</b></td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td align="right"><b>{{ $order->customer_email ?? 'N/A' }}</b></td>
                            </tr>
                            @if ($order->car_registration)
                                <tr>
                                    <td>🚗 Car Reg</td>
                                    <td align="right"><b>{{ $order->car_registration }}</b></td>
                                </tr>
                            @endif
                        </table>

                        {{-- ===== ORDER DATE ===== --}}
                        @if ($order->order_date)
                            <table width="100%"
                                style="margin-bottom: 16px; background-color: #fafcfa; border: 1px solid #e5ede3; border-radius: 10px; padding: 10px 16px;">
                                <tr>
                                    <td style="font-size: 12px; color: #64748b;">📅 Order Date</td>
                                    <td align="right" style="font-size: 13px; font-weight: 700; color: #1e293b;">
                                        {{ \Carbon\Carbon::parse($order->order_date)->format('l, j M Y') }}
                                    </td>
                                </tr>
                            </table>
                        @endif

                        {{-- ===== TIME SLOTS ===== --}}
                        @if ($order->time_slots && $order->time_slots->count() > 0)
                            <p class="section-title">⏰ Time Slots</p>
                            <table class="slot-table">
                                <thead>
                                    <tr>
                                        <th>Slot</th>
                                        <th align="center" width="50">Qty</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order->time_slots as $slot)
                                        <tr>
                                            <td>{{ $slot->start_time->format('g:i A') }} –
                                                {{ $slot->end_time->format('g:i A') }}</td>
                                            <td align="center"><b>{{ $slot->capacity }}</b></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif

                        {{-- ===== ORDER ITEMS ===== --}}
                        <p class="section-title">🛒 Order Items</p>
                        <table class="item-table">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th align="center" width="40">Qty</th>
                                    <th align="right" width="70">Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->items as $item)
                                    <tr>
                                        <td>
                                            <p class="item-name">{{ $item->item_name }}</p>
                                            @if ($item->size_name)
                                                <p class="item-desc">Size: {{ $item->size_name }}</p>
                                            @endif
                                            @if ($item->addons->count() > 0)
                                                <div class="addon-list">
                                                    @foreach ($item->addons as $addon)
                                                        <div>+ {{ $addon->quantity }}x {{ $addon->name }}
                                                            —
                                                            £{{ number_format($addon->price * $addon->quantity, 2) }}
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </td>
                                        <td align="center" style="font-size: 13px; color: #475569; font-weight: 600;">
                                            {{ $item->quantity }}</td>
                                        <td class="price">
                                            £{{ number_format($item->price * $item->quantity, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{-- ===== ORDER SUMMARY ===== --}}
                        <table class="summary-table">
                            <tr>
                                <td>Subtotal</td>
                                <td align="right">£{{ number_format($order->sub_total, 2) }}</td>
                            </tr>
                            @if ($order->discount_total > 0)
                                <tr>
                                    <td>Discount</td>
                                    <td align="right" style="color: #16a34a; font-weight: 600;">
                                        -£{{ number_format($order->discount_total, 2) }}</td>
                                </tr>
                            @endif
                            @if ($order->delivery_charges > 0)
                                <tr>
                                    <td>Delivery Fee</td>
                                    <td align="right">
                                        £{{ number_format($order->delivery_charges, 2) }}</td>
                                </tr>
                            @endif
                            @if ($order->tax_total > 0)
                                <tr>
                                    <td>Tax</td>
                                    <td align="right">
                                        £{{ number_format($order->tax_total, 2) }}</td>
                                </tr>
                            @endif
                            <tr class="total-row">
                                <td>Total</td>
                                <td align="right">£{{ number_format($order->grand_total, 2) }}</td>
                            </tr>
                        </table>

                        {{-- ================================================================ --}}
                        {{-- ===== COLLECTION INSTRUCTIONS (kerbside) ===== --}}
                        {{-- ================================================================ --}}
                        @if ($order->order_type == 'collection')
                            <div class="instructions-box">
                                <h3>📣 Collection Details</h3>

                                <p>Please let us know <b>5–6 minutes</b> before your arrival by texting
                                    your <b>full name used on the order</b> to
                                    <b><a href="tel:07451221187">07451221187</a></b>.
                                </p>

                                <p class="sub-heading">🕠 Time</p>
                                <p>
                                    @if ($order->order_date)
                                        <b>{{ \Carbon\Carbon::parse($order->order_date)->format('l, j M Y') }}</b>
                                    @endif
                                    @if ($order->time_slots && $order->time_slots->count() > 0)
                                        —
                                        <b>{{ $order->time_slots->first()->start_time->format('g:i A') }}
                                            –
                                            {{ $order->time_slots->first()->end_time->format('g:i A') }}</b>
                                    @endif
                                </p>
                                <p style="font-size: 11px; color: #64748b;">(We aim to be on time; slight
                                    delays may happen, and we'll keep you updated.)</p>

                                <p class="sub-heading">📍 Location</p>
                                <p>Google Maps – Search <b>"The Forest Tree"</b>, Chadderton, OL9 0HW,
                                    Oldham. Near the nursery car parking. Park somewhere near the kerb
                                    around here:</p>
                                <p><a
                                        href="https://maps.app.goo.gl/xHPGrVsnZm4Hcg9dA?g_st=ic">https://maps.app.goo.gl/xHPGrVsnZm4Hcg9dA</a>
                                </p>
                            </div>

                            {{-- Warning box --}}
                            <div class="warning-box">
                                <p><b>⚠️ IMPORTANT – DO NOT PARK INSIDE THE NURSERY CAR PARK</b></p>
                                <ul>
                                    <li>The nursery car park is private property.</li>
                                    <li>Please park only along the kerb nearby and stay close to the
                                        nursery; do not go too far ahead.</li>
                                    <li>Kindly leave once your food is collected, and please do not
                                        litter.</li>
                                </ul>
                            </div>

                            <div class="instructions-box" style="margin-top: 12px;">
                                <p class="sub-heading">🚘 Kerbside Service Only</p>
                                <ul>
                                    <li>Please remain in your car.</li>
                                    <li>We will bring your order directly to you.</li>
                                    <li>Do <b>NOT</b> get out or knock on doors — strictly kerbside
                                        service due to previous issues.</li>
                                </ul>
                                <p style="margin-top: 8px;">Thank you & see you soon! 😀</p>
                            </div>

                            {{-- ================================================================ --}}
                            {{-- ===== DELIVERY INSTRUCTIONS ===== --}}
                            {{-- ================================================================ --}}
                        @else
                            <div class="instructions-box">
                                <h3>📣 Delivery Details</h3>

                                <p>Please make sure you're available at your delivery address at the
                                    scheduled time. It is your responsibility to remain at the address and
                                    to text or call
                                    <b><a href="tel:07451221187">07451221187</a></b> if there are any
                                    issues.
                                </p>

                                <p class="sub-heading">🕠 Time</p>
                                <p>
                                    @if ($order->order_date)
                                        <b>{{ \Carbon\Carbon::parse($order->order_date)->format('l, j M Y') }}</b>
                                    @endif
                                    @if ($order->time_slots && $order->time_slots->count() > 0)
                                        —
                                        <b>{{ $order->time_slots->first()->start_time->format('g:i A') }}
                                            –
                                            {{ $order->time_slots->first()->end_time->format('g:i A') }}</b>
                                    @endif
                                </p>
                                <p style="font-size: 11px; color: #64748b;">(We aim to be on time; minor
                                    delays may happen, and we'll keep you updated.)</p>

                                <p class="sub-heading">📍 Address</p>
                                <p>
                                    <b>{{ $order->delivery_address }}@if ($order->city)
                                            , {{ $order->city }}
                                            @endif @if ($order->postal_code)
                                                , {{ $order->postal_code }}
                                            @endif
                                    </b>
                                </p>

                                <p style="margin-top: 10px;">Thank you for your order! We'll be in touch
                                    closer to the time. 😊</p>
                            </div>
                        @endif

                        {{-- ===== ORDER INSTRUCTIONS ===== --}}
                        @if ($order->order_instruction)
                            <div class="order-notes">
                                <p style="font-style: normal; font-weight: 700; color: #1e293b; margin-bottom: 4px;">
                                    📝 Order Instructions</p>
                                <p>"{{ $order->order_instruction }}"</p>
                            </div>
                        @endif

                        {{-- ===== VIEW ORDER BUTTON ===== --}}
                        <div style="text-align: center; margin-top: 24px;">
                            <a href="{{ config('app.frontend_url') }}/orders/{{ $order->id }}" class="btn">View
                                Order Details →</a>
                        </div>

                        {{-- ===== SIGN-OFF ===== --}}
                        <div class="sign-off">
                            <p>Many Thanks!</p>
                            <p class="team-name">The Chim 'N' Churri Team</p>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="footer">
                        <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
                        <p>Chim 'N' Churri — Steak, Sides, Sauce.</p>
                    </td>
                </tr>
            </table>
        </center>
    </div>
</body>

</html>
