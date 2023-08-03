<?php

namespace App\Http\Livewire\Role;

use Livewire\Component;
use App\Models\Role;
use App\Http\Livewire\Modal;

class EditModal extends Modal
{
	public $id_;
	public $title;
    public $permission = [];

	protected $listeners = [
		'openEditModal' => 'show',
		'showToggled' => 'showToggled',
		'editRoleErrorBag' => 'editRoleErrorBag'
	];

	public function showToggled($params) {
		if ($params) {
			$this->id_ = $params['id'];
			$role = Role::find($this->id_);
			$this->title = $role->title;
            $this->permission = $role->permissions->pluck('id');

		}
	}

	public function emitEvent() {
		$this->emit('updateRole', [
			'id' => $this->id_,
			'title' => $this->title,
            'permission' => $this->permission
		]);
	}

	public function editRoleErrorBag($errorBag) {
		$this->setErrorBag($errorBag);
	}

    public function render()
    {
        return view('livewire.role.edit-modal');
    }
}
