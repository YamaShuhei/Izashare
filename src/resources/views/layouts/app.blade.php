<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Izashare') }}</title>

    <!--フォント -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome-animation/0.2.1/font-awesome-animation.css" type="text/css" media="all" />
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Sawarabi+Gothic" rel="stylesheet">
    <script src="https://kit.fontawesome.com/90c1ff3ff9.js" crossorigin="anonymous"></script>

    <!-- スクリプト -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'public/css/app.css'])

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

</head>
<body>
  <header>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light hd-bg shadow-sm py-3">
            <div class="container">

                {{-- ロゴ表示部分 --}}
                <a href="{{route('post.index')}}">
                <img class="h-logo" src="{{asset('images/logo.png')}}">
                </a>

                {{-- 検索フォーム --}}
                <div>
                    <form class="input-group m-0" method="GET" action="{{ route('post.index') }}" style="height:45px;width:30vw;">
                      <input class="form-control" type="search" placeholder="投稿タイトルを検索" name="search" value="@if (isset($search)) {{ $search }} @endif">
                          <button class="btn bg-white" type="submit"><i class="fa-solid fa-magnifying-glass"></i> </button>

                     </form>
                  </div>

                <div>
                    <!-- ナビバー右部 -->
                    
                        <!-- メニューバー -->
                        @if(!Auth::check() && (!isset($authgroup) || !Auth::guard($authgroup)->check()))
                        <ul>
                            @if (Route::has('login'))
                              {{-- 管理者用ログインリンク --}}
                              @isset($authgroup)
                               <a class="nav-link text-white text-end c-txt line" href="{{ url("login/$authgroup") }}">{{ __('管理者ログイン') }}</a>
                              @else
                              {{-- ユーザー用ログインリンク --}}
                                <li class="nav-item">
                                    <a class="p-0 nav-link text-white text-end mx-2 c-txt line" href="{{ route('login') }}">{{ __('ログイン') }}</a>
                                </li>
                              @endisset
                            @endif
                            
                            {{-- 新規登録用リンク --}}
                            @if (Route::has('register'))
                            @isset($authgroup)
                            {{-- 管理者用 --}}
                              @if (Route::has("$authgroup-register"))
                                  <li class="nav-item">
                                      <a class="nav-link text-white text-end" href="{{ route("$authgroup-register") }}">{{ __('管理者新規登録') }}</a>
                                  </li>
                              @endif
                            @else
                            {{-- ユーザー用 --}}
                              @if (Route::has('register'))
                                  <li class="nav-item">
                                      <a class="p-0 nav-link text-white text-end mx-2 c-txt line" href="{{ route('register') }}">{{ __('新規登録') }}</a>
                                  </li>
                              @endif
                            @endisset
                            @endif
                        </ul>
                        @else
                
                    {{-- ログイン中ヘッダーメニュー --}}
                    <ul class="menu text-end">
                            <li class="menu__single">
                                        @isset($authgroup)
                                        {{-- 管理者名 --}}
                                        <a class="px-2 c-txt line init-bottom text-white" href="#">
                                          {{ Auth::guard($authgroup)->user()->name }}
                                        </a>
                                        @else
                                        {{-- ユーザー名 --}}
                                        <a class="px-3 border rounded border-success init-bottom text-white" href="#">
                                          {{ Auth::user()->name }}
                                        </a>
                                        @endisset
                                    
                                    <ul class="menu__second-level p-0">
                                    {{-- 管理者用 --}}
                                    @isset($authgroup)
                                    {{-- 投稿一覧 --}}
                                    <li><a class="c-txt line text-white" href="{{route('adminpost.index')}}">投稿一覧</a></li>
                                    {{-- 管理者ログアウト --}}
                                    <li>
                                        <a class="btn btn-secondary" href="{{ route('logout') }}"   
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                        {{ __('管理者ログアウト') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none"> 
                                        @csrf
                                    </form>
                                    </li>
                                    @else
                                    {{-- ユーザー用 --}}
                                    {{-- 投稿一覧 --}}
                                    <li><a class="c-txt line text-white text-center" href="{{route('post.index')}}"><i class="fa-solid fa-beer-mug-empty"></i> 投稿一覧</a></li>
                                    {{-- 新規投稿画面 --}}
                                    <li><a class="c-txt line text-white text-center" href="{{route('post.create')}}"><i class="fa-regular fa-square-plus"></i> 新規投稿</a></li>
                                    <li>
                                        <a class="c-txt line text-white text-center" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                      document.getElementById('logout-form').submit();">
                                         <i class="fa-solid fa-right-from-bracket"></i> {{ __('ログアウト') }}
                                     </a>
 
                                     <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                         @csrf
                                     </form>
                                    </li>
                                    @endisset
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
    </header>

        <main>
            @yield('content')
        </main>
    </div>

</body>


    

</html>
