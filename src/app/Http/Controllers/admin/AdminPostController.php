<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;



//管理者用投稿画面
class AdminPostController extends Controller
{
    // 一覧画面
    public function index(Request $request){
        $post = Post::paginate(10);

        $search = $request->input('search');
        $query = Post::query();

        if($search) {
          $spaceConversion = mb_convert_kana($search ,'s', 'utf-8');
          $wordArraySearched = preg_split('/[\s,]+/', $spaceConversion, -1, PREG_SPLIT_NO_EMPTY);

          foreach($wordArraySearched as $value) {
            $query->where('title', 'like', '%'.$value.'%');
          }

          $post = $query->paginate(10);
        }

        return view('post.index')
          ->with([
            'post' => $post,
            'search' => $search,
          ]);
          
    }


        //詳細画面
        public function show($id){
            $post = Post::find($id);

            return view('post.show',['post' => $post]);
        }

        // 削除
        public function destroy($id){
            $post=Post::find($id);
            $post->delete();

            return redirect('post/index');
        }
    
}
