@push('title')
    Addresses
@endpush
<div>
    <h3 class="mx-auto my-4 w-25"><i class="bi bi-geo-alt"> Your Addresses</i></h3>
    <div class="container mt-4">
        <!-- Button to Show the Add Address Modal -->
        <button class="btn btn-primary float-end" wire:click="showAddAddressModal">
            +
        </button>
        <!-- Display Existing Addresses -->
        <div class="my-2 row">
            @foreach ($addresses as $address)
                <div class="col-md-4">
                    <div class="mb-4 shadow card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $address->street }}</h5>
                            <p class="card-text">{{ $address->city }}, {{ $address->state }}, {{ $address->zip_code }}
                            </p>
                            <p class="card-text">{{ $address->country }}</p>
                            @if ($address->phone)
                                <p class="card-text"><strong>Phone:</strong> {{ $address->phone }}</p>
                            @endif
                            <p class="card-text"><strong>Default:</strong> {{ $address->is_default ? 'Yes' : 'No' }}</p>

                            <!-- Edit and Delete Buttons -->
                            <button class="btn btn-outline-warning"
                                wire:click="showEditAddressModal({{ $address->id }})">Edit</button>
                            <button class="btn btn-outline-danger"
                                wire:click="deleteAddress({{ $address->id }})">Delete</button>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>

        <!-- Bootstrap Modal -->
        <div class="modal fade @if ($showModal) show d-block @endif" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ $isEditMode ? 'Edit Address' : 'Add New Address' }}</h5>
                        <button type="button" class="btn-close" wire:click="$set('showModal', false)"></button>
                    </div>
                    <div class="modal-body">
                        <form wire:submit.prevent="saveAddress">
                            <div class="mb-3">
                                <label for="street" class="form-label">Street</label>
                                <input type="text" id="street" class="form-control" wire:model="street">
                                @error('street')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="city" class="form-label">City</label>
                                <input type="text" id="city" class="form-control" wire:model="city">
                                @error('city')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="state" class="form-label">State</label>
                                <input type="text" id="state" class="form-control" wire:model="state">
                                @error('state')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="zip_code" class="form-label">Zip Code</label>
                                <input type="text" id="zip_code" class="form-control" wire:model="zip_code">
                                @error('zip_code')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="country" class="form-label">Country</label>
                                <input type="text" id="country" class="form-control" wire:model="country">
                                @error('country')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" id="phone" class="form-control" wire:model="phone">
                                @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3 form-check">
                                <input type="checkbox" id="is_default" <?= $is_default == 1 ? 'checked' : '' ?>
                                    class="form-check-input" wire:model="is_default" />
                                <label for="is_default" class="form-check-label">Make Default Address</label>
                            </div>

                            <button type="submit"
                                class="btn btn-primary">{{ $isEditMode ? 'Update Address' : 'Save Address' }}</button>
                        </form>
                    </div>
                    {{-- <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            wire:click="$set('showModal', false)">Close</button>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</div>
