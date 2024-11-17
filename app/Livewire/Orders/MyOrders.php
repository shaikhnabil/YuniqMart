<?php
namespace App\Livewire\Orders;

use Livewire\Component;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MyOrders extends Component
{
    public $groupedOrders;

    public function mount()
    {
        // $this->groupedOrders = DB::table('orders')
        //     ->join('products', 'orders.product_id', '=', 'products.id')
        //     ->where('orders.user_id', Auth::id())
        //     ->select('orders.*', 'products.name as product_name', 'products.image as product_image', 'products.price as product_price')
        //     ->get()
        //     ->groupBy('order_number');
        $this->groupedOrders = Order::with('product')
            ->where('user_id', Auth::id())
            ->get()
            ->map(function ($order) {
                return [
                    'id' => $order->id,
                    'order_number' => $order->order_number,
                    'product_name' => $order->product->name,
                    'product_image' => $order->product->image,
                    'product_price' => $order->product->price,
                    // Add any other fields from the order or product here
                ];
            })
            ->groupBy('order_number');
    }

    public function cancelOrder($orderNumber)
    {
        $orders = Order::where('order_number', $orderNumber)
            ->where('status', 0)
            ->get();

        if ($orders->count()) {

            Order::where('order_number', $orderNumber)
                ->where('status', 0)
                ->update(['status' => 4]);

            $this->groupedOrders = DB::table('orders')
                ->join('products', 'orders.product_id', '=', 'products.id')
                ->where('orders.user_id', Auth::id())
                ->select('orders.*', 'products.name as product_name', 'products.image as product_image', 'products.price as product_price')
                ->get()
                ->groupBy('order_number');

            session()->flash('success', 'Order canceled successfully.');
        } else {
            session()->flash('error', 'Order is already dispatched so now it cannot be canceled.');
        }
    }

    public function render()
    {
        return view('livewire.orders.my-orders');
    }
}


// namespace App\Livewire\Orders;

// use Livewire\Component;
// use App\Models\Order;
// use Illuminate\Support\Facades\Auth;

// class MyOrders extends Component
// {
//     public $orders;
//     public function mount()
//     {
//         $this->orders = Order::where('user_id', Auth::id())->with('product')->get();
//     }

//     public function cancelOrder($orderId)
//     {
//         $order = Order::find($orderId);
//         if ($order && $order->status === 0) {
//             $order->status = 4;
//             $order->save();
//             $this->orders = Order::where('user_id', Auth::id())->with('product')->get();
//             session()->flash('success', 'Order canceled successfully.');
//         } else {
//             session()->flash('error', 'Order cannot be canceled.');
//         }
//     }

//     public function render()
//     {
//         return view('livewire.orders.my-orders');
//     }
// }
