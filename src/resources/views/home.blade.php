@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('ホームメニュー') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('ようこそ！あなたの訪れた居酒屋を記録しまししょう！') }}
                    {{__('居酒屋の情報をシェアして美味しいお店を調べましょう')}}
                    {{__('管理者画面、集合地点検索機能を作成予定')}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
