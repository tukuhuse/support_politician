@extends('layouts.app')

@section('title','検索結果')

@section('content')
    @if ($result["numberOfRecords"] == 0)
        <div>検索条件に該当する発言はありませんでした。</div>
    @else
        @foreach ($result["speechRecord"] as $comment)
            {{ Form::open(['method'=>'get','url'=>'parliament/show/' . $comment["issueID"]]) }}
                {{ csrf_field() }}
                <a href="javascript:void(0)" onclick="this.parentNode.submit()" class="nonstyle">
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
    @endif
@endsection