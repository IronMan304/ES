<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;

class UserList extends Component
{
    public $userId;
    public $search = '';
    public $action = '';  //flash
    public $message = '';  //flash

    protected $listeners = [
        'refreshParentUser' => '$refresh',
        'deleteUser',
        'editUser',
        'deleteConfirmUser'
    ];

    public function updatingSearch()
    {
        $this->emit('refreshTable');
    }

    public function createUser()
    {
        $this->emit('resetInputFields');
        $this->emit('openUserModal');
    }

    public function editUser($userId)
    {
        $this->userId = $userId;
        $this->emit('userId', $this->userId);
        $this->emit('openUserModal');
    }

    public function deleteUser($userId)
    {
        User::destroy($userId);

        $action = 'error';
        $message = 'Successfully Deleted';

        $this->emit('flashAction', $action, $message);
        $this->emit('refreshTable');
    }

    public function render()
    {
        $users = User::query();

        if (!empty($this->search)) {
            $users->where(function ($query) {
                $query->where('first_name', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('last_name', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('position', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('email', 'LIKE', '%' . $this->search . '%');
            });
        }

        $users = $users->with('roles')->get();

        return view('livewire.user.user-list', [
            'users' => $users
        ]);
    }
}
