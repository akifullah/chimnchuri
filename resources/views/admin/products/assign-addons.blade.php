@extends('admin.layouts.app')

@section('content')
    <form id="assingAddonsForm" method="POST" action="{{ route('products.assign-addons.store', $product->id) }}">
        @csrf

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">Assign Addons to {{ $product->name }}</h4>
                <a href="{{ route('products.index') }}" class="btn btn-secondary btn-sm">Back</a>
            </div>
            <div class="card-body">

                <div id="addon-groups-container">

                </div>

                <div class="row mt-4">
                    <div class="col-lg-12 border-top pt-3">
                        <label class="form-label">Add New Addon Category</label>
                        <div class="d-flex gap-2">
                            <select id="addonCategorySelector" class="form-control" style="max-width: 300px;">
                                <option value="">Select Addon Category</option>
                                @foreach ($addonCategories as $addonCategory)
                                    <option value="{{ $addonCategory->id }}" data-name="{{ $addonCategory->name }}">
                                        {{ $addonCategory->name }}
                                    </option>
                                @endforeach
                            </select>
                            <button type="button" id="btnAddCategory" class="btn btn-primary">Add Category</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="p-3 bg-light mb-3 rounded">
            <div class="row justify-content-end g-2">
                <div class="col-lg-2">
                    <button type="submit" class="btn btn-success w-100">Save Assignments</button>
                </div>
            </div>
        </div>
    </form>

    {{-- Template for Addon Group --}}
    <template id="group-template">
        <div class="addon-group-block border rounded p-3 mb-3 bg-white" data-index="{index}">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="mb-0 text-primary group-title">{CategoryName}</h5>
                <button type="button" class="btn btn-danger btn-sm remove-group">Remove Group</button>
            </div>

            <input type="hidden" name="addon_groups[{index}][addon_category_id]" value="{CategoryId}"
                class="input-category-id">

            <div class="row g-3 mb-3">
                <div class="col-md-3">
                    <label class="form-label btn-sm p-0">Type</label>
                    <select name="addon_groups[{index}][selection_type]"
                        class="form-control form-control-sm input-selection-type">
                        <option value="single">Single Select</option>
                        <option value="multiple">Multiple Select</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label btn-sm p-0">Min Qty</label>
                    <input type="number" name="addon_groups[{index}][min_qty]"
                        class="form-control form-control-sm input-min" value="" min="0">
                </div>
                <div class="col-md-2">
                    <label class="form-label btn-sm p-0">Max Qty</label>
                    <input type="number" name="addon_groups[{index}][max_qty]"
                        class="form-control form-control-sm input-max" value="" min="0">
                </div>
                <div class="col-md-2">
                    <label class="form-label btn-sm p-0">Sort Order</label>
                    <input type="number" name="addon_groups[{index}][sort_order]"
                        class="form-control form-control-sm input-sort" value="0">
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <div class="form-check">
                        <input class="form-check-input input-required" type="checkbox"
                            name="addon_groups[{index}][is_required]" value="1" id="req-{index}">
                        <label class="form-check-label" for="req-{index}">Required</label>
                    </div>
                </div>
            </div>

            <div class="addon-items-section border-top pt-2">
                <label class="form-label"><strong>Addon Items:</strong></label>
                <div class="items-container row g-2">
                    {{-- Checkboxes will be injected here --}}
                </div>
            </div>
        </div>
    </template>

    {{-- Template for Addon Item Checkbox --}}
    <template id="item-template">
        <div class="col-md-4 col-sm-6 mt-1">
            <label class="border p-1 rounded-1 d-flex flex-column gap-0 h-100 cursor-pointer "
                for="item-{groupIndex}-{itemId}">
                <div class="form-check">
                    <input class="form-check-input item-checkbox" type="checkbox"
                        name="addon_groups[{groupIndex}][items][{itemId}][selected]" value="1"
                        id="item-{groupIndex}-{itemId}">
                    <label class="form-check-label " for="item-{groupIndex}-{itemId}">
                        {ItemName} | <span style="font-size: 12px;" class="text-success">(£ {price})</span>
                    </label>
                </div>
                {{-- <div class="d-flex gap-2">
                    <div class="input-group input-group-sm">
                        <span class="input-group-text">Price</span>
                        <input type="number" step="0.01" name="addon_groups[{groupIndex}][items][{itemId}][price]"
                            class="form-control item-price" placeholder="Price" value="{ItemPrice}">
                    </div>
                </div> --}}
                {{-- <div class="d-flex gap-2">
                    <div class="input-group input-group-sm">
                        <span class="input-group-text">Sort Order</span>
                        <input type="number" name="addon_groups[{groupIndex}][items][{itemId}][sort_order]"
                            class="form-control item-sort" placeholder="0" value="0">
                    </div>
                </div> --}}
            </label>
        </div>
    </template>
