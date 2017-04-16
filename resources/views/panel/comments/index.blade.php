@extends('layout.panel.index')

@section('title')
MyBlog - Comments
@stop

@section('views_styles')
<!-- Styles for comments.index view here -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
@stop


@section('content')
<h2 class="sub-header">
    <i class="glyphicon glyphicon-comment"></i> Comments of Posts
</h2>

@if(count($comments) > 0)
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Author</th>
                <th>Email</th>
                <th>Content</th>
                <th class="text-center text-nowrap">Created At</th>
                <th class="text-center">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($comments as $comment)
                <tr>
                    <td>{{ $comment->id }}</td>
                    <td class="text-nowrap">{{ $comment->name }}</td>
                    <td class="text-nowrap">{{ $comment->email }}</td>
                    <td>{{ $comment->content }}</td>
                    <td class="text-nowrap">{{ $comment->created_at }}</td>
                    <td class="text-center">
                        {!! Form::button($comment->confirmed ? '<span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>' : '<span class="glyphicon glyphicon-thumbs-down" aria-hidden="true"></span>', [
                                'type' => 'button',
                                'class' => $comment->confirmed ? 'btn btn-xs btn-success btnToggleConfirm' : 'btn btn-xs btn-danger btnToggleConfirm',
                                'title' => $comment->confirmed ? 'Trust' : 'Untrust',
                                'data-toggle' => 'tooltip',
                                'data-placement' => 'bottom',
                                'data-id' => $comment->id,
                                'data-route' => route('panel.comments.toggleConfirm', $comment->id)
                        ]) !!}

                        {!! Form::button('<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>', [
                            'type' => 'button',
                            'class' => 'btn btn-xs btn-danger btnCommentDestroy',
                            'title' => 'Destroy',
                            'data-toggle' => 'tooltip',
                            'data-placement' => 'bottom',
                            'data-id' => $comment->id,
                            'data-route' => route('panel.comments.destroy', $comment->id)
                        ]) !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    {{-- Paginação Inicio --}}
    <p>Viewing {!! $comments->count() !!} records of a total of {!! $comments->total() !!} records.</p>

    <div class="row">
        <div class="col-md-12 text-center">
            {!! $comments->render() !!}
        </div>
    </div>
    {{-- Paginação Final --}}
@else
    <h5>No <i>comments</i> found!</h5>
@endif
@stop

@section('views_scripts')
<!-- TODO implement functions in comments.js file -->
<!-- Scripts for comments.index view here -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    (function ($) {
        "use strict";

        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        });

        $('.btnCommentDestroy').on('click', function(e) {
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

        $('.btnToggleConfirm').on('click', function(e) {
            var route = $(this).data('route');
            var id = $(this).data('id');

            $.ajax({
                url: route,
                type: 'POST',
                global: true,
                cache: false,
                data: {
                    'id': id,
                    '_method': 'PUT'
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