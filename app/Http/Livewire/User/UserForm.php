<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class UserForm extends Component
{
    public $userId, $first_name, $middle_name, $last_name, $position, $email, $password, $password_confirmation;
    public $action = '';  //flash
    public $message = '';  //flash
    public $roleCheck = array();
    public $selectedRoles = [];

    protected $listeners = [
        'userId',
        'resetInputFields'
    ];

    public function resetInputFields()
    {
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }

    public function userId($userId)
    {
        $this->userId = $userId;
        $user = User::find($userId);
        $this->first_name = $user->first_name;
        $this->middle_name = $user->middle_name;
        $this->last_name = $user->last_name;
        $this->position = $user->position; // Changed from position to position
        $this->email = $user->email;

        $this->selectedRoles = $user->getRoleNames()->toArray();
    }

    public function store()
    {
          if (is_object($this->selectedRoles)) {
            $this->selectedRoles = json_decode(json_encode($this->selectedRoles), true);
        }

        if (empty($this->roleCheck)) {
            $this->roleCheck = array_map('strval', $this->selectedRoles);
        }

        if ($this->userId) {

            $data = $this->validate([
                'first_name'    => 'required',
                'middle_name'   => 'nullable',
                'last_name'     => 'required',
                'position'      => 'required',
                'email'         => ['required', 'email'],
                
            ]);
            
            
            $user = User::find($this->userId);
            $user->update($data);

            // $doc = Doctor::where('user_id', $user->id)->first();
            // if ($is_doc == true) {
            //     if ($doc == null) {
            //         Doctor::create([
            //             'user_id'       => $user->id,
            //             'first_name'    => $this->first_name,
            //             'middle_name'   => $this->middle_name,
            //             'last_name'     => $this->last_name
            //         ]);
            //     } else {
            //         $doc->update([
            //             'first_name'    => $this->first_name,
            //             'middle_name'   => $this->middle_name,
            //             'last_name'     => $this->last_name
            //         ]);
            //     }
            // } else {
            //     if ($doc != null) {
            //         $doc->delete();
            //     }
            // }
            if (!empty($this->password)) {
                $this->validate([
                    'password' => ['required', 'confirmed', Rules\Password::defaults()],
                ]);
    
                $user->update([
                    'password' => Hash::make($this->password),
                ]);
            }
            $user = User::find($this->userId);
            $user->update($data);

            // Update the doctor's assigned departments
            // $this->updateUserBranches($user);
            // $this->updateUserDepartments($user);
            // $this->updateDoctorSpecializations($user);

            $user->syncRoles($this->roleCheck);

            $action = 'edit';
            $message = 'Successfully Updated';
        } else {

            $this->validate([
                'first_name'    => 'required',
                'middle_name'   => 'nullable',
                'last_name'     => 'required',
                'position'      => 'required',
                'email'         => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
                'password'      => ['required', 'confirmed', Rules\Password::defaults()],
            ]);

            $user = User::create([
                'first_name'    => $this->first_name,
                'middle_name'   => $this->middle_name,
                'last_name'     => $this->last_name,
                'position'      => $this->position,
                'email'         => $this->email,
                'password'      => Hash::make($this->password)
            ]);

            $user->assignRole($this->roleCheck);

            // if ($is_doc == true) {
            //     Doctor::create([
            //         'user_id'       => $user->id,
            //         'first_name'    => $this->first_name,
            //         'middle_name'   => $this->middle_name,
            //         'last_name'     => $this->last_name
            //     ]);
            // }
            // $this->createUserBranches($user);
            // $this->createUserDepartments($user);

            $action = 'store';
            $message = 'Successfully Created';
        }

        $this->emit('flashAction', $action, $message);
        $this->resetInputFields();
        $this->emit('closeUserModal');
        $this->emit('refreshParentUser');
        $this->emit('refreshTable');
    }

    public function render()
    {
        $roles = Role::all();
        return view('livewire.user.user-form', [
            'roles' => $roles,
        ]);
    }
}
