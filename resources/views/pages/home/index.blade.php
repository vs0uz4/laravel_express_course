@extends('layout.blog.index')

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
                    {{ $post->title }}
                </h2>
                <h3 class="post-subtitle">
                    {{ str_limit($post->content, 140, '...') }}
                </h3>
            </a>
            <p class="post-meta">
                <span class="fa fa-clock-o fa-fw"></span> Posted by <a href="#">{{ $post->author->nickname }}</a> {{ $post->created_at }}
                @if(count($post->comments)>0)
                    <span class="fa fa-comments fa-fw"></span> {{ (count($post->comments)>1) ? count($post->comments) . ' comments' : count($post->comments) . ' comment' }}
                @else
                    <span class="fa fa-comments fa-fw"></span> no comments.
                @endif
            </p>
            @if(count($post->tags)>0)
                <p class="post-tags">
                    <span class="fa fa-tags fa-fw"></span> {{ $post->tagList }}
                </p>
            @else
                <p class="post-tags">
                    <span class="fa fa-tags fa-fw"></span> no tags.
                </p>
            @endif
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