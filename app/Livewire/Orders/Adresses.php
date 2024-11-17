<?php

namespace App\Livewire\Orders;

use App\Models\Adress;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Adresses extends Component
{
    // public $addresses;
    // public $addressId;
    // public $street, $city, $state, $zip_code, $country, $phone, $is_default = false;
    // public $showModal = false;
    // public $isEditMode = false;

    // protected $rules = [
    //     'street' => 'required|string|max:255',
    //     'city' => 'required|string|max:255',
    //     'state' => 'nullable|string|max:255',
    //     'zip_code' => 'required|string|max:10',
    //     'country' => 'required|string|max:255',
    //     'phone' => 'required|string|max:15',
    //     'is_default' => 'boolean',
    // ];

    // public function mount()
    // {
    //     $this->addresses = Auth::user()->addresses;
    // }

    // public function showAddressForm()
    // {
    //     $this->showForm = true;
    // }

    // public function addAddress()
    // {
    //     $this->validate();

    //     Adress::create([
    //         'user_id' => Auth::id(),
    //         'street' => $this->street,
    //         'city' => $this->city,
    //         'state' => $this->state,
    //         'zip_code' => $this->zip_code,
    //         'country' => $this->country,
    //         'phone' => $this->phone,
    //         'is_default' => $this->is_default,
    //     ]);

    //     $this->addresses = Auth::user()->addresses;
    //     $this->reset(['street', 'city', 'state', 'zip_code', 'country', 'phone', 'is_default', 'showForm']);
    // }
    public $addresses;
    public $addressId;
    public $street, $city, $state, $zip_code, $country, $phone, $is_default = false;
    public $showModal = false;
    public $isEditMode = false;

    protected $rules = [
        'street' => 'required|string|max:255',
        'city' => 'required|string|max:255',
        'state' => 'nullable|string|max:255',
        'zip_code' => 'required|string|max:10',
        'country' => 'required|string|max:255',
        'phone' => 'nullable|string|max:15',
        'is_default' => 'boolean',
    ];

    public function mount()
    {
        $this->addresses = Auth::user()->addresses;
    }

    // Open the modal for adding a new address
    public function showAddAddressModal()
    {
        $this->resetInputFields();
        $this->isEditMode = false;
        $this->showModal = true;
    }

    // Open the modal for editing an existing address
    public function showEditAddressModal($id)
    {
        $address = Adress::findOrFail($id);

        $this->addressId = $id;
        $this->street = $address->street;
        $this->city = $address->city;
        $this->state = $address->state;
        $this->zip_code = $address->zip_code;
        $this->country = $address->country;
        $this->phone = $address->phone;
        $this->is_default = $address->is_default;

        $this->isEditMode = true;
        $this->showModal = true;
    }

    // Add or update address
    public function saveAddress()
    {
        $this->validate();

        if ($this->is_default) {
            Adress::where('user_id', Auth::id())
                ->where('id', '!=', $this->addressId)
                ->update(['is_default' => false]);
        }

        if ($this->isEditMode) {
            // Edit the existing address
            $address = Adress::findOrFail($this->addressId);
            $address->update([
                'street' => $this->street,
                'city' => $this->city,
                'state' => $this->state,
                'zip_code' => $this->zip_code,
                'country' => $this->country,
                'phone' => $this->phone,
                'is_default' => $this->is_default,
            ]);
        } else {
            // Create new address
            Adress::create([
                'user_id' => Auth::id(),
                'street' => $this->street,
                'city' => $this->city,
                'state' => $this->state,
                'zip_code' => $this->zip_code,
                'country' => $this->country,
                'phone' => $this->phone,
                'is_default' => $this->is_default,
            ]);
        }

        // Refresh the addresses and close the modal
        $this->addresses = Auth::user()->addresses;
        $this->resetInputFields();
        $this->showModal = false;
    }

    // Delete an address
    public function deleteAddress($id)
    {
        Adress::findOrFail($id)->delete();
        $this->addresses = Auth::user()->addresses; // Refresh addresses
    }

    // Reset form fields
    public function resetInputFields()
    {
        $this->reset(['street', 'city', 'state', 'zip_code', 'country', 'phone', 'is_default', 'addressId']);
    }
    public function render()
    {
        return view('livewire.orders.adresses');
    }
}
