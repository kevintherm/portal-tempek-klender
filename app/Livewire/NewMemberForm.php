<?php

namespace App\Livewire;

use App\Models\Member;
use Livewire\Component;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Http;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Validation\ValidationException;

class NewMemberForm extends Component
{
    use LivewireAlert;

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
    #[Validate('required')]
    public $captcha;

    public function verifyCaptch($token)
    {
        $response = Http::post(
            'https://www.google.com/recaptcha/api/siteverify?secret=' .
            config('services.recaptcha.secret') .
            '&response=' . $token
        );

        $success = $response->json()['success'];

        if (!$success) {
            throw ValidationException::withMessages([
                'captcha' => __('Google thinks, you are a bot, please refresh and try again!'),
            ]);
        } else {
            $this->captcha = true;
        }
    }

    public function save()
    {
        $this->validate();


        Member::create(
            $this->only(['name', 'age', 'job', 'address', 'phone', 'reason_to_join'])
        );

        $this->alert('success', "Berhasil mengirim formulir!\nSilahkan tunggu informasi lebih lanjut.", [
            'position' => 'center',
            'timer' => 3000,
            'toast' => false,
            'timerProgressBar' => true,
        ]);

        $this->reset();
        $this->dispatch('reset-captcha');
    }

    public function render()
    {
        return view('livewire.new-member-form');
    }

}
