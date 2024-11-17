<?php

namespace App\Livewire\Cart;

use App\Models\Order;
use App\Models\Products;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Cart extends Component
{
    public function remove($id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        session()->flash('success', 'Product removed from cart!');
        return $this->redirect('/cart', navigate: true);
    }

    public function checkout()
    {
        if (!Auth::check()) {
            session()->flash('status', 'You must be logged in to checkout.');
            return redirect()->route('login');
        }
        $user = Auth::user();
        $cart = session()->get('cart', []);

        // Ensure data is not duplicated in Cart table
        $existingCartItems = \App\Models\Cart::where('user_id', $user->id)->pluck('product_id')->toArray();

        foreach ($cart as $id => $item) {
            // Add item to cart table only if it doesn't already exist
            if (!in_array($id, $existingCartItems)) {
                \App\Models\Cart::create([
                    'user_id' => $user->id,
                    'product_id' => $id,
                    'product_qty' => $item['quantity'],
                ]);
            }
        }

        return $cart;
    }

    public function placeOrder()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('status', 'You must be logged in to place an order.');
        }

        $user = Auth::user();
        $cart = session()->get('cart', []);
        $cartItems = \App\Models\Cart::where('user_id', $user->id)->get();

        // Validate cart is not empty
        if (empty($cartItems)) {
            return redirect()->route('cart.index')->with('status', 'Your cart is empty. Please add products to your cart before proceeding to place an order.');
        }

        $orderNumber = uniqid('ORDER_');
        foreach ($cartItems as $item) {
            Order::create([
                'user_id' => $user->id,
                'product_id' => $item->product_id,
                'product_qty' => $item->product_qty,
                'product_price' => $item->product->price,
                'order_number' => $orderNumber,
            ]);
        }

        // Clear the cart
        session()->forget('cart');
        // \App\Models\Cart::where('user_id', $user->id)->delete();
        session()->flash('status', 'Order placed successfully!');
        return $this->redirectRoute('invoice', ['order_number' => $orderNumber], navigate:true);
    }

    public function render()
    {
        if (request()->routeIs('checkout')) {
            $cart = $this->checkout();
            return view('livewire.cart.checkout', compact('cart'));
        } else {
            $cart = session()->get('cart', []);
            return view('livewire.cart.cart', compact('cart'));
        }
    }
}
