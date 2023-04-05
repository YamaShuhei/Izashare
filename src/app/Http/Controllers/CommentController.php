<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;
use App\Http\Requests\StoreCommentRequest;

class CommentController extends Controller
{
    public function store(StoreCommentRequest $request,Post $post){
 
        $comment = new Comment();
        $comment->post_id = $post->id;
        $comment->body = $request->body;
        $comment->save();

        return redirect()->route('post.show',$post);

    }

    public function destroy(Comment $comment){
        $comment->delete();

        return redirect()->back();
    }
}
