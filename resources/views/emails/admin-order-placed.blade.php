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

        .wrapper {
            width: 100%;
            table-layout: fixed;
            background-color: #f0f4f0;
            padding: 28px 0;
        }

        .main {
            background-color: #ffffff;
            margin: 0 auto;
            width: 100%;
            max-width: 600px;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 8px 32px rgba(57, 100, 48, 0.10), 0 2px 8px rgba(0, 0, 0, 0.04);
        }

        /* === HEADER === */
        .header {
            background: linear-gradient(135deg, #396430 0%, #4a7a3e 40%, #2d5026 100%);
            padding: 24px 20px;
            text-align: center;
        }

        .header-title {
            color: rgba(255, 255, 255, 0.88);
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            margin: 8px 0 0;
        }

        /* === ALERT BANNER === */
        .alert-banner {
            background-color: #fafcfa;
            border-bottom: 1px solid #e5ede3;
            padding: 16px 20px;
            text-align: center;
        }

        .alert-banner p {
            color: #1e293b;
            font-size: 18px;
            font-weight: 800;
            margin: 0;
            letter-spacing: -0.02em;
        }

        .alert-banner .sub {
            font-size: 12px;
            font-weight: 400;
            color: #64748b;
            margin-top: 4px;
        }

        /* === CONTENT === */
        .content {
            padding: 20px;
        }

        /* === SECTION TITLES === */
        .section-title {
            font-size: 11px;
            font-weight: 800;
            color: #396430;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            margin: 0 0 10px;
            padding-bottom: 6px;
            border-bottom: 2px solid #e5ede3;
        }

        /* === META GRID === */
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
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }

        .meta-value {
            font-size: 13px;
            font-weight: 700;
            color: #1e293b;
            margin-top: 2px;
        }

        /* === BADGES === */
        .badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }

        .badge-collection {
            background-color: #d1fae5;
            color: #047857;
        }

        .badge-delivery {
            background-color: #dbeafe;
            color: #1d4ed8;
        }

        .badge-paid {
            background-color: #d1fae5;
            color: #047857;
        }

        .badge-pending {
            background-color: #fef3c7;
            color: #92400e;
        }

        .badge-cod {
            background-color: #ffedd5;
            color: #c2410c;
        }

        .badge-online {
            background-color: #e0e7ff;
            color: #4338ca;
        }

        /* === HIGHLIGHT TOTAL === */
        .highlight-total {
            background: linear-gradient(135deg, #f0f7ef 0%, #e8f5e6 100%);
            border: 1px solid #d4e5d0;
            border-radius: 16px;
            padding: 14px 18px;
            text-align: center;
            margin: 16px 0;
            box-shadow: 0 1px 4px rgba(57, 100, 48, 0.06);
        }

        .highlight-total .amount {
            font-size: 28px;
            font-weight: 900;
            color: #396430;
            letter-spacing: -0.02em;
        }

        .highlight-total .label {
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: #64748b;
        }

        /* === CUSTOMER BOX === */
        .customer-box {
            background-color: #fafcfa;
            border-radius: 16px;
            padding: 16px;
            margin-bottom: 16px;
            box-shadow: 0 1px 4px rgba(57, 100, 48, 0.06);
        }

        .customer-box p {
            font-size: 12.5px;
            color: #475569;
            margin: 3px 0;
            line-height: 1.5;
        }

        .customer-box .name {
            font-size: 14px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 6px;
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

        .item-size {
            font-size: 11px;
            color: #64748b;
            margin: 2px 0 0;
        }

        .price {
            font-size: 13px;
            font-weight: 600;
            color: #1e293b;
            text-align: right;
        }

        .qty {
            font-size: 13px;
            font-weight: 600;
            color: #475569;
            text-align: center;
        }

        /* === SLOT TABLE === */
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

        .summary-table .total td {
            font-size: 16px;
            font-weight: 700;
            color: #396430;
            padding-top: 10px;
            border-top: 2px solid #e5ede3;
        }

        /* === INSTRUCTIONS BOX === */
        .instructions-box {
            background: linear-gradient(135deg, #fafcfa 0%, #f0f7ef 100%);
            border: 1px solid #d4e5d0;
            border-left: 4px solid #396430;
            border-radius: 0 16px 16px 0;
            padding: 20px 18px;
            margin: 20px 0;
            box-shadow: 0 1px 4px rgba(57, 100, 48, 0.06);
        }

        .instructions-box h3 {
            font-size: 15px;
            font-weight: 700;
            color: #2d5026;
            margin: 0 0 14px;
        }

        .instructions-box p,
        .instructions-box li {
            font-size: 12.5px;
            color: #475569;
            line-height: 1.6;
            margin: 0 0 6px;
        }

        .instructions-box a {
            color: #1d4ed8;
            text-decoration: underline;
        }

        .instructions-box b {
            color: #1e293b;
        }

        .instructions-box ul {
            padding-left: 18px;
            margin: 6px 0 12px;
        }

        .instructions-box li {
            margin-bottom: 4px;
        }

        .instructions-box .sub-heading {
            font-size: 13px;
            font-weight: 700;
            color: #1e293b;
            margin: 14px 0 4px;
        }

        /* === WARNING BOX === */
        .warning-box {
            background-color: #fef3c7;
            border: 1px solid #fcd34d;
            border-radius: 16px;
            padding: 14px 16px;
            margin: 12px 0;
            box-shadow: 0 1px 4px rgba(250, 204, 21, 0.15);
        }

        .warning-box p,
        .warning-box li {
            font-size: 12.5px;
            color: #92400e;
            line-height: 1.5;
            margin: 0 0 4px;
        }

        .warning-box b {
            color: #78350f;
        }

        .warning-box ul {
            padding-left: 18px;
            margin: 6px 0;
        }

        /* === ORDER NOTES === */
        .instruction-box {
            background-color: #f8fafc;
            border: 1px dashed #cbd5e1;
            border-radius: 16px;
            padding: 14px 16px;
            margin-bottom: 16px;
        }

        .instruction-box .label {
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #64748b;
            margin: 0 0 4px;
        }

        .instruction-box p {
            font-size: 12.5px;
            color: #475569;
            margin: 0;
            font-style: italic;
            line-height: 1.5;
        }

        /* === CTA BUTTON === */
        .btn {
            background: linear-gradient(135deg, #396430 0%, #4a7a3e 100%);
            color: #ffffff !important;
            padding: 13px 28px;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 700;
            font-size: 13px;
            display: inline-block;
            margin-top: 8px;
            letter-spacing: 0.3px;
            box-shadow: 0 4px 12px rgba(57, 100, 48, 0.25);
        }

        /* === SIGN-OFF === */
        .sign-off {
            text-align: center;
            padding: 22px 0 6px;
            border-top: 1px solid #f1f5f9;
            margin-top: 24px;
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
            padding: 18px 22px;
            text-align: center;
            border-top: 1px solid #e5ede3;
        }

        .footer p {
            font-size: 10px;
            color: #94a3b8;
            margin: 2px 0;
        }

        /* === MOBILE === */
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
                font-size: 14px;
            }

            .content {
                padding: 14px;
            }

            .section-title {
                font-size: 10px;
            }

            .meta-label {
                font-size: 9px;
            }

            .meta-value {
                font-size: 11px;
            }

            .badge {
                font-size: 9px;
                padding: 2px 8px;
            }

            .highlight-total .amount {
                font-size: 22px;
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

            .item-name {
                font-size: 11px;
            }

            .price,
            .qty {
                font-size: 11px;
            }

            .summary-table .total td {
                font-size: 14px;
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
                        {{-- <img src="{{ $message->embed(public_path('admin/assets/images/chimnchurri.png')) }}"
                            height="50" alt="{{ config('app.name') }}"> --}}
                        <p class="header-title">Admin Order Notification</p>
                    </td>
                </tr>

                {{-- Alert Banner --}}
                <tr>
                    <td class="alert-banner">
                        <p>📦 New Order #{{ $order->order_number }}</p>
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
                                    <div class="meta-label">Status</div>
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

                        {{-- Order Date --}}
                        @if ($order->order_date)
                            <table width="100%"
                                style="margin-bottom: 20px; background-color: #fafcfa; border-radius: 16px; padding: 12px 18px; box-shadow: 0 1px 4px rgba(57, 100, 48, 0.06);">
                                <tr>
                                    <td style="font-size: 12px; color: #64748b;">📅 Order Date</td>
                                    <td align="right" style="font-size: 13px; font-weight: 700; color: #1e293b;">
                                        {{ \Carbon\Carbon::parse($order->order_date)->format('l, j M Y') }}
                                    </td>
                                </tr>
                            </table>
                        @endif

                        {{-- Customer Details --}}
                        <p class="section-title">👤 Customer Details</p>
                        <div class="customer-box">
                            <p class="name">{{ $order->customer_name }}</p>
                            <p>📞 {{ $order->customer_phone }}</p>
                            <p>✉️ {{ $order->customer_email ?? 'N/A' }}</p>
                            @if ($order->order_type == 'collection' && $order->car_registration)
                                <p style="margin-top: 8px; padding-top: 8px; border-top: 1px solid #e5ede3;">
                                    🚗 Car Reg: <strong>{{ $order->car_registration }}</strong>
                                </p>
                            @endif
                            @if ($order->order_type == 'delivery')
                                <p style="margin-top: 8px; padding-top: 8px; border-top: 1px solid #e5ede3;">
                                    🚚 {{ $order->delivery_address }}@if ($order->city)
                                        , {{ $order->city }}
                                        @endif @if ($order->postal_code)
                                            , {{ $order->postal_code }}
                                        @endif
                                </p>
                            @endif
                        </div>

                        {{-- Time Slots --}}
                        @if ($order->time_slots && $order->time_slots->count() > 0)
                            <p class="section-title">⏰ Time Slots</p>
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
                                            <td>{{ $slot->start_time->format('g:i A') }}</td>
                                            <td align="center"><strong>{{ $slot->capacity }}</strong></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif

                        {{-- Order Items --}}
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
                                                <p class="item-size">Size: {{ $item->size_name }}</p>
                                            @endif
                                        </td>
                                        <td class="qty">{{ $item->quantity }}</td>
                                        <td class="price">£{{ number_format($item->price * $item->quantity, 2) }}</td>
                                    </tr>
                                    @if ($item->addons->count() > 0)
                                        @foreach ($item->addons as $addon)
                                            <tr>
                                                <td
                                                    style="padding: 2px 0 2px 10px; border-bottom: none; border-left: 2px solid #396430;">
                                                    <span style="font-size: 11px; color: #64748b;">+
                                                        {{ $addon->quantity }}x {{ $addon->name }}</span>
                                                </td>
                                                <td style="border-bottom: none;"></td>
                                                <td align="right"
                                                    style="font-size: 11px; font-weight: 600; color: #1e293b; padding: 2px 0; border-bottom: none; white-space: nowrap;">
                                                    £{{ number_format($addon->price * $addon->quantity, 2) }}</td>
                                            </tr>
                                        @endforeach
                                    @endif
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
                                    <td align="right" style="color: #16a34a; font-weight: 600;">
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
                            <tr class="total">
                                <td>Total</td>
                                <td align="right">£{{ number_format($order->grand_total, 2) }}</td>
                            </tr>
                        </table>

                        {{-- ===== COLLECTION INSTRUCTIONS ===== --}}
                        @if ($order->order_type == 'collection')
                            <div class="instructions-box">
                                <h3>📣 Collection Details</h3>

                                <p>Customer should text <b>full name used on the order</b> to
                                    <b><a href="tel:07451221187">07451221187</a></b> 5–6 minutes before arrival.
                                </p>

                                <p class="sub-heading">🕠 Time</p>
                                <p>
                                    @if ($order->order_date)
                                        <b>{{ \Carbon\Carbon::parse($order->order_date)->format('l, j M Y') }}</b>
                                    @endif
                                    @if ($order->time_slots && $order->time_slots->count() > 0)
                                        —
                                        <b>{{ $order->time_slots->first()->start_time->format('g:i A') }}</b>
                                    @endif
                                </p>

                                <p class="sub-heading">📍 Location</p>
                                <p>Google Maps – Search <b>"The Forest Tree"</b>, Chadderton, OL9 0HW, Oldham. Kerbside
                                    service.</p>
                                <p><a
                                        href="https://maps.app.goo.gl/xHPGrVsnZm4Hcg9dA?g_st=ic">https://maps.app.goo.gl/xHPGrVsnZm4Hcg9dA</a>
                                </p>
                            </div>

                            <div class="warning-box">
                                <p><b>⚠️ IMPORTANT – DO NOT PARK INSIDE THE NURSERY CAR PARK</b></p>
                                <ul>
                                    <li>The nursery car park is private property.</li>
                                    <li>Please park only along the kerb nearby and stay close to the nursery.</li>
                                    <li>Kindly leave once food is collected, and please do not litter.</li>
                                </ul>
                            </div>

                            <div class="instructions-box" style="margin-top: 12px;">
                                <p class="sub-heading">🚘 Kerbside Service Only</p>
                                <ul>
                                    <li>Customer to remain in car.</li>
                                    <li>Order brought directly to them.</li>
                                    <li>Do <b>NOT</b> get out or knock on doors — strictly kerbside.</li>
                                </ul>
                            </div>

                            {{-- ===== DELIVERY INSTRUCTIONS ===== --}}
                        @else
                            <div class="instructions-box">
                                <h3>📣 Delivery Details</h3>

                                <p>Customer must be available at delivery address. Contact
                                    <b><a href="tel:07451221187">07451221187</a></b> for any issues.
                                </p>

                                <p class="sub-heading">🕠 Time</p>
                                <p>
                                    @if ($order->order_date)
                                        <b>{{ \Carbon\Carbon::parse($order->order_date)->format('l, j M Y') }}</b>
                                    @endif
                                    @if ($order->time_slots && $order->time_slots->count() > 0)
                                        —
                                        <b>{{ $order->time_slots->first()->start_time->format('g:i A') }}</b>
                                    @endif
                                </p>

                                <p class="sub-heading">📍 Address</p>
                                <p>
                                    <b>{{ $order->delivery_address }}@if ($order->city)
                                            , {{ $order->city }}
                                            @endif @if ($order->postal_code)
                                                , {{ $order->postal_code }}
                                            @endif
                                    </b>
                                </p>
                            </div>
                        @endif

                        {{-- Order Instructions --}}
                        @if ($order->order_instruction)
                            <div class="instruction-box" style="margin-top: 16px;">
                                <p class="label">📝 Order Instructions</p>
                                <p>"{{ $order->order_instruction }}"</p>
                            </div>
                        @endif

                        {{-- Action Button --}}
                        <div style="text-align: center; margin-top: 20px;">
                            <a href="{{ config('app.url') }}/admin/orders/{{ $order->id }}" class="btn">View in
                                Admin Panel →</a>
                        </div>

                        {{-- Sign Off --}}
                        <div class="sign-off">
                            <p>Many Thanks!</p>
                            <p class="team-name">The Chim 'N' Churri Team</p>
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
