<?php

namespace App\Livewire;

use Livewire\Attributes\Validate;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class CreateRole extends Component
{

    #[Validate('required|string|max:255|unique:roles')]
    public $name;

    public function save()
    {
        $this->validate();

        Role::create(
            $this->only(['name'])
        );

        $this->redirect(route('roles.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.create-role');
    }
}
