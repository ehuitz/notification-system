<?php

namespace App\Http\Livewire\Role;

use App\Models\Permission;
use App\Models\PermissionRole;
use Livewire\Component;
use App\Models\Role;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class Management extends Component
{
    use WithPagination;

    protected $listeners = [
        'createRole' => 'create',
        'updateRole' => 'update',
        'deleteRole' => 'delete',
    ];

    public function create($payload) {
        try {
            // Validate the informaiton and make sure the
            // Role doesn't already exist
            $validated = Validator::make($payload, [
                'title' => 'required|string|unique:roles,title',
                'permission' => 'nullable|array',
            ])->validate();

            try {
                // Create the role
                if (Role::where('title', $payload['title'])->first())
                    return $this->dispatchBrowserEvent('errorMessage', ['message' => 'Role already exists!']);;

               $role = Role::create($validated);

               if($payload['permission']) $role->permissions()->attach($payload['permission']);

                $this->emitTo('role.create-modal', 'show');
                $this->emit('flashSuccess', 'Role created!');
            } catch (\exception $e) {
                $this->emit('flashError', 'Error trying to create role');
            }
        } catch (ValidationException $e) {
            foreach($e->errors() as $key=>$error) {
                $this->addError('create_' . $key, $error[0]);
            }
            $this->emit('createRoleErrorBag', $this->getErrorBag());
        }
    }

    public function update($payload) {
        try {
            // Check if role title was entered and doesn't already exists
            $validated = Validator::make($payload, [
                'id' => 'required|exists:roles',
                'title' => 'required|string|unique:roles,title,' . $payload['id'],
                'permission' => 'nullable|array',

            ])->validate();

            try{
                 // Check if the role doesn't exist
                 if (!$role = Role::find($payload['id'])) {
                    return $this->dispatchBrowserEvent('errorMessage', ['message' => 'Role does not exist']);
                }
                PermissionRole::where('role_id', $role->id)->delete();




            // Attach the updated permissions
            $role->permissions()->attach($payload['permission']);


                $this->emitTo('role.edit-modal', 'show');
                $this->emit('flashSuccess', 'Role updated!');
            } catch (\exception $e) {
                $this->emit('flashError', 'Error trying to update role');
            }

        } catch (ValidationException $e) {
            foreach($e->errors() as $key=>$error) {
                $this->addError('edit_' . $key, $error[0]);
            }
            $this->emit('editRoleErrorBag', $this->getErrorBag());
        }
    }

    public function delete($id) {
        try {
            // Make sure role id exists
            Validator::make(
                ['id' => $id],
                ['id' => 'required|exists:roles']
            )->validate();

            // Delete the Role
            try {
                Role::find($id)->delete();
                $this->emit('flashSuccess', 'Role deleted!');
            } catch (\exception $e) {
                $this->emit('flashError', 'Error trying to delete role');
            }
        } catch (ValidationException $e) {
            $this->emit('flashError', $e->errors()['id'][0]);
        }
    }

    public function paginationView() {
        return 'vendor/livewire/tailwind';
    }

    public function render() {
        return view('livewire.role.management', [
            'roles' => Role::with('permissions')
                ->paginate(14)
        ]);
    }
}
