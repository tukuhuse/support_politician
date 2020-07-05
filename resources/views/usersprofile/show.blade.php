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
    <div id="user_good">
        <div id="user_good_title">goodした発言一覧</div>
        @foreach($goods as $good)
            <div id="user_good_content">
                <div id="legislator_name">{{ $good->legislator_name }}</div>
                <div id="speech">{{ $good->speech }}</div>
            </div>
        @endforeach
        <div id="user_bad_title">badした発言一覧</div>
        @foreach($bads as $bad)
            <div id="user_bad_content">
                <div id="legislator_name">{{ $bad->legislator_name }}</div>
                <div id="speech">{{ $bad->speech }}</div>
            </div>
        @endforeach
    </div>
    <div id="user_comment">
        @foreach($comments as $comment)
            <div id="user_comment_content">
                <div id="comment_id">{{ $comment->id }}</div>
                <div id="issueID">{{ $comment->issueID }}</div>
                <a href="{{ action('kokkaiapi@detail_topic',$comment->issueID) }}">討論詳細</a>
                <div id="update_time">{{ $comment->updated_at }}</div>
                <div id="comment">{{ $comment->comment }}</div>
                @if ($user->id == Auth::id())
                    {{ Form::open(['url' => 'comments/' . $comment->id]) }}
                        {{ csrf_field() }}
                        {{ Form::hidden('commentid', $comment["id"]) }}
                        <input type="button" class="commentdelete" value="削除" onclick="javascript:commentdelete">
                    {{ Form::close() }}
                @endif
            </div>
        @endforeach
    </div>
    <a href="/users">一覧に戻る</a>
@endsection