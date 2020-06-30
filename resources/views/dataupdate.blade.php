@extends('layouts.app')

@section('title','会議詳細')

@section('content')
    <h4>CSVファイルを選択して下さい</h4>
    {{ Form::file('legislator',['class' => 'csvinput']) }}
@endsection