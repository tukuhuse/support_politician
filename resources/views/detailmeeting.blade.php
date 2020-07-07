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
        {{ Form::open(['url'=>'comments','method'=>'post','class'=>'card']) }}
            {{ csrf_field() }}
            <div class="card-body" name="comment">
                {{ Form::Label('comment','コメント投稿',['class'=>'card-title']) }}
                <br>
                {{ Form::textarea('create_comment') }}
                {{ Form::hidden('issueID', $issueID) }}
                <br>
            </div>
            <input type="button" id="commentadd" value="投稿" onclick="javascript:commentadd">
        {{ Form::close() }}
    @endauth
    @foreach ($comments as $comment)
        <div id="othercomment" class="card">
            <div id="writer" class="card-header">{{ $comment->user_name->name }}</div>
            <div id="comment" class="card-text">{{ $comment["comment"] }}</div>
            <div id="time" class="card-footer">{{ $comment["updated_at"] }}</div>
            @if ($comment["user_id"] == Auth::id())
                {{ Form::open(['url' => 'comments/' . $comment["id"]]) }}
                    {{ csrf_field() }}
                    {{ Form::hidden('commentid', $comment["id"]) }}
                    <input type="button" class="commentdelete" value="削除" onclick="javascript:commentdelete">
                {{ Form::close() }}
            @endif
        </div>
    @endforeach
@endsection