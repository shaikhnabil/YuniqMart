@push('title')
    Edit Category
@endpush
<!-- create Category position-absolute top-50 start-50 translate-middle-->
<div>
    <div class="container my-5">
        <div class="row">
            <div class="p-3 bg-white border rounded shadow ">
                <h3 class="text-center">Update Category</h3>
                <form wire:submit.prevent='update({{$category->id}})' method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="name" class="form-label">Category Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name" wire:model='name' value="{{ $category->name }}">
                    </div>
                    @error('name')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror

                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input class="form-control @error('image') is-invalid @enderror" type="file" id="image"
                            name="image" wire:model='image'>
                        @if ($category->image)
                            <div class="overflow-x-auto card-img-container d-flex">
                                <img src="{{ asset('storage/' . $category->image) }}" class="mx-2 my-2 border card-img"
                                    alt="Product Image" style="width:40px;height:30px;">
                            </div>
                        @endif
                        <div wire:loading.class="mt-2 progress progress-bar-animated d-block w-100" wire:target="image" class="w-0 progress-bar progress-bar-striped"
                                role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" hidden></div>

                    </div>
                    @error('image')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror

                    <button type="submit" wire:loading.attr="disabled" wire:target="image" class="mt-2 btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
