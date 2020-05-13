{{-- layoutsフォルダのapp.blade.phpを継承 --}}
@extends('layouts.app')

{{-- @yield('title')にテンプレート毎の値を代入 --}}
@section('title', 'ユーザー登録情報')

{{-- app.blade.phpの@yield('content')に以下のレイアウトを代入 --}}
@section('content')
    <div id="user_profile_detail">
        <div id="user_profile_subject">ユーザー名</div>
        <div id="user_profile_content">{{ $user->name }}</div>
    </div>
    <div id="user_profile_detail">
        <div id="user_profile_subject">選挙区</div>
        @if(empty($user->constituency_id))
        @else
            <div id="user_profile_content">{{ $user->constituency_name->name }}</div>
        @endif
    </div>
    <div id="user_profile_detail">
        <div id="user_profile_subject">支援している政党</div>
        @if(empty($speaker_group->user_id))
        @else
            <div id="user_profile_content">{{ $speaker_group->speaker_name->name }}</div>
        @endif
    </div>
    <div id="user_profile_detail">
        <div id="user_profile_subject">支援している国会議員</div>
        @if(empty($legislator->user_id))
        @else
            <div id="user_profile_content">{{ $legislator->legislator_name->name }}</div>
        @endif
    </div>
    <a href="/users/{{$user->id}}/edit">編集する</a>
    @foreach($comments as $comment)
        <div id="comment_id">{{ $comment->id }}</div>
        <div id="issueID">{{ $comment->issueID }}</div>
        <a href="{{ action('kokkaiapi@detail_topic',$comment->issueID) }}">討論詳細</a>
        <div id="update_time">{{ $comment->update_time }}</div>
        <div id="comment">{{ $comment->comment }}</div>
        {{ Form::open(['url' => 'comments/' . $comment->id]) }}
            {{ csrf_field() }}
            @method('DELETE')
            {{ Form::submit('削除') }}
        {{ Form::close() }}
    @endforeach
    <a href="/users">一覧に戻る</a>
@endsection