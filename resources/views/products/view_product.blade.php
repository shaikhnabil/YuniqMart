@extends('layouts.main')
@push('title')
    Product Details
@endpush
@section('css')
<style>
.quantity-input {
    width: 80px !important;
    text-align: center;
}
</style>
@endsection
@section('main')
    @if (session('success'))
        <x-alert :msg="session('success')"></x-alert>
    @endif
    <div class="container my-3 w-100">
        <div class="card mx-2 border p-3 shadow rounded bg-white">
            @php
                $images = $product->image ? json_decode($product->image) : [];
            @endphp
            @if (!empty($images))
                <div class="card-img-container d-flex overflow-x-auto" style="height:400px;">
                    @foreach ($images as $image)
                        <img src="{{ asset('storage/' . $image) }}" class="card-img mx-2 my-2 border p-3" alt="Product Image"
                            style="width:400px;height:auto;">
                    @endforeach
                </div>
            @else
                <img src="{{ asset('storage/products/default.png') }}" class="product-image" alt="Default Product Image"
                    style="width:400px;height:300px; object-fit: cover;">
            @endif
            <hr>
            <div class="card-body">
                <h3 class="card-title mb-4">{{ $product->name }}</h3>
                <p class="card-text mb-0"><span class="fw-bold">Description: </span> {!! $product->description !!}</p>
                <p class="card-text mb-0"><span class="fw-bold">Price: </span>₹{{ number_format($product->price, 2) }}</p>
                <p class="card-text mb-0"><span class="fw-bold">Category: </span>{{ $product->category->name ?? 'None' }}</p>
                <p class="card-text"><span class="fw-bold">Sub Categories: </span>
                    @foreach ($product->subcategories as $subcategory)
                        <span class="badge bg-secondary">{{ $subcategory->name }}</span>
                    @endforeach
                </p>

                    <!-- Quantity and Add/Remove Cart Buttons -->
                    <div class="container mx-0">
                        <div class="row float-end">
                            @if (session('cart') && array_key_exists($product->id, session('cart')))
                                <form action="{{ route('cart.remove', $product->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger"><i class="bi bi-cart-x"> Remove From Cart</i></button>
                                </form>
                            @else
                                <form action="{{ route('cart.add', $product->id) }}" method="POST" class="cart">
                                    @csrf
                                    <div class="input-group">
                                        <input type="number" name="quantity" class="form-control quantity-input border-primary" value="1" min="1" >
                                        <button type="submit" class="btn btn-primary"><i class="bi bi-cart-plus"> Add To Cart</i></button>
                                    </div>
                                </form>
                            @endif
                        </div>
                        <form action="{{ route('checkout.direct', $product->id) }}" method="POST" class="float-end mx-3">
                            @csrf
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class="btn btn-dark"><i class="bi bi-cart-check"> Buy Now</i></button>
                        </form>
                    </div>



            </div>
        </div>
    </div>
@endsection
