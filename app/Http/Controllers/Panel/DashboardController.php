<?php

namespace MyBlog\Http\Controllers\Panel;

use Illuminate\Support\Facades\DB;
use MyBlog\Http\Controllers\Controller;
use Illuminate\Http\Request;
use MyBlog\Http\Requests;
use MyBlog\Post;
use MyBlog\Tag;
use MyBlog\User;
use MyBlog\Comment;

class DashboardController extends Controller
{
    /**
     * @var Post
     */
    private $postModel;

    /**
     * @var User
     */
    private $userModel;

    /**
     * @var Tag
     */
    private $tagModel;

    /**
     * @var Comment
     */
    private $commentModel;


    public function __construct(Post $post, User $user, Tag $tag, Comment $comment){
        $this->postModel = $post;
        $this->userModel = $user;
        $this->tagModel = $tag;
        $this->commentModel = $comment;
    }

    public function index(){
        $topPosts = $this->postModel->with('author','tags')->orderBy('created_at', 'desc')->take(5)->get();
        $topComments = $this->commentModel->orderBy('created_at', 'asc')->take(5)->get();
        $topUsers = $this->userModel->orderBy('created_at', 'desc')->take(10)->get();

        $postsData = $this->postModel->select(DB::raw("COUNT(id) as count, substr('--JanFebMarAprMayJunJulAugSepOctNovDec', strftime('%m', created_at) * 3, 3) as month"))
            ->orderBy('created_at')
            ->groupBy('month')
            ->get()
            ->toArray();
        $postsData = json_encode(array_column($postsData, 'count'), JSON_NUMERIC_CHECK);

        $tagsData = $this->tagModel->select(DB::raw("COUNT(id) as count, substr('--JanFebMarAprMayJunJulAugSepOctNovDec', strftime('%m', created_at) * 3, 3) as month"))
            ->orderBy('created_at')
            ->groupBy('month')
            ->get()
            ->toArray();
        $tagsData = json_encode(array_column($tagsData, 'count'), JSON_NUMERIC_CHECK);

        $commentsData = $this->commentModel->select(DB::raw("COUNT(id) as count, substr('--JanFebMarAprMayJunJulAugSepOctNovDec', strftime('%m', created_at) * 3, 3) as month"))
            ->orderBy('created_at')
            ->groupBy('month')
            ->get()
            ->toArray();
        $commentsData = json_encode(array_column($commentsData, 'count'), JSON_NUMERIC_CHECK);

        /*
         * Método antigo já melhorado
        $postsData = Post::select(DB::raw("COUNT(id) as count, strftime('%Y', created_at) as year"))
            ->orderBy("created_at")
            ->groupBy("year")
            ->get()
            ->toArray();
        $postsData = json_encode(array_column($postsData, 'count'), JSON_NUMERIC_CHECK);

        $tagsData = Tag::select(DB::raw("COUNT(id) as count, strftime('%Y', created_at) as year"))
            ->orderBy("created_at")
            ->groupBy("year")
            ->get()
            ->toArray();
        $tagsData = json_encode(array_column($tagsData, 'count'), JSON_NUMERIC_CHECK);

        $comments = Comment::select(DB::raw("COUNT(id) as count, strftime('%Y', created_at) as year"))
            ->orderBy("created_at")
            ->groupBy("year")
            ->get()
            ->toArray();
        $commentsData = json_encode(array_column($comments, 'count'), JSON_NUMERIC_CHECK);
        */

        return view('panel.dashboard.index', compact('topPosts', 'topComments', 'topTags', 'topUsers', 'commentsData', 'tagsData', 'postsData'));
    }
}
