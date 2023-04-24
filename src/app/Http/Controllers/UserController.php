<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
        //ユーザーページ
        public function show($id){
            $user = User::find($id);
            $posts = $user->posts;
            return view('user.show',['user' => $user, 'posts' => $posts]);
        }

        // 更新
        public function update(UpdateUserRequest $request, $id){

            $user=User::find($id);
            $posts = $user->posts;
              
              $user->name=$request->input('name');
              $user->email=$request->input('email');

              $user->save();
              
            //更新後投稿一覧へ遷移
            return view('user.show',['user' => $user, 'posts' => $posts]);

        }

        // 更新画面へ
        public function edit($id){
            $user = User::find($id);
            $posts= Post::All();
            //   投稿者以外が編集ページに飛べないようにする
              if(Auth::id() != $user->id){
                return view('post.index',['post' => $posts]);
              }

            return view('user.edit', ['user' => $user]);
        }
}
