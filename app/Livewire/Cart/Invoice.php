<?php

namespace App\Livewire\Cart;

use App\Models\Order;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Barryvdh\DomPDF\Facade\Pdf;


class Invoice extends Component
{
    public $order_number;

    public function mount($order_number)
    {
        $this->order_number = $order_number;
    }

    public function generateInvoice($order_number)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('status', 'You need to log in to view the invoice.');
        }

        $user = Auth::user();

        $orders = Order::where('user_id', $user->id)
            ->where('order_number', $order_number)
            ->get();

        if ($orders->isEmpty()) {
            return redirect()->route('cart.index')->with('status', 'No order found for the invoice.');
        }

        $subtotal = $orders->sum(function ($item) {
            return $item->product_price * $item->product_qty;
        });

        $shippingFee = 23;
        $taxFee = 7;
        $discount = 0;
        $total = $subtotal + $shippingFee + $taxFee - $discount;

        $pdf = Pdf::loadView('livewire.cart.invoicepdf', compact('orders', 'subtotal', 'shippingFee', 'taxFee', 'discount', 'total'));

        //return $pdf->stream('invoice.pdf');
        return $pdf->download('invoice.pdf');
    }

    public function render()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('status', 'You need to log in to view the invoice.');
        }

        $user = Auth::user();

        $orders = Order::where('user_id', $user->id)
            ->where('order_number', $this->order_number)
            ->get();

        if ($orders->isEmpty()) {
            return redirect()->route('cart.index')->with('status', 'No order found for the invoice.');
        }

        // Calculate totals
        $subtotal = $orders->sum(function ($item) {
            return $item->product_price * $item->product_qty;
        });

        $shippingFee = 23;
        $taxFee = 7;
        $discount = 0;
        $total = $subtotal + $shippingFee + $taxFee - $discount;
        return view('livewire.cart.invoice', compact('orders', 'subtotal', 'shippingFee', 'taxFee', 'discount', 'total'));
    }
}
