<?php

namespace App\Http\Livewire\Permission;

use Livewire\Component;
use App\Http\Livewire\Modal;

class CreateModal extends Modal
{
    public $title = '';

    protected $listeners = [
        'createPermissionErrorBag' => 'createPermissionErrorBag',
        'showToggled' => 'resetValues',
        'openCreateModal' => 'show'
    ];

    public function emitEvent() {
        $this->emit('createPermission', [
            'title' => $this->title
        ]);
    }

    public function createPermissionErrorBag($errorBag) {
        $this->setErrorBag($errorBag);
    }

    public function resetValues() {
        $this->title = '';
    }

    public function render()
    {
        return view('livewire.permission.create-modal');
    }
}
