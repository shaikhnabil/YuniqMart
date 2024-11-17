<div>
    @push('title')
        Home
    @endpush

    <!-- Display all products-->
    <div class="container my-3">
        <h3 class="my-2 text-center">Products</h3>

        <!-- No Products Alert -->
        @if ($products->isEmpty())
            <div class="my-4 text-center alert alert-warning" role="alert">
                <strong>No products available.</strong>
            </div>
        @endif

        <!-- Product Grid -->
        <div class="row">
            @foreach ($products as $product)
                <div class="col-12 col-md-6 col-lg-4 mt-4">
                    <a href="{{ route('products.show', $product->id) }}" wire:navigate class="text-decoration-none text-dark">
                        <div class="shadow card" style="width: 100%;height:500px; ">

                            <!-- Check if images array is not empty -->
                            @php
                                $images = $product->image ? json_decode($product->image) : [];
                            @endphp

                            <!-- Carousel or Default Image -->
                            @if (!empty($images))
                                <!-- Carousel -->
                                <div id="carousel-{{ $product->id }}" class="carousel slide p-2"
                                    data-bs-ride="carousel">
                                    <div class="carousel-inner">
                                        @foreach ($images as $index => $image)
                                            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                                <img src="{{ asset('storage/' . $image) }}" class="img-fluid"
                                                    alt="Product Image"
                                                    style="width: 100%; height: 200px; object-fit: contain; border-radius: 5px;">
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
                                    <hr>
                                </div>
                            @else
                                <!-- Default Image -->
                                <div class="border-bottom">
                                    <img src="{{ asset('storage/products/default.png') }}" class="p-2 img-fluid"
                                        alt="Default Product Image"
                                        style="object-fit: contain; width: 100%; height: 150px;">
                                </div>
                            @endif

                            <!-- Product Details -->
                            <div class="card-body" style="text-align: justify;">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="my-0 card-text"><span class="fw-bold">Description: </span>
                                    {{ Str::words($product->description, 12, '...') }}</p>
                                <p class="my-0 card-text"><span class="fw-bold">Price: </span>
                                    ₹{{ number_format($product->price, 2) }}</p>
                                <p class="my-0 card-text"><span class="fw-bold">Category: </span>
                                    {{ $product->category->name ?? 'None' }}</p>
                    </a>
                </div>
        </div>
    </div>
    @endforeach
</div>

<!-- Pagination -->
<div class="container mt-3 d-flex justify-content-center">
    {{ $products->links() }}
</div>
</div>
</div>

{{-- <div>
    @push('title')
        Home
    @endpush

    <!-- Display all products-->
    <div class="container my-3">
        <h3 class="my-2 text-center">Productsss</h3>
        <div class="row">
            <div class="container">
                @if ($products->isEmpty())
                    <div class="my-4 text-center alert alert-warning" role="alert">
                        <strong>No products available.</strong>
                    </div>
                @endif
            </div>

            @foreach ($products as $product)
                <div class="mx-auto mt-4 shadow card" style="width: 20rem;">
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
                                        <img src="{{ asset('storage/' . $image) }}" class="p2 img-fluid"
                                            alt="Product Image"
                                            style="object-fit: contain; 100%">
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
                            {{ Str::words($product->description, 12, '...') }}</p>
                        <p class="my-0 card-text"><span class="fw-bold">Price: </span>
                            <td>₹{{ number_format($product->price, 2) }}</td>
                        </p>
                        <p class="my-0 card-text"><span class="fw-bold">Category:
                            </span>{{ $product->category->name ?? 'None' }}</p>
                        <a href="{{ route('products.show', $product->id) }}" wire:navigate
                            class="mt-2 btn btn-primary float-end"><i class="bi bi-arrow-right-circle"> View</i></a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="container mt-2">
            {{ $products->links() }}
        </div>
    </div>
</div> --}}
