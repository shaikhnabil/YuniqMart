<div>
    @push('title')
        Products
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


    <!-- Product description Modal -->
    <div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="productModalLabel">Product Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="productDescription"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    {{-- <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteConfirmationModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this product?
                </div>
                <div class="modal-footer">
                    <form id="deleteForm" method="post" action="">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}



    <div class="container my-4 alert-container">
        @if (session('success'))
            <x-alert :msg="session('success')"></x-alert>
        @endif



        <div class="table-responsive">
            <a href="{{ route('products.trashed', ['view' => 'trashed-products']) }}" wire:navigate
                class="my-1 border btn btn-light text-danger border-danger ">
                <i class="bi bi-trash-fill"> Products</i>
            </a>
            <a href="{{ route('products.create', ['view' => 'create_product']) }}" wire:navigate
                class="mx-2 my-1 text-center btn btn-primary ">+</a>
            <h3 class="text-center mb">Products</h3>
            <table class="table rounded shadow table-bordered table-striped" id="productTable">
                <thead>
                    <tr>
                        <th>Images</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Brand</th>
                        <th>Color</th>
                        <th>Size</th>
                        <th>Stock</th>
                        <th>Price</th>
                        <th>Category</th>
                        <th>Sub Category</th>
                        <th>Created By</th>
                        <th>Status</th>
                        <th style="white-space: nowrap;">Actions</th>
                    </tr>
                </thead>
            </table>
        </div>

    </div>
</div>

{{-- @push('script') --}}
<script type="text/javascript" defer>
    // $(document).ready(function() {
    var tableObj;

    // getting products
    function initializetable() {
        if (tableObj) {
            tableObj.clear().destroy();
            $('.dataTables_length').closest('.row').remove();
            $('.dataTables_length').remove();
            $('.dataTables_filter').remove();

            $('.dataTables_info').closest('.row').remove();
            $('.dataTables_info').remove();
            $('.dataTables_paginate').remove();

            $('.dataTables_wrapper ').css('padding', '0');
        }

        tableObj = $('#productTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('products_data') }}",
                type: 'GET'
            },
            columns: [{
                    data: 'image',
                    name: 'image',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'description',
                    name: 'description'
                },
                {
                    data: 'brand',
                    name: 'brand'
                },
                {
                    data: 'color',
                    name: 'color'
                },
                {
                    data: 'size',
                    name: 'size'
                },
                {
                    data: 'stock',
                    name: 'stock'
                },
                {
                    data: 'price',
                    name: 'price',
                    orderable: false,
                },
                {
                    data: 'category',
                    name: 'category'
                },
                {
                    data: 'subcategories',
                    name: 'subcategories',
                },
                {
                    data: 'created_by',
                    name: 'created_by',
                },
                {
                    data: 'status',
                    name: 'status',
                },
                {
                    data: 'actions',
                    name: 'actions',
                    orderable: false,
                    searchable: false
                }
            ]
        });
    } //end of initializetable

    initializetable();
    // display description modal
    $('#productTable tbody').on('click', '.view-description', function() {
        var description = $(this).data('description');
        $('#productDescription').text(description);
        var myModal = new bootstrap.Modal(document.getElementById('productModal'));
        myModal.show();
    });
    // });
    //change produc status
    //  $(document).on('change', '.toggle-status', function() {
    //     var productId = $(this).data('id');
    //     var isActive = $(this).is(':checked') ? 0 : 1; // 0 is enabled, 1 is disabled

    //     $.ajax({
    //         url: '/admin/products/toggle-status/' + productId,
    //         method: 'POST',
    //         data: {
    //             _token: $('meta[name="csrf-token"]').attr('content'),
    //         },
    //         success: function(response) {
    //             alert(response.message);
    //         },
    //         error: function(error) {
    //             alert('Error updating product status.');
    //         }
    //     });
    // });
</script>
{{-- @endpush --}}
