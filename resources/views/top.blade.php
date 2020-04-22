{{-- layoutsフォルダのapp.blade.phpを継承 --}}
@extends('layouts.app')

{{-- @yield('title')にテンプレート毎の値を代入 --}}
@section('title', 'トップページ')

{{-- app.blade.phpの@yield('content')に以下のレイアウトを代入 --}}
@section('content')
    <div id="menu_list">
        <a href="#">議題検索ページ</a>
        <a href="#">議員検索ページ</a>
        @guest
            <a href="{{ route('register') }}">新規登録</a>
            <a href="{{ route('login') }}">ログイン</a>
        @endguest
    </div>
@endsection
