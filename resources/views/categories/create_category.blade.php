@extends('admin.dashboard')
@section('main')
@push('title') Create Category @endpush
    <!-- create Category position-absolute top-50 start-50 translate-middle-->
    <div class="container my-5">
        <div class="row">
        <div class="p-3 bg-white border rounded shadow col-md-6">
            <h3 class="text-center">Create Category</h3>
            <form action="/create-category" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Category Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name">
                </div>
                @error('name')<p class="text-danger">{{ $message }}</p>@enderror

                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image">
                </div>
                @error('image')<p class="text-danger">{{ $message }}</p>@enderror

                <button type="submit" class="mt-2 btn btn-primary">Submit</button>
            </form>
        </div>

        {{-- child category --}}
        <div class="p-3 bg-white border rounded shadow col-md-5 ms-5">
            <h3 class="text-center">Create Child Category</h3>
            <form action="/child_category" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="categories" class="form-label">Categories</label>
                    <select class="form-select @error('category') is-invalid @enderror" id="category"
                        name="category_id" required>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{  old('category') ? 'selected' : '' }}>
                                {{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('categories')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label">Child Category Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name">
                </div>
                @error('name')<p class="text-danger">{{ $message }}</p>@enderror

                <button type="submit" class="mt-2 btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
    </div>

@endsection
