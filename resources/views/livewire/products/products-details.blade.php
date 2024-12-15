<div>
    @push('title')
        Product Details
    @endpush
    @section('css')
        <style>
            /* .quantity-input {
                width: 80px !important;
                text-align: center;
            } */

            .cart .row {
                gap: 10px;
            }

            @media (max-width: 768px) {
    /* Stack buttons vertically on small screens */
    .cart .col-12,
    .cart .col-md-6 {
        width: 100%;
    }
}


            @media (min-width: 768px) {
             /* Constrain the overall card height */
             .cd {
                max-height: 90vh;
                display: flex;
                flex-direction: row;
            }

            /* Product image container */
            .images {
                position: sticky;
                top: 0;
                height: 90vh;
                overflow: hidden;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
            }

            #main-image {
                max-width: 100%;
                height: auto;
                object-fit: contain;
            }

            .thumbnail img {
                margin: 5px;
                cursor: pointer;
                border: 2px solid transparent;
                transition: border-color 0.3s ease;
            }

            .thumbnail img:hover {
                border-color: #007bff;
            }

            /* Scrollable product details */
            .product {
                max-height: 90vh;
                overflow-y: auto;
                padding: 15px;
            }

            /* Hide scrollbar for product details */
            .product::-webkit-scrollbar {
                width: 0;
                display: none;
            }

            .product {
                -ms-overflow-style: none;
                scrollbar-width: none;
            }
        }
        </style>
    @endsection

    @if (session('success'))
        <x-alert :msg="session('success')"></x-alert>
    @endif

    <div class="container-fluid my-2">
        <div class="row d-flex justify-content-center">
            <div class="col-12 col-md-10 col-lg-12">
                <div class="card cd">
                    <div class="row g-0">
                        <!-- Product Images Section -->
                        @php
                            $images = $product->image ? json_decode($product->image) : [];
                        @endphp
                        <div class="col-12 col-md-6">
                            <div class="p-3 images">
                                <div class="p-4 text-center">
                                    <img id="main-image" src="{{ $images ? asset('storage/' . $images[0]) : asset('storage/products/default.png') }}"
                                         class="img-fluid" style="max-height: 300px; object-fit: cover;" />
                                </div>
                                @if (!empty($images))
                                    <div class="d-flex justify-content-center flex-wrap gap-2 thumbnail">
                                        @foreach ($images as $image)
                                            <img onclick="change_image(this)" src="{{ asset('storage/' . $image) }}" width="70"
                                                 class="img-thumbnail" style="cursor: pointer;">
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
    
                        <!-- Product Details Section -->
                        <div class="col-12 col-md-6 product">
                            <div class="p-4 product">
                                <div class="mt-2 mb-3">
                                    <span class="text-uppercase text-muted brand">{{ $product->brand ?? '' }}</span>
                                    <h5 class="text-uppercase">{{ $product->name }}</h5>
                                    <div class="price d-flex align-items-center">
                                        <span class="act-price fw-bold">₹{{ number_format($product->price, 2) }}</span>
                                        <div class="ml-2">
                                            @if ($product->discount)
                                                <small class="text-muted ms-2">₹{{ number_format($product->price - ($product->price * $product->discount) / 100, 2) }}</small>
                                                <span class="badge bg-success ms-2">{{ $product->discount }}% OFF</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
    
                                <p class="about">{!! $product->description !!}</p>
    
                                <!-- Color Selection -->
                                @if (!empty($product->color))
                                    <div class="mt-2 colors">
                                        <h6 class="text-uppercase">Color</h6>
                                        @php
                                            $colors = explode(',', $product->color);
                                        @endphp
                                        <div class="d-flex gap-2 flex-wrap">
                                            @foreach ($colors as $color)
                                                <label class="radio">
                                                    <input type="radio" name="color" wire:model="color"
                                                           value="{{ $color }}" @if ($loop->first) checked @endif>
                                                    <span>{{ $color }}</span>
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
    
                                <!-- Size Selection -->
                                @if (!empty($product->size))
                                    <div class="mt-2 sizes">
                                        <h6 class="text-uppercase">Size</h6>
                                        @php
                                            $sizes = explode(',', $product->size);
                                        @endphp
                                        <div class="d-flex gap-2 flex-wrap">
                                            @foreach ($sizes as $size)
                                                <label class="radio">
                                                    <input type="radio" name="size" wire:model="size"
                                                           value="{{ $size }}" @if ($loop->first) checked @endif>
                                                    <span>{{ $size }}</span>
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
    
                                @if (!empty($product->stock))
                                    <p class="mt-2 text-muted">Available Stock: {{ $product->stock }} units</p>
                                @endif
    
                                <!-- Add to Cart and Buy Now Buttons -->
                                <div class="mt-4 cart">
                                    <div class="row g-2">
                                        @if (session('cart') && array_key_exists($product->id, session('cart')))
                                            <div class="col-12 col-md-6">
                                                <form wire:submit='remove({{ $product->id }})' method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger w-100">
                                                        <i class="bi bi-cart-x"></i> Remove From Cart
                                                    </button>
                                                </form>
                                            </div>
                                        @else
                                            <div class="col-12 col-md-6">
                                                <form wire:submit.prevent="addToCart({{ $product->id }})" method="POST">
                                                    @csrf
                                                    <div class="input-group">
                                                        <input type="number" name="quantity" wire:model="quantity"
                                                               class="form-control" value="1" min="1"
                                                               placeholder="Quantity">
                                                        <button type="submit" class="btn btn-primary">
                                                            <i class="bi bi-cart-plus"></i> Add to Cart
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        @endif
    
                                        <div class="col-12 col-md-6">
                                            <form wire:submit.prevent='directCheckout({{ $product->id }})' method="POST">
                                                @csrf
                                                <input type="hidden" name="quantity" wire:model="quantity" value="1">
                                                <button type="submit" class="btn btn-dark w-100">
                                                    <i class="bi bi-cart-check"></i> Buy Now
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
    
                                <!-- Category and Subcategories -->
                                <p class="mt-3 text-muted">{{ $product->category->name ?? '' }}
                                    @if ($product->subcategories->isNotEmpty())
                                        @foreach ($product->subcategories as $subcategory)
                                            <span class="badge bg-secondary">{{ $subcategory->subcategory }}</span>
                                        @endforeach
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <script>
            function change_image(element) {
                var mainImage = document.getElementById('main-image');
                mainImage.src = element.src;
            }
        </script>
    </div>
    
    
    {{-- <div class="container mt-3 mb-3">
        <div class="row d-flex justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="row">
                        <!-- Product Images Section -->
                        @php
                            $images = $product->image ? json_decode($product->image) : [];
                        @endphp
                        <div class="col-md-6">
                            <div class="p-3 images">
                                <div class="p-4 text-center">
                                    <img id="main-image"
                                        src="{{ $images ? asset('storage/' . $images[0]) : asset('storage/products/default.png') }}"
                                        width="250" />
                                </div>
                                @if (!empty($images))
                                    <div class="text-center thumbnail">
                                        @foreach ($images as $image)
                                            <img onclick="change_image(this)" src="{{ asset('storage/' . $image) }}"
                                                width="70">
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Product Details Section -->
                        <div class="col-md-6">
                            <div class="p-4 product">
                                <div class="mt-2 mb-3">
                                    <span class="text-uppercase text-muted brand">{{ $product->brand ?? '' }}</span>
                                    <h5 class="text-uppercase">{{ $product->name }}</h5>
                                    <div class="price d-flex align-items-center">
                                        <span class="act-price fw-bold">₹{{ number_format($product->price, 2) }}</span>
                                        <div class="ml-2">
                                            @if ($product->discount)
                                                <small
                                                    class="dis-price">₹{{ number_format($product->price - ($product->price * $product->discount) / 100, 2) }}</small>
                                                <span>{{ $product->discount }}% OFF</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <p class="about">{{ $product->description }}</p>

                                <!-- Color Selection -->
                                @if (!empty($product->color))
                                    <div class="mt-2 colors">
                                        <h6 class="text-uppercase">Color</h6>
                                        @php
                                            $colors = explode(',', $product->color);
                                        @endphp
                                        @foreach ($colors as $color)
                                            <label class="radio">
                                                <input type="radio" name="color" wire:model="color"
                                                    value="{{ $color }}"
                                                    @if ($loop->first) checked @endif>
                                                <span>{{ $color }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                @endif

                                <!-- Size Selection -->
                                @if (!empty($product->size))
                                    <div class="mt-2 sizes">
                                        <h6 class="text-uppercase">Size</h6>
                                        @php
                                            $sizes = explode(',', $product->size);
                                        @endphp
                                        @foreach ($sizes as $size)
                                            <label class="radio">
                                                <input type="radio" name="size" wire:model="size"
                                                    value="{{ $size }}"
                                                    @if ($loop->first) checked @endif>
                                                <span>{{ $size }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                @endif


                                @if (!empty($product->stock))
                                    <p><span class="mt-2 text-muted">Available Stock:</span> {{ $product->stock }}
                                        units</p>
                                @endif

                                <!-- Add to Cart and Buy Now Buttons -->
                                <div class="mt-4 cart align-items-center">
                                    <div class="row">
                                        @if (session('cart') && array_key_exists($product->id, session('cart')))
                                            <div class="col-md-6">
                                                <form wire:submit='remove({{ $product->id }})' method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger"><i
                                                            class="bi bi-cart-x"> Remove From
                                                            Cart</i></button>
                                                </form>
                                            </div>
                                        @else
                                            <div class="col-md-6">
                                                <form wire:submit.prevent="addToCart({{ $product->id }})"
                                                    method="POST">
                                                    @csrf
                                                    <div class="input-group">
                                                        <input type="number" name="quantity" wire:model="quantity"
                                                            class="form-control" value="1" min="1"
                                                            placeholder="Quantity">
                                                        <button type="submit" class="btn btn-primary text-uppercase"><i
                                                                class="bi bi-cart-plus"></i> Add to
                                                            Cart</button>
                                                    </div>
                                                </form>
                                            </div>
                                        @endif

                                        <div class="col-md-6">
                                            <form wire:submit.prevent='directCheckout({{ $product->id }})'
                                                method="POST">
                                                @csrf
                                                <input type="hidden" name="quantity" wire:model="quantity"
                                                    value="1">
                                                <button type="submit" class="btn btn-dark text-uppercase w-100">
                                                    <i class="bi bi-cart-check"></i> Buy Now
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- category and subcategories -->
                                <p class="mt-3 disabled text-muted">{{ $product->category->name ?? '' }}
                                    @if ($product->subcategories->isNotEmpty())
                                        @foreach ($product->subcategories as $subcategory)
                                            <span class="badge bg-secondary">{{ $subcategory->subcategory }}</span>
                                        @endforeach
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function change_image(element) {
            var mainImage = document.getElementById('main-image');
            mainImage.src = element.src;
        }
    </script>
</div> --}}
