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
    <span>Ответил: <b>{{$question->user_name}}</b></span>
    <blockquote>
        {!! $question->answer !!}
    </blockquote>
    {{--@forelse($questions as $question)--}}
        {{--<div class="card horizontal">--}}
            {{--<div class="card-stacked">--}}
                {{--<div class="card-content">--}}
                    {{--<span class="card-title">--}}
                        {{--{{$question->name}}--}}
                        {{--<span class="right size1">--}}
                            {{--Дата публикации: {{$question->updated_at}}--}}
                        {{--</span>--}}
                    {{--</span>--}}
                    {{--<span>Автор: {{$question->author}}</span>--}}
                    {{--<div class="clear"></div>--}}
                    {{--<br>--}}
                    {{--{!! $question->text !!}--}}
                {{--</div>--}}
                {{--<div class="card-action">--}}
                    {{--<span>Ответил: {{$question->admin_name}}</span>--}}
                    {{--<a href="{{url($data['activeRubricAlias'].'/'.$question->alias)}}" >Просмотреть ответ</a>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--@empty--}}
        {{--<p class="center-align">--}}
            {{--В этой рубрике еще не задавали вопросов. Будте первым!<br><br>--}}
            {{--<a href="{{url($data['activeRubricAlias'] . '/new-question')}}" class="red btn">Задать вопрос</a>--}}
        {{--</p>--}}
    {{--@endforelse--}}

@endsection