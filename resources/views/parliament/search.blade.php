@extends('layouts.app')

@section('title','議題検索ページ')

@section('content')
    {{ Form::open(['route' => 'index', 'method' => 'GET', 'class' => 'form-group form-horizontal']) }}
        {{ csrf_field() }}
        <div class="form-inline">
            {{ Form::label('search_way','発言内容入力',['class'=>'col-sm-1 control-label']) }}
            {{ Form::text('search_word','',['class'=>'form-control col-sm-2','id'=>'search_word']) }}
        </div>
        <div class="form-inline">
            {{ Form::label('search_way','議員名選択',['class' => 'control-label col-sm-1']) }}
            {{ Form::select('legislator_id',$legislators,null,['class' => 'form-control col-sm-1','id' => 'legislator_id','placeholder'=>'選択して下さい']) }}
        </div>
        <div class="form-inline">
            {{ Form::label('search_way','選挙区選択',['class' => 'control-label col-sm-1']) }}
            {{ Form::select('constituency_id',$constituencies,null,['class' => 'form-control col-sm-1','id' => 'constituency_id','placeholder'=>'選択して下さい']) }}
        </div>
        <div class="form-inline">
            {{ Form::label('search_way','政党選択', ['class' => 'control-label col-sm-1']) }}
            {{ Form::select('speaker_group_id', $speaker_groups,null,['class' => 'form-control col-sm-1','id' => 'speaker_group_id','placeholder'=>'選択して下さい']) }}
        </div>
        <div class="form-group">
            <div class="col-sm-offset-10 col-sm-10">
                {{ Form::button('検索 <i class="fas fa-search"></i>',['type'=>'submit', 'class' => 'btn btn-primary']) }}
            </div>
        </div>
    {{ Form::close() }}
@endsection