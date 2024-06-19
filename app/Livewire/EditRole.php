<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Spatie\Permission\Exceptions\PermissionAlreadyExists;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class EditRole extends Component
{
    public Role $role;
    public $users = [], $users_id = [];

    public $perms_id = [], $perms = [];

    #[Validate]
    public $name;

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255', Rule::unique('roles')->ignore($this->role->id)]
        ];
    }

    function getUsers($search)
    {
        $this->users = User::where('name', 'LIKE', "%$search%")->get(['id', 'name']);
    }

    function getPerms($search)
    {
        $this->perms = Permission::where('name', 'LIKE', "%$search%")->get(['id', 'name']);
    }

    function addOrDeleteUsers($id)
    {
        $index = array_search($id, $this->users_id);
        if ($index !== false) {
            array_splice($this->users_id, $index, 1);
        } else {
            $this->users_id[] = $id;
        }
    }

    function addOrDeletePerms($id)
    {
        $index = array_search($id, $this->perms_id);
        if ($index !== false) {
            array_splice($this->perms_id, $index, 1);
        } else {
            $this->perms_id[] = $id;
        }
    }

    public function mount(Role $role)
    {
        $this->role = $role;
        $this->perms = $this->role->permissions;
        $this->users = $this->role->users;


        $this->fill(
            $this->role->only(['name'])
        );
        $this->perms_id = $this->role->permissions()->pluck('id')->toArray();
        $this->users_id = $this->role->users()->pluck('id')->toArray();

    }

    public function searchUsers($search)
    {
        $this->users = User::where('name', 'LIKE', "%$search%")->get();
    }

    public function save()
    {
        $this->validate();

        $this->role->update(
            $this->only(['name'])
        );

        $this->role->syncPermissions($this->perms_id);

        $this->role->users()->sync($this->users_id);

        $this->redirect(route('roles.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.edit-role');
    }
}
