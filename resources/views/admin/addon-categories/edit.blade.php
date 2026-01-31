@extends('admin.layouts.app')

@section('content')
    <form id="addonCategoryForm">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Edit Addon Category Information</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="name" class="form-label">Category Name</label>
                            <input type="text" id="name" name="name" class="form-control"
                                placeholder="Category Name" value="{{ $category->name }}" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="slug" class="form-label">Category Slug</label>
                            <input type="text" id="slug" name="slug" class="form-control"
                                placeholder="Category Slug" value="{{ $category->slug }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control bg-light-subtle" id="description" rows="5" placeholder="Category Description"
                                name="description">{{ $category->description }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="p-3 bg-light mb-3 rounded">
            <div class="row justify-content-end g-2">
                <div class="col-lg-2">
                    <button type="submit" class="btn btn-outline-secondary w-100">Update Category</button>
                </div>
            </div>
        </div>
    </form>
@endsection


@section('javascript')
    <script>
        $(document).ready(function() {

            $('#addonCategoryForm').on('submit', function(e) {
                e.preventDefault();

                let form = this;
                let formData = new FormData(form);
                formData.append('_method', 'PUT');

                $.ajax({
                    url: "{{ route('admin.addon-categories.update', $category->id) }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    beforeSend: function() {
                        // Clear previous errors
                        $('#addonCategoryForm .is-invalid').removeClass('is-invalid');
                        $('#addonCategoryForm .invalid-feedback').remove();
                    },
                    success: function(response) {
                        window.location.href = "{{ route('admin.addon-categories.index') }}";
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
                });

            });

        });
    </script>
@endsection
