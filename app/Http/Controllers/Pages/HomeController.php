<?php

namespace MyBlog\Http\Controllers\Pages;

use Illuminate\Http\Request;

use MyBlog\Http\Requests;
use MyBlog\Http\Controllers\Controller;
use MyBlog\Post;

class HomeController extends Controller
{
    /**
     * @var Post
     */
    private $postModel;

    public function __construct(Post $post){

        $this->postModel = $post;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = $this->postModel->orderBy('created_at', 'desc')->paginate(5);

        return view('pages.home.index', compact('posts'));
    }

}
