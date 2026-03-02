<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation - #{{ $order->order_number }}</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            width: 100% !important;
            background-color: #f8fafc;
            font-family: 'Instrument Sans', -apple-system, sans-serif;
            -webkit-font-smoothing: antialiased;
        }

        table {
            border-spacing: 0;
            border-collapse: collapse;
        }

        .wrapper {
            width: 100%;
            table-layout: fixed;
            background-color: #f8fafc;
            padding-bottom: 16px;
        }

        .main {
            background-color: #ffffff;
            margin: 0 auto;
            width: 100%;
            max-width: 560px;
            border-radius: 10px;
            overflow: hidden;
            border: 1px solid #e2e8f0;
        }

        .header {
            padding: 14px;
            text-align: center;
            border-bottom: 1px solid #f1f5f9;
        }

        .content {
            padding: 16px;
        }

        h1 {
            font-size: 18px;
            font-weight: 700;
            margin: 0 0 6px;
            color: #0f172a;
            text-align: center;
        }

        p {
            font-size: 12px;
            line-height: 1.4;
            margin: 0 0 8px;
            color: #475569;
        }

        .order-meta {
            background-color: #f1f5f9;
            padding: 8px 10px;
            border-radius: 6px;
            margin-bottom: 12px;
        }

        .order-meta td {
            font-size: 11px;
            padding: 1px 4px;
            color: #64748b;
        }

        .order-meta b {
            color: #0f172a;
        }

        .section-title {
            font-size: 12px;
            font-weight: 700;
            color: #0f172a;
            margin: 0 0 6px;
            padding-bottom: 4px;
            border-bottom: 1px solid #f1f5f9;
        }

        .item-table {
            width: 100%;
            margin-bottom: 10px;
        }

        .item-table th {
            text-align: left;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #94a3b8;
            border-bottom: 1px solid #f1f5f9;
            padding: 4px 0;
        }

        .item-table td {
            padding: 6px 0;
            border-bottom: 1px solid #f8fafc;
            vertical-align: top;
        }

        .item-name {
            font-size: 12px;
            font-weight: 600;
            color: #1e293b;
            margin: 0;
        }

        .item-desc {
            font-size: 11px;
            color: #64748b;
            margin: 1px 0 0;
        }

        .addon-list {
            font-size: 10px;
            color: #64748b;
            margin: 3px 0 0;
            padding-left: 8px;
            border-left: 2px solid #e2e8f0;
        }

        .addon-list div {
            margin: 1px 0;
        }

        .price {
            font-size: 12px;
            font-weight: 600;
            color: #1e293b;
            text-align: right;
        }

        .summary-table {
            width: 100%;
            margin-top: 6px;
            border-top: 2px solid #f1f5f9;
            padding-top: 6px;
        }

        .summary-table td {
            font-size: 12px;
            color: #64748b;
            padding: 2px 0;
        }

        .summary-table .total {
            font-size: 14px;
            font-weight: 700;
            color: #396430;
        }

        .info-box {
            font-size: 11px;
            color: #64748b;
            line-height: 1.4;
            background-color: #f8fafc;
            padding: 8px 10px;
            border-radius: 6px;
            margin-bottom: 10px;
        }

        .info-box p {
            font-size: 11px;
            margin: 2px 0;
        }

        .slot-table {
            width: 100%;
            margin-bottom: 10px;
        }

        .slot-table th {
            text-align: left;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            color: #94a3b8;
            padding: 3px 0;
            border-bottom: 1px solid #f1f5f9;
        }

        .slot-table td {
            font-size: 11px;
            color: #475569;
            padding: 4px 0;
            border-bottom: 1px solid #f8fafc;
        }

        .badge {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.03em;
        }

        .badge-delivery {
            background-color: #dbeafe;
            color: #1d4ed8;
        }

        .badge-collection {
            background-color: #ccfbf1;
            color: #0f766e;
        }

        .btn {
            background-color: #396430;
            color: #ffffff !important;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 700;
            font-size: 12px;
            display: inline-block;
            margin-top: 6px;
        }

        .footer {
            padding: 12px;
            text-align: center;
            font-size: 10px;
            color: #94a3b8;
        }

        .footer p {
            font-size: 10px;
            margin: 2px 0;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <center>
            <table class="main" width="100%">
                <tr>
                    <td class="header">
                        <img src="{{ $message->embed(public_path('admin/assets/images/chimnchurri.png')) }}"
                            height="60" alt="{{ config('app.name') }}">
                    </td>
                </tr>
                <tr>
                    <td class="content">
                        <h1>Thank you for your order!</h1>
                        <p style="text-align:center;">Hi {{ $order->customer_name }}, your order has been received and
                            is being processed.</p>

                        {{-- Order Meta --}}
                        <table class="order-meta" width="100%">
                            <tr>
                                <td>Order: <b>#{{ $order->order_number }}</b></td>
                                <td align="right">Date: <b>{{ $order->created_at->format('M d, Y') }}</b></td>
                            </tr>
                            <tr>
                                <td>Payment: <b>{{ ucfirst($order->payment_status) }}</b></td>
                                <td align="right">Method:
                                    <b>{{ $order->payment_method == 'cod' ? ($order->order_type == 'collection' ? 'Pay on Pickup' : 'COD') : 'Online Payment' }}</b>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Type:
                                    @if ($order->order_type == 'collection')
                                        <span class="badge badge-collection">Collection</span>
                                    @else
                                        <span class="badge badge-delivery">Delivery</span>
                                    @endif
                                </td>
                                <td align="right">Items: <b>{{ $order->steak_qty }}</b></td>
                            </tr>
                        </table>

                        {{-- Time Slots --}}
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

                        {{-- Items --}}
                        <p class="section-title">🛒 Order Items</p>
                        <table class="item-table">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th align="center" width="35">Qty</th>
                                    <th align="right" width="65">Price</th>
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
                                                        <div>+ {{ $addon->quantity > 1 ? $addon->quantity . 'x ' : '' }}{{ $addon->name }} — £{{ number_format($addon->price * $addon->quantity, 2) }}</div>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </td>
                                        <td align="center" style="font-size: 12px; color: #475569;">
                                            {{ $item->quantity }}</td>
                                        <td class="price">£{{ number_format($item->price * $item->quantity, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{-- Summary --}}
                        <table class="summary-table">
                            <tr>
                                <td>Subtotal</td>
                                <td align="right">£{{ number_format($order->sub_total, 2) }}</td>
                            </tr>
                            @if ($order->discount_total > 0)
                                <tr>
                                    <td>Discount</td>
                                    <td align="right" style="color: #16a34a;">
                                        -£{{ number_format($order->discount_total, 2) }}</td>
                                </tr>
                            @endif
                            @if ($order->delivery_charges > 0)
                                <tr>
                                    <td>Delivery Fee</td>
                                    <td align="right">£{{ number_format($order->delivery_charges, 2) }}</td>
                                </tr>
                            @endif
                            @if ($order->tax_total > 0)
                                <tr>
                                    <td>Tax</td>
                                    <td align="right">£{{ number_format($order->tax_total, 2) }}</td>
                                </tr>
                            @endif
                            <tr>
                                <td class="total">Total</td>
                                <td align="right" class="total">£{{ number_format($order->grand_total, 2) }}</td>
                            </tr>
                        </table>

                        {{-- Address Section --}}
                        <div style="margin-top: 12px;">
                            @if ($order->order_type == 'collection')
                                <p class="section-title">📍 Collection Details</p>
                                <div class="info-box">
                                    <p><b>{{ $order->customer_name }}</b></p>
                                    <p>📞 {{ $order->customer_phone }}</p>
                                    <p>✉️ {{ $order->customer_email ?? 'N/A' }}</p>
                                    @if ($order->pickup_address)
                                        <p style="margin-top: 4px; padding-top: 4px; border-top: 1px solid #e2e8f0;">
                                            🏪 Pickup: <b>{{ $order->pickup_address }}</b>
                                        </p>
                                    @endif
                                </div>
                            @else
                                <p class="section-title">📍 Delivery Details</p>
                                <div class="info-box">
                                    <p><b>{{ $order->customer_name }}</b></p>
                                    <p>📞 {{ $order->customer_phone }}</p>
                                    <p>✉️ {{ $order->customer_email ?? 'N/A' }}</p>
                                    <p style="margin-top: 4px; padding-top: 4px; border-top: 1px solid #e2e8f0;">
                                        🚚 {{ $order->delivery_address }}@if ($order->city)
                                            , {{ $order->city }}
                                            @endif @if ($order->postal_code)
                                                , {{ $order->postal_code }}
                                            @endif
                                    </p>
                                </div>
                            @endif
                        </div>

                        @if ($order->order_instruction)
                            <div style="margin-top: 10px;">
                                <p class="section-title">Order Instructions</p>
                                <div class="info-box" style="font-style: italic;">
                                    <p>"{{ $order->order_instruction }}"</p>
                                </div>
                            </div>
                        @endif

                        <div style="text-align: center; margin-top: 16px;">
                            <a href="{{ config('app.frontend_url') }}/orders/{{ $order->id }}" class="btn">View
                                Order Details</a>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="footer">
                        <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
                        <p>Chimnchurri - Steak, Sides, Sauce.</p>
                    </td>
                </tr>
            </table>
        </center>
    </div>
</body>

</html>
