<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use App\Models\RoleUser;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

class Management extends Component
{
    protected $listeners = [
        'createUser' => 'create',
        'updateUser' => 'update',
        'deleteUser' => 'delete',
    ];

    public function create($payload) {
        try {
            Validator::make($payload, [
                'name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => [
                    'required',
                    'confirmed',
                    Password::defaults()
                ],
                'password_confirmation' => 'required',
                'role'=> 'nullable|array',
            ])->validate();

            try {
                // Create user
                $user = User::create([
                    'name' => $payload['name'],
                    'email' => $payload['email'],
                    'password' => Hash::make($payload['password']),
                ]);

                if($payload['role']) {
                    $user->roles()->attach($payload['role']);
                }



                $this->emitTo('user.create-modal', 'show');
                $this->emit('flashSuccess', 'User created');
            } catch (\exception $e) {
                $this->emit('flashError', 'Error trying to create user');
            }
        } catch (ValidationException $e) {
            foreach($e->errors() as $key=>$error) {
                $this->addError('create_' . $key, $error[0]);
            }
            $this->emit('createUserErrorBag', $this->getErrorBag());
        }
    }

    public function update($payload) {
        try {
            // Validate information and that the email doesn't exist
            Validator::make($payload, [
                'id' => 'required',
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,' . $payload['id'],
                'role' => 'nullable|array'
            ])->validate();

            try {
                // Find user and update their information
                $user = User::find($payload['id']);
                $user->name = $payload['name'];
                $user->email = $payload['email'];

                $user->save();

                RoleUser::where('user_id', $user->id )->delete();
                $user->roles()->attach($payload['role']);
                $this->emitTo('user.edit-modal', 'show');
                $this->emit('flashSuccess', 'User updated');
            } catch (\exception $e) {
                $this->emit('flashError', 'Error trying to update user');
            }
        } catch (ValidationException $e) {
            foreach($e->errors() as $key=>$error) {
                $this->addError('edit_' . $key, $error[0]);
            }
            $this->emit('editUserErrorBag', $this->getErrorBag());
        }
    }

    public function delete($id) {
        try {
            // Validate that the ID exists
            Validator::make(
                ['id' => $id],
                ['id' => 'required|exists:users']
            )->validate();

            try {
                // Find the user and delete them
                $user = User::find($id);
                $user->delete();
                $this->emit('flashSuccess', 'User deleted');
            } catch (\exception $e) {
                $this->emit('flashError', 'Error trying to delete user');
            }
        } catch (ValidationException $e) {
            $this->emit('flashError', $e->errors()['id'][0]);
        }
    }

    public function render()
    {
        return view('livewire.user.management', [
            'users' => User::latest()
                ->paginate(10)
        ]);
    }
}
