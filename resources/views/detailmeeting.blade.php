@extends('layouts.app')

@section('title','会議詳細')

@section('content')
    @foreach ($result as $comment)
        <div id="comment">
            <div id="speaker">{{ $comment["speaker"] }}</div>
            <div id="speaker_group">{{ $comment["speakerGroup"] }}</div>
            <div id="speech">{{ $comment["speech"] }}</div>
        </div>
    @endforeach
@endsection