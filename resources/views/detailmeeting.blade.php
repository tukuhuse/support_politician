@extends('layouts.app')

@section('title','会議詳細')

@section('content')
    @foreach ($result as $proposal)
        <div id="proposal">
            <div id="card" style="with: 30rem;">
                <div id="card_content" class="card_body">
                    <h4 id="speaker" class="card-title">{{ $proposal["speaker"] }}</h4>
                    <h5 id="speaker_group" class="card-subtitle">{{ $proposal["speakerGroup"] }}</h5>
                    <p id="speech" class="card-text">{{ $proposal["speech"] }}</p>
                    <div style="display:inline-flex">
                        {{ Form::open(['method' => 'POST','action' => 'goodController@goodstatechange']) }}
                            {{ csrf_field() }}
                            {{ Form::hidden('issueID',$issueID) }}
                            {{ Form::hidden('speechID',$proposal["speechID"]) }}
                            {{ Form::hidden('speaker',$proposal["speaker"]) }}
                            {{ Form::hidden('speech',str_split($proposal["speech"],280)[0]) }}
                            {{ Form::hidden('state','1') }}
                            <a href="javascript:void(0)" onclick="this.parentNode.submit()">
                                @if (isset($good[$proposal["speechID"]]) and $good[$proposal["speechID"]] == 1 )
                                    <i class="far fa-thumbs-up fa-3x fa-fw good active"></i>
                                @else
                                    <i class="far fa-thumbs-up fa-3x fa-fw"></i>
                                @endif
                            </a>
                        {{ Form::close() }}
                        {{ Form::open(['method' => 'POST','action' => 'goodController@goodstatechange']) }}
                            {{ csrf_field() }}
                            {{ Form::hidden('issueID',$issueID) }}
                            {{ Form::hidden('speechID',$proposal["speechID"]) }}
                            {{ Form::hidden('speaker',$proposal["speaker"]) }}
                            {{ Form::hidden('speech',str_split($proposal["speech"],280)[0]) }}
                            {{ Form::hidden('state','2') }}
                            <a href="javascript:void(0)" onclick="this.parentNode.submit()">
                                @if (isset($good[$proposal["speechID"]]) and $good[$proposal["speechID"]] == 2)
                                    <i class="far fa-thumbs-down fa-3x fa-fw bad active"></i>
                                @else
                                    <i class="far fa-thumbs-down fa-3x fa-fw"></i>
                                @endif
                            </a>
                        {{ Form::close() }}
                    </div>
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