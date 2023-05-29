<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only('create');
        $this->authorizeResource(Post::class, 'post');
    }

    public function index()
    {
        return view('Post.index', [
            'posts' => Post::orderBy('id')
                        ->paginate(10)
        ]);
    }

    public function listing()
    {
        $posts = Post::whereNotNull('published')
                    ->latest()
                    ->paginate(5);
    
        return view('Post.listing', ['posts' => $posts]);
    }

     /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Post.create', ['categories' => Category::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $validated = $request->validated();
        
        $post = new Post();
        $post->title = $validated['title'];
        $post->body = $validated['body'];
        $post->user()->associate($request->user());
        $post->category()->associate(Category::find($validated['category']));

        $post->save();

        return redirect()->route('post.listing')->with('status', 'Пост создан и ожидает проверки администратором');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        if(!(Cookie::has("$post->id"))) {
            Post::withoutTimestamps(fn() => $post->increaseViewCount());
        }

        return response()->view('Post.show', ['post' => $post])->withCookie("$post->id", $post->id, 60);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('Post.edit', ['post' => $post, 'categories' => Category::all()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required|max:255|unique:posts,title,' . $post->id,
            'category' => 'required',
            'body' => 'required|string'
        ]);

        $post->update($validated);

        if ($post->category->id !== $validated['category']) {
            $post->category()->associate(Category::find($validated['category']));
            $post->save();
        }
        

        return redirect()->route('post.show', $post)->with('status', 'Пост изменён');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {     
        $post->delete();
        
        if (url()->previous() === route('post.index')) {
            return back()->with('status', 'Пост удалён');
        }
        
        return redirect()->route('post.listing');
    }

    public function showPopular()
    {
        $posts = Post::popular()
                    ->whereNotNull('published')
                    ->orderBy('views', 'desc')
                    ->paginate(5);

        return view('Post.listing', ['posts' => $posts]);
    }
    
    public function showByCategory($id = null)
    {
        $posts = Post::whereRelation('category', 'slug', $id)
                    ->whereNotNull('published')
                    ->latest()
                    ->paginate(5);

        return view('Post.listing', ['posts' => $posts]);
    }

    public function search(Request $request)
    {
        $validated = $request->validate([
            'search' => 'string|max:255',
        ]);

        $result = Post::where('title', 'LIKE', "%{$validated['search']}%")
                    ->whereNotNull('published')
                    ->paginate(10);

        return view('Post.listing', ['posts' => $result]);
    }
}
