@extends('layouts.app')

@section('title','検索結果')

@section('content')
    @foreach ($result["speechRecord"] as $comment)
        {{ Form::open(['method'=>'get','url'=>'outcome/detail/' . $comment["issueID"]]) }}
            {{ csrf_field() }}
            <a href="javascript:void(0)" onclick="this.parentNode.submit()" style="color:inherit;text-decoration:none;">
                <div class="card">
                    <div class="card-header d-flex">
                        <h4 id="speakerGroup" class="p-2 bd-highlight">{{ $comment["speakerGroup"] }}</h4>
                        <h4 id="speaker" class="p-2 bd-highlight">{{ $comment["speaker"] }}</h4>
                    </div>
                    <div class="card-body">
                        <div id="meeting" class="card-title">{{ $comment["nameOfMeeting"] }}</div>
                        <div id="speech" class="card-content">{{ $comment["speech"] }}</div>
                    </div>
                    <div id="date" class="card-footer">{{ $comment["date"] }}</div>
                </div>
            </a>
        {{ Form::close() }}
    @endforeach
@endsection