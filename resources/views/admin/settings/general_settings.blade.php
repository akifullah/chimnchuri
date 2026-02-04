        @extends('admin.layouts.app')

        @section('content')
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form action="{{ route('admin.general-settings.update') }}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">General Settings</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="restaurant_name" class="form-label">Restaurant Name</label>
                                    <input type="text" id="restaurant_name"
                                        value="{{ old('restaurant_name', $settings->restaurant_name ?? '') }}"
                                        name="restaurant_name" class="form-control" placeholder="Restaurant Name">
                                    @error('restaurant_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input type="text" id="phone" value="{{ old('phone', $settings->phone ?? '') }}"
                                        name="phone" class="form-control" placeholder="Phone">
                                    @error('phone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" id="email" value="{{ old('email', $settings->email ?? '') }}"
                                        name="email" class="form-control" placeholder="Email">
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" id="address"
                                        value="{{ old('address', $settings->address ?? '') }}" name="address"
                                        class="form-control" placeholder="Address">
                                    @error('address')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="city" class="form-label">City</label>
                                    <input type="text" id="city" value="{{ old('city', $settings->city ?? '') }}"
                                        name="city" class="form-control" placeholder="City">
                                    @error('city')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="postcode" class="form-label">Postcode</label>
                                    <input type="text" id="postcode"
                                        value="{{ old('postcode', $settings->postcode ?? '') }}" name="postcode"
                                        class="form-control" placeholder="Postcode">
                                    @error('postcode')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="state" class="form-label">State</label>
                                    <input type="text" id="state" value="{{ old('state', $settings->state ?? '') }}"
                                        name="state" class="form-control" placeholder="State">
                                    @error('state')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>



                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="country" class="form-label">Country</label>
                                    <input type="text" id="country"
                                        value="{{ old('country', $settings->country ?? '') }}" name="country"
                                        class="form-control" placeholder="Country">
                                    @error('country')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="currency_code" class="form-label">Currency</label>
                                    <input type="text" id="currency_code"
                                        value="{{ old('currency_code', $settings->currency_code ?? 'PKR') }}"
                                        name="currency_code" class="form-control" placeholder="Currency">
                                    @error('currency_code')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="tax_percentage" class="form-label">Tax Percentage (%)</label>
                                    <input type="number" step="0.01" id="tax_percentage"
                                        value="{{ old('tax_percentage', $settings->tax_percentage ?? '') }}"
                                        name="tax_percentage" class="form-control" placeholder="Tax Percentage">
                                    @error('tax_percentage')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="delivery_charge" class="form-label">Delivery Charge</label>
                                    <input type="number" step="0.01" id="delivery_charge"
                                        value="{{ old('delivery_charge', $settings->delivery_charge ?? '') }}"
                                        name="delivery_charge" class="form-control" placeholder="Delivery Charge">
                                    @error('delivery_charge')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="min_order_amount" class="form-label">Minimum Order Amount</label>
                                    <input type="number" step="0.01" id="min_order_amount"
                                        value="{{ old('min_order_amount', $settings->min_order_amount ?? '') }}"
                                        name="min_order_amount" class="form-control" placeholder="Minimum Order Amount">
                                    @error('min_order_amount')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <h4 class="text-start">Order Settings</h4>
                            </div>

                            <div class="col-lg-2">
                                <div class="mb-3">
                                    <label for="is_order_enabled"
                                        class="form-label d-block cursor-pointer user-select-none">Enable
                                        Order</label>
                                    <div class="form-check form-switch">
                                        <input type="hidden" name="is_order_enabled" value="0">
                                        <input class="form-check-input" type="checkbox" role="switch"
                                            id="is_order_enabled" name="is_order_enabled" value="1"
                                            {{ old('is_order_enabled', $settings->is_order_enabled ?? 1) == 1 ? 'checked' : '' }}>
                                    </div>
                                    @error('is_order_enabled')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-2">
                                <div class="mb-3">
                                    <label for="is_delivery_enabled"
                                        class="form-label d-block cursor-pointer user-select-none">Enable
                                        Delivery</label>
                                    <div class="form-check form-switch">
                                        <input type="hidden" name="is_delivery_enabled" value="0">
                                        <input class="form-check-input" type="checkbox" role="switch"
                                            id="is_delivery_enabled" name="is_delivery_enabled" value="1"
                                            {{ old('is_delivery_enabled', $settings->is_delivery_enabled ?? 1) == 1 ? 'checked' : '' }}>
                                    </div>
                                    @error('is_delivery_enabled')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-2">
                                <div class="mb-3">
                                    <label for="is_pickup_enabled"
                                        class="form-label d-block cursor-pointer user-select-none">Enable
                                        Pickup</label>
                                    <div class="form-check form-switch">
                                        <input type="hidden" name="is_pickup_enabled" value="0">
                                        <input class="form-check-input" type="checkbox" role="switch"
                                            id="is_pickup_enabled" name="is_pickup_enabled" value="1"
                                            {{ old('is_pickup_enabled', $settings->is_pickup_enabled ?? 1) == 1 ? 'checked' : '' }}>
                                    </div>
                                    @error('is_pickup_enabled')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-2">
                                <div class="mb-3">
                                    <label for="is_cod_enabled"
                                        class="form-label d-block cursor-pointer user-select-none">Enable
                                        COD</label>
                                    <div class="form-check form-switch">
                                        <input type="hidden" name="is_cod_enabled" value="0">
                                        <input class="form-check-input" type="checkbox" role="switch"
                                            id="is_cod_enabled" name="is_cod_enabled" value="1"
                                            {{ old('is_cod_enabled', $settings->is_cod_enabled ?? 1) == 1 ? 'checked' : '' }}>
                                    </div>
                                    @error('is_cod_enabled')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-2">
                                <div class="mb-3">
                                    <label for="is_online_enabled"
                                        class="form-label d-block cursor-pointer user-select-none">Enable
                                        Online Payment</label>
                                    <div class="form-check form-switch">
                                        <input type="hidden" name="is_online_enabled" value="0">
                                        <input class="form-check-input" type="checkbox" role="switch"
                                            id="is_online_enabled" name="is_online_enabled" value="1"
                                            {{ old('is_online_enabled', $settings->is_online_enabled ?? 1) == 1 ? 'checked' : '' }}>
                                    </div>
                                    @error('is_online_enabled')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
                </div>
                <div class="p-3 bg-light mb-3 rounded">
                    <div class="row justify-content-end g-2">
                        <div class="col-lg-2">
                            <button type="submit" class="btn btn-primary w-100">Save Settings</button>
                        </div>
                    </div>
                </div>
            </form>
        @endsection
