<?php

namespace App\Http\Livewire\Authentication;

use Livewire\Component;
use Spatie\Permission\Models\Role;

class RoleList extends Component
{
    public $roleId;
    public $search = '';
    public $action = '';  //flash
    public $message = '';  //flash

    protected $listeners = [
        'refreshParentRole' => '$refresh',
        'deleteRole',
        'editRole',
        'deleteConfirmRole'
    ];

    public function updatingSearch()
    {
        $this->emit('refreshTable');
    }

    public function createRole()
    {
        $this->emit('resetInputFields');
        $this->emit('openRoleModal');
    }

    public function editRole($roleId)
    {
        $this->roleId = $roleId;
        $this->emit('roleId', $this->roleId);
        $this->emit('openRoleModal');
    }

    public function deleteRole($roleId)
    {
        Role::destroy($roleId);

        $action = 'error';
        $message = 'Successfully Deleted';

        $this->emit('flashAction', $action, $message);
        $this->emit('refreshTable');
    }

    public function render()
    {
        if (empty($this->search)) {
            $roles  = Role::all();
        } else {
            $roles  = Role::where('name', 'LIKE', '%' . $this->search . '%')->get();
        }

        return view('livewire.authentication.role-list', [
            'roles' => $roles
        ]);
    }
}
