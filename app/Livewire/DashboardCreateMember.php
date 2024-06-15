<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Member;
use Livewire\Component;
use Livewire\Attributes\Validate;
use Illuminate\Auth\Events\Validated;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Validation\ValidationException;

class DashboardCreateMember extends Component
{
    use LivewireAlert;

    public $user_id;
    public $disabled_user_input = true;

    public $user_email;
    #[Validate('required')]
    public $name;
    #[Validate('required')]
    public $age;
    #[Validate('required')]
    public $job;
    #[Validate('required')]
    public $address;
    #[Validate('required')]
    public $phone;
    #[Validate('required')]
    public $reason_to_join;

    public function save()
    {
        $this->validate();

        // check user exists
        if ($this->user_email) {

            if ($user = User::where('email', $this->user_email)->first()) {
                if (Member::where('user_id', $user->id)->count() > 0) {
                    throw ValidationException::withMessages([
                        'user_email' => __('Member dengan user account sudah ada, silahkan hubungi admin yang bersangkutan.'),
                    ]);
                }

                $this->user_id = $user->id;

            } else
                throw ValidationException::withMessages([
                    'user_email' => __('User account tidak ada, silahkan hubungi admin yang bersangkutan.'),
                ]);
        }

        Member::create($this->only(['name', 'age', 'job', 'address', 'phone', 'reason_to_join']));

        $this->alert('success', 'Member baru ditambahkan!', [
            'position' => 'bottom-right',
            'timer' => 3000,
            'toast' => true,
            'timerProgressBar' => true,
        ]);


        $this->reset();
    }

    function toggle_user_input()
    {
        $this->disabled_user_input = !$this->disabled_user_input;
    }

    public function render()
    {
        return view('livewire.dashboard-create-member');
    }
}
