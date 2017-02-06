<?php

namespace MyBlog\Http\Controllers;

use Illuminate\Http\Request;

use MyBlog\Http\Requests;
use MyBlog\Http\Controllers\Controller;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.contact.index');
    }

}
