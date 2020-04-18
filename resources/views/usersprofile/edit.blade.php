{{-- layoutsフォルダのapp.blade.phpを継承 --}}
@extends('layouts.app')

{{-- @yield('title')にテンプレート毎の値を代入 --}}
@section('title','編集')

{{-- app.blade.phpの@yield('content')に以下のレイアウトを代入 --}}
@section('content')
    <form action="/users/{{$user->id}}" method="post">
        {{ csrf_field() }}
        <div>
            <label for="name">ユーザー名</label>
            <input type="text" name="name" value="{{$user->name}}">
        </div>
        <div>
            <label for="constituency_id">選挙区</label>
            <input type="text" name="constituency" value="{{$user->constituency_id}}">
        </div>
        <div>
            <label for="legislator_id">応援している国会議員</label>
            <input type="text" name="legislator" value="">
        </div>
        <div>
            <label for="speaker_group_id">応援している政党</label>
            <input type="text" name="speaker_group" value="">
        </div>
    </form>
@endsection