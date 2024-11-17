<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Order;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderStatusChanged;

class Orders extends Component
{
    use WithPagination;
    //public $status = [];
    public $query = '';
    public function mount()
    {
        $this->status = Order::pluck('status', 'id')->toArray();
    }

    // public function updateStatus($id)
    // {
    //     $order = Order::find($id);
    //     $order->status = $this->status[$id];
    //     $order->save();
    //     Mail ::to($order->user->email)->queue(new OrderStatusChanged($order));
    //     session()->flash('message', 'Order status updated and customer notified.');
    // }

    public function updateStatus($id, $newStatus)
    {
        $order = Order::find($id);
        $order->status = $newStatus;
        $order->save();
        Mail::to($order->user->email)->queue(new OrderStatusChanged($order));
        session()->flash('message', 'Order status updated and customer notified.');
    }

    public function render()
    {
        $orders = Order::with('user', 'product')
            ->when($this->query, function ($query) {
                $query->whereHas('product', function ($q) {
                    $q->where('name', 'like', '%' . $this->query . '%');
                })
                    ->orWhere('order_number', 'like', '%' . $this->query . '%');
            })->paginate(10);
        //$orders = Order::with('user', 'product')->paginate(10);
        return view('livewire.admin.orders', ['orders' => $orders])
            ->layout('components.layouts.adminapp');
    }
}
