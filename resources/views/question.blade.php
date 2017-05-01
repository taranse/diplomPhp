@extends('layouts.main')
@section('title', $data['activeName'])

@section('sidebar')
    @include("sidebar", $data)
@endsection
@section('content')
    <h2 class="left">
        {{$question->name}}
    </h2>

    <span class="right size1 right-align">
        Дата публикации: {{$question->updated_at}}<br>
        <h5><b>{{$question->author}}</b></h5>
    </span>
    <div class="clear"></div>
    <div class="content">
        {!! $question->text !!}
    </div>
    <div class="mar-30"></div>
    <span>Ответил: <b>{{$question->getUser->name}}</b></span>
    <blockquote>
        {!! $question->answer !!}
    </blockquote>

@endsection