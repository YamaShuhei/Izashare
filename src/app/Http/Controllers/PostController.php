<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;

class PostController extends Controller
{
    public function index(){
        
        $post = Post::all();
        return view('post.index',['post' => $post]);
    }

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
            return view('post.index',['post' => $posts]);
            
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
            return view('post.index',['post' => $posts]);

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
