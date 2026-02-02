@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-xl-12">

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

            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center gap-1">
                    <h4 class="card-title flex-grow-1">All Users List</h4>

                    <a href="{{ route('admin.users.create') }}" class="btn btn-sm btn-primary">
                        Add User
                    </a>
                </div>
                <div>
                    <div class="table-responsive">
                        <table class="table  table-sm align-middle mb-0 table-hover table-centered">
                            <thead class="bg-light-subtle">
                                <tr>
                                    <th style="width: 20px;">
                                        #ID
                                    </th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                    <tr class="">
                                        <td>
                                            {{ $user->id }}
                                        </td>
                                        <td class="text-capitalize">
                                            <a href="#!" class="text-dark fw-medium fs-15">{{ $user->name }}</a>
                                        </td>
                                        <td class="">
                                            {{ ucfirst($user->email) }}
                                        </td>
                                        <td>
                                            {{ $user->phone ?? 'N/A' }}
                                        </td>
                                        <td class="text-capitalize">
                                            {{ $user->role }}
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <a href="{{ route('admin.users.edit', $user->id) }}"
                                                    class="btn btn-soft-primary btn-sm"><iconify-icon
                                                        icon="solar:pen-2-broken"
                                                        class="align-middle fs-18"></iconify-icon></a>
                                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                                    onsubmit="return confirm('Are you sure you want to delete this addon item?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-soft-danger btn-sm">
                                                        <iconify-icon icon="solar:trash-bin-minimalistic-2-broken"
                                                            class="align-middle fs-18"></iconify-icon>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">No users found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer border-top">
                    <nav aria-label="Page navigation example">
                        {{ $users->links() }}
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection
