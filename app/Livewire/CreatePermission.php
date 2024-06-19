<?php

namespace App\Livewire;

use Livewire\Attributes\Validate;
use Livewire\Component;
use Spatie\Permission\Models\Permission;

class CreatePermission extends Component
{
    #[Validate('required|string|max:255|lowercase')]
    public $name;

    public function save()
    {
        $this->validate();

        Permission::create(
            $this->only(['name'])
        );

        $this->redirect(route('roles.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.create-permission');
    }
}
