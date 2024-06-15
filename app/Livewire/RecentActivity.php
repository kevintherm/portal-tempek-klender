<?php

namespace App\Livewire;

use App\Models\Post;
use App\PostType;
use Livewire\Component;

class RecentActivity extends Component
{
    public $activity;
    public function mount()
    {
        $this->activity = Post::latest()->whereIn('type', [PostType::Activity, PostType::Anouncement])->where('show_on_featured', true)->first();
    }

    public function render()
    {
        return <<<'HTML'
        <div>
            @if($this->activity)
            <section class="md:m-10 m-4 bg-white dark:bg-gray-800">
                <div
                    class="p-6 md:p-10 border border-yellow-700/60 dark:border-yellow-600 bg-gradient-to-tr from-yellow-900/0 to-yellow-800/20 backdrop-blur-sm bg-no-repeat lg:bg-contain bg-cover bg-right rounded-xl">
                    <p class="font-bold mb-2 text-sm capitalize">
                        {{ $this->activity->type }} Terbaru
                    </p>
                    <h3 class="font-bold text-3xl line-clamp-1">
                        {{ Str::limit($this->activity->title, 50) }}
                    </h3>
                    <p class="mt-2 mb-6 !text-base font-normal text-gray-500 line-clamp-2">
                        {{ Str::limit(strip_tags($this->activity->body), 100) }}
                    </p>
                    <a
                        href="{{route('posts.show', $this->activity->slug)}}"
                        class="flex-shrink-0 px-6 py-3 border-yellow-900 border hover:bg-yellow-900 transition text-yellow-900 hover:text-white rounded-xl font-semibold dark:text-yellow-600 dark:border-yellow-600 dark:hover:bg-yellow-600">
                        Selengkapnya
                    </a>
                </div>
                </section>
            @endif
        </div>
        HTML;
    }
}
