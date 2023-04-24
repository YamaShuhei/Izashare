<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    // 一覧画面
    public function index(Request $request){
        $post = Post::paginate(10);

        $search = $request->input('search');
        $query = Post::query();

        //検索機能
        if($search) {
          $spaceConversion = mb_convert_kana($search ,'s', 'utf-8');
          $wordArraySearched = preg_split('/[\s,]+/', $spaceConversion, -1, PREG_SPLIT_NO_EMPTY);

          // 投稿タイトルからあいまい検索
          foreach($wordArraySearched as $value) {
            $query->where('title', 'like', '%'.$value.'%');
          }

          // 10件ごとのページネーション
          $post = $query->paginate(10);
        }

        // post.indexを開く
        return view('post.index')
          ->with([
            'post' => $post,
            'search' => $search,
          ]);
          
    }

    // 新規投稿画面
    public function create(){
        return view('post.create');
    }

    // 新規投稿
    public function store(StorePostRequest $request){
        $post = new Post();
        $posts = Post::all();

        // AmazonS3へ画像保存
        if ($request->hasFile('image')) {
          $path = $request->file('image')->store('images', 's3');
          $post->image = Storage::disk('s3')->url($path);
      } else {
          $post->image = null;
      }
            
            $post->title = $request->input('title');
            $post->description = $request->input('description');
            $post->user_id = Auth::id();
            $post->save();

            //   投稿後詳細画面へ遷移
            return view('post.show',['post' => $post]);
            
        }

        // 詳細画面
        public function show($id){
            $post = Post::find($id);

            return view('post.show',['post' => $post]);
        }

        // 更新
        public function update(UpdatePostRequest $request, $id){

            $post=Post::find($id);
            $posts = Post::all();

            // AmazonS3の画像を更新
            if ($request->hasFile('image')) {
              $path = $request->file('image')->store('images', 's3');
              $post->image = Storage::disk('s3')->url($path);
          } else {
              $post->image = null;
          }
              
              $post->title=$request->input('title');
              $post->description=$request->input('description');
              $post->save();
              
            //更新後投稿一覧へ遷移
            return redirect('post/index');

        }

        // 更新画面へ
        public function edit($id){
            $post = Post::find($id);
            $posts = Post::all();
            //   投稿者以外が編集ページに飛べないようにする
              if(Auth::id() != $post->user_id){
                return view('post.index',['post' => $posts]);
              }

            return view('post.edit', ['post' => $post]);
        }

        // 削除
        public function destroy($id){
            $post=Post::find($id);
            $post->delete();

            return redirect('post/index');
        }

}
