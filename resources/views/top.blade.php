@extends('layouts.app')

@section('title','討論検索ページ')

@section('javascript')
    <script src="{{ asset('js/main.js') }}" defer></script>
@endsection

@section('content')
    @if (Session::has('message'))
        <div class="flash_message bg-danger text-center py-3 my-0">
            {{ session('message') }}
        </div>
    @endif
    <h3 class="page-title">検索内容入力</h3>
    {{ Form::open(['route' => 'index', 'method' => 'GET', 'class' => 'form-horizontal center']) }}
        {{ csrf_field() }}
        <div class="form-group">
            {{ Form::label('search_way_word','発言内容入力',['class'=>'col-sm-2 control-label']) }}
            <div class="col-md-12">
                {{ Form::text('search_word','',['class'=>'form-control','id'=>'search_word']) }}
            </div>
        </div>
        <div class="form-row form-group">
            <div class="col px-4">
                {{ Form::label('search_way_constituency','選挙区',['class' => 'control-label']) }}
                <div>
                    {{ Form::select('constituency_id', $constituencies, old('constituency_id'), ['class' => 'form-control col-md-7', 'id' => 'constituency_id', 'placeholder' => '選択して下さい']) }}
                </div>
                <div class="search_way">
                    {{ Form::button('選挙区検索 <i class="fas fa-search"></i>', ['type' => 'submit', 'class' => 'form-control btn btn-outline-primary col-md-6', 'name' => 'search_way', 'value' => '選挙区']) }}
                </div>
            </div>
            <div class="col px-4">
                {{ Form::label('search_way_speaker_group','政党',['class' => 'control-label']) }}
                <div>
                    {{ Form::select('speaker_group_id', $speaker_groups, old('speaker_group_id'),['class' => 'form-control col-md-7','id' => 'speaker_group_id','placeholder'=>'選択して下さい']) }}
                </div>
                <div class="search_way">
                    {{ Form::button('政党検索 <i class="fas fa-search"></i>', ['type' => 'submit', 'class' => 'form-control btn btn-outline-success col-md-6', 'name' => 'search_way', 'value' => '政党']) }}
                </div>
            </div>
            <div class="col px-4 end">
                {{ Form::label('search_way_legislator','議員名',['class' => 'control-label']) }}
                <div>
                    {{ Form::select('legislator_id', $legislators, old('legislator_id'), ['class' => 'form-control col-md-7', 'id' => 'legislator_id', 'placeholder' => '選択して下さい']) }}
                </div>
                <div class="search_way">
                    {{ Form::button('議員名検索 <i class="fas fa-search"></i>', ['type' => 'submit', 'class' => 'form-control col-md-6 btn btn-outline-info', 'name' => 'search_way', 'value' => '議員名']) }}
                </div>
            </div>
        </div>
    {{ Form::close() }}
@endsection