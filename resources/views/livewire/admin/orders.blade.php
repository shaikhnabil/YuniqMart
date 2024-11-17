@push('title')
    Orders
@endpush
@section('css')
    <style>
        table td:last-child {
            white-space: nowrap;
        }

        div.dataTables_wrapper div.dataTables_length select {
            width: 50%;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            margin: 0;
            padding: 0;
        }
    </style>
@endsection
<div>
    <div class="container my-3">

        <div class="mb-3 col-md-4">
            <div class="input-group">
                <input type="text" class="form-control" id="validationDefaultUsername"
                    wire:model.live.debounce.250ms='query' placeholder="Search..." aria-describedby="inputGroupPrepend2"
                    required>
                {{-- <div class="input-group-prepend">
                    <button wire:click='search' class="px-4 mx-2 btn btn-dark"><i class="bi bi-search"></i></button>
                </div> --}}
            </div>
        </div>

        <table class="table rounded shadow table-bordered w-100" id="orderstable">
            <thead class="table-light">
                <tr>
                    <th>Order Number</th>
                    <th>User</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                {{-- @if ($orders->isEmpty())
                    <tr class="text-center">
                        <td colspan="7">No Orders found.</td>
                    </tr>
                @endif --}}
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->order_number }}</td>
                        <td>{{ $order->user->name }}</td>
                        <td>{{ $order->product->name }}</td>
                        <td>{{ $order->product_qty }}</td>
                        <td>{{ $order->product_price }}</td>
                        <td>{{ $order->status }}</td>
                        {{-- <td>
                            <select class="btn btn-sm btn-dark"  wire:model="status.{{ $order->id }}"
                                wire:change="updateStatus({{ $order->id }})" wire:loading.attr="disabled">
                                <option selected>Status</option>
                                <option value="0">Pending</option>
                                <option value="1">Processing</option>
                                <option value="2">SHIPPED</option>
                                <option value="3">Delivered</option>
                                <option value="4">Cancelled</option>
                                <option value="5">Returned</option>
                            </select>
                        </td> --}}
                        <td>
                            <select class="btn btn-sm btn-dark"
                                wire:change="updateStatus({{ $order->id }}, $event.target.value)"
                                wire:loading.attr="disabled">
                                <option value="0">Pending</option>
                                <option value="1">Processing</option>
                                <option value="2">Shipped</option>
                                <option value="3">Delivered</option>
                                <option value="4">Cancelled</option>
                                <option value="5">Returned</option>
                            </select>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $orders->links() }}
</div>

@push('script')
    <script>
        $('#orderstable').DataTable();
        // $(document).ready(function() {
        //     $('#orderstable').DataTable();
        // });
    </script>
@endpush
