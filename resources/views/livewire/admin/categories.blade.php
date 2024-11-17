<div>
    @push('title')
        Categories
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


    <div class="container mb-3">
        <a href="{{ route('categories.create', ['view' => 'create-category']) }}" wire:navigate
            class="my-2 btn btn-primary float-end">+</a>
    </div>
    <div class="container mb-3">
        @if (session('success'))
            <x-alert :msg="session('success')"></x-alert>
        @endif

        <!-- edit or delete sub category Modal -->
        <div class="modal fade" id="editsubcategory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Sub Category
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form wire:submit='update_subcat()' method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="subcategory" class="form-label">Sub Category</label>
                                <input type="text" wire:model='subcategory'
                                    class="form-control @error('name') is-invalid @enderror" id="subcategory"
                                    name="subcategory">
                            </div>
                            @error('name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            <button type="submit" class="btn btn-primary col">Update</button>
                            <button type='button' wire:click='subdelete()'
                                wire:confirm='Are you really want to delete this sub category ?'
                                class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <table class="table rounded shadow table-bordered w-100 table-striped" id="dataTable">
            <thead class="table-light">
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Category Name</th>
                    <th scope="col">Image</th>
                    <th scope="col" class="text-center">Edit</th>
                    <th scope="col" class="text-center">Delete</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $index => $category)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td><strong>{{ $category->name }}</strong>
                            @foreach ($category->subcategories as $subcategory)
                                <li class="my-1 ms-4">
                                    {{ $subcategory->subcategory }}
                                    {{-- <button class="border-0 rounded bg-warning float-end"
                                        wire:click="$dispatch('setSubcategory', { subcat_id: {{ $subcategory->id }} })"
                                        data-bs-toggle="modal" data-bs-target="#subcategory-{{ $subcategory->slug }}">
                                        <i class="bi bi-pencil-square"></i></button> --}}
                                    <button class="border-0 rounded bg-warning float-end"
                                    wire:click="$dispatch('setSubcategory', { subcat_id: {{ $subcategory->id }} })">
                                        <i class="bi bi-pencil-square"></i></button>

                                </li>
                            @endforeach
                        </td>
                        <td class="text-center">
                            @if ($category->image)
                                <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}"
                                    width="80">
                            @else
                                No image
                            @endif
                        </td>
                        <td class="text-center"><a
                                href="{{ route('category.edit', ['view' => 'edit-category', 'id' => $category->id]) }}"
                                wire:navigate class="btn btn-warning"><i class="bi bi-pencil-square"></i></a></td>
                        <td class="text-center">
                            <form wire:submit.prevent='delete({{ $category->id }})'
                                wire:confirm="Are you sure you want to delete this category?" method="POST"
                                class="d-inline delete-form">
                                @csrf

                                <button type="submit" class="btn btn-danger"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr class="text-center">
                        <td colspan="5">No Categories found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>



@push('script')
    <script>
        var tableObj;
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
        tableObj = $('#dataTable').DataTable();

        window.addEventListener('openeditmodel', event => {
            $('#editsubcategory').modal('show');
        })
        window.addEventListener('closeeditmodel', event => {
            $('#editsubcategory').modal('hide');
        });
    </script>
@endpush
