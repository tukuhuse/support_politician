@extends('layouts.app')

@section('title','議題検索ページ')

@section('content')
    {{ Form::open(['route' => 'outcome', 'method' => 'GET', 'class' => 'form-group form-inline']) }}
        {{ csrf_field() }}
        {{ Form::hidden('invisible',1) }}
        {{ Form::label('search_way','発言内容検索') }}
        {{ Form::text('search_word','',['class'=>'form-control','id'=>'search_word']) }}
        {{ Form::button('検索<i class="fas fa-search"></i>',['type'=>'submit', 'class' => 'btn btn-primary']) }}
    {{ Form::close() }}
@endsection