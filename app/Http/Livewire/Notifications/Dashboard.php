<?php

namespace App\Http\Livewire\Notifications;

use App\Models\Notification;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

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

    protected $listeners = [
        'createNotification' => 'create',
        'updateNotification' => 'update',
        'deleteNotification' => 'delete',
    ];

    public function update($payload) {
        try {
            // Validate information and that the email doesn't exist
            Validator::make($payload, [
                'id' => 'required',
                'title' => 'required|string|max:255',
                'content' => 'required|string|max:255',
                'date' => 'required'
            ])->validate();

            try {
                // Find notification and update their information
                $notification = Notification::find($payload['id']);
                $notification->title = $payload['title'];
                $notification->content = $payload['content'];
                $notification->date = now();
                $notification->status_id = '1';
                $notification->excecuted_at = null;

                $notification->save();

                $this->emitTo('notifications.edit-modal', 'show');
                $this->emit('flashSuccess', 'Notification updated');
            } catch (\exception $e) {
                $this->emit('flashError', 'Error trying to update notification');
            }
        } catch (ValidationException $e) {
            foreach($e->errors() as $key=>$error) {
                $this->addError('edit_' . $key, $error[0]);
            }
            $this->emit('editNotificationErrorBag', $this->getErrorBag());
        }
    }

    public function delete($id) {
        try {
            // Validate that the ID exists
            Validator::make(
                ['id' => $id],
                ['id' => 'required|exists:notifications']
            )->validate();

            try {
                // Find the notification and delete them
                $notification = Notification::find($id);
                $notification->delete();
                $this->emit('flashSuccess', 'Notification deleted');
            } catch (\exception $e) {
                $this->emit('flashError', 'Error trying to delete Notification');
            }
        } catch (ValidationException $e) {
            $this->emit('flashError', $e->errors()['id'][0]);
        }
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
