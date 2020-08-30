{{-- layoutsフォルダのapp.blade.phpを継承 --}}
@extends('layouts.app')

{{-- @yield('title')にテンプレート毎の値を代入 --}}
@section('title', 'ユーザー登録情報')

@section('javascript')
    <script src="{{ asset('js/comment.js') }}" defer></script>
@endsection

{{-- app.blade.phpの@yield('content')に以下のレイアウトを代入 --}}
@section('content')
    <center>
        <h3>ユーザー情報</h3>
        <ul class="list-group list-group-flush">
            @if($user->id == Auth::id())
                <li class="list-gruop-item d-flex justify-content-between align-items-center">
                    <a class="btn btn-outline-danger" href="/users" role="button">一覧に戻る</a>
                    <a class="btn btn-outline-primary" href="/users/{{$user->id}}/edit" role="button">編集する</a>
                </li>
            @else
                <li class="list-gruop-item d-flex justify-content-start align-items-center">
                    <a class="btn btn-outline-danger" href="/users" role="button">一覧に戻る</a>
                </li>
            @endif
            <li class="list-group-item d-flex justify-content-between align-items-center">
                ユーザー名：
                <span>{{ $user->name }}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                選挙区：
                @if(empty($user->constituency_id))
                    <span>選択なし</span>
                @else
                    <span>{{ $user->constituency_name->name }}</span>
                @endif
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                応援している政党：
                @if(empty($speaker_group->user_id))
                    <span>選択なし</span>
                @else
                    <span>{{ $speaker_group->speaker_name->name }}</span>
                @endif
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                応援している議員：
                @if(empty($legislator->user_id))
                    <span>選択なし</span>
                @else
                    <span>{{ $legislator->legislator_name->name }}</span>
                @endif
            </li>
        </ul>
    </center>
    <div id="user_good">
        @if(count($goods)!=0)
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
                                <a href="{{ url('parliament/show/'.$issueID . '/' . $good->speechID) }}" class="btn btn-outline-success">討論詳細</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
        @if(count($bads)!=0)
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
                                <a href="{{ url('parliament/show/'.$issueID . '/' . $bad->speechID) }}" class="btn btn-outline-danger">討論詳細</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
    @if(count($comments)!=0)
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
    @endif
@endsection