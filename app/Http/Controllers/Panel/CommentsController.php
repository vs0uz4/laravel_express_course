<?php

namespace MyBlog\Http\Controllers\Panel;

use Exception;
use Illuminate\Http\Request;

use MyBlog\Comment;
use MyBlog\Http\Requests;
use MyBlog\Http\Controllers\Controller;

class CommentsController extends Controller
{
    /**
     * @var Comment
     */
    private $commentModel;

    /**
     * CommentsController constructor.
     * @param Comment $comment
     */
    public function __construct(Comment $comment){
        $this->commentModel = $comment;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        $comments = $this->commentModel->orderBy('created_at', 'desc')->paginate(10);

        return view('panel.comments.index', compact('comments'));
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function toggleConfirm($id, Request $request){
        if ( $request->ajax() ) {
            try {
                $this->trustUnstrust($id);

                return response(['msg' => 'Comment updated', 'status' => 'success']);
            } catch (Exception $e) {
                return response(['msg' => 'Failed update the Comment', 'status' => 'failed']);
            }
        }

        $this->trustUnstrust($id);
        return redirect()->route('panel.comments.index');
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function destroy($id, Request $request){
        if ( $request->ajax() ){
            try {
                $this->commentModel->find($id)->delete();

                return response(['msg' => 'Comment deleted', 'status' => 'success']);
            } catch (Exception $e){
                return response(['msg' => 'Failed deleting the Comment', 'status' => 'failed']);
            }
        }

        $this->commentModel->find($id)->delete();

        return redirect()->route('panel.comments.index');
    }

    /**
     * @param $id
     */
    protected function trustUnstrust($id){
        $comment = $this->commentModel->find($id);
        $comment->confirmed ? $comment->confirmed = false : $comment->confirmed = true;
        $comment->update();
    }
}
