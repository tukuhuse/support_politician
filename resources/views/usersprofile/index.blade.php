{{-- layoutsフォルダのapplication.blade.phpを継承 --}}
@extends('layouts.app')

{{-- @yield('title')にテンプレート毎の値を代入 --}}
@section('title', 'ユーザー一覧')

{{-- application.blade.phpの@yield('content')に以下のレイアウトを代入 --}}
@section('content')
    <div class="list-group">
        @foreach ($users as $user)
            <a href="/users/{{$user->id}}" class="list-group-item list-group-item-action">{{ $user->name }}</a>
        @endforeach
    </div>
@endsection