<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    // 一覧画面
    public function index(){
        $post = DB::table('users')
        ->join('posts','users.id','=','posts.user_id')
        ->select('posts.title','posts.image','posts.description','posts.user_id','posts.id','users.name')
        ->get();

        return view('post.index',['post' => $post]);
    }

    // 新規投稿画面
    public function create(){
        return view('post.create');
    }

    // 新規投稿
    public function store(StorePostRequest $request){
        $post = new Post();
        $posts = Post::all();

        if ($file = $request->image) {
            $fileName = time() . $file->getClientOriginalName();
            $target_path = public_path('uploads/');
            $file->move($target_path, $fileName);
        }else {
            $fileName = null;
        }

            $post->title = $request->input('title');
            $post->image = $fileName;
            $post->description = $request->input('description');
            $post->user_id = Auth::id();

            $post->save();

            //   更新後投稿一覧へ遷移
            return redirect('post/index');
            
        }

        public function show($id){
            $post = Post::find($id);

            return view('post.show',['post' => $post]);
        }

        // 更新
        public function update(UpdatePostRequest $request, $id){

            $post=Post::find($id);
            $posts = Post::all();

              if ($file = $request->image) {
                $fileName = time() . $file->getClientOriginalName();
                $target_path = public_path('uploads/');
                $file->move($target_path, $fileName);
              } else {
                $fileName = null;
              }

              $post->title=$request->input('title');
              $post->image=$fileName;
              $post->description=$request->input('description');

              $post->save();
              
            //   更新後投稿一覧へ遷移
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
