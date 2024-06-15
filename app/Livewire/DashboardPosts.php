<?php

namespace App\Livewire;

use App\Models\Post;
use Carbon\Carbon;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class DashboardPosts extends Component
{

    use LivewireAlert;

    public string $date_between = "Hari ini";
    public $date1;
    public $date2;

    public function mount()
    {
        $this->date1 = request('date1') ?? date('Y-m-d');
        $this->date2 = request('date2') ?? date('Y-m-d');
    }

    public function render()
    {
        return view('livewire.dashboard-posts', [
            'posts' => Post::latest()->filters(request(['title', 'type', 'edited', 'date1', 'date2']))->paginate(20)
        ]);
    }

    public function delete_post(Post $post)
    {

        $post->delete();

        $this->alert('success', 'Berhasil menghapus!', [
            'position' => 'bottom-end',
            'timer' => 3000,
            'toast' => true,
            'timerProgressBar' => true,
        ]);

    }

    public function get_date_between()
    {
        Carbon::setLocale('id');

        if ($this->date2 < $this->date1) {
            $this->date_between = "Jangka waktu tidak valid";
            return;
        } elseif ($this->date1 == $this->date2) {
            if ($this->date1 == date('Y-m-d')) {
                $this->date_between = 'Hari ini';
            } else {
                $this->date_between = Carbon::parse($this->date1)->translatedFormat('d F Y');
            }

            return;
        }

        $this->date_between = Carbon::parse($this->date1)->translatedFormat('d F Y') . " sampai " . Carbon::parse($this->date2)->translatedFormat('d F Y');
    }
}
