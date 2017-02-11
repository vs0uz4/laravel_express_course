<?php

namespace MyBlog\Http\Controllers\Panel;

use Illuminate\Http\Request;

use MyBlog\Http\Requests;
use MyBlog\Http\Controllers\Controller;
use MyBlog\Post;

class PostsController extends Controller
{
    public function index(){
        $posts = Post::all();

        return view('panel.posts.index', compact('posts'));
    }
}
