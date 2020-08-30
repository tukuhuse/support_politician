@extends('layouts.app')

@section('title','検索結果')

@section('content')
    <h3 class="page-title">検索結果</h3>
    @foreach ($result["speechRecord"] as $comment)
        {{ Form::open(['method'=>'get','url'=>'parliament/show/' . $comment["issueID"] . '/' . $comment["speechID"]]) }}
            {{ csrf_field() }}
            <div class="card">
                <div class="card-header d-flex">
                    <h4 class="p-2 bd-highlight">{{ $comment["speakerGroup"] }}</h4>
                    <h4 class="p-2 bd-highlight">{{ $comment["speaker"] }}</h4>
                </div>
                <div class="card-body">
                    <div class="card-title">{{ $comment["nameOfMeeting"] }}</div>
                    <div class="card-content">{{ $comment["speech"] }}</div>
                </div>
                <div class="card-footer d-flex">
                    <div class="p-2 bd-highlight">{{ $comment["date"] }}</div>
                    <div class="p-2 bd-highlight">
                        {{ Form::submit('討論詳細', ['class' => 'btn btn-outline-danger'] ) }}
                    </div>
                </div>
            </div>
        {{ Form::close() }}
    @endforeach
@endsection