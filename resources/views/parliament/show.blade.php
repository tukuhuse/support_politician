@extends('layouts.app')

@section('title','会議詳細')

@section('javascript')
    <script src="{{ asset('js/comment.js') }}" defer></script>
    <script src="{{ asset('js/good.js') }}" defer></script>
@endsection

@section('content')
    <h3 class="page-title">討論詳細</h3>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="discussion-tab" href="#discussion" data-toggle="tab" role="tab" aria-controls="discussion" aria-selected="true">討論</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="comment-content" href="#comment" data-toggle="tab" role="tab" aria-controls="comment" aria-selected="false">コメント</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div id="discussion" class="tab-pane fade show active" role="tabpanel" aria-labelledby="discussion-tab">
            @foreach ($result as $proposal)
                <div>
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ $proposal["speakerGroup"] }}</h4>
                            <h4>{{ $proposal["speaker"] }}</h4>
                        </div>
                        <div class="card-body" speechID="{{ $proposal['speechID'] }}">
                            <p class="card-text">{{ $proposal["speech"] }}</p>
                            @if (Auth::check())
                                {{ Form::open(['method' => 'POST','action' => 'goodController@ajaxupdate']) }}
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
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div id="comment" class="tab-pane fade" role="tabpanel" aria-labelledby="comment">
            @auth
                {{ Form::open(['url'=>'comments','method'=>'post','class'=>'card']) }}
                    {{ csrf_field() }}
                    <div class="card-header">
                        {{ Form::Label('comment','コメント入力') }}
                    </div>
                    <div class="card-body" name="comment">
                        {{ Form::textarea('create_comment') }}
                        {{ Form::hidden('issueID', $issueID) }}
                    </div>
                    <div class="card-footer">
                        {{ Form::button('投稿',['id'=>'commentadd','class'=>'btn btn-outline-primary','onclick'=>'javascript:commentadd']) }}
                    </div>
                {{ Form::close() }}
            @endauth
            @foreach ($comments as $comment)
                <div class="card">
                    <div class="card-header">
                        <a href="{{ url('/users/' . $comment->user_id) }}">
                            {{ $comment->user_name->name }}
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="card-text">{{ $comment["comment"] }}</div>
                    </div>
                    <div class="card-footer">
                        <div>{{ $comment["updated_at"] }}</div>
                        @if ($comment["user_id"] == Auth::id())
                            {{ Form::open(['url' => 'comments/' . $comment["id"]]) }}
                                {{ csrf_field() }}
                                {{ Form::hidden('commentid', $comment["id"]) }}
                                {{ Form::button('削除', ['class' => 'commentdelete btn btn-outline-danger', 'onclick' => 'javascript:commentdelete']) }}
                            {{ Form::close() }}
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection