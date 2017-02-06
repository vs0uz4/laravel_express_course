@extends('layout.site')

@section('title')
myBlog - Home
@stop

@section('page_header')
    <!-- Set your background image for this header on the line below. -->
    <header class="intro-header" style="background-image: url('img/home-bg.jpg')">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="site-heading">
                        <h1>vS0uz4 Xp's</h1>
                        <hr class="small">
                        <span class="subheading">My experiences, listed on a blog.</span>
                    </div>
                </div>
            </div>
        </div>
    </header>
@stop

@section('content')
    @foreach($posts as $post)
        <div class="post-preview">
            <a href="#">
                <h2 class="post-title">
                    {{ $post['title'] }}
                </h2>
                <h3 class="post-subtitle">
                    {{ $post['body_resume'] }}
                </h3>
            </a>
            <p class="post-meta">Posted by <a href="#">{{ $post['author'] }}</a> on {{ $post['public_date'] }}</p>
        </div>
        <hr>
    @endforeach

    <!-- Pager -->
    <ul class="pager">
        <li class="next">
            <a href="#">Older Posts &rarr;</a>
        </li>
    </ul>
@stop

@section('page_scripts')
<!-- Scripts for home page here -->
@stop