@extends('admin.layouts.app')


@section('content')
    <form id="productForm">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Product Information</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label for="product-name" class="form-label">Product Name</label>
                            <input type="text" id="name" name="name" class="form-control"
                                placeholder="Items Name" value="{{ $product->name }}">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label for="slug" class="form-label">Product Slug</label>
                            <input type="text" id="slug" name="slug" class="form-control"
                                placeholder="Items Slug" value="{{ $product->slug }}">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <label for="product-categories" class="form-label">Product Categories</label>
                        <select class="form-control" id="product-categories" data-choices data-choices-groups
                            data-placeholder="Select Categories" name="category_id">
                            <option value="">Choose a categories</option>
                            @if ($categories->isNotEmpty())
                                @foreach ($categories as $category)
                                    <option
                                        {{ $product->categories_relation->contains('id', $category->id) ? 'selected' : '' }}
                                        value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-lg-12">
                        <div class="mt-3">
                            <h5 class="text-dark fw-medium">Sizes & Prices:</h5>
                            <div class="item-sizes " id="item-sizes">
                                @forelse($product->sizes as $index => $size)
                                    <div class="row">
                                        <div class="col-md-3 mb-3">
                                            <label class="form-label">Name</label>
                                            <input type="text" name="sizes[{{ $index }}][name]"
                                                class="form-control" value="{{ $size->name }}" required>
                                            <input type="hidden" name="sizes[{{ $index }}][id]"
                                                value="{{ $size->id }}">
                                        </div>
                                        <div class="col-md-2 mb-3">
                                            <label class="form-label">Price</label>
                                            <input type="number" name="sizes[{{ $index }}][price]"
                                                class="form-control" step="0.01" value="{{ $size->price }}" required>
                                        </div>

                                        <div class="col-md-3 mb-3 d-flex align-items-end">
                                            @if ($index > 0)
                                                <button type="button" class="btn btn-sm btn-danger ms-2 remove-size-row"
                                                    title="Remove row">&times;</button>
                                            @endif
                                        </div>
                                    </div>
                                @empty
                                    <div class="row">
                                        <div class="col-md-3 mb-3">
                                            <label class="form-label">Name</label>
                                            <input type="text" name="sizes[0][name]" class="form-control" required>
                                        </div>
                                        <div class="col-md-2 mb-3">
                                            <label class="form-label">Price</label>
                                            <input type="number" name="sizes[0][price]" class="form-control" step="0.01"
                                                required>
                                        </div>
                                        <div class="col-md-3 mb-3 d-flex align-items-end"></div>
                                    </div>
                                @endforelse
                            </div>

                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control bg-light-subtle" id="description" rows="7"
                                placeholder="Short description about the product" name="description">{{ $product->description }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="p-3 bg-light mb-3 rounded">
            <div class="row justify-content-end g-2">
                <div class="col-lg-2">
                    <button type="submit" class="btn btn-outline-secondary w-100">Update Product</button>
                </div>
            </div>
        </div>
    </form>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Add Product Photo</h4>
        </div>
        <div class="card-body">
            <!-- File Upload -->
            <form action="" method="post" class="dropzone" id="myAwesomeDropzone" data-plugin="dropzone"
                data-previews-container="#file-previews" data-upload-preview-template="#uploadPreviewTemplate">
                <div class="fallback">
                    <input name="file" type="file" multiple />
                </div>
                <div class="dz-message needsclick">
                    <i class="bx bx-cloud-upload fs-48 text-primary"></i>
                    <h3 class="mt-4">Drop your images here, or <span class="text-primary">click to browse</span></h3>
                    <span class="text-muted fs-13">
                        1600 x 1200 (4:3) recommended. PNG, JPG and GIF files are allowed
                    </span>
                </div>
            </form>
        </div>
    </div>
@endsection


@section('javascript')
    <script>
        Dropzone.autoDiscover = false;
        const myDropzone = new Dropzone("#myAwesomeDropzone", {
            url: "{{ route('products.media.store', $product->id) }}",
            autoProcessQueue: false,
            maxFilesize: 5,
            maxFiles: 10,
            uploadMultiple: false,
            parallelUploads: 10,
            acceptedFiles: ".jpg,.jpeg,.png",
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            init: function() {
                var myDropzone = this;

                // Existing images
                @if ($product->media)
                    @foreach ($product->media as $media)
                        var mockFile = {
                            name: "{{ $media->file_name }}",
                            size: {{ $media->size }},
                            id: "{{ $media->id }}"
                        };

                        mockFile.status = Dropzone.SUCCESS;
                        mockFile.accepted = true;

                        myDropzone.emit("addedfile", mockFile);
                        myDropzone.emit("thumbnail", mockFile, "{{ $media->getUrl() }}");
                        myDropzone.emit("success", mockFile);
                        myDropzone.emit("complete", mockFile);
                    @endforeach
                @endif


                this.on("removedfile", function(file) {
                    if (file.id) {
                        $.ajax({
                            type: 'DELETE',
                            url: '/products/media/' + file.id,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                                    .attr('content')
                            },
                            success: function(data) {
                                console.log("File has been successfully removed!!");
                            },
                            error: function(e) {
                                console.log(e);
                            }
                        });
                    }
                });


            }
        });
        myDropzone.on("queuecomplete", function() {
            if (myDropzone.getUploadingFiles().length === 0 &&
                myDropzone.getQueuedFiles().length === 0 &&
                myDropzone.getAcceptedFiles().length > 0) {

                window.location.href = "{{ route('products.index') }}";
            }
        });
        $(document).ready(function() {

            $('#productForm').on('submit', function(e) {
                e.preventDefault();

                let form = this;
                let formData = new FormData(form);
                formData.append('_method', 'PUT');

                $.ajax({
                    url: "{{ route('products.update', $product->id) }}",
                    type: "POST", // Use POST with _method=PUT for Laravel
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    beforeSend: function() {
                        // Clear previous errors
                        $('#productForm .is-invalid').removeClass('is-invalid');
                        $('#productForm .invalid-feedback').remove();
                    },
                    success: function(response) {
                        console.log(response);
                        if (myDropzone.getQueuedFiles().length > 0) {
                            myDropzone.processQueue();
                        } else {
                            window.location.href = "{{ route('products.index') }}";
                        }
                        // window.location.href = "{{ route('products.index') }}";
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            $.each(errors, function(key, value) {
                                // Handle dot notation for arrays like sizes.0.name -> sizes[0][name]
                                let inputName = key;
                                if (key.includes('.')) {
                                    let parts = key.split('.');
                                    inputName = parts.shift(); // get first part
                                    parts.forEach(part => {
                                        inputName += `[${part}]`;
                                    });
                                }

                                let input = $(`[name="${inputName}"]`);
                                if (input.length > 0) {
                                    input.addClass('is-invalid');
                                    // Append error message if not already present
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

        // Dynamically handle item size rows
        document.addEventListener('DOMContentLoaded', function() {
            // References to sizes container and add-row button
            const sizesContainer = document.getElementById('item-sizes');

            // Remove all but the first row on page load
            // (function showOnlyFirstRow() {
            //      Logic removed as we are populating from backend
            // })();

            // Button to add another row
            const addRowBtn = document.createElement("button");
            addRowBtn.type = "button";
            addRowBtn.className = "btn btn-outline-primary";
            addRowBtn.textContent = "Add Another Size";

            // Insert button at the end of the sizes container
            sizesContainer.appendChild(document.createElement("div")).appendChild(addRowBtn);

            // Next index tracker
            let sizeRowIndex = {{ $product->sizes->count() > 0 ? $product->sizes->count() : 1 }};
            addRowBtn.addEventListener("click", function() {
                // Template for a row
                const rowHtml = `<div class="row">

                                            <div class="col-md-3 mb-3">
                                                <label class="form-label">Name</label>
                                                <input type="text" name="sizes[${sizeRowIndex}][name]" class="form-control" required>
                                            </div>
                                            <div class="col-md-2 mb-3">
                                                <label class="form-label">Price</label>
                                                <input type="number" name="sizes[${sizeRowIndex}][price]" class="form-control" step="0.01" required>
                                            </div>

                                            <div class="col-md-3 mb-3 d-flex align-items-end">

                                                <button type="button" class="btn btn-sm btn-danger ms-2 remove-size-row" title="Remove row">&times;</button>
                                            </div>
                                            </div>
                                                    `;

                // Insert the row BEFORE the add-row button's wrapper div (so add button remains last)
                const wrapper = document.createElement("div");
                wrapper.innerHTML = rowHtml;
                // Insert before the button row
                sizesContainer.insertBefore(wrapper, addRowBtn.parentElement);

                sizeRowIndex++;
            });

            // Remove row event
            sizesContainer.addEventListener('click', function(e) {
                if (e.target.classList.contains('remove-size-row')) {
                    // Remove the complete group (5 x col-md-x + w-100)
                    let parentDiv = e.target.closest('.col-md-3.mb-3');
                    let toRemove = [];
                    // Traverse backwards to get preceding fields
                    let el = parentDiv;
                    for (let i = 0; i < 4; i++) {
                        el = el.previousElementSibling;
                        if (!el) break;
                        toRemove.push(el);
                    }
                    // Remove current, then collected, then next sibling "w-100" row clear
                    parentDiv.parentElement.removeChild(parentDiv);
                    toRemove.forEach(elem => {
                        if (elem) elem.parentElement.removeChild(elem);
                    });
                    // Remove w-100
                    if (addRowBtn.parentElement.previousElementSibling &&
                        addRowBtn.parentElement.previousElementSibling.classList.contains('w-100')) {
                        addRowBtn.parentElement.parentElement.removeChild(addRowBtn.parentElement
                            .previousElementSibling);
                    }
                }
            });

            // Helper to remove a row by index (for initial cleanup)
            function removeRowByIndex(idx) {
                const input = sizesContainer.querySelector(`input[name="sizes[${idx}][name]"]`);
                if (!input) return;
                // Go backwards to catch 'item_id', then as above
                let itemIdDiv = input.closest('.col-md-3.mb-3').previousElementSibling.previousElementSibling;
                // Remove 5 cols and w-100 after
                for (let i = 0; i < 5; i++) {
                    if (itemIdDiv) {
                        let toRemoveDiv = itemIdDiv;
                        let next = itemIdDiv.nextElementSibling;
                        itemIdDiv = itemIdDiv.nextElementSibling;
                        if (toRemoveDiv) toRemoveDiv.parentElement.removeChild(toRemoveDiv);
                    }
                }
                // Remove w-100
                let w100Div = sizesContainer.querySelector('.w-100');
                if (w100Div) w100Div.parentElement.removeChild(w100Div);
            }
        });
    </script>
@endsection
