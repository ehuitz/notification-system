<?php

namespace App\Http\Livewire\Notifications;

use App\Models\Notification;
use Livewire\Component;
use App\Http\Livewire\Modal;

class EditModal extends Modal
{
	public $id_ = '';
	public $title = '';
    public $content = '';
    public $date = '';



	protected $listeners = [
		'openEditModal' => 'show',
		'showToggled' => 'showToggled',
		'editNotificationErrorBag' => 'editNotificationErrorBag'
	];

	public function showToggled($params) {
		if ($params) {
			$this->id_ = $params['id'];
			$notification = Notification::find($this->id_);
			$this->title = $notification->title;
            $this->content = $notification->content;
            $this->date = $notification->date;
		}
	}

	public function emitEvent() {
		$this->emit('updateNotification', [
			'id' => $this->id_,
			'title' => $this->title,
            'content' => $this->content,
            'date' => $this->date,
		]);
	}

	public function editNotificationErrorBag($errorBag) {
		$this->setErrorBag($errorBag);
	}

    public function render()
    {
        return view('livewire.notifications.edit-modal');
    }
}
