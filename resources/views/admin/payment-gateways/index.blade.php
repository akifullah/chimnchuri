@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center gap-1">
                    <h4 class="card-title flex-grow-1">All Payment Gateways List</h4>

                    <a href="{{ route('payment-gateways.create') }}" class="btn btn-sm btn-primary">
                        Add Payment Gateway
                    </a>
                </div>
                <div>
                    <div class="table-responsive">
                        <table class="table align-middle mb-0 table-hover table-centered">
                            <thead class="bg-light-subtle">
                                <tr>
                                    <th style="width: 20px;">
                                        #ID
                                    </th>
                                    <th>Name</th>
                                    <th>Code</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($gateways as $gateway)
                                    <tr>
                                        <td>{{ $gateway->id }}</td>
                                        <td>{{ $gateway->name }}</td>
                                        <td>{{ $gateway->code }}</td>
                                        <td>
                                            {{ $gateway->setting->is_enabled ? 'Enabled' : 'Disabled' }}
                                        </td>

                                        <td>
                                            <a href="{{ route('payment-gateways.edit', $gateway->id) }}"
                                                class="btn btn-soft-primary btn-sm"><iconify-icon icon="solar:pen-2-broken"
                                                    class="align-middle fs-18"></iconify-icon></a>

                                            <form method="POST"
                                                action="{{ route('payment-gateways.destroy', $gateway->id) }}"
                                                style="display:inline">

                                                @csrf
                                                @method('DELETE')

                                                <button class="btn btn-soft-danger btn-sm"><iconify-icon
                                                        icon="solar:trash-bin-minimalistic-2-broken"
                                                        class="align-middle fs-18"></iconify-icon></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer border-top">
                    {{-- <nav aria-label="Page navigation example">
                        {{ $gateways->links() }}
                    </nav> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
