<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;

class CommentController extends Controller
{
    public function index(){
        $comments = Comment::with(['post'])->orderBy('id','desc')->paginate(10);
        return view('admin.comment.index',[
            'comments'=>$comments
        ]);
    }

    public function approved(int $comment_id){
     $comment = Comment::findOrFail($comment_id);
     $comment->update([
        'status'=>'approved'
     ]);
     return back()->with('success','Rey ugurla tesdiqlendi ve saytda gorunmeye basladi');
    }
    public function delete( int $comment_id){
        $comment = Comment::findOrFail($comment_id);
        $comment->delete();
        return back()->with('success','Rey ugurla silindi');
    }
}
