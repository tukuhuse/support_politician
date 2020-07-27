{{-- layoutsフォルダのapp.blade.phpを継承 --}}
@extends('layouts.app')

{{-- @yield('title')にテンプレート毎の値を代入 --}}
@section('title','編集')

{{-- app.blade.phpの@yield('content')に以下のレイアウトを代入 --}}
@section('content')
    {{ Form::open(['method'=>'POST', 'url'=>'/users/'.$user->id]) }}
        {{ csrf_field() }}
        <div class="form-group row">
            {{ Form::Label('username', 'ユーザー名', ['class'=>'col-sm-2 col-form-label']) }}
            <div class="col-sm-5">
                {{ Form::text('username', $user->name,['class'=>'form-control']) }}
            </div>
        </div>
        <div class="form-group row">
            {{ Form::Label('constituency','選挙区',['class'=>'col-sm-2 col-form-label']) }}
            <div class="col-sm-5">
                {{ Form::select('constituency_id', $constituencies, $user->constituency_id, ['class' => 'form-control', 'placeholder' => '選択してください']) }}
            </div>
        </div>
        <div class="form-group row">
            {{ Form::Label('speaker_group', '応援している政党', ['class' => 'col-sm-2 col-form-label']) }}
            <div class="col-sm-5">
                {{ Form::select('speaker_group_id', $speaker_group, $userspeakergroup, ['class' => 'form-control', 'placeholder' => '選択してください']) }}
            </div>
        </div>
        <div class="form-group row">
            {{ Form::Label('legislator', '応援している議員', ['class' => 'col-sm-2 col-form-label']) }}
            <div class="col-sm-5">
                {{ Form::select('legislator_id', $legislators, $userlegislator,['class'=>'form-control', 'placeholder' => '選択してください']) }}
            </div>
        </div>
        @method('PUT')
        <div class="col-sm-7">
            <div class="form-group row justify-content-between">
                <a href="/users/{{$user->id}}" class="btn btn-outline-danger" role="button">戻る</a>
                {{ Form::submit('ユーザー情報を更新', ['class' => 'btn btn-outline-success']) }}
            </div>
        </div>
    {{ Form::close() }}
    @if (count($comments)!=0)
        <div id="user_comment">
            <center><h3 class="comment">コメント一覧</h3></center>
            @foreach($comments as $comment)
                <div class="card">
                    <div class="card-header">
                        コメント投稿日:{{ $comment->created_at }}
                    </div>
                    <div class="card-body">
                        {{ $comment->comment }}
                    </div>
                    <div class="card-footer">
                        <a href="{{ url('parliament/show/'.$comment->issueID) }}">討論詳細</a>
                        {{ Form::open(['url' => 'comments/' . $comment->id]) }}
                            {{ csrf_field() }}
                            {{ Form::hidden('commentid', $comment["id"]) }}
                            <input type="button" class="commentdelete" value="削除" onclick="javascript:commentdelete">
                        {{ Form::close() }}
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection