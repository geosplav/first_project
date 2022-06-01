<?php

namespace App\Http\Controllers;

use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();

        return view('post.index', compact('posts'));
    }

    public function create()
    {
        return view('post.create');
    }

    public function store()
    {
        $data = request()->validate([
            'title' => 'string',
            'content' => 'string',
            'image' => 'string',
        ]);
        Post::create($data);
        return redirect()->route('post.index');
    }

    public function show(Post $post)
    {
        dd($post->title);

    }

    public function update()
    {
        $post = Post::find(7);

        $post->update([
            'title' => '1111 update',
            'content' => '1111 update',
        ]);
        dd('updated');
    }

    public function delete()
    {
        $post = Post::withTrashed()->find(2);
        $post->restore();
        dd('deleted');
    }

    // firstOrCreate
    // updateOrCreate

    public function firstOrCreate()
    {
        $anotherPost = [
            'title' => 'some post',
            'content' => 'some content',
            'image' => 'some imageschena.jpg',
            'likes' => 500,
            'is_published' => 1,
        ];

        $post = Post::firstOrCreate([
            'title' => 'some title php storm',
        ], [
            'title' => 'some title php storm',
            'content' => 'some content',
            'image' => 'some imageschena.jpg',
            'likes' => 500,
            'is_published' => 1,
        ]);
        dump($post->content);
        dd('finished');
    }

    public function updateOrCreate()
    {
        $anotherPost = [
            'title' => 'updateorcreate some post',
            'content' => 'updateorcreate some content',
            'image' => 'updateorcreate some imageschena.jpg',
            'likes' => 5000,
            'is_published' => 0,
        ];

        $post =Post::updateOrCreate([
            'title' => 'some title php storm'
        ], [
            'title' => 'some title php post',
            'content' => 'updateorcreate some content',
            'image' => 'updateorcreate some imageschena.jpg',
            'likes' => 5000,
            'is_published' => 0,
        ]);
        dump($post->content);
        dd(2222222);
    }
}


