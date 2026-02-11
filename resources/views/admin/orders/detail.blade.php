@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-xl-9 col-lg-8">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-wrap align-items-center justify-content-between gap-2">
                                <div>
                                    <h4 class="fw-medium text-dark d-flex align-items-center gap-2">
                                        #{{ $order->order_number }}
                                        @if ($order->payment_status == 'paid')
                                            <span class="badge bg-success-subtle text-success  px-2 py-1 fs-13">Paid</span>
                                        @else
                                            <span class="badge bg-danger-subtle text-danger  px-2 py-1 fs-13">Unpaid</span>
                                        @endif
                                        @if ($order->order_status == 'pending')
                                            <span
                                                class="badge bg-warning-subtle text-warning  px-2 py-1 fs-13">Pending</span>
                                        @elseif ($order->order_status == 'confirmed')
                                            <span class="badge bg-info-subtle text-info  px-2 py-1 fs-13">Confirmed</span>
                                        @elseif ($order->order_status == 'processing')
                                            <span class="badge bg-info-subtle text-info  px-2 py-1 fs-13">Processing</span>
                                        @elseif ($order->order_status == 'shipped')
                                            <span
                                                class="badge bg-primary-subtle text-primary  px-2 py-1 fs-13">Shipped</span>
                                        @elseif ($order->order_status == 'completed')
                                            <span
                                                class="badge bg-success-subtle text-success  px-2 py-1 fs-13">Completed</span>
                                        @elseif ($order->order_status == 'cancelled')
                                            <span
                                                class="badge bg-danger-subtle text-danger  px-2 py-1 fs-13">Cancelled</span>
                                        @endif
                                    </h4>
                                    <p class="mb-0">Order / Order Details / {{ $order->order_number }} -
                                        {{ $order->created_at->format('M d, Y') }} at
                                        {{ $order->created_at->format('h:i A') }}</p>
                                </div>


                            </div>

                            {{-- <div class="mt-4">
                                <h4 class="fw-medium text-dark">Progress</h4>
                            </div>

                           
                            <div class="row row-cols-xxl-5 row-cols-md-2 row-cols-1">
                                <div class="col">
                                    <div class="progress mt-3" style="height: 10px;">
                                        <div class="progress-bar progress-bar  progress-bar-striped progress-bar-animated bg-success"
                                            role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0"
                                            aria-valuemax="70">
                                        </div>
                                    </div>
                                    <p class="mb-0 mt-2">Order Confirming</p>
                                </div>
                                <div class="col">
                                    <div class="progress mt-3" style="height: 10px;">
                                        <div class="progress-bar progress-bar  progress-bar-striped progress-bar-animated bg-success"
                                            role="progressbar" style="width: 100%" aria-valuenow="70" aria-valuemin="0"
                                            aria-valuemax="70">
                                        </div>
                                    </div>
                                    <p class="mb-0 mt-2">Payment Pending</p>
                                </div>
                                <div class="col">
                                    <div class="progress mt-3" style="height: 10px;">
                                        <div class="progress-bar progress-bar  progress-bar-striped progress-bar-animated bg-warning"
                                            role="progressbar" style="width: 60%" aria-valuenow="70" aria-valuemin="0"
                                            aria-valuemax="70">
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center gap-2 mt-2">
                                        <p class="mb-0">Processing</p>
                                        <div class="spinner-border spinner-border-sm text-warning" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="progress mt-3" style="height: 10px;">
                                        <div class="progress-bar progress-bar  progress-bar-striped progress-bar-animated bg-primary"
                                            role="progressbar" style="width: 0%" aria-valuenow="70" aria-valuemin="0"
                                            aria-valuemax="70">
                                        </div>
                                    </div>
                                    <p class="mb-0 mt-2">Shipping</p>
                                </div>
                                <div class="col">
                                    <div class="progress mt-3" style="height: 10px;">
                                        <div class="progress-bar progress-bar  progress-bar-striped progress-bar-animated bg-primary"
                                            role="progressbar" style="width: 0%" aria-valuenow="70" aria-valuemin="0"
                                            aria-valuemax="70">
                                        </div>
                                    </div>
                                    <p class="mb-0 mt-2">Delivered</p>
                                </div>
                            </div> --}}
                        </div>
                        <form action="{{ route('admin.orders.status', $order->id) }}" method="POST">
                            @csrf
                            <div
                                class="card-footer d-flex flex-wrap align-items-center justify-content-end bg-light-subtle gap-2">
                                <p class="mb-0 text-dark fw-semibold text-nowrap ">Order Status :</p>
                                <select class="form-select form-select-sm " style="max-width: 200px" name="order_status">
                                    <option value="pending" {{ $order->order_status == 'pending' ? 'selected' : '' }}>
                                        Pending</option>
                                    <option value="confirmed" {{ $order->order_status == 'confirmed' ? 'selected' : '' }}>
                                        Confirmed</option>
                                    <option value="processing" {{ $order->order_status == 'processing' ? 'selected' : '' }}>
                                        Processing</option>
                                    <option value="shipped" {{ $order->order_status == 'shipped' ? 'selected' : '' }}>
                                        Shipped</option>
                                    <option value="completed" {{ $order->order_status == 'completed' ? 'selected' : '' }}>
                                        Completed</option>
                                    <option value="cancelled" {{ $order->order_status == 'cancelled' ? 'selected' : '' }}>
                                        Cancelled</option>
                                </select>

                                <div>
                                    <button class="btn btn-primary btn-sm updateOrderStatus">Update Status</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Product</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table align-middle mb-0 table-hover table-centered">
                                    <thead class="bg-light-subtle border-bottom">
                                        <tr>
                                            <th>Product Name & Size</th>
                                            <th class="text-center">Quantity</th>
                                            <th class="text-end">Price</th>
                                            <th class="text-end">Total Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($order->items as $item)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <div
                                                            class="rounded bg-light avatar-md d-flex align-items-center justify-content-center">
                                                            <img src="{{ $item->item->getFirstMediaUrl('images') ?: asset('admin/assets/images/logo.png') }}"
                                                                alt="" class="rounded avatar-md">
                                                        </div>
                                                        <div>
                                                            <a class="text-dark fw-medium fs-15">{{ $item->item_name }}</a>
                                                            <p class="text-muted mb-0 mt-1 fs-13"><span>Size :
                                                                </span>{{ $item->size_name }}</p>
                                                        </div>
                                                    </div>

                                                </td>


                                                <td class="text-center"> {{ $item->quantity }}</td>
                                                <td class="text-end">£{{ $item->price }}</td>
                                                <td class="text-end">
                                                    £{{ $item->price * $item->quantity }}
                                                </td>
                                            </tr>
                                            @foreach ($item->addons->groupBy('category_name') as $categoryName => $addons)
                                                <tr>
                                                    <td colspan="4" class="ps-5 py-1">
                                                        <div class="text-muted fs-13 fw-bold">{{ $categoryName }}</div>
                                                        @foreach ($addons as $addon)
                                                            <div
                                                                class="d-flex justify-content-between align-items-center text-muted fs-13 ps-2">
                                                                <span>+ {{ $addon->name }} ({{ $addon->quantity }} x
                                                                    £{{ $addon->price }})</span>
                                                                <span>£{{ number_format($addon->price * $addon->quantity, 2) }}</span>
                                                            </div>
                                                        @endforeach
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center">No items found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Order Timeline</h4>
                        </div>
                        <div class="card-body">
                            <div class="position-relative ms-2">
                                <span class="position-absolute start-0  top-0 border border-dashed h-100"></span>
                                @forelse($order->timelines as $timeline)
                                    <div class="position-relative ps-4 mb-3">
                                        <div class="mb-2">
                                            <span
                                                class="position-absolute start-0 avatar-sm translate-middle-x bg-light d-inline-flex align-items-center justify-content-center rounded-circle text-success fs-20">
                                                <i class='bx bx-check-circle'></i>
                                            </span>
                                            <div
                                                class="ms-2 d-flex flex-wrap gap-2  align-items-center justify-content-between">
                                                <div>
                                                    <h5 class="mb-1 text-dark fw-medium fs-15">{{ $timeline->title }}</h5>
                                                    <p class="mb-1">{{ $timeline->description }}</p>
                                                </div>
                                                <div class="">
                                                    <p class="mb-0">{{ $timeline->created_at->format('M d, Y, h:i A') }}
                                                    </p>
                                                    <small class="text-sm">Created By : <span
                                                            class="text-capitalize">{{ $timeline->created_by }}</span>
                                                    </small>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="position-relative ps-4">
                                        <div class="mb-2">
                                            <span
                                                class="position-absolute start-0 avatar-sm translate-middle-x bg-light d-inline-flex align-items-center justify-content-center rounded-circle text-success fs-20">
                                                <i class='bx bx-check-circle'></i>
                                            </span>
                                            <div
                                                class="ms-2 d-flex flex-wrap gap-2  align-items-center justify-content-between">
                                                <p class="mb-0">No timeline found</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-4">

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Customer Details</h4>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center gap-2">
                        <img src="{{ asset('admin/assets/images/users/avatar-1.jpg') }}" alt=""
                            class="avatar rounded-3 border border-light border-3">
                        <div>
                            <p class="mb-1">{{ $order->customer_name }}</p>
                            <a href="mailto:{{ $order->customer_email }}"
                                class="link-primary fw-medium">{{ $order->customer_email }}</a>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between mt-3">
                        <h5 class="">Contact Number</h5>
                    </div>
                    <p class="mb-1">{{ $order->customer_phone }}</p>

                    <div class="d-flex justify-content-between mt-3">
                        <h5 class="">Shipping Address</h5>
                    </div>

                    <div>
                        <p class="mb-1">{{ $order->delivery_address }}</p>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Order Summary</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <tbody>
                                <tr>
                                    <td class="px-0">
                                        <p class="d-flex mb-0 align-items-center gap-1"><iconify-icon
                                                icon="solar:clipboard-text-broken"></iconify-icon> Sub Total : </p>
                                    </td>
                                    <td class="text-end text-dark fw-medium px-0">£{{ $order->sub_total }}</td>
                                </tr>
                                <tr>
                                    <td class="px-0">
                                        <p class="d-flex mb-0 align-items-center gap-1"><iconify-icon
                                                icon="solar:ticket-broken" class="align-middle"></iconify-icon> Discount :
                                        </p>
                                    </td>
                                    <td class="text-end text-dark fw-medium px-0">£{{ $order->discount_total ?? 0 }}</td>
                                </tr>
                                <tr>
                                    <td class="px-0">
                                        <p class="d-flex mb-0 align-items-center gap-1"><iconify-icon
                                                icon="solar:kick-scooter-broken" class="align-middle"></iconify-icon>
                                            Delivery Charge : </p>
                                    </td>
                                    <td class="text-end text-dark fw-medium px-0">£{{ $order?->delivery_charge ?? 0 }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-0">
                                        <p class="d-flex mb-0 align-items-center gap-1"><iconify-icon
                                                icon="solar:calculator-minimalistic-broken"
                                                class="align-middle"></iconify-icon> Estimated Tax (15.5%) : </p>
                                    </td>
                                    <td class="text-end text-dark fw-medium px-0">£{{ $order->tax_total ?? 0 }}</td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between bg-light-subtle">
                    <div>
                        <p class="fw-medium text-dark mb-0">Total Amount</p>
                    </div>
                    <div>
                        <p class="fw-medium text-dark mb-0">£{{ $order->grand_total ?? 0 }}</p>
                    </div>

                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Payment Information</h4>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="rounded-3 bg-light avatar d-flex align-items-center justify-content-center">
                            <img src="{{ asset('admin/assets/images/card/mastercard.svg') }}" alt=""
                                class="avatar-sm">
                        </div>
                        <div>
                            <p class="mb-1 text-dark fw-medium">Master Card</p>
                            <p class="mb-0 text-dark">xxxx xxxx xxxx 7812</p>
                        </div>
                        <div class="ms-auto">
                            <iconify-icon icon="solar:check-circle-broken" class="fs-22 text-success"></iconify-icon>
                        </div>
                    </div>
                    <p class="text-dark mb-1 fw-medium">Transaction ID : <span class="text-muted fw-normal fs-13">
                            #IDN768139059</span></p>
                    <p class="text-dark mb-0 fw-medium">Card Holder Name : <span class="text-muted fw-normal fs-13">
                            Gaston Lapierre</span></p>

                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="mapouter">
                        <div class="gmap_canvas"><iframe class="gmap_iframe rounded" width="100%"
                                style="height: 418px;" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"
                                src="https://maps.google.com/maps?width=1980&amp;height=400&amp;hl=en&amp;q={{ $order->delivery_address }}&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
