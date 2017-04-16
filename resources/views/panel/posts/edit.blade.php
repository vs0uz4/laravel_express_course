@extends('layout.panel.index')

@section('title')
MyBlog - Posts
@stop

@section('views_styles')
<!-- Styles for posts.edit view here -->
    <link href="/vendor/bootstrap-tagsinput-latest/dist/bootstrap-tagsinput.css" rel="stylesheet">
@stop

@section('content')
    <h2 class="sub-header">
        <i class="glyphicon glyphicon-file"></i>Edit Post : {{ $post->title }}
    </h2>

    @include('panel.partials._alerts')

    {!! Form::model($post, ['route'=>['panel.posts.update', $post->id], 'method'=>'put', 'id' => 'postEdit']) !!}

        @include('panel.posts._form')

        <div class="form-group">
            {!! Form::label('tags', 'Tags:') !!}
            {!! Form::text('tags', $post->tagList, ['data-role' => 'tagsinput']) !!}
        </div>

        <div class="form-group">
            <a class="btn btn-default" href="{!! route('panel.posts.index') !!}">
                <i class="glyphicon glyphicon-chevron-left"></i> Back
            </a>
            <button class="btn btn-primary" type="button" id="submitButton">
                <i class="glyphicon glyphicon-save"></i> Update
            </button>
        </div>

    {!! Form::close() !!}

@stop

@section('views_scripts')
<!-- Scripts for posts.edit view here -->
<script src="/vendor/bootstrap-tagsinput-latest/dist/bootstrap-tagsinput.js"></script>
<script>
    (function ($) {
        "use strict";

        $('button#submitButton').click( function() {
            $('form#postEdit').submit();
        });
    })(window.jQuery);
</script>
@stop