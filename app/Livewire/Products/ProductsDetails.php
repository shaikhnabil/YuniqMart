<?php

namespace App\Livewire\Products;

use App\Models\Cart;
use App\Models\Products;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ProductsDetails extends Component
{
    protected $product;
    public $quantity = 1;
    public $color, $size;
    public function mount($id)
    {
        $this->product = Products::findOrFail($id);

        $colors = !empty($this->product->color) ? explode(',', $this->product->color) : [];
        $sizes = !empty($this->product->size) ? explode(',', $this->product->size) : [];
        $this->color = $colors ? $colors[0] : null; // Set to first color if available
        $this->size = $sizes ? $sizes[0] : null;   // Set to first size if available
    }

    // add and remove products from cart session
    public function addToCart($id)
    {
        $product = Products::findOrFail($id);
        $images = $product->image ? json_decode($product->image, true) : [];

        if (Auth::check()) {
            // If user is logged in, store in the database
            Cart::updateOrCreate(
                ['user_id' => Auth::id(), 'product_id' => $id],
                [
                    'name' => $product->name,
                    'price' => $product->price,
                    'quantity' => $this->quantity,
                    'color' => $this->color,
                    'size' => $this->size,
                    'image' => is_array($images) && !empty($images) ? $images[0] : null,
                ]
            );
        } else {
            // If user is not logged in, store in session
            $cart = session()->get('cart', []);
            if (isset($cart[$id])) {
                $cart[$id]['quantity'] += $this->quantity;
            } else {
                $cart[$id] = [
                    'name' => $product->name,
                    'price' => $product->price,
                    'quantity' => $this->quantity,
                    'color' => $this->color,
                    'size' => $this->size,
                    'image' => is_array($images) && !empty($images) ? $images[0] : null,
                ];
            }
            session()->put('cart', $cart);
        }

        session()->flash('success', 'Product added to cart!');
        return $this->redirect('/cart', navigate: true);
    }

    // public function addToCart($id)
    // {
    //     $product = Products::findOrFail($id);

    //     $cart = session()->get('cart', []);
    //     $images = $product->image ? json_decode($product->image, true) : [];
    //     if (isset($cart[$id])) {
    //         $cart[$id]['quantity'] += $this->quantity;
    //     } else {
    //         $cart[$id] = [
    //             'name' => $product->name,
    //             'price' => $product->price,
    //             'quantity' => $this->quantity,
    //             'color' => $this->color,
    //             'size' => $this->size,
    //             'image' => is_array($images) && !empty($images) ? $images[0] : null,
    //         ];
    //     }

    //     session()->put('cart', $cart);
    //     session()->flash('success', 'Product added to cart!');
    //     return $this->redirect('/cart', navigate: true);
    // }


    public function remove($id)
    {
        if (Auth::check()) {
            // If the user is logged in, remove the item from the database
            $deleted = Cart::where('user_id', Auth::id())->where('product_id', $id)->delete();
            if ($deleted) {
                session()->flash('success', 'Product removed from cart!');
            } else {
                session()->flash('error', 'Failed to remove product from cart.');
            }
        } else {
            // If the user is not logged in, remove the item from the session
            $cart = session()->get('cart', []);
            if (isset($cart[$id])) {
                unset($cart[$id]);
                session()->put('cart', $cart);
                session()->flash('success', 'Product removed from cart!');
            } else {
                session()->flash('error', 'Product not found in cart.');
            }
        }

        return $this->redirect('/cart', navigate: true);
    }

    // public function remove($id)
    // {
    //     $cart = session()->get('cart', []);
    //     if (isset($cart[$id])) {
    //         unset($cart[$id]);
    //         session()->put('cart', $cart);
    //     }
    //     session()->flash('success', 'Product removed from cart!');
    //     return $this->redirect('/cart', navigate: true);
    // }

    //buy now button triggered directCheckout
    public function directCheckout($id)
    {
        $product = Products::findOrFail($id);

        $cart = session()->get('cart', []);
        $images = $product->image ? json_decode($product->image, true) : [];

        $cart[$id] = [
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => $this->quantity,
            'color' => $this->color,
            'size' => $this->size,
            'image' => is_array($images) && !empty($images) ? $images[0] : null,
        ];
        session()->put('cart', $cart);
        return redirect()->route('checkout');
    }

    public function render()
    {
        return view('livewire.products.products-details', ['product' => $this->product]);
    }
}
