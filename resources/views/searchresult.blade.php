@extends('layouts.app')

@section('title','検索結果')

@section('content')
    @foreach ($result["speechRecord"] as $comment)
        <form method="post" action="{{ url('outcome/detail') }}">
            {{ csrf_field() }}
            {{ Form::hidden('issueID',$comment["issueID"]) }}
            <button type="submit">
                <div id="date">{{ $comment["date"] }}</div>
                <div id="meeting">{{ $comment["nameOfMeeting"] }}</div>
                <div id="speakerGroup">{{ $comment["speakerGroup"] }}</div>
                <div id="speaker">{{ $comment["speaker"] }}</div>
                <div id="speech">{{ $comment["speech"] }}</div>
            </button>
        </form>
    @endforeach
@endsection