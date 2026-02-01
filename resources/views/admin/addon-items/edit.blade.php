@extends('admin.layouts.app')

@section('content')
    <form id="addonItemForm">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Update Addon Item Information</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="name" class="form-label">Item Name</label>
                            <input type="text" id="name" name="name" value="{{ $addonItem->name }}"
                                class="form-control" placeholder="Item Name" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input type="text" id="price" name="price" value="{{ $addonItem->price }}"
                                class="form-control" placeholder="Price" required>
                        </div>
                    </div>
                    {{-- <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="slug" class="form-label">Category Slug</label>
                            <input type="text" id="slug" name="slug" class="form-control"
                                placeholder="Category Slug">
                        </div>
                    </div> --}}
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control bg-light-subtle" id="description" rows="5" placeholder="Category Description"
                                name="description">{{ $addonItem->description }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="p-3 bg-light mb-3 rounded">
            <div class="row justify-content-end g-2">
                <div class="col-lg-2">
                    <button type="submit" class="btn btn-outline-secondary w-100">Update Item</button>
                </div>
            </div>
        </div>
    </form>
@endsection


@section('javascript')
    <script>
        $(document).ready(function() {


            $("#addonItemForm").on("submit", function(e) {
                e.preventDefault();

                let form = this;
                let formData = new FormData(form);
                formData.append('_method', 'PUT');

                $.ajax({
                    url: "{{ route('admin.addon-items.update', $addonItem->id) }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    beforeSend: function() {
                        // Clear previous errors
                        $('#addonItemForm .is-invalid').removeClass('is-invalid');
                        $('#addonItemForm .invalid-feedback').remove();
                    },
                    success: function(response) {
                        window.location.href = "{{ route('admin.addon-items.index') }}";
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
