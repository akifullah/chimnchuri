<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Order - #{{ $order->order_number }}</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            width: 100% !important;
            background-color: #0f0f0f;
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
            background-color: #0f0f0f;
            padding: 24px 0;
        }

        .main {
            background-color: #1a1a1a;
            margin: 0 auto;
            width: 100%;
            max-width: 600px;
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid #2a2a2a;
        }

        .header {
            background: linear-gradient(135deg, #1a1a1a 0%, #111111 100%);
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid #2a2a2a;
        }

        .header-title {
            color: #ffffff;
            font-size: 14px;
            font-weight: 700;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            margin: 8px 0 0;
        }

        .alert-banner {
            background-color: #396430;
            padding: 12px 16px;
            text-align: center;
        }

        .alert-banner p {
            color: #ffffff;
            font-size: 16px;
            font-weight: 800;
            margin: 0;
            letter-spacing: -0.02em;
        }

        .alert-banner .sub {
            font-size: 11px;
            font-weight: 400;
            color: rgba(255, 255, 255, 0.7);
            margin-top: 2px;
        }

        .content {
            padding: 20px;
        }

        .section-title {
            font-size: 11px;
            font-weight: 800;
            color: #888888;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            margin: 0 0 10px;
            padding-bottom: 6px;
            border-bottom: 1px solid #2a2a2a;
        }

        .meta-grid {
            width: 100%;
            margin-bottom: 20px;
        }

        .meta-grid td {
            padding: 6px 0;
            vertical-align: top;
        }

        .meta-label {
            font-size: 10px;
            font-weight: 700;
            color: #666666;
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }

        .meta-value {
            font-size: 13px;
            font-weight: 700;
            color: #e0e0e0;
            margin-top: 2px;
        }

        .badge {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 6px;
            font-size: 10px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }

        .badge-collection {
            background-color: rgba(14, 165, 233, 0.15);
            color: #38bdf8;
        }

        .badge-delivery {
            background-color: rgba(168, 85, 247, 0.15);
            color: #c084fc;
        }

        .badge-paid {
            background-color: rgba(34, 197, 94, 0.15);
            color: #4ade80;
        }

        .badge-pending {
            background-color: rgba(234, 179, 8, 0.15);
            color: #facc15;
        }

        .badge-cod {
            background-color: rgba(249, 115, 22, 0.15);
            color: #fb923c;
        }

        .badge-online {
            background-color: rgba(99, 102, 241, 0.15);
            color: #818cf8;
        }

        .item-table {
            width: 100%;
            margin-bottom: 16px;
        }

        .item-table th {
            text-align: left;
            font-size: 9px;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: #555555;
            border-bottom: 1px solid #2a2a2a;
            padding: 6px 0;
            font-weight: 700;
        }

        .item-table td {
            padding: 10px 0;
            border-bottom: 1px solid #1f1f1f;
            vertical-align: top;
        }

        .item-name {
            font-size: 13px;
            font-weight: 700;
            color: #ffffff;
            margin: 0;
        }

        .item-size {
            font-size: 11px;
            color: #777777;
            margin: 2px 0 0;
        }

        .addon-list {
            margin: 4px 0 0;
            padding-left: 10px;
            border-left: 2px solid #333333;
        }

        .addon-list div {
            font-size: 11px;
            color: #999999;
            margin: 2px 0;
        }

        .price {
            font-size: 13px;
            font-weight: 700;
            color: #e0e0e0;
            text-align: right;
        }

        .qty {
            font-size: 13px;
            font-weight: 700;
            color: #cccccc;
            text-align: center;
        }

        .summary-table {
            width: 100%;
            margin-top: 8px;
        }

        .summary-table td {
            font-size: 12px;
            color: #888888;
            padding: 4px 0;
        }

        .summary-table .total td {
            font-size: 16px;
            font-weight: 800;
            color: #ffffff;
            padding-top: 10px;
            border-top: 2px solid #333333;
        }

        .customer-box {
            background-color: #141414;
            border: 1px solid #2a2a2a;
            border-radius: 8px;
            padding: 14px;
            margin-bottom: 16px;
        }

        .customer-box p {
            font-size: 12px;
            color: #aaaaaa;
            margin: 3px 0;
            line-height: 1.5;
        }

        .customer-box .name {
            font-size: 14px;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 6px;
        }

        .slot-table {
            width: 100%;
            margin-bottom: 16px;
        }

        .slot-table th {
            text-align: left;
            font-size: 9px;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: #555555;
            padding: 4px 0;
            border-bottom: 1px solid #2a2a2a;
        }

        .slot-table td {
            font-size: 12px;
            color: #cccccc;
            padding: 6px 0;
            border-bottom: 1px solid #1f1f1f;
        }

        .instruction-box {
            background-color: #141414;
            border: 1px solid #333;
            border-left: 3px solid #396430;
            border-radius: 6px;
            padding: 10px 14px;
            margin-bottom: 16px;
        }

        .instruction-box .label {
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #666;
            margin: 0 0 4px;
        }

        .instruction-box p {
            font-size: 12px;
            color: #ccc;
            margin: 0;
            font-style: italic;
            line-height: 1.5;
        }

        .btn {
            background-color: #396430;
            color: #ffffff !important;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 800;
            font-size: 12px;
            display: inline-block;
            margin-top: 8px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .footer {
            padding: 16px;
            text-align: center;
            border-top: 1px solid #2a2a2a;
        }

        .footer p {
            font-size: 10px;
            color: #555555;
            margin: 2px 0;
        }

        .highlight-total {
            background: linear-gradient(135deg, rgba(57, 100, 48, 0.2) 0%, rgba(57, 100, 48, 0.05) 100%);
            border: 1px solid rgba(57, 100, 48, 0.3);
            border-radius: 8px;
            padding: 12px 16px;
            text-align: center;
            margin: 12px 0;
        }

        .highlight-total .amount {
            font-size: 28px;
            font-weight: 900;
            color: #4ade80;
            letter-spacing: -0.02em;
        }

        .highlight-total .label {
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: #666;
        }

        @media only screen and (max-width: 480px) {
            .wrapper {
                padding: 8px 0;
            }

            .main {
                border-radius: 0;
            }

            .header {
                padding: 14px;
            }

            .header img {
                height: 36px !important;
            }

            .header-title {
                font-size: 11px;
            }

            .alert-banner p {
                font-size: 13px;
            }

            .alert-banner .sub {
                font-size: 10px;
            }

            .content {
                padding: 14px;
            }

            .section-title {
                font-size: 10px;
                margin: 0 0 8px;
                padding-bottom: 4px;
            }

            .meta-label {
                font-size: 9px;
            }

            .meta-value {
                font-size: 11px;
            }

            .badge {
                font-size: 9px;
                padding: 2px 7px;
            }

            .highlight-total .amount {
                font-size: 22px;
            }

            .highlight-total .label {
                font-size: 9px;
            }

            .highlight-total {
                padding: 10px 12px;
            }

            .customer-box {
                padding: 10px;
            }

            .customer-box .name {
                font-size: 12px;
            }

            .customer-box p {
                font-size: 11px;
            }

            .item-name {
                font-size: 11px;
            }

            .item-size {
                font-size: 10px;
            }

            .addon-list div {
                font-size: 10px;
            }

            .price {
                font-size: 11px;
            }

            .qty {
                font-size: 11px;
            }

            .summary-table td {
                font-size: 11px;
            }

            .summary-table .total td {
                font-size: 14px;
            }

            .slot-table td {
                font-size: 11px;
            }

            .instruction-box .label {
                font-size: 9px;
            }

            .instruction-box p {
                font-size: 11px;
            }

            .btn {
                padding: 10px 18px;
                font-size: 11px;
            }

            .footer p {
                font-size: 9px;
            }
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <center>
            <table class="main" width="100%">
                {{-- Header --}}
                <tr>
                    <td class="header">
                        <img src="{{ $message->embed(public_path('admin/assets/images/chimnchurri.png')) }}"
                            height="50" alt="{{ config('app.name') }}">
                        <p class="header-title">Admin Order Notification</p>
                    </td>
                </tr>

                {{-- Alert Banner --}}
                <tr>
                    <td class="alert-banner">
                        <p>New Order #{{ $order->order_number }}</p>
                        <p class="sub">{{ $order->created_at->format('M d, Y \a\t h:i A') }}</p>
                    </td>
                </tr>

                <tr>
                    <td class="content">

                        {{-- Quick Stats --}}
                        <table class="meta-grid" width="100%">
                            <tr>
                                <td width="33%">
                                    <div class="meta-label">Order Type</div>
                                    <div style="margin-top: 4px;">
                                        @if ($order->order_type == 'collection')
                                            <span class="badge badge-collection">Collection</span>
                                        @else
                                            <span class="badge badge-delivery">Delivery</span>
                                        @endif
                                    </div>
                                </td>
                                <td width="33%">
                                    <div class="meta-label">Payment</div>
                                    <div style="margin-top: 4px;">
                                        @if ($order->payment_status == 'paid')
                                            <span class="badge badge-paid">Paid</span>
                                        @else
                                            <span
                                                class="badge badge-pending">{{ ucfirst($order->payment_status) }}</span>
                                        @endif
                                    </div>
                                </td>
                                <td width="33%">
                                    <div class="meta-label">Method</div>
                                    <div style="margin-top: 4px;">
                                        @if ($order->payment_method == 'cod')
                                            <span
                                                class="badge badge-cod">{{ $order->order_type == 'collection' ? 'Pay on Pickup' : 'COD' }}</span>
                                        @else
                                            <span class="badge badge-online">Online</span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="meta-label">Steak Qty</div>
                                    <div class="meta-value">{{ $order->steak_qty }} steaks</div>
                                </td>
                                <td>
                                    <div class="meta-label">Items</div>
                                    <div class="meta-value">{{ $order->items->count() }} items</div>
                                </td>
                                <td>
                                    <div class="meta-label">Order Status</div>
                                    <div class="meta-value" style="text-transform: capitalize;">
                                        {{ $order->order_status }}</div>
                                </td>
                            </tr>
                        </table>

                        {{-- Grand Total Highlight --}}
                        <div class="highlight-total">
                            <div class="label">Grand Total</div>
                            <div class="amount">£{{ number_format($order->grand_total, 2) }}</div>
                        </div>

                        {{-- Customer Details --}}
                        <p class="section-title">Customer Details</p>
                        <div class="customer-box">
                            <p class="name">{{ $order->customer_name }}</p>
                            <p>{{ $order->customer_email ?? 'N/A' }}</p>
                            @if ($order->customer_phone)
                                <p>{{ $order->customer_phone }}</p>
                            @endif
                            @if ($order->order_type == 'delivery')
                                <p style="margin-top: 8px; padding-top: 8px; border-top: 1px solid #2a2a2a;">
                                    {{ $order->delivery_address }}@if ($order->city)
                                        , {{ $order->city }}
                                        @endif @if ($order->postal_code)
                                            , {{ $order->postal_code }}
                                        @endif
                                </p>
                            @elseif ($order->pickup_address)
                                <p style="margin-top: 8px; padding-top: 8px; border-top: 1px solid #2a2a2a;">
                                    Pickup: <strong>{{ $order->pickup_address }}</strong>
                                </p>
                            @endif
                        </div>

                        {{-- Time Slots --}}
                        @if ($order->time_slots && $order->time_slots->count() > 0)
                            <p class="section-title">Time Slots</p>
                            <table class="slot-table">
                                <thead>
                                    <tr>
                                        <th>Slot</th>
                                        <th align="center" width="60">Qty</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order->time_slots as $slot)
                                        <tr>
                                            <td>{{ $slot->start_time->format('g:i A') }} –
                                                {{ $slot->end_time->format('g:i A') }}</td>
                                            <td align="center"><strong>{{ $slot->capacity }}</strong></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif

                        {{-- Order Items --}}
                        <p class="section-title">Order Items</p>
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
                                                <p class="item-size">Size: {{ $item->size_name }}</p>
                                            @endif
                                            @if ($item->addons->count() > 0)
                                                <div class="addon-list">
                                                    @foreach ($item->addons as $addon)
                                                        <div>+
                                                            {{ $addon->quantity > 1 ? $addon->quantity . 'x ' : '' }}{{ $addon->name }}
                                                            — £{{ number_format($addon->price * $addon->quantity, 2) }}
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </td>
                                        <td class="qty">{{ $item->quantity }}</td>
                                        <td class="price">£{{ number_format($item->price * $item->quantity, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{-- Summary --}}
                        <table class="summary-table">
                            <tr>
                                <td>Subtotal</td>
                                <td align="right" style="color: #ccc;">£{{ number_format($order->sub_total, 2) }}</td>
                            </tr>
                            @if ($order->discount_total > 0)
                                <tr>
                                    <td>Discount</td>
                                    <td align="right" style="color: #4ade80;">
                                        -£{{ number_format($order->discount_total, 2) }}</td>
                                </tr>
                            @endif
                            @if ($order->delivery_charges > 0)
                                <tr>
                                    <td>Delivery Fee</td>
                                    <td align="right" style="color: #ccc;">
                                        £{{ number_format($order->delivery_charges, 2) }}</td>
                                </tr>
                            @endif
                            @if ($order->tax_total > 0)
                                <tr>
                                    <td>Tax</td>
                                    <td align="right" style="color: #ccc;">£{{ number_format($order->tax_total, 2) }}
                                    </td>
                                </tr>
                            @endif
                            <tr class="total">
                                <td>Total</td>
                                <td align="right">£{{ number_format($order->grand_total, 2) }}</td>
                            </tr>
                        </table>

                        {{-- Order Instructions --}}
                        @if ($order->order_instruction)
                            <div class="instruction-box" style="margin-top: 16px;">
                                <p class="label">Order Instructions</p>
                                <p>"{{ $order->order_instruction }}"</p>
                            </div>
                        @endif

                        {{-- Action Button --}}
                        <div style="text-align: center; margin-top: 20px;">
                            <a href="{{ config('app.url') }}/admin/orders/{{ $order->id }}" class="btn">View in
                                Admin Panel</a>
                        </div>
                    </td>
                </tr>

                {{-- Footer --}}
                <tr>
                    <td class="footer">
                        <p>This is an automated admin notification from {{ config('app.name') }}</p>
                        <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
                    </td>
                </tr>
            </table>
        </center>
    </div>
</body>

</html>
