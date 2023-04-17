<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Izashare') }}</title>

    <!--フォント -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- スクリプト -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</head>
<body>
  <header>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-primary shadow-sm">
            <div class="container">
                <a class="navbar-brand text-white fs-1 fw-bolder" href="{{route('post.index')}}">
                    {{('Izashare') }}
                </a>
                <button class="navbar-toggler bg-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    {{-- <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul> --}}

                    <!-- ナビバー右部 -->
                    <ul class="navbar-nav ms-auto">
                        <!-- メニューバー -->
                        @if(!Auth::check() && (!isset($authgroup) || !Auth::guard($authgroup)->check()))
                            @if (Route::has('login'))
                              {{-- 管理者用ログインリンク --}}
                              @isset($authgroup)
                               <a class="nav-link text-white text-end" href="{{ url("login/$authgroup") }}">{{ __('管理者ログイン') }}</a>
                              @else
                                <li class="nav-item">
                                    <a class="nav-link text-white text-end" href="{{ route('login') }}">{{ __('ログイン') }}</a>
                                </li>
                              @endisset
                            @endif
                            
                            @if (Route::has('register'))
                            @isset($authgroup)
                              @if (Route::has("$authgroup-register"))
                                  <li class="nav-item">
                                      <a class="nav-link text-white text-end" href="{{ route("$authgroup-register") }}">{{ __('管理者新規登録') }}</a>
                                  </li>
                              @endif
                            @else
                              @if (Route::has('register'))
                                  <li class="nav-item">
                                      <a class="nav-link text-white text-end" href="{{ route('register') }}">{{ __('新規登録') }}</a>
                                  </li>
                              @endif
                            @endisset
                            @endif
                        @else
                            <li class="nav-item dropdown border  border-2 rounded">
                                <p class="bg-secondary text-white fw-bold text-center m-0">
                                  @isset($authgroup)
                                  {{ Auth::guard($authgroup)->user()->name }}
                                  @else
                                  {{ Auth::user()->name }}
                                  @endisset
                                </p>

                                <div class="btn-group">
                                    <a class="btn btn-secondary" href="{{route('post.index')}}">投稿一覧</a>
                                    <a class="btn btn-secondary" href="{{route('post.create')}}">新規投稿</a>
                                    @isset($authgroup)
                                      <a class="btn btn-secondary" href="{{ route('logout') }}"   
                                          onclick="event.preventDefault();
                                                          document.getElementById('logout-form').submit();">
                                          {{ __('管理者ログアウト') }}
                                      </a>
                                      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none"> 
                                          @csrf
                                      </form>
                                    @else
                                    <a class="btn btn-secondary" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('ログアウト') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                    @endisset
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
    </header>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
