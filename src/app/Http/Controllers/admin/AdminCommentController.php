<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;
use App\Http\Requests\StoreCommentRequest;

class AdminCommentController extends Controller
{
    //コメント削除
    public function destroy(Comment $comment){
        $comment->delete();

        return redirect()->back();
    }
}
