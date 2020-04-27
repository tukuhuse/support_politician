@extends('layouts.app')

@section('title','検索結果')

@section('content')
    @foreach ($result["speechRecord"] as $comment)
        <div id="content">
            <div id="speaker">{{ $comment["speaker"] }}</div>
            <div id="speakerGroup">{{ $comment["speakerGroup"] }}</div>
            <div id="speech">{{ $comment["speech"] }}</div>
            <div id="speechID">{{ $comment["speechID"] }}</div>
            <div id="issueID">{{ $comment["issueID"] }}</div>
        </div>
    @endforeach
@endsection