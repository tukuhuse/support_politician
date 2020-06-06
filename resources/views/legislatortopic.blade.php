@extends('layouts.app')

@section('title','議員検索')

@section('content')
    {{ Form::open(['route' => 'outcome2','method'=>'get', 'class' => 'form-group form-inline']) }}
        {{ csrf_field() }}
        {{ Form::hidden('invisible',1) }}
        {{ Form::label('search_way','議員名検索',['class' => 'control-label col-sm-1']) }}
        {{ Form::select('legislator_id',$legislators,null,['class' => 'form-control col-sm-1','id' => 'legislator_id']) }}
        {{ Form::button('検索<i class="fas fa-search"></i>',['type'=>'submit', 'class' => 'btn btn-outline-primary']) }}
    {{ Form::close() }}
    {{ Form::open(['route' => 'outcome3','method'=>'get', 'class' => 'form-group form-inline']) }}
        {{ csrf_field() }}
        {{ Form::hidden('invisible',1) }}
        {{ Form::label('search_way','選挙区検索',['class' => 'control-label col-sm-1']) }}
        {{ Form::select('constituency_id',$constituencies,null,['class' => 'form-control col-sm-1','id' => 'constituency_id']) }}
        {{ Form::button('検索<i class="fas fa-search"></i>',['type'=>'submit', 'class' => 'btn btn-outline-primary']) }}
    {{ Form::close() }}
    {{ Form::open(['route' => 'outcome4','method'=>'get', 'class' => 'form-group form-inline']) }}
        {{ csrf_field() }}
        {{ Form::hidden('invisible',1) }}
        {{ Form::label('search_way','政党検索', ['class' => 'control-label col-sm-1']) }}
        {{ Form::select('speaker_group_id', $speaker_groups,null,['class' => 'form-control col-sm-1','id' => 'speaker_group_id']) }}
        {{ Form::button('検索<i class="fas fa-search"></i>',['type'=>'submit', 'class' => 'btn btn-outline-primary']) }}
    {{ Form::close() }}
@endsection