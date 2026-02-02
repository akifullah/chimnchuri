@extends('admin.layouts.app')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <form id="smtpForm" autocomplete="off">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">SMTP Information</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="mailer" class="form-label">Mailer</label>
                            <input type="text" id="mailer" name="mailer" value="{{ $smtpSetting->mailer ?? 'smtp' }}"
                                class="form-control" placeholder="Mailer" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="host" class="form-label">Host</label>
                            <input type="text" id="host" name="host"
                                value="{{ $smtpSetting->host ?? 'smtp.gmail.com' }}" class="form-control" placeholder="Host"
                                required>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" id="username" name="username" value="{{ $smtpSetting->username ?? '' }}"
                                class="form-control" placeholder="Username" required>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" id="password" name="password" value="{{ $smtpSetting->password ?? '' }}"
                                class="form-control" placeholder="Password" required>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="port" class="form-label">Port</label>
                            <input type="text" id="port" name="port" value="{{ $smtpSetting->port ?? '587' }}"
                                class="form-control" placeholder="Port" required>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="encryption" class="form-label">Encryption</label>
                            <input type="text" id="encryption" name="encryption"
                                value="{{ $smtpSetting->encryption ?? 'tls' }}" class="form-control"
                                placeholder="Encryption" required>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="from_address" class="form-label">From Address</label>
                            <input type="text" id="from_address" name="from_address"
                                value="{{ $smtpSetting->from_address ?? '' }}" class="form-control"
                                placeholder="From Address" required>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="from_name" class="form-label">From Name</label>
                            <input type="text" id="from_name" name="from_name"
                                value="{{ $smtpSetting->from_name ?? '' }}" class="form-control" placeholder="From Name"
                                required>
                        </div>
                    </div>

                </div>

            </div>
        </div>
        <div class="p-3 bg-light mb-3 rounded">
            <div class="row justify-content-end g-2">
                <div class="col-lg-2">
                    <button type="submit" class="btn btn-outline-secondary w-100">Update SMTP</button>
                </div>
            </div>
        </div>
    </form>
@endsection


@section('javascript')
    <script>
        $(document).ready(function() {


            $("#smtpForm").on("submit", function(e) {
                e.preventDefault();

                let form = this;
                let formData = new FormData(form);

                $.ajax({
                    url: "{{ route('admin.smtp.store') }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    beforeSend: function() {
                        $('#smtpForm .is-invalid').removeClass('is-invalid');
                        $('#smtpForm .invalid-feedback').remove();
                    },
                    success: function(response) {
                        window.location.href = "{{ route('admin.smtp.index') }}";
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            $.each(errors, function(key, value) {
                                let input = $(`[name="${key}"]`);
                                if (input.length > 0) {
                                    input.addClass('is-invalid');
                                    if (input.next('.invalid-feedback').length === 0) {
                                        input.after(
                                            `<div class="invalid-feedback">${value[0]}</div>`
                                        );
                                    } else {
                                        input.next('.invalid-feedback').text(value[0]);
                                    }
                                }
                            });
                        } else {
                            alert("Something went wrong. Check server logs.");
                        }
                    }
                })


            });
        });
    </script>
@endsection
