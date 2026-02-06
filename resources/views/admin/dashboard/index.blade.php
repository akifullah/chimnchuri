@extends('admin.layouts.app')


@section('style')
@endsection


@section('content')
    <!-- Start here.... -->
    <div class="row">
        <div class="col-xxl-12">
            <div class="row">
                <div class="col-md-3">
                    <div class="card overflow-hidden">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="avatar-md bg-soft-primary rounded">
                                        <iconify-icon icon="solar:cart-5-bold-duotone"
                                            class="avatar-title fs-32 text-primary"></iconify-icon>
                                    </div>
                                </div> <!-- end col -->
                                <div class="col-6 text-end">
                                    <p class="text-muted mb-0 text-truncate">Total Orders</p>
                                    <h3 class="text-dark mt-1 mb-0">{{ $totalOrders }}</h3>
                                </div> <!-- end col -->
                            </div> <!-- end row-->
                        </div> <!-- end card body -->
                        <div class="card-footer py-2 bg-light bg-opacity-50">
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    @if ($orderWeekChange >= 0)
                                        <span class="text-success"> <i class="bx bxs-up-arrow fs-12"></i>
                                            {{ $orderWeekChange }}%</span>
                                        <span class="text-muted ms-1 fs-12">Last Week</span>
                                    @else
                                        <span class="text-danger"> <i class="bx bxs-down-arrow fs-12"></i>
                                            {{ abs($orderWeekChange) }}%</span>
                                        <span class="text-muted ms-1 fs-12">Last Week</span>
                                    @endif
                                </div>
                                <a href="{{ route('admin.orders') }}" class="text-reset fw-semibold fs-12">View
                                    More</a>
                            </div>
                        </div> <!-- end card body -->
                    </div> <!-- end card -->
                </div> <!-- end col -->
                <div class="col-md-3">
                    <div class="card overflow-hidden">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="avatar-md bg-soft-primary rounded">
                                        <i class="bx bx-award avatar-title fs-24 text-primary"></i>
                                    </div>
                                </div> <!-- end col -->
                                <div class="col-6 text-end">
                                    <p class="text-muted mb-0 text-truncate">Today Orders</p>
                                    <h3 class="text-dark mt-1 mb-0">{{ $totalOrders }}</h3>
                                </div> <!-- end col -->
                            </div> <!-- end row-->
                        </div> <!-- end card body -->
                        <div class="card-footer py-2 bg-light bg-opacity-50">
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    <span class="text-success"> <i class="bx bxs-up-arrow fs-12"></i>
                                        8.1%</span>
                                    <span class="text-muted ms-1 fs-12">Last Month</span>
                                </div>
                                <a href="#!" class="text-reset fw-semibold fs-12">View More</a>
                            </div>
                        </div> <!-- end card body -->
                    </div> <!-- end card -->
                </div> <!-- end col -->
                <div class="col-md-3">
                    <div class="card overflow-hidden">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="avatar-md bg-soft-primary rounded">
                                        <i class="bx bxs-backpack avatar-title fs-24 text-primary"></i>
                                    </div>
                                </div> <!-- end col -->
                                <div class="col-6 text-end">
                                    <p class="text-muted mb-0 text-truncate">Pending Orders</p>
                                    <h3 class="text-dark mt-1 mb-0">{{ $pendingOrders }}</h3>
                                </div> <!-- end col -->
                            </div> <!-- end row-->
                        </div> <!-- end card body -->
                        <div class="card-footer py-2 bg-light bg-opacity-50">
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    @if ($pendingChange > 0)
                                        <span class="text-success"> <i class="bx bxs-up-arrow fs-12"></i>
                                            {{ $pendingChange }}%</span>
                                        <span class="text-muted ms-1 fs-12">Last Month</span>
                                    @else
                                        <span class="text-danger"> <i class="bx bxs-down-arrow fs-12"></i>
                                            {{ $pendingChange }}%</span>
                                        <span class="text-muted ms-1 fs-12">Last Month</span>
                                    @endif
                                </div>
                                <a href="#!" class="text-reset fw-semibold fs-12">View More</a>
                            </div>
                        </div> <!-- end card body -->
                    </div> <!-- end card -->
                </div> <!-- end col -->
                <div class="col-md-3">
                    <div class="card overflow-hidden">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="avatar-md bg-soft-primary rounded">
                                        <i class="bx bx-dollar-circle avatar-title text-primary fs-24"></i>
                                    </div>
                                </div> <!-- end col -->
                                <div class="col-6 text-end">
                                    <p class="text-muted mb-0 text-truncate">Total Revenue</p>
                                    <h3 class="text-dark mt-1 mb-0"> £ {{ $totalRevenue }}</h3>
                                </div> <!-- end col -->
                            </div> <!-- end row-->
                        </div> <!-- end card body -->
                        <div class="card-footer py-2 bg-light bg-opacity-50">
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    @if ($revenueChange >= 0)
                                        <span class="text-success"> <i class="bx bxs-up-arrow fs-12"></i>
                                            {{ $revenueChange }}%</span>
                                        <span class="text-muted ms-1 fs-12">Last Month</span>
                                    @else
                                        <span class="text-danger"> <i class="bx bxs-down-arrow fs-12"></i>
                                            {{ abs($revenueChange) }}%</span>
                                        <span class="text-muted ms-1 fs-12">Last Month</span>
                                    @endif
                                </div>
                                <a href="#!" class="text-reset fw-semibold fs-12">View More</a>
                            </div>
                        </div> <!-- end card body -->
                    </div> <!-- end card -->
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div> <!-- end col -->

        <div class="col-xxl-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Monthly Sales</h4>
                        {{-- <div>
                            <button type="button" class="btn btn-sm btn-outline-light">ALL</button>
                            <button type="button" class="btn btn-sm btn-outline-light">1M</button>
                            <button type="button" class="btn btn-sm btn-outline-light">6M</button>
                            <button type="button" class="btn btn-sm btn-outline-light active">1Y</button>
                        </div> --}}
                    </div> <!-- end card-title-->

                    <div dir="ltr">
                        <div id="dash-performance-chart" class="apex-charts"></div>
                    </div>
                </div> <!-- end card body -->
            </div> <!-- end card -->
        </div> <!-- end col -->
    </div> <!-- end row -->

    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Conversions</h5>
                    <div id="conversions" class="apex-charts mb-2 mt-n2"></div>
                    <div class="row text-center">
                        <div class="col-6">
                            <p class="text-muted mb-2">This Week</p>
                            <h3 class="text-dark mb-3">23.5k</h3>
                        </div> <!-- end col -->
                        <div class="col-6">
                            <p class="text-muted mb-2">Last Week</p>
                            <h3 class="text-dark mb-3">41.05k</h3>
                        </div> <!-- end col -->
                    </div> <!-- end row -->
                </div>
            </div>
        </div> <!-- end left chart card -->

        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Sessions by Country</h5>
                    <div id="world-map-markers" style="height: 316px">
                    </div>
                    <div class="row text-center">
                        <div class="col-6">
                            <p class="text-muted mb-2">This Week</p>
                            <h3 class="text-dark mb-3">23.5k</h3>
                        </div> <!-- end col -->
                        <div class="col-6">
                            <p class="text-muted mb-2">Last Week</p>
                            <h3 class="text-dark mb-3">41.05k</h3>
                        </div> <!-- end col -->
                    </div> <!-- end row -->
                </div>
            </div> <!-- end card-->
        </div> <!-- end col -->

        <div class="col-lg-4">
            <div class="card card-height-100">
                <div class="card-header d-flex align-items-center justify-content-between gap-2">
                    <h4 class="card-title flex-grow-1">Top Selling Items</h4>

                    <a href="{{ route('products.index') }}" class="btn btn-sm btn-soft-primary">View All</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-sm table-nowrap table-centered m-0">
                        <thead class="bg-light bg-opacity-50">
                            <tr>
                                <th class="text-muted ps-3">Item Name</th>
                                <th class="text-muted">Quantity Sold</th>
                                <th class="text-muted">Sale Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($topItems as $topItem)
                                <tr>
                                    <td class="ps-3 text-capitalize"><a href="#"
                                            class="text-muted">{{ $topItem->item_name }}
                                            <small>({{ $topItem->size_name }})</small></a>
                                    </td>
                                    <td>{{ $topItem->total }}</td>
                                    <td>
                                        £{{ $topItem->total * $topItem->price }}
                                    </td>
                                </tr>
                            @empty
                                <td colspan="3" class="text-center">No top selling items</td>
                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="card-title">
                            Recent Orders
                        </h4>

                        <a href="{{ route('admin.orders') }}" class="btn btn-sm btn-soft-primary">
                            All Orders
                        </a>
                    </div>
                </div>
                <!-- end card body -->
                <div class="table-responsive table-centered">
                    <table class="table mb-0">
                        <thead class="bg-light bg-opacity-50">
                            <tr>
                                <th class="ps-3">
                                    Order ID.
                                </th>
                                <th>
                                    Date & Time
                                </th>

                                <th>
                                    Customer Name
                                </th>
                                <th>
                                    Email ID
                                </th>
                                <th>
                                    Phone No.
                                </th>

                                <th>
                                    Payment Type
                                </th>
                                <th>
                                    Order Status
                                </th>
                            </tr>
                        </thead>
                        <!-- end thead-->
                        <tbody>
                            @forelse($recentOrders as $order)
                                <tr>
                                    <td class="ps-3">
                                        <a
                                            href="{{ route('admin.orders.show', $order->id) }}">{{ $order->order_number }}</a>
                                    </td>
                                    <td>{{ $order->created_at->format('d M Y h:i A') }}</td>
                                    <td>
                                        {{ $order->customer_name }}
                                    </td>
                                    <td>{{ $order->customer_email }}</td>
                                    <td>{{ $order->customer_phone }}</td>
                                    <td class="text-uppercase">{{ $order->payment_method }}</td>
                                    <td class="text-capitalize">
                                        @if ($order->order_status == 'pending')
                                            <i class="bx bxs-circle text-warning me-1"></i>{{ $order->order_status }}
                                        @elseif ($order->order_status == 'confirmed')
                                            <i class="bx bxs-circle text-success me-1"></i>{{ $order->order_status }}
                                        @elseif ($order->order_status == 'processing')
                                            <i class="bx bxs-circle text-info me-1"></i>{{ $order->order_status }}
                                        @elseif ($order->order_status == 'completed')
                                            <i class="bx bxs-circle text-success me-1"></i>{{ $order->order_status }}
                                        @elseif ($order->order_status == 'cancelled')
                                            <i class="bx bxs-circle text-danger me-1"></i>{{ $order->order_status }}
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">No recent orders</td>
                                </tr>
                            @endforelse


                        </tbody>
                        <!-- end tbody -->
                    </table>
                    <!-- end table -->
                </div>
                <!-- table responsive -->

                <div class="card-footer border-top">

                </div>
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div> <!-- end row -->
@endsection


@section('javascript')
    <!-- Dashboard Js -->
    <script src="{{ asset('admin/assets/js/pages/dashboard.js') }}"></script>


    <script>
        document.addEventListener("DOMContentLoaded", async function() {


            const data = await fetch("{{ route('admin.data') }}")
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    return data;
                })
                .catch(error => console.error(error));
            console.log(data);
            var options = {
                series: [{
                        name: "Orders",
                        type: "bar",
                        data: data.sales,
                    },
                    {
                        name: "Sales",
                        type: "area",
                        data: data.sales,
                    },
                ],
                chart: {
                    height: 313,
                    type: "line",
                    toolbar: {
                        show: false,
                    },
                },
                stroke: {
                    dashArray: [0, 0],
                    width: [0, 2],
                    curve: 'smooth'
                },
                fill: {
                    opacity: [1, 1],
                    type: ['solid', 'gradient'],
                    gradient: {
                        type: "vertical",
                        inverseColors: false,
                        opacityFrom: 0.5,
                        opacityTo: 0,
                        stops: [0, 90]
                    },
                },
                markers: {
                    size: [0, 0],
                    strokeWidth: 2,
                    hover: {
                        size: 4,
                    },
                },
                xaxis: {
                    categories: data.months,
                    axisTicks: {
                        show: false,
                    },
                    axisBorder: {
                        show: false,
                    },
                },
                yaxis: {
                    min: 0,
                    axisBorder: {
                        show: false,
                    }
                },
                grid: {
                    show: true,
                    strokeDashArray: 3,
                    xaxis: {
                        lines: {
                            show: false,
                        },
                    },
                    yaxis: {
                        lines: {
                            show: true,
                        },
                    },
                    padding: {
                        top: 0,
                        right: -2,
                        bottom: 0,
                        left: 10,
                    },
                },
                legend: {
                    show: false,
                    horizontalAlign: "center",
                    offsetX: 0,
                    offsetY: 5,
                    markers: {
                        width: 9,
                        height: 9,
                        radius: 6,
                    },
                    itemMargin: {
                        horizontal: 10,
                        vertical: 0,
                    },
                },
                plotOptions: {
                    bar: {
                        columnWidth: "30%",
                        barHeight: "70%",
                        borderRadius: 3,
                    },
                },
                colors: ["#396430", "#22c55e"],
                tooltip: {
                    shared: true,
                    y: [{
                            formatter: function(y) {
                                if (typeof y !== "undefined") {
                                    return y;
                                }
                                return y;
                            },
                        },
                        {
                            formatter: function(y) {
                                if (typeof y !== "undefined") {
                                    return y.toFixed(1);
                                }
                                return y;
                            },
                        },
                    ],
                },
            }

            var chart = new ApexCharts(
                document.querySelector("#dash-performance-chart"),
                options
            );

            chart.render();

        });
    </script>
@endsection
