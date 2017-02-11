@extends('layout.panel.index')

@section('title')
MyBlog - Dashboard
@stop

@section('content')
<h2 class="sub-header">Posts</h2>
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>Author</th>
            <th>Title</th>
            <th>Created At</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($posts as $post)
            <tr>
                <td>{{ $post->id }}</td>
                <td>{{ $post->author->name }}</td>
                <td>{{ $post->title }}</td>
                <td>{{ $post->created_at }}</td>
                <td>
                    <a class="btn btn-xs btn-default" href="#" role="button" data-toggle="tooltip" data-placement="bottom" title="Tags"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span></a>
                    <a class="btn btn-xs btn-warning" href="#" role="button" data-toggle="tooltip" data-placement="bottom" title="Edit"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
                    <a class="btn btn-xs btn-danger" href="#" role="button" data-toggle="tooltip" data-placement="bottom" title="Delete"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@stop

@section('views_scripts')
<!-- TODO implement functions in posts.js file -->
<!-- Scripts for posts view here -->
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>
@stop