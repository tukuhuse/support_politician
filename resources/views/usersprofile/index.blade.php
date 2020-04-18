{{-- layoutsフォルダのapplication.blade.phpを継承 --}}
@extends('layouts.app')

{{-- @yield('title')にテンプレート毎の値を代入 --}}
@section('title', 'ユーザー一覧')

{{-- application.blade.phpの@yield('content')に以下のレイアウトを代入 --}}
@section('content')
    @foreach ($users as $user)
        <h4>{{$user->name}}</h4>
        <a href="/users/{{$user->id}}">詳細を表示</a>
        <p>{{$user->constituency_id}}</p>
    @endforeach
@endsection