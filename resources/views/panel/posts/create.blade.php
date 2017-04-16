@extends('layout.panel.index')

@section('title')
MyBlog - Posts
@stop

@section('views_styles')
<!-- Styles for posts.create view here -->
    <link href="/vendor/bootstrap-tagsinput-latest/dist/bootstrap-tagsinput.css" rel="stylesheet">
@stop

@section('content')
    <h2 class="sub-header">
        <i class="glyphicon glyphicon-file"></i>Create new Post
    </h2>

    @include('panel.partials._alerts')

    {!! Form::open(['route'=>'panel.posts.store', 'method'=>'post', 'id' => 'postCreate']) !!}

        @include('panel.posts._form')

        <div class="form-group">
            {!! Form::label('tags', 'Tags:') !!}
            {!! Form::text('tags', null, ['data-role' => 'tagsinput']) !!}
        </div>

        <div class="form-group">
            <a class="btn btn-default" href="{!! route('panel.posts.index') !!}">
                <i class="glyphicon glyphicon-chevron-left"></i> Back
            </a>
            <button class="btn btn-primary" type="button" id="submitButton">
                <i class="glyphicon glyphicon-save"></i> Save
            </button>
        </div>

    {!! Form::close() !!}

@stop

@section('views_scripts')
<!-- Scripts for posts.create view here -->
<script src="/vendor/bootstrap-tagsinput-latest/dist/bootstrap-tagsinput.js"></script>
<script>
    (function ($) {
        "use strict";

        $('button#submitButton').click( function() {
            $('form#postCreate').submit();
        });
    })(window.jQuery);
</script>
@stop