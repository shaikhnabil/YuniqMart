<div>
    @push('title')
        Create Products
    @endpush
    <!-- create product -->
    <div class="container my-3">

        <form method="POST" enctype="multipart/form-data">

            <div class="mb-3 row">
                <div class="col-4">
                    <a href="{{ asset('storage/templates/create_products_excel_template.xlsx') }}" download class="btn btn-dark">
                        <i class="bi bi-arrow-down-circle"> products Template</i>
                    </a>
                </div>
                <div class="col-4">
                    <input type="file" class="form-control d-none @error('bulkFile') is-invalid @enderror" id="bulkFile"
                        wire:model="bulkFile" wire:change='importProducts'>
                        <label for="bulkFile" class="btn btn-dark">
                            <i class="bi bi-cloud-upload"> Choose File</i>
                        </label>
                    @error('bulkFile')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                {{-- <div class="col-4">
                    <button type="submit" class="btn btn-dark"><i class="bi bi-cloud-upload"> Import Products</i></button>
                </div> --}}
            </div>

        </form>


        <div class="p-3 mx-auto bg-white border rounded shadow">
            <h3 class="text-center">Create Product</h3>
            <form wire:submit='save'>
                <div class="container row">
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="name" class="form-label">Product Name *</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                id="name" name="name" wire:model='name'>
                        </div>
                        @error('name')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror

                        <div class="mb-3">
                            <label for="images" id="incoming" class="form-label">Images</label>
                            <input class="form-control @error('images.*') is-invalid @enderror" type="file"
                                wire:model='images' id="images" name="images" multiple>
                        </div>
                        @error('images.*')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                        @error('images')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror


                        <div class="mb-3">
                            <label for="price" class="form-label">Price *</label>
                            <input type="text" class="form-control @error('price') is-invalid @enderror"
                                id="price" wire:model='price' name="price">
                        </div>
                        @error('price')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror

                        <div class="mb-3">
                            <label for="color" class="form-label">Colors <span
                                    class="text-muted">(Red,Green,Blue...)</span></label>
                            <input type="text" class="form-control @error('color') is-invalid @enderror"
                                id="color" wire:model='color' name="color">
                        </div>
                        @error('color')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror

                        <div class="mb-3">
                            <label for="size" class="form-label">Sizes <span
                                    class="text-muted">(sm,l,xl...)</span></label>
                            <input type="text" class="form-control @error('size') is-invalid @enderror"
                                id="size" wire:model='size' name="size">
                        </div>
                        @error('size')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror

                        <div class="mb-3">
                            <label for="description" class="form-label">Description *</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                wire:model='description' rows="3"></textarea>
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
                            <label for="Category" class="form-label">Category</label>
                            <select class="form-select @error('category') is-invalid @enderror" wire:model='category'
                                required name="category" id="category">
                                <option class="text-muted bg-secondary">Categories</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="subcategories" class="form-label">Subcategories</label>
                            <select class="form-select @error('subcategory_ids') is-invalid @enderror"
                                id="subcategories" wire:model='subcategory_ids' name="subcategory_ids[]" multiple>
                            </select>
                            @error('subcategory_ids')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- <div class="mb-3">
                    <label for="subcategories" class="form-label">Subcategories (Populated based on category)</label>
                    <select class="form-select @error('subcategory_ids') is-invalid @enderror" required
                        id="subcategories" wire:model="subcategory_ids" name="subcategory_ids[]" multiple>
                        @foreach ($subcategories as $subcategory)
                            <option value="{{ $subcategory->id }}">{{ $subcategory->subcategory }}</option>
                        @endforeach
                    </select>
                    @error('subcategory_ids')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div> --}}

                    <button type="submit" class="mx-auto mt-2 btn btn-sm col-2 btn-primary ">Submit</button>
            </form>
        </div>
    </div>
</div>

@push('script')
    <script>
        $(document).ready(function() {
            $('#category').change(function() {
                var categoryId = $(this).val();
                if (categoryId) {
                    $.ajax({
                        url: '/subcategories/' + categoryId,
                        type: 'GET',
                        beforeSend: function() {

                            $('#subcategories').empty();
                            $('#subcategories').append(
                                '<option>Loading...</option>');
                        },
                        success: function(data) {
                            $('#subcategories')
                                .empty();

                            $.each(data, function(key, value) {
                                $('#subcategories').append('<option value="' + key +
                                    '">' + value + '</option>');
                            });
                        },
                        error: function() {
                            $('#subcategories').empty();
                            $('#subcategories').append(
                                '<option>No subcategories found</option>');
                        }
                    });
                } else {
                    $('#subcategories').empty();
                }
            });
        });
    </script>
@endpush
