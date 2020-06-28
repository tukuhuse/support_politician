@extends('layouts.app')

@section('title','会議詳細')

@section('content')
    @foreach ($result as $proposal)
        <div id="proposal">
            <div id="card" class="card">
                <div id="card_header" class="card-header">
                    <h4 id="speaker_group">{{ $proposal["speakerGroup"] }}</h4>
                    <h4 id="speaker">{{ $proposal["speaker"] }}</h4>
                </div>
                <div id="card_content" class="card-body" speechID="{{ $proposal['speechID'] }}">
                    <p id="speech" class="card-text">{{ $proposal["speech"] }}</p>
                    {{ Form::open(['method' => 'POST','action' => 'goodController@goodstatechange']) }}
                        {{ csrf_field() }}
                        {{ Form::hidden('issueID',$issueID) }}
                        {{ Form::hidden('speechID',$proposal["speechID"]) }}
                        {{ Form::hidden('speaker',$proposal["speaker"]) }}
                        {{ Form::hidden('speech',mb_substr($proposal["speech"],0,140)) }}
                        @for ($status=1;$status<=2;$status++)
                            <div onclick="javascript:goodbutton" class="btn-status-change" name="{{ $status }}">
                                {{ Form::hidden('status',$status) }}
                                @if ($status == 1)
                                    @if (isset($good[$proposal["speechID"]]) and $good[$proposal["speechID"]] == 1 )
                                        <i class="far fa-thumbs-up fa-2x fa-fw active"></i>
                                    @else
                                        <i class="far fa-thumbs-up fa-2x fa-fw"></i>
                                    @endif
                                @else
                                    @if (isset($good[$proposal["speechID"]]) and $good[$proposal["speechID"]] == 2)
                                        <i class="far fa-thumbs-down fa-2x fa-fw active"></i>
                                    @else
                                        <i class="far fa-thumbs-down fa-2x fa-fw"></i>
                                    @endif
                                @endif
                            </div>
                        @endfor
                    {{ Form::close() }}
                </div>
            </div>
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