@push('title')
    Cart
@endpush

<div>
    @if (session('success'))
        <x-alert :msg="session('success')"></x-alert>
    @endif

    <section class="h-100 gradient-custom">
        <div class="container py-4">
            @if (empty($cart))
                <div class="my-4 text-center alert alert-warning" role="alert">
                    <strong>Your cart is empty.</strong>
                </div>
            @else
                <div class="my-0 row d-flex justify-content-center">
                    <div class="col-md-8">
                        <div class="mb-2 card">
                            <div class="py-3 card-header">
                                <h5 class="mb-0">Cart - {{ count($cart) }} items</h5>
                            </div>
                            <div class="card-body">
                                <!-- Single item -->
                                @php
                                    $totalAmount = 0;
                                @endphp

                                @foreach ($cart as $id => $item)
                                    @php
                                        $price = (float) $item['price'];
                                        $quantity = (int) $item['quantity'];
                                        $total = $price * $quantity;
                                        $totalAmount += $total; // Add to total amount
                                    @endphp
                                    <div class="mb-4 row">
                                        <div class="mb-4 col-lg-3 col-md-12 mb-lg-0">
                                            <div class="rounded bg-image hover-overlay hover-zoom ripple"
                                                data-mdb-ripple-color="light">
                                                <img src="{{ asset('storage/' . $item['image']) }}" class="w-100"
                                                    alt="{{ $item['name'] }}" />
                                                <a href="#!">
                                                    <div class="mask"
                                                        style="background-color: rgba(251, 251, 251, 0.2)">
                                                    </div>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="mb-4 col-lg-5 col-md-6 mb-lg-0">
                                            <p><strong>{{ $item['name'] }}</strong></p>
                                            <p>Color: {{ $item['color'] ?? 'N/A' }}</p>
                                            <p>Size: {{ $item['size'] ?? 'N/A' }}</p>
                                            <form wire:submit='remove({{ $id }})' method="POST">
                                                @csrf
                                                <button type="submit" class="mb-2 btn btn-danger btn-sm me-1"
                                                    title="Remove item">
                                                    <i class="bi bi-trash-fill"></i>
                                                </button>
                                            </form>
                                        </div>

                                        <div class="mb-4 col-lg-4 col-md-6 mb-lg-0">
                                            <div class="mb-4 d-flex" style="max-width: 300px">
                                                <button class="h-25 btn btn-primary me-2"
                                                    onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                                                    <i class="bi bi-dash-lg"></i>
                                                </button>

                                                <div class="form-outline">
                                                    <input id="quantity-{{ $id }}" min="0"
                                                        name="quantity" value="{{ $quantity }}" type="number"
                                                        class="text-center form-control" />
                                                    <label class="ms-4 form-label"
                                                        for="quantity-{{ $id }}">Quantity</label>
                                                </div>

                                                <button class="h-25 ms-2 btn btn-primary"
                                                    onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                                                    <i class="bi bi-plus"></i>
                                                </button>
                                            </div>
                                            <p class="text-start text-md-center">
                                                <strong>₹{{ number_format($total, 2) }}</strong>
                                            </p>
                                        </div>
                                    </div>
                                    <hr class="my-4" />
                                @endforeach

                            </div>
                        </div>

                        {{-- <div class="mb-4 card">
                        <div class="card-body">
                            <p><strong>Expected shipping delivery</strong></p>
                            <p class="mb-0">12.10.2020 - 14.10.2020</p>
                        </div>
                    </div> --}}
                        {{-- <div class="mb-4 card mb-lg-0">
                        <div class="card-body">
                            <p><strong>We accept</strong></p>
                            <img class="me-2" width="45px"
                                src="https://mdbcdn.b-cdn.net/wp-content/plugins/woocommerce-gateway-stripe/assets/images/visa.svg"
                                alt="Visa" />
                            <img class="me-2" width="45px"
                                src="https://mdbcdn.b-cdn.net/wp-content/plugins/woocommerce-gateway-stripe/assets/images/amex.svg"
                                alt="American Express" />
                            <img class="me-2" width="45px"
                                src="https://mdbcdn.b-cdn.net/wp-content/plugins/woocommerce-gateway-stripe/assets/images/mastercard.svg"
                                alt="Mastercard" />
                        </div>
                    </div> --}}
                    </div>

                    <div class="col-md-4">
                        <div class="mb-4 card">
                            <div class="py-3 card-header">
                                <h5 class="mb-0">Summary</h5>
                            </div>
                            <div class="card-body">
                                <ul class="list-group list-group-flush">
                                    <li
                                        class="px-0 pb-0 border-0 list-group-item d-flex justify-content-between align-items-center">
                                        Products
                                        <span>₹{{ number_format($totalAmount, 2) }}</span>
                                    </li>
                                    <li class="px-0 list-group-item d-flex justify-content-between align-items-center">
                                        Shipping
                                        <span>100.00</span>
                                    </li>
                                    <li
                                        class="px-0 mb-3 border-0 list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <strong>Total amount</strong>
                                            <strong>
                                                <p class="mb-0">(including VAT)</p>
                                            </strong>
                                        </div>
                                        <span><strong>₹{{ number_format($totalAmount + 100.0, 2) }} </strong></span>
                                    </li>
                                </ul>

                                <a href="{{ route('checkout') }}" wire:navigate  class="shadow btn btn-dark btn-sm">
                                    <i class="bi bi-cart4"> Go to Checkout</i></a>

                                {{-- <button type="button" data-mdb-button-init data-mdb-ripple-init
                                    class="btn btn-dark btn-sm btn-block">
                                    <i class="bi bi-cart4"> Go to checkout</i>
                                </button> --}}
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
</div>

{{-- <div class="container my-4">
        <h3 class="mb-4 text-center"> <i class="bi bi-cart4"> Shopping Cart</i></h3>

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
                                <form wire:submit='remove({{$id}})' method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger"><i class="bi bi-cart-x">
                                            Remove</i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-4 text-center">
                <a href="{{ route('checkout') }}" wire:navigate  class="shadow btn btn-dark"><i class="bi bi-cart-check"> Proceed to
                        Checkout</i></a>
            </div>
        @endif
    </div> --}}