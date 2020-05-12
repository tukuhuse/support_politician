@extends('layouts.app')

@section('title','検索結果')

@section('content')
    @foreach ($result["speechRecord"] as $comment)
        {{ Form::open(['method'=>'get','action'=>'kokkaiapi@detail_topic']) }}
            {{ csrf_field() }}
            {{ Form::hidden('issueID',$comment["issueID"]) }}
            <button type="submit">
                <div id="date">{{ $comment["date"] }}</div>
                <div id="meeting">{{ $comment["nameOfMeeting"] }}</div>
                <div id="speakerGroup">{{ $comment["speakerGroup"] }}</div>
                <div id="speaker">{{ $comment["speaker"] }}</div>
                <div id="speech">{{ $comment["speech"] }}</div>
            </button>
        {{ Form::close() }}
    @endforeach
@endsection