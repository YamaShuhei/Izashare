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

class UserController extends Controller
{
        //ユーザーページ
        public function show($id){
            $user = User::find($id);
            return view('user.show',['user' => $user]);
        }

        // 更新
        public function update(UpdatePostRequest $request, $id){

            $post=Post::find($id);
            $posts = Post::all();

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
