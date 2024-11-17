@push('title')
    Create Category
@endpush
<!-- create Category position-absolute top-50 start-50 translate-middle-->
<div>
    <div class="container my-5">
        <div class="row">
            <div class="p-3 bg-white border rounded shadow col-md-6">
                <h3 class="text-center">Create Category</h3>
                <form wire:submit.prevent='store' method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="name" class="form-label">Category Name</label>
                        <input type="text" wire:model='name' class="form-control @error('name') is-invalid @enderror"
                            id="name" name="name">
                    </div>
                    @error('name')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror

                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input class="form-control @error('image') is-invalid @enderror" type="file" id="image"
                            name="image" wire:model='image'>
                                <div wire:loading.class="mt-2 progress progress-bar-animated d-block w-100" wire:target="image" class="w-0 progress-bar progress-bar-striped"
                                role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" hidden></div>
                    </div>
                    @error('image')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <button wire:loading.attr="disabled" wire:target="image" type="submit"
                        class="mt-2 btn btn-primary">Submit</button>

                </form>
            </div>

            {{-- child category --}}
            <div class="p-3 bg-white border rounded shadow col-md-5 ms-5">
                <h3 class="text-center">Create Sub Category</h3>
                <form wire:submit='subcat_save' method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="categories" class="form-label">Categories</label>
                        <select wire:model='category_id' class="form-select @error('category_id') is-invalid @enderror"
                            id="category_id" name="category_id" required>

                            <option selected>--Select Category--</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">
                                    {{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="subcategory" class="form-label">Sub Category Name</label>
                        <input type="text" class="form-control @error('subcategory') is-invalid @enderror"
                            id="subcategory" wire:model='subcategory' name="subcategory">
                    </div>
                    @error('subcategory')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror

                    <button type="submit" class="mt-2 btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
