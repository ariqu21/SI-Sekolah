<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

use function Symfony\Component\String\b;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts=
        Post::latest()
        ->paginate(10);

        return view(
        'admin.posts.index',
        compact('posts')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data=$request->validate([

        'title'=>'required',
        'content'=>'nullable',
        'status'=>'required',
        'thumbnail'=>'nullable|image'

        ]);

        $data['slug']=
        Str::slug(
        $request->title
        );

        if($request->hasFile('thumbnail')){

            $data['thumbnail']=
            $request
            ->file('thumbnail')
            ->store(
            'posts',
            'public'
            );
        }

        Post::create($data);

        return redirect()
        ->route('posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('frontend.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
        'title'=>'required',
        'content'=>'nullable',
        'status'=>'required',
        'thumbnail'=>'nullable|image'
        ]);

        $data['slug']=
        Str::slug(
        $request->title
        );

        if($request->hasFile('thumbnail')){

            if(
                $post->thumbnail &&
                Storage::disk('public')
                ->exists(
                $post->thumbnail
                )
            ){
                Storage::disk('public')
                ->delete(
                $post->thumbnail
                );
            }
            $data['thumbnail'] =
            $request
            ->file('thumbnail')
            ->store(
            'posts',
            'public'
            );
        }

        $post->update($data);

        return redirect()
        ->route('posts.index')
        ->with(
        'success',
        'Post updated'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if(
            $post->thumbnail &&
            Storage::disk('public')
            ->exists(
            $post->thumbnail
            )
        ){
            Storage::disk('public')
            ->delete(
            $post->thumbnail
            );
        }

        $post->delete();
        return back();
    }
}
