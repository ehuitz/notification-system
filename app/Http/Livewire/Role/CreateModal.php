<?php

namespace App\Http\Livewire\Role;

use Livewire\Component;
use App\Http\Livewire\Modal;

class CreateModal extends Modal
{
    public $title = '';
    public $permission = [];


    protected $listeners = [
        'createRoleErrorBag' => 'createRoleErrorBag',
        'showToggled' => 'resetValues',
        'openCreateModal' => 'show'
    ];

    public function emitEvent() {
        $this->emit('createRole', [
            'title' => $this->title,
            'permission' => $this->permission
        ]);
    }

    public function createRoleErrorBag($errorBag) {
        $this->setErrorBag($errorBag);
    }

    public function resetValues() {
        $this->title = '';
        $this->permission = '';
    }

    public function render()
    {
        return view('livewire.role.create-modal');
    }
}
