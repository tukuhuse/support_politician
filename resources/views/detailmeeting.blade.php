@extends('layouts.app')

@section('title','会議詳細')

@section('content')
    @foreach ($result as $proposal)
        <div id="proposal">
            <div id="speaker">{{ $proposal["speaker"] }}</div>
            <div id="speaker_group">{{ $proposal["speakerGroup"] }}</div>
            <div id="speech">{{ $proposal["speech"] }}</div>
            <i class="fas fa-thumbs-up fa-3x active"></i>
            <i class="far fa-thumbs-up fa-3x"></i>
            <i class="fas fa-thumbs-down fa-3x"></i>
            <i class="far fa-thumbs-down fa-3x active"></i>
        </div>
    @endforeach
    @auth
        {{ Form::open(['url'=>'comments','method'=>'get']) }}
            {{ csrf_field() }}
            {{ Form::Label('comment','コメント投稿') }}
            <br>
            {{ Form::textarea('create_comment') }}
            {{ Form::hidden('issueID', $issueID) }}
            <br>
            {{ Form::submit() }}
        {{ Form::close() }}
    @endauth
    @foreach ($comments as $comment)
        <div id="othercomment">
            <div id="writer">{{ $comment->user_name->name }}</div>
            <div id="time">{{ $comment["updated_at"] }}</div>
            <div id="comment">{{ $comment["comment"] }}</div>
            @if ($comment["user_id"] == Auth::id())
                {{ Form::open(['url' => 'comments/' . $comment->id]) }}
                    {{ csrf_field() }}
                    @method('DELETE')
                    {{ Form::submit('削除') }}
                {{ Form::close() }}
            @endif
        </div>
    @endforeach
@endsection