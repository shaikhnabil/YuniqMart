<?php

namespace App\Livewire;

use App\Models\Products;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Home extends Component
{
    use WithPagination;

    public function markAsRead()
    {
        Auth::user()->unreadNotifications->markAsRead();
        return redirect()->back();
    }


    public function render()
    {
        //$notifications = auth()->user()->notifications()->paginate(10);
        $notifications = auth()->check() ? auth()->user()->notifications()->paginate(10) : collect();
        $products = Products::where('is_active', '==', '0')->with('category')->latest()->paginate(21);
        return view('livewire.home', compact(['products', 'notifications']));
    }
}
