@extends('layout.panel.index')

@section('title')
MyBlog - Posts
@stop

@section('views_styles')
<!-- Styles for posts.index view here -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
@stop

@section('content')
<h2 class="sub-header">
    <i class="glyphicon glyphicon-duplicate"></i> Posts
    <div class="pull-right">
        <a class="btn btn-sm btn-primary" href="{!! route('panel.posts.create') !!}"><i class="glyphicon glyphicon-plus"></i> Create</a>
    </div>
</h2>

@if(count($posts) > 0)
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Author</th>
                <th>Title</th>
                <th class="text-center text-nowrap">Created At</th>
                <th class="text-center">Comments</th>
                <th class="text-center">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($posts as $post)
                <tr>
                    <td>{{ $post->id }}</td>
                    <td>{{ $post->author->nickname }}</td>
                    <td>{{ $post->title }}</td>
                    <td class="text-center text-nowrap">{{ $post->created_at }}</td>
                    <td class="text-center">{{ count($post->comments) }}</td>
                    <td class="text-center">
                        <a class="btn btn-xs btn-default {{ count($post->comments)>0 ? '' : 'disabled' }}" href="{!! route('panel.posts.comments', ['id' => $post->id]) !!}" role="button" data-toggle="tooltip" data-placement="bottom" title="Comments"><span class="glyphicon glyphicon-comment" aria-hidden="true"></span></a>
                        <a class="btn btn-xs btn-warning" href="{!! route('panel.posts.edit', ['id' => $post->id]) !!}" role="button" data-toggle="tooltip" data-placement="bottom" title="Edit"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>

                        {!! Form::button('<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>', [
                            'type' => 'button',
                            'class' => 'btn btn-xs btn-danger btnPostDestroy',
                            'title' => 'Destroy',
                            'data-toggle' => 'tooltip',
                            'data-placement' => 'bottom',
                            'data-id' => $post->id,
                            'data-route' => route('panel.posts.destroy', $post->id)
                        ]) !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    {{-- Paginação Inicio --}}
    <p>Visualizando {!! $posts->count() !!} registros de um total de {!! $posts->total() !!}</p>

    <div class="row">
        <div class="col-md-12 text-center">
            {!! $posts->render() !!}
        </div>
    </div>
    {{-- Paginação Final --}}
@else
    <h5>Nenhum <i>post</i> foi encontrado!</h5>
@endif
@stop

@section('views_scripts')
<!-- TODO implement functions in posts.js file -->
<!-- Scripts for posts view here -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    (function ($) {
        "use strict";

        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        });

        $('.btnPostDestroy').on('click', function(e) {
            var route = $(this).data('route');
            var id = $(this).data('id');

            $.ajax({
                url: route,
                type: 'POST',
                global: true,
                cache: false,
                data: {
                    'id': id,
                    '_method': 'DELETE'
                },
                success: function ( data ) {
                    if ( data.status === 'success' ) {
                        toastr.success( data.msg );
                    }
                },
                error: function( data ) {
                    if ( data.status === 'failed' ) {
                        toastr.error( data.msg );
                    }
                },
                complete: function(){
                    setInterval(function() {
                        window.location.reload();
                    }, 2000);
                }
            });

            return false;
        });
    })(window.jQuery);
</script>
@stop