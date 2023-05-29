<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Comment::class);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comments = Comment::with(['post', 'user'])->get();

        return view('Post.show', ['comments' => $comments]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommentRequest $request, Post $post)
    {
        $validated = $request->validated();

        $comment = new Comment();
        $comment->message = $validated['message'];
        $comment->post_id = $post->id;
        $comment->user()->associate($request->user());
        
        $comment->save();

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();

        return back();
    }
}
