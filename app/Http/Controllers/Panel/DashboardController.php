<?php

namespace MyBlog\Http\Controllers\Panel;

use Illuminate\Http\Request;

use MyBlog\Http\Requests;
use MyBlog\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(){
        return view('panel.dashboard.index');
    }
}
