<?php

namespace App\Http\Livewire\Permission;

use Livewire\Component;
use App\Models\Permission;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class Management extends Component
{
    use WithPagination;

    protected $listeners = [
        'createPermission' => 'create',
        'updatePermission' => 'update',
        'deletePermission' => 'delete',
    ];

    public function create($payload) {
        try {
            // Validate the informaiton and make sure the
            // Permission doesn't already exist
            $validated = Validator::make($payload, [
                'title' => 'required|string|unique:permissions,title',
            ])->validate();

            try {
                // Create the permission
                Permission::create($validated);
                $this->emitTo('permission.create-modal', 'show');
                $this->emit('flashSuccess', 'Permission created!');
            } catch (\exception $e) {
                $this->emit('flashError', 'Error trying to create permission');
            }
        } catch (ValidationException $e) {
            foreach($e->errors() as $key=>$error) {
                $this->addError('create_' . $key, $error[0]);
            }
            $this->emit('createPermissionErrorBag', $this->getErrorBag());
        }
    }

    public function update($payload) {
        try {
            // Check if permission title was entered and doesn't already exists
            $validated = Validator::make($payload, [
                'id' => 'required',
                'title' => 'required|string|unique:permissions,title,' . $payload['id'],
            ])->validate();

            try{
                // Find the permission and update the title
                $permission = Permission::find($payload['id']);
                $permission->title = $payload['title'];
                $permission->save();
                $this->emitTo('permission.edit-modal', 'show');
                $this->emit('flashSuccess', 'Permission updated!');
            } catch (\exception $e) {
                $this->emit('flashError', 'Error trying to update permission');
            }

        } catch (ValidationException $e) {
            foreach($e->errors() as $key=>$error) {
                $this->addError('edit_' . $key, $error[0]);
            }
            $this->emit('editPermissionErrorBag', $this->getErrorBag());
        }
    }

    public function delete($id) {
        try {
            // Make sure permission id exists
            Validator::make(
                ['id' => $id],
                ['id' => 'required|exists:permissions']
            )->validate();

            // Delete the Permission
            try {
                Permission::find($id)->delete();
                $this->emit('flashSuccess', 'Permission deleted!');
            } catch (\exception $e) {
                $this->emit('flashError', 'Error trying to delete permission');
            }
        } catch (ValidationException $e) {
            $this->emit('flashError', $e->errors()['id'][0]);
        }
    }

    public function paginationView() {
        return 'vendor/livewire/tailwind';
    }

    public function render() {
        return view('livewire.permission.management', [
            'permissions' => Permission::first('updated_at')
                ->orderBy('title', 'asc')
                ->paginate(14)
        ]);
    }
}
