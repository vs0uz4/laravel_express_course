<?php

namespace MyBlog\Http\Controllers\Panel;

use Illuminate\Http\Request;

use MyBlog\Post;
use MyBlog\User;
use MyBlog\Tag;
use MyBlog\Http\Requests\PostRequest;
use MyBlog\Http\Controllers\Controller;


class PostsController extends Controller
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
     * PostsController constructor.
     * @param Post $post
     * @param User $user
     * @param Tag $tag
     */
    public function __construct(Post $post, User $user, Tag $tag){
        $this->postModel = $post;
        $this->userModel = $user;
        $this->tagModel = $tag;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        $posts = $this->postModel->orderBy('created_at', 'desc')->paginate(10);

        return view('panel.posts.index', compact('posts'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(){
        $authors = $this->getAuthorsNicknames();

        return view('panel.posts.create', compact('authors'));
    }

    /**
     * @param PostRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PostRequest $request){
        $post = $this->postModel->create($request->all());
        $post->tags()->sync($this->getTagsIds($request->tags));

        return redirect()->route('panel.posts.index');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id){
        $post = $this->postModel->find($id);
        $authors = $this->getAuthorsNicknames();

        return view('panel.posts.edit', compact('post','authors'));
    }

    /**
     * @param $id
     * @param PostRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, PostRequest $request){
        $post = $this->postModel->find($id);
        $post->update($request->all());

        $post->tags()->sync($this->getTagsIds($request->tags));

        return redirect()->route('panel.posts.index');
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id, Request $request){
        if ( $request->ajax() ){
            try {
                $this->postModel->find($id)->delete();

                return response(['msg' => 'Post deleted', 'status' => 'success']);
            } catch (Exception $e){
                return response(['msg' => 'Failed deleting the Post', 'status' => 'failed']);
            }
        }

        $this->postModel->find($id)->delete();

        return redirect()->route('panel.posts.index');
    }

    /**
     * @param $post_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function comments($post_id){
        $post = $this->postModel->find($post_id);
        $comments =  $post->comments()->orderBy('created_at', 'desc')->paginate(10);

        return view('panel.posts.comments', compact('post','comments'));
    }

    /**
     * @return static
     */
    public function getAuthorsNicknames(){
        $authors = $this->userModel->all()->pluck('nickname','id');

        return $authors;
    }

    /**
     * @param $tags
     * @return array
     */
    private function getTagsIds($tags){
        $tagList = explode(',', $tags);
        $tagsIDs = [];

        foreach ($tagList as $tagName){
            $tagsIDs[] = $this->tagModel->firstOrCreate(['name' => $tagName])->id;
        }

        return $tagsIDs;
    }
}
