<?php

namespace App\Livewire;

use Livewire\Component;

class Notifications extends Component
{
    public function markAsReadone($notificationId)
    {
        auth()->user()->notifications->find($notificationId)->markAsRead();
        return redirect()->back();
    }
    public function render()
    {
        $notifications = auth()->user()->notifications()->paginate(10);
        return view('livewire.notifications', compact('notifications'));
    }
}
