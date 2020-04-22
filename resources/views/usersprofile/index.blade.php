{{-- layoutsフォルダのapplication.blade.phpを継承 --}}
@extends('layouts.app')

{{-- @yield('title')にテンプレート毎の値を代入 --}}
@section('title', 'ユーザー一覧')

{{-- application.blade.phpの@yield('content')に以下のレイアウトを代入 --}}
@section('content')
    @foreach ($users as $user)
        <h4>{{$user->name}}</h4>
        <a href="/users/{{$user->id}}">詳細を表示</a>
        <form action="/users/{$user->id}" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="delete">
            <input type="submit" name="" value="退会する">
        </form>
        {{-- <a href="/users/{{$user->id}}">削除する</a> --}}
    @endforeach
@endsection