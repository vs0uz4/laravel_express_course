@extends('layout.panel.index')

@section('title')
MyBlog - Dashboard
@stop

@section('content')
<h1 class="page-header">Dashboard</h1>

<div class="row">
    <div class="col-xs-6 col-sm-6">
        <div id="yearlyRatio"></div>
    </div>
    <div class="col-xs-6 col-sm-6">
        <div id="chartPostsComments"></div>
    </div>
</div>

<h2 class="sub-header">5 most recent posts</h2>
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>Author</th>
            <th>Title</th>
            <th class="text-center text-nowrap">Created At</th>
            <th class="text-center text-nowrap">Updated At</th>
            <th class="text-center">Tags</th>
            <th class="text-center">Comments</th>
        </tr>
        </thead>
        <tbody>
        @foreach($topPosts as $post)
            <tr>
                <td>{{ $post->id }}</td>
                <td>{{ $post->author->nickname }}</td>
                <td>{{ $post->title }}</td>
                <td class="text-center text-nowrap">{{ $post->created_at }}</td>
                <td class="text-center text-nowrap">{{ $post->updated_at }}</td>
                <td class="text-center"><span class="glyphicon glyphicon-tags" aria-hidden="true"></span> {{ count($post->tags) }}</td>
                <td class="text-center"><span class="glyphicon glyphicon-comment" aria-hidden="true"></span> {{ count($post->comments) }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<h2 class="sub-header">5 most recent comments</h2>
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>E-mail</th>
            <th>Content</th>
            <th class="text-center text-nowrap">Created At</th>
            <th class="text-center">Confirmed</th>
        </tr>
        </thead>
        <tbody>
        @foreach($topComments as $comment)
            <tr>
                <td>{{ $comment->id }}</td>
                <td class="text-center text-nowrap">{{ $comment->name }}</td>
                <td>{{ $comment->email }}</td>
                <td>{{ str_limit($comment->content, 140, '...') }}</td>
                <td class="text-center text-nowrap">{{ $comment->created_at }}</td>
                <td class="text-center">{!! ($comment->confirmed) ? '<span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>' : '<span class="glyphicon glyphicon-thumbs-down" aria-hidden="true"></span>' !!}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<div class="row">
    <div class="col-xs-6 col-sm-6">
        <h2 class="sub-header">10 latest users added</h2>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Nickname</th>
                    <th>Name</th>
                    <th>E-Mail</th>
                    <th class="text-center text-nowrap">Created At</th>
                    <th>Posts</th>
                </tr>
                </thead>
                <tbody>
                @foreach($topUsers as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->nickname }}</td>
                        <td class="text-nowrap">{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td class="text-center text-nowrap">{{ $user->created_at }}</td>
                        <td><span class="glyphicon glyphicon-duplicate" aria-hidden="true"></span> {{ count($user->posts) }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="col-xs-6 col-sm-6">
        <h2 class="sub-header">Posts of users</h2>
        <div id="chartUsersPosts"></div>
    </div>
</div>

@stop

@section('views_scripts')
<!-- highcharts Javascript -->
<script src="/vendor/highcharts/highcharts.js"></script>

<!-- Scripts for dashboard view here -->
<script type="text/javascript">
    (function ($) {
        "use strict";

        $(function() {
            var data_posts = <?php echo $postsData; ?>;
            var data_tags = <?php echo $tagsData; ?>;
            var data_comments = <?php echo $commentsData; ?>;

            $('#yearlyRatio').highcharts({
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Monthly Average Entities'
                },
                subtitle: {
                    text: '(latest six months)'
                },
                xAxis: {
                    categories: ['Mar','Feb', 'Jan', 'Dez'],
                    crosshair: true
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Quantity (unit)'
                    }
                },
                tooltip: {
                    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y} units</b></td></tr>',
                    footerFormat: '</table>',
                    shared: true,
                    useHTML: true
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0
                    }
                },
                series: [{
                    name: 'Posts',
                    data: data_posts
                },{
                    name: 'Tags',
                    data: data_tags
                },{
                    name: 'Comments',
                    data: data_comments
                }]
            });
        });
    })(window.jQuery);
</script>
@stop