<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;


class PublicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $posts = Post::whereNull('published')->orderBy('id')->paginate(10);

        return view('Publication.index', ['posts' => $posts]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Post $post): RedirectResponse
    {
        $post->published = now();

        $post->save();

        return back()->with('status', 'Пост опубликован');
    }

    public function update(Post $post): RedirectResponse
    {
        $post->published = null;

        $post->save();

        return back()->with('status', 'Пост снят с публикации');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post): RedirectResponse
    {
        $post->delete();

        return back()->with('status', 'Пост удалён');
    }
}
