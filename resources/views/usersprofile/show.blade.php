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
    <div id="user_good">
        <center><h3 id="user_good_title" class="user title">goodした発言一覧</h3></center>
        @foreach($goods as $good)
            <div class="accordion">
                <div class="card">
                    <div class="card-header" id="{{ 'good' . $loop->iteration }}">
                        <h4 class="mb-0">
                            {{ Form::button($good->legislator_name, ['class'=>'btn btn-link btn-block text-left','data-target'=>'#goodspeech'.$loop->iteration,'data-toggle'=>'collapse','aria-expanded'=>'false','aria-controls'=>'goodspeech'.$loop->iteration]) }}
                        </h4>
                    </div>
                    <div id="{{ 'goodspeech' . $loop->iteration }}" class="collapse" aria-labelledby="{{ 'good' . $loop->iteration }}" data-parent="#user_good_title">
                        <div class="card-body">
                            {{ $good->speech }}
                        </div>
                        <div class="card-footer">
                            <?php $issueID = explode('_',$good->speechID)[0]; ?>
                            <a href="{{ url('parliament/show/'.$issueID) }}">討論詳細</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <center><h3 id="user_bad_title" class="user title">badした発言一覧</h3></center>
        @foreach($bads as $bad)
            <div class="accordion">
                <div class="card">
                    <div class="card-header" id="{{ 'bad' . $loop->iteration }}">
                        <h4 class="mb-0">
                            {{ Form::button($bad->legislator_name, ['class'=>'btn btn-link btn-block text-left','data-target'=>'#badspeech'.$loop->iteration,'data-toggle'=>'collapse','aria-expanded'=>'false','aria-controls'=>'badspeech'.$loop->iteration]) }}
                        </h4>
                    </div>
                    <div id="{{ 'badspeech' . $loop->iteration }}" class="collapse" aria-labelledby="{{ 'bad' . $loop->iteration }}" data-parent="#user_bad_title">
                        <div class="card-body">
                            {{ $bad->speech }}
                        </div>
                        <div class="card-footer">
                            <?php $issueID = explode('_',$bad->speechID)[0]; ?>
                            <a href="{{ url('parliament/show/'.$issueID) }}">討論詳細</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
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
                </div>
            </div>
            <!--
                <div id="comment">{{ $comment->comment }}</div>
                @if ($user->id == Auth::id())
                    {{ Form::open(['url' => 'comments/' . $comment->id]) }}
                        {{ csrf_field() }}
                        {{ Form::hidden('commentid', $comment["id"]) }}
                        <input type="button" class="commentdelete" value="削除" onclick="javascript:commentdelete">
                    {{ Form::close() }}
                @endif
            -->
        @endforeach
    </div>
    <a href="/users/{{$user->id}}/edit">編集する</a>
    <a href="/users">一覧に戻る</a>
@endsection