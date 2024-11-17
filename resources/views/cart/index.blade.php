{{-- @extends('layouts.main')
@push('title')
    Cart
@endpush

@section('main')
    @if (session('success'))
        <x-alert :msg="session('success')"></x-alert>
    @endif
    <div class="container my-4">
        <h3 class="mb-4 text-center">Shopping Cart</h3>
        @if (empty($cart))
        <div class="my-4 text-center alert alert-warning" role="alert">
            <strong>Your cart is empty.</strong>
        </div>
        @else
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cart as $id => $item)
                        @php
                            $price = (float) $item['price'];
                            $quantity = (int) $item['quantity'];
                            $total = $price * $quantity;
                        @endphp
                        <tr>
                            <td><img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}"
                                    style="width:100px;"></td>
                            <td>{{ $item['name'] }}</td>
                            <td>₹{{ number_format($price, 2) }}</td>
                            <td>{{ $quantity }}</td>
                            <td>₹{{ number_format($total, 2) }}</td>
                            <td class="text-center">
                                <form action="{{ route('cart.remove', $id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger"><i class="bi bi-cart-x"> Remove</i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-4 text-center">
                <a href="{{ route('checkout') }}" class="shadow btn btn-dark"><i class="bi bi-cart-check"> Proceed to Checkout</i></a>
            </div>
        @endif
    </div>
@endsection --}}
