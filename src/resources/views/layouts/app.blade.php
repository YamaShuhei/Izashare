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
                <a href="{{route('post.index')}}">
                <img class="h-logo" src="{{asset('images/logo.png')}}">
                </a>
                <button class="navbar-toggler bg-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    {{-- <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul> --}}
                    <div class="sel sel--black-panther">
                        <select name="select-profession" id="select-profession">
                          <option value="" disabled>Profession</option>
                          <option value="hacker">Hacker</option>
                          <option value="gamer">Gamer</option>
                          <option value="developer">Developer</option>
                          <option value="programmer">Programmer</option>
                          <option value="designer">Designer</option>
                        </select>
                      </div>

                    <!-- ナビバー右部 -->
                    <ul class="navbar-nav ms-auto">
                        <!-- メニューバー -->
                        @if(!Auth::check() && (!isset($authgroup) || !Auth::guard($authgroup)->check()))
                            @if (Route::has('login'))
                              {{-- 管理者用ログインリンク --}}
                              @isset($authgroup)
                               <a class="nav-link text-white text-end c-txt line" href="{{ url("login/$authgroup") }}">{{ __('管理者ログイン') }}</a>
                              @else
                                <li class="nav-item">
                                    <a class="p-0 nav-link text-white text-end mx-2 c-txt line" href="{{ route('login') }}">{{ __('ログイン') }}</a>
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
                                      <a class="p-0 nav-link text-white text-end mx-2 c-txt line" href="{{ route('register') }}">{{ __('新規登録') }}</a>
                                  </li>
                              @endif
                            @endisset
                            @endif
                        @else
                            <li class="nav-item">

                                <div class="">
                                        @isset($authgroup)
                                        <a class="c-txt line text-white" href="/">
                                          {{ Auth::guard($authgroup)->user()->name }}
                                        </a>
                                        @else
                                        <a class="c-txt line text-white" href="/">
                                          {{ Auth::user()->name }}
                                        </a>
                                        @endisset
                                    </a>
                                    <a class="c-txt line text-white" href="{{route('post.index')}}">投稿一覧</a>
                                    <a class="c-txt line text-white" href="{{route('post.create')}}">新規投稿</a>
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
                                    <a class="c-txt line text-white" href="{{ route('logout') }}"
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

        <main>
            @yield('content')
        </main>
    </div>

<script>
    // ヘッダーメニュー用
    $('.sel').each(function() {
  $(this).children('select').css('display', 'none');
  
  var $current = $(this);
  
  $(this).find('option').each(function(i) {
    if (i == 0) {
      $current.prepend($('<div>', {
        class: $current.attr('class').replace(/sel/g, 'sel__box')
      }));
      
      var placeholder = $(this).text();
      $current.prepend($('<span>', {
        class: $current.attr('class').replace(/sel/g, 'sel__placeholder'),
        text: placeholder,
        'data-placeholder': placeholder
      }));
      
      return;
    }
    
    $current.children('div').append($('<span>', {
      class: $current.attr('class').replace(/sel/g, 'sel__box__options'),
      text: $(this).text()
    }));
   });
  });

// Toggling the `.active` state on the `.sel`.
$('.sel').click(function() {
  $(this).toggleClass('active');
});
</script>

</body>


    

</html>
