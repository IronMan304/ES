<?php

namespace App\Http\Livewire\Authentication;

use Livewire\Component;
use Spatie\Permission\Models\Permission;

class PermissionList extends Component
{
    public $permissionId;
    public $search = '';
    public $action = '';  //flash
    public $message = '';  //flash

    protected $listeners = [
        'refreshParentPermission' => '$refresh',
        'deletePermission',
        'editPermission',
        'deleteConfirmPermission'
    ];

    public function updatingSearch()
    {
        $this->emit('refreshTable');
    }

    public function createPermission()
    {
        $this->emit('resetInputFields');
        $this->emit('openPermissionModal');
    }

    public function editPermission($permissionId)
    {
        $this->permissionId = $permissionId;
        $this->emit('permissionId', $this->permissionId);
        $this->emit('openPermissionModal');
    }

    public function deletePermission($permissionId)
    {
        Permission::destroy($permissionId);
        
        $action = 'error';
        $message = 'Successfully Deleted';

        $this->emit('flashAction', $action, $message);
        $this->emit('refreshTable');
    }

    public function render()
    {
        if (empty($this->search)) {
            $permissions  = Permission::all();
        } else {
            $permissions  = Permission::where('name', 'LIKE', '%' . $this->search . '%')->get();
        }

        return view('livewire.authentication.permission-list', [
            'permissions' => $permissions
        ]);
    }
}
