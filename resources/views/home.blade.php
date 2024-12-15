@extends('layouts.main')
@push('title')
    Home
@endpush

@section('main')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('success') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Display all products-->
    <div class="container my-3">
        <h3 class="my-2 text-center">home Products</h3>
        <div class="row">

            {{-- @foreach ($products as $product)
    <div class="mx-2 card" style="width: 20rem;">
        @if ($product->image)
        @php
            $images = json_decode($product->image);
        @endphp
        @foreach ($images as $image)
            <img src="{{ asset('storage/' . $image) }}" class="card-img-top" alt="Product Image" style="width:100px;">
        @endforeach
    @endif
        <div class="card-body">
          <h5 class="card-title">{{ $product->name }}</h5>
          <p class="card-text"><span class="fw-bold">Description: </span> {{  Str::words($product->description , 10, '...') }}</p>
          <p class="card-text"><span class="fw-bold">Price:  </span>{{ $product->price }}</p>
          <p class="card-text"><span class="fw-bold">Category:  </span>{{ $product->category->name }}</p>
          <a href="product/{{$product->slug}}" class="btn btn-primary">View</a>
        </div>
      </div>
    @endforeach --}}
            <div class="container">
                @if ($products->isEmpty())
                    <div class="my-4 text-center alert alert-warning" role="alert">
                        <strong>No products available.</strong>
                    </div>
                @endif
            </div>

            @foreach ($products as $product)
                <div class="mx-auto mt-2 shadow card" style="width: 22rem;">
                    @php
                        $images = $product->image ? json_decode($product->image) : [];
                    @endphp

                    <!-- Check if images array is not empty -->
                    @if (!empty($images))
                        <!-- Carousel -->
                        <div id="carousel-{{ $product->id }}" class="p-2 carousel slide border-bottom"
                            data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @foreach ($images as $index => $image)
                                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                        <img src="{{ asset('storage/' . $image) }}" class="p2 img-fluid" alt="Product Image"
                                            style="object-fit: contain; width: 100%; height: 150px;">
                                    </div>
                                @endforeach
                            </div>
                            <button class="carousel-control-prev" type="button"
                                data-bs-target="#carousel-{{ $product->id }}" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button"
                                data-bs-target="#carousel-{{ $product->id }}" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    @else
                        <!-- Default Image -->
                        <div class="border-bottom" style="">
                            <img src="{{ asset('storage/products/default.png') }}" class="p-2 img-fluid"
                                alt="Default Product Image" style="object-fit: contain; width: 100%; height: 200px;">
                        </div>
                    @endif

                    <div class="card-body" style="text-align: justify;">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="my-0 card-text"><span class="fw-bold">Description: </span>
                            {{ Str::words(strip_tags($product->description), 12, '...') }}</p>
                            {{-- {{ Str::words($product->description, 12, '...') }}</p> --}}
                        <p class="my-0 card-text"><span class="fw-bold">Price: </span>
                            <td>₹{{ number_format($product->price, 2) }}</td>
                        </p>
                        <p class="my-0 card-text"><span class="fw-bold">Category:
                            </span>{{ $product->category->name ?? 'None' }}</p>
                        <a href="{{ route('products.show', $product->slug) }}" class="mt-2 btn btn-primary float-end"><i
                                class="bi bi-arrow-right-circle"> View</i></a>
                    </div>
                </div>
            @endforeach


        </div>
        <div class="container mt-2">
            {{ $products->links() }}
        </div>
    </div>
@endsection
