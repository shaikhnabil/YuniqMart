{{-- @extends('layouts.main')

@section('main')
    <div class="container my-3">
        <h2 class="text-center">Checkout</h2>
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <h5 class="text-center mt-4">Order Summary</h5>
        <table class="table table-bordered rounded shadow text-center">
            <thead class="table-light">
                <tr>
                    <th>Image</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @foreach ($cart as $productId => $details)
                    <tr>
                        <td><img src="{{ asset('storage/' . $details['image']) }}" alt="{{ $details['name'] }}" style="width:100px;"></td>
                        <td>{{ $details['name'] }}</td>
                        <td>{{ $details['quantity'] }}</td>
                        <td>₹{{ number_format($details['price'], 2) }}</td>
                        <td>₹{{ number_format($details['quantity'] * $details['price'], 2) }}</td>
                    </tr>
                    @php $total += $details['quantity'] * $details['price']; @endphp
                @endforeach
                <tr>
                    <td colspan="4" class="text-center table-light"><strong>Total</strong></td>
                    <td><strong>₹{{ number_format($total, 2) }}</strong></td>
                </tr>
            </tbody>
        </table>
        <form action="{{ route('placeorder') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-dark float-end shadow"><i class="bi bi-cart-check-fill"> Place Order</i></button>
        </form>
    </div>
@endsection --}}

@extends('layouts.main')

@section('main')
<div class="container my-3">
    <h2 class="text-center">Checkout</h2>

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <h5 class="text-center mt-4">Order Summary</h5>
    <table class="table table-bordered rounded shadow text-center">
        <thead class="table-light">
            <tr>
                <th>Image</th>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @php $total = 0; @endphp
            @foreach ($cart as $productId => $details)
                <tr>
                    <td><img src="{{ asset('storage/' . $details['image']) }}" alt="{{ $details['name'] }}" style="width:100px;"></td>
                    <td>{{ $details['name'] }}</td>
                    <td>{{ $details['quantity'] }}</td>
                    <td>₹{{ number_format($details['price'], 2) }}</td>
                    <td>₹{{ number_format($details['quantity'] * $details['price'], 2) }}</td>
                </tr>
                @php $total += $details['quantity'] * $details['price']; @endphp
            @endforeach
            <tr>
                <td colspan="4" class="text-center table-light"><strong>Total</strong></td>
                <td><strong>₹{{ number_format($total, 2) }}</strong></td>
            </tr>
        </tbody>
    </table>

    <form action="{{ route('placeorder') }}" method="POST">
        @csrf
        <div class="container card p-2 w-50">

        <!-- User Address Details -->
        @php $user = Auth::user(); @endphp
        <h4 class="mb-3 text-center">Billing Address</h4>
        <div class="mb-3 ms-5">
            <label for="address" class="fw-bold">Address: </label>
            <span class=""  id="address" >{{ $user->address }}</span>
        </div>

        <div class="mb-3 ms-5">
            <label for="city" class="fw-bold">City: </label>
            <span class=""  id="city" >{{ $user->city }}</span>
        </div>

            <div class="mb-3 ms-5">
                <label for="state" class="fw-bold">State: </label>
                <span class=""  id="state" > {{ $user->state }}</span>
            </div>
            <div class="mb-3 ms-5">
                <label for="zipcode" class="fw-bold">Zip Code: </label>
                <span class=""  id="zipcode">{{ $user->zipcode }}</span>
            </div>


        </div>
        <button type="submit" class="btn btn-dark float-end shadow"><i class="bi bi-cart-check-fill"></i> Place Order</button>
    </form>
</div>
@endsection