@endsection

@section('javascript')
    <script>
        $(document).ready(function() {
            const allAddonItems = @json($addonItems);
            const existingGroups = @json($product->addonGroups); // Includes items due to eager load

            let groupCounter = 0;

            function renderGroup(categoryName, categoryId, groupData = null) {
                let index = groupCounter++;
                let template = document.getElementById('group-template').innerHTML;
                let html = template
                    .replace(/{index}/g, index)
                    .replace(/{CategoryName}/g, categoryName)
                    .replace(/{CategoryId}/g, categoryId);

                let $groupBlock = $(html);

                // If editing existing
                if (groupData) {
                    $groupBlock.find('.input-selection-type').val(groupData.selection_type);
                    $groupBlock.find('.input-min').val(groupData.min_qty);
                    $groupBlock.find('.input-max').val(groupData.max_qty);
                    $groupBlock.find('.input-sort').val(groupData.sort_order);
                    if (groupData.is_required) {
                        $groupBlock.find('.input-required').prop('checked', true);
                    }
                }

                // Render Items
                let itemContainer = $groupBlock.find('.items-container');
                let itemTemplate = document.getElementById('item-template').innerHTML;


                allAddonItems.forEach(item => {
                    let isSelected = false;
                    let existingItemData = null;

                    if (groupData && groupData.items) {
                        existingItemData = groupData.items.find(i => i.addon_item_id === item.id);
                        if (existingItemData) isSelected = true;
                    }

                    let itemHtml = itemTemplate
                        .replace(/{groupIndex}/g, index)
                        .replace(/{itemId}/g, item.id)
                        .replace(/{ItemName}/g, item.name)
                        .replace(/{price}/g, item.price)
                        .replace(/{ItemPrice}/g, existingItemData ? existingItemData.price : null);

                    let $itemBlock = $(itemHtml);

                    if (isSelected) {
                        $itemBlock.find('.item-checkbox').prop('checked', true);
                        if (existingItemData) {
                            $itemBlock.find('.item-sort').val(existingItemData.sort_order);
                        }
                    }

                    itemContainer.append($itemBlock);
                });

                $('#addon-groups-container').append($groupBlock);
            }

            // Load Existing Data
            if (existingGroups && existingGroups.length > 0) {
                existingGroups.forEach(group => {
                    // We need the category name. Since we only have ID in group, we can match from the dropdown options or pass categories json
                    let catName = $(`#addonCategorySelector option[value="${group.addon_category_id}"]`)
                        .data('name') || 'Unknown Category';
                    renderGroup(catName, group.addon_category_id, group);
                });
            }

            // Add New Group
            $('#btnAddCategory').click(function() {
                let categoryId = $('#addonCategorySelector').val();
                let categoryName = $('#addonCategorySelector option:selected').data('name');

                if (!categoryId) {
                    alert('Please select a category');
                    return;
                }

                // Check if already added? Maybe allow multiples of same category? The schema allows strict unique (itemId, catId). 
                // Migration says: $table->unique(["item_id", "addon_category_id"]); 
                // So we should prevent duplicate categories.

                let alreadyExists = false;
                $('.input-category-id').each(function() {
                    if ($(this).val() == categoryId) alreadyExists = true;
                });

                if (alreadyExists) {
                    alert('This category is already assigned. Please edit the existing block.');
                    return;
                }

                renderGroup(categoryName, categoryId);
                $('#addonCategorySelector').val('');
            });

            // Remove Group
            $(document).on('click', '.remove-group', function() {
                if (confirm('Are you sure checking to remove this group assignment?')) {
                    $(this).closest('.addon-group-block').remove();
                }
            });
        });
    </script>
@endsection
