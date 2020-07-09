@extends('layouts.app')

@section('title','会議詳細')

@section('content')
    <h4>CSVファイルを選択して下さい</h4>
    {{ Form::open(['method'=>'POST','url'=>'#','class'=>'form-inline']) }}
        {{ csrf_field() }}
        {{ Form::hidden('kind','1') }}
        {{ Form::Label('国会議員のデータ') }}
        {{ Form::file('legislator',['class' => 'custom-file']) }}
        {{ Form::submit('データアップロード',['class' => 'btn btn-primary']) }}
    {{ Form::close() }}
    {{ Form::open(['method'=>'POST','url'=>'#','class'=>'form-inline']) }}
        {{ csrf_field() }}
        {{ Form::hidden('kind','2') }}
        {{ Form::Label('政党のデータ') }}
        {{ Form::file('speaker_group',['class' => 'custom-file']) }}
        {{ Form::submit('データアップロード',['class' => 'btn btn-primary']) }}
    {{ Form::close() }}
    {{ Form::open(['method'=>'POST','url'=>'#','class'=>'form-inline']) }}
        {{ csrf_field() }}
        {{ Form::hidden('kind','3') }}
        {{ Form::Label('選挙区のデータ') }}
        {{ Form::file('constituency',['class' => 'custom-file']) }}
        {{ Form::submit('データアップロード',['class'=> 'btn btn-primary']) }}
    {{ Form::close() }}
@endsection