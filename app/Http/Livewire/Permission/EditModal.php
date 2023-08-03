<?php

namespace App\Http\Livewire\Permission;

use Livewire\Component;
use App\Models\Permission;
use App\Http\Livewire\Modal;

class EditModal extends Modal
{
	public $id_;
	public $title;

	protected $listeners = [
		'openEditModal' => 'show',
		'showToggled' => 'showToggled',
		'editPermissionErrorBag' => 'editPermissionErrorBag'
	];

	public function showToggled($params) {
		if ($params) {
			$this->id_ = $params['id'];
			$permission = Permission::find($this->id_);
			$this->title = $permission->title;
		}
	}

	public function emitEvent() {
		$this->emit('updatePermission', [
			'id' => $this->id_,
			'title' => $this->title,
		]);
	}

	public function editPermissionErrorBag($errorBag) {
		$this->setErrorBag($errorBag);
	}

    public function render()
    {
        return view('livewire.permission.edit-modal');
    }
}
