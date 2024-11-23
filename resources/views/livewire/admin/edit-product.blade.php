@push('title')
    Update Product
@endpush
<div>
    <!-- create product -->
    <div class="container my-3">
        <div class="p-3 mx-auto bg-white border rounded shadow">
            <h3 class="text-center">Edit Product</h3>
            <form wire:submit='update()' method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="container row">
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="name" class="form-label">Product Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                id="name" name="name" wire:model='name'>
                        </div>
                        @error('name')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror

                        <div class="mb-3">
                            <label for="images" class="form-label">Images</label>
                            <input class="form-control @error('images') is-invalid @enderror" type="file"
                                id="images" name="images" wire:model='images' multiple>
                                <div wire:loading.class="mt-2 progress progress-bar-animated d-block w-100" wire:target="images" class="w-0 progress-bar progress-bar-striped"
                                role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" hidden></div>
                            @if ($product->image)
                                @php
                                    $images = json_decode($product->image);
                                @endphp
                                <div class="overflow-x-auto card-img-container d-flex">
                                    @foreach ($images as $image)
                                        <img src="{{ asset('storage/' . $image) }}" class="mx-2 my-2 border card-img"
                                            alt="Product Image" style="width:40px;height:30px;">
                                    @endforeach
                                </div>
                            @endif
                        </div>
                        @error('images.*')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                        @error('images')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror

                        <div class="mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input type="text" class="form-control @error('price') is-invalid @enderror"
                                id="price" name="price" wire:model='price' value="{{ $product->price }}">
                        </div>
                        @error('price')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror

                        <div class="mb-3">
                            <label for="color" class="form-label">Colors <span class="text-muted">(Red,Green,Blue...)</span></label>
                            <input type="text" class="form-control @error('color') is-invalid @enderror"
                                id="color" wire:model='color' name="color">
                        </div>
                        @error('color')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror

                        <div class="mb-3">
                            <label for="size" class="form-label">Sizes <span class="text-muted">(sm,l,xl...)</span></label>
                            <input type="text" class="form-control @error('size') is-invalid @enderror"
                                id="size" wire:model='size' name="size">
                        </div>
                        @error('size')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                rows="3" wire:model='description'>{{ $product->description }}</textarea>
                        </div>
                        @error('description')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror

                    </div>


                    <div class="col-6">
                        <div class="mb-3">
                            <label for="brand" class="form-label">Brand</label>
                            <input type="text" class="form-control @error('brand') is-invalid @enderror"
                                id="brand" wire:model='brand' name="brand">
                        </div>
                        @error('brand')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror

                        <div class="mb-3">
                            <label for="stock" class="form-label">Stock</label>
                            <input type="number" class="form-control @error('stock') is-invalid @enderror"
                                id="stock" wire:model='stock' name="stock">
                        </div>
                        @error('stock')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror

                        <div class="mb-3">
                            <label for="category" class="form-label">Category</label>
                            <select class="form-select @error('category') is-invalid @enderror" name="category"
                                wire:model='category' id="category">
                                <option selected disabled>Select a Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ isset($product->category) && $product->category->id == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Subcategories -->
                        <div class="mb-3">
                            <label for="subcategories" class="form-label">Sub categories</label>
                            <select wire:model='subcategory_ids'
                                class="form-select @error('subcategory_ids') is-invalid @enderror" id="subcategories"
                                name="subcategory_ids[]" multiple>

                            </select>
                            @error('subcategory_ids')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <label class="form-check-label text-muted" for="flexSwitchCheckChecked">
                                    Enabled or Disabled Product
                                </label>
                                <input class="form-check-input" type="checkbox" role="switch"
                                    id="flexSwitchCheckChecked" wire:model="is_active" wire:change="toggleStatus"
                                    @if ($is_active == 0) checked @endif />
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="mx-auto mt-2 btn btn-sm col-2 btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>

@push('script')
    <script>
        $(document).ready(function() {

            populateSubcategories('{{ $product->category_id }}', @json($product->subcategories->pluck('id')->toArray()));

            $('#category').change(function() {
                var categoryId = $(this).val();
                populateSubcategories(categoryId, []);
            });

            function populateSubcategories(categoryId, selectedSubcategories) {
                if (categoryId) {
                    $.ajax({
                        url: '/subcategories/' + categoryId,
                        type: 'GET',
                        success: function(data) {
                            $('#subcategories').empty();
                            $.each(data, function(key, value) {
                                var isSelected = selectedSubcategories.includes(parseInt(key)) ?
                                    'selected' : '';
                                $('#subcategories').append('<option value="' + key + '" ' +
                                    isSelected + '>' + value + '</option>');
                            });
                        }
                    });
                } else {
                    $('#subcategories').empty();
                }
            }
        });
    </script>
@endpush
