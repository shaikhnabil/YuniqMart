<div>
    <section class="h-100">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-10">

                    @if (session('success'))
                        <x-alert :msg="session('success')"></x-alert>
                    @endif

                    @if (session('error'))
                        <x-alert :msg="session('error')"></x-alert>
                    @endif

                    <div class="mt-0 mb-4 d-flex justify-content-between align-items-center">
                        <h3 class="mx-auto mb-0 fw-normal"><i class="bi bi-bag-heart-fill"> My Orders</i></h3>
                    </div>
                    @if ($groupedOrders->isEmpty())
                        <p class="text-center text-muted"> No Orders Found.</p>
                    @endif

                    @foreach ($groupedOrders as $orderNumber => $orders)
                        <div class="mb-4 shadow card rounded-3">
                            <div class="p-4 card-body">
                                <div class="row col-12">
                                    <h6 class="col-6">Order Number: {{ $orderNumber }}</h6>
                                    <p class="col-3"></p>
                                    <p class="text-muted col-3 float-end">Order Date:
                                        {{ \Carbon\Carbon::parse($orders->first()->created_at)->format('d M Y') }}</p>
                                </div>

                                @foreach ($orders as $order)
                                    @php
                                        $image = json_decode($order->product_image);
                                        $order_status = '';
                                        switch ($order->status):
                                            case 0:
                                                $order_status = 'Pending';
                                                break;
                                            case 1:
                                                $order_status = 'Processing';
                                                break;
                                            case 2:
                                                $order_status = 'Shipped';
                                                break;
                                            case 3:
                                                $order_status = 'Delivered';
                                                break;
                                            case 4:
                                                $order_status = 'Cancelled';
                                                break;
                                            case 5:
                                                $order_status = 'Returned';
                                                break;
                                        endswitch;
                                    @endphp

                                    <div class="mb-4 row d-flex justify-content-between align-items-center">
                                        <div class="col-md-2 col-lg-2 col-xl-2">
                                            <img src="{{ asset('storage/' . $image[0]) }}" class="img-fluid rounded-3"
                                                alt="{{ $order->product_name }}">
                                        </div>
                                        <div class="col-md-2 col-lg-3 col-xl-3">
                                            <p class="mb-2 lead fw-normal">{{ $order->product_name }}</p>
                                            <p><span class="text-muted">Size: </span>M <span class="text-muted">Color:
                                                </span>Grey</p>
                                        </div>
                                        <div class="col-md-3 col-lg-2 col-xl-2">
                                            <p class="mb-0 text-muted">Quantity: {{ $order->product_qty }}</p>
                                        </div>
                                        <div class="col-md-3 col-lg-2 col-xl-2">
                                            <h5 class="mb-0">₹{{ number_format($order->product_price, 2) }}</h5>
                                        </div>
                                    </div>

                                    <hr class="my-2">
                                @endforeach
                                <div class="row">
                                    @if ($order->status != 4)
                                        <button wire:click="cancelOrder('{{ $orderNumber }}')"
                                            class="btn btn-sm btn-danger col-2">
                                            <i class="bi bi-cart-x"> Cancel Order</i>
                                        </button>
                                    @endif

                                    <p class="mx-auto my-auto text-muted col-3"><span class="fw-semibold">Status:
                                        </span> {{ $order_status }}</p>

                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </section>
</div>




{{-- <div>
    <section class="h-100">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-10">

                    @if (session('success'))
                        <x-alert :msg="session('success')"></x-alert>
                    @endif

                    <div class="mb-4 d-flex justify-content-between align-items-center">
                        <h3 class="mb-0 fw-normal">My Orders</h3>
                    </div>
                    @foreach ($orders as $order)
                        @php
                            $image = json_decode($order->product->image);
                        @endphp
                        <div class="mb-4 shadow card rounded-3">
                            <div class="p-4 card-body">
                                <div class="row d-flex justify-content-between align-items-center">
                                    <div class="col-md-2 col-lg-2 col-xl-2">
                                        <img src="{{ asset('storage/' . $image[0]) }}"
                                            class="img-fluid rounded-3" alt="{{ $order->product->name }}">
                                    </div>
                                    <div class="col-md-3 col-lg-3 col-xl-3">
                                        <p class="mb-2 d-inline">
                                        <h6>Order Number: </h6> {{ $order->order_number }}
                                        </p>
                                        <p class="mb-2 lead fw-normal">{{ $order->product->name }}</p>
                                        <p><span class="text-muted">Size: </span>M <span class="text-muted">Color:
                                            </span>Grey</p>
                                    </div>
                                    <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                                        <h5 class="mb-0">{{ $order->product_qty }}</h5>
                                    </div>

                                    <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                                        <h5 class="mb-0">₹{{ number_format($order->product_price, 2) }}</h5>
                                    </div>
                                    <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                        <a href="#!" class="text-danger"><i class="fas fa-trash fa-lg"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </section> --}}
{{-- <div>
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        @if (session()->has('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <h2>My Orders</h2>

        <table class="table">
            <thead>
                <tr>
                    <th>Order Number</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->order_number }}</td>
                        <td>{{ $order->product->name }}</td>
                        <td>{{ $order->product_qty }}</td>
                        <td>${{ number_format($order->product_price, 2) }}</td>
                        <td>
                            @if ($order->status === 0)
                                Pending
                            @elseif ($order->status === 1)
                                Completed
                            @else
                                Canceled
                            @endif
                        </td>
                        <td>
                            @if ($order->status === 0)
                                <button wire:click="cancelOrder({{ $order->id }})" class="btn btn-danger">
                                    Cancel
                                </button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div> --}}

{{-- </div> --}}


{{-- quantity textbox :
<div class="col-md-3 col-lg-3 col-xl-2 d-flex">
    <button data-mdb-button-init data-mdb-ripple-init class="px-2 btn btn-link"
        onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
        <i class="fas fa-minus"></i>
    </button>

    <input id="form1" min="0" name="quantity" value="2"
        type="number" class="form-control form-control-sm" />

    <button data-mdb-button-init data-mdb-ripple-init class="px-2 btn btn-link"
        onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
        <i class="fas fa-plus"></i>
    </button>
</div> --}}
