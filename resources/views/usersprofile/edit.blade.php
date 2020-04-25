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
            {{ Form::select('constituency_id', $constituencies, $user->constituency_id, ['class' => 'form', 'id' => 'constituency_id']) }}
        </div>
        <button id="legislatoradd">国会議員を追加</button>
        <div id="legislator">
            <label for="legislator_id">応援している国会議員</label>
            {{ Form::select('legislator_id', $legislators,
            $userlegislator, ['class' => 'form', 'id' => 'legislator_id']) }}
        </div>
        <div id="speaker_group">
            <label for="speaker_group_id">応援している政党</label>
            {{ Form::select('speaker_group_id', $speaker_group, $userspeakergroup, ['class' => 'form', 'id' => 'speaker_group_id']) }}
        </div>
        @method('PUT')
        <input type="submit" >
        <button href="/user/{{$user->id}}">戻る</button>
    </form>
@endsection