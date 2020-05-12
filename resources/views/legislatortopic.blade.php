@extends('layouts.app')

@section('title','議員検索')

@section('content')
    {{ Form::open(['route' => 'outcome2','method'=>'get']) }}
        {{ csrf_field() }}
        {{ Form::hidden('invisible',1) }}
        {{ Form::label('search_way','議員名検索') }}
        {{ Form::select('legislator_id',$legislators,null,['class' => 'form','id' => 'legislator_id']) }}
        {{ Form::submit('検索') }}
    {{ Form::close() }}
    {{ Form::open(['route' => 'outcome3','method'=>'get']) }}
        {{ csrf_field() }}
        {{ Form::hidden('invisible',1) }}
        {{ Form::label('search_way','選挙区検索') }}
        {{ Form::select('constituency_id',$constituencies,null,['class' => 'form','id' => 'constituency_id']) }}
        {{ Form::submit('検索') }}
    {{ Form::close() }}
    {{ Form::open(['route' => 'outcome4','method'=>'get']) }}
        {{ csrf_field() }}
        {{ Form::hidden('invisible',1) }}
        {{ Form::label('search_way','政党検索') }}
        {{ Form::select('speaker_group_id', $speaker_groups,null,['class' => 'form','id' => 'speaker_group_id']) }}
        {{ Form::submit('検索') }}
    {{ Form::close() }}
@endsection