<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;
use Illuminate\Support\Str;

class PostForm extends Component
{
    public $subtitle = "Buat post baru";
    public $method = "POST";
    public $route = "";
    public $post;
    public $parameter = [];
    public $title;
    public $slug;
    public $attendance_list;

    public function mount()
    {
        $this->title = old('title', $this->post ? $this->post->title : '');
        $this->slug = old('slug', $this->post ? $this->post->slug : '');
    }

    public function render()
    {
        return view('livewire.post-form');
    }

    public function get_slug()
    {
        $slug = Str::slug($this->title);
        if (Post::where('slug', $slug)->count() < 1) {
            $this->slug = $slug;
        } else {
            $this->slug = $slug . '-' . time();
        }

    }
}
