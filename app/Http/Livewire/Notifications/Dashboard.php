<?php

namespace App\Http\Livewire\Notifications;

use App\Models\Notification;
use Livewire\Component;
use Livewire\WithPagination;

class Dashboard extends Component
{
    use WithPagination;

    public $search;
    public $status;
    public $department;

    protected $queryString = ['search','status'];

    public function updating() {
        $this->resetPage();
    }

    public function render()
    {
        if(auth()->user()->is_admin())
            return view('livewire.notifications.dashboard', [
                'notifications' => Notification::latest('updated_at')
                    ->filter([
                        'search' => $this->search,
                        'status' => $this->status,
                    ])
                    ->with('status', 'owner')
                    ->paginate(10)
                    ->withQueryString()
            ]);
        else
            return view('livewire.notifications.dashboard', [
                'notifications' => Notification::latest('updated_at')
                    ->filter([
                        'search' => $this->search,
                    ])
                    ->where('owner_id', auth()->user()->id)
                    ->with('status', 'owner')
                    ->paginate(10)
                    ->withQueryString()
            ]);

    }
}
