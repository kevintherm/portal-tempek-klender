<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\PostType;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('posts.index', [
            'posts' => Post::latest()
                ->whereIn(
                    'type',
                    request('type') ?
                    [request('type')] :
                    array_column(PostType::cases(), 'value')
                )
                ->paginate(7)->withQueryString()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => ['required', 'string', Rule::in(array_column(PostType::cases(), 'value'))],
            'title' => ['required'],
            'slug' => ['required', 'unique:posts', 'alpha_dash'],
            'body' => ['required'],
            'category_id' => 'nullable',
            'attendance_list' => 'nullable',
            'show_on_featured' => 'nullable',
        ]);

        $validated['user_id'] = Auth::user()->id;

        $post = Post::create($validated);

        if ($request->expenses) {
            foreach ($request->expenses as $expense) {
                Expense::create([
                    'post_id' => $post->id,
                    'desc' => isset($expense['desc'])
                        ? $expense['desc']
                        : '',
                    'amount' => isset($expense['amount'])
                        ? $expense['amount']
                        : ''
                ]);
            }
        }

        return redirect()->route('posts.show', $post->slug);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('posts.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('posts.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'type' => ['required', 'string', Rule::in(array_column(PostType::cases(), 'value'))],
            'title' => ['required'],
            'slug' => [
                'required',
                $request->slug === $post->slug ? '' : 'unique:posts',
                'alpha_dash'
            ],
            'body' => ['required'],
            'category_id' => 'nullable',
            'attendance_list' => 'nullable',
            'show_on_featured' => 'nullable',
        ]);

        $validated['user_id'] = Auth::user()->id;

        $post->update($validated);

        return redirect()->route('posts.show', $post->slug);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('dashboard.posts');
    }
}
