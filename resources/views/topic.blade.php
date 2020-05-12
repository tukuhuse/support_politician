@extends('layouts.app')

@section('title','議題検索ページ')

@section('content')
    <form action="{{ route('outcome') }}" method="GET">
        {{ csrf_field() }}
        {{ Form::hidden('invisible',1) }}
        {{ Form::label('search_way','発言内容検索') }}
        {{ Form::text('search_word','',['class'=>'field','id'=>'search_word']) }}
        {{ Form::submit('検索') }}
    </form>
@endsection