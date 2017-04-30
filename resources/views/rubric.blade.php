@extends('layouts.main')
@section('title', $data['activeName'])

@section('sidebar')
    @include("sidebar", $data)
@endsection
@section('content')

    @forelse($questions as $question)
        <div class="card horizontal">
            <div class="card-stacked">
                <div class="card-content">
                    <span class="card-title">
                        {{$question->name}}
                        <span class="right size1">
                            Дата публикации: {{$question->updated_at}}
                        </span>
                    </span>
                    <span>Автор: {{$question->author}}</span>
                    <div class="clear"></div>
                    <br>
                    {!! $question->text !!}
                </div>
                <div class="card-action">
                    <span>Ответил: {{$question->admin_name}}</span>
                    <a href="{{url($data['activeAlias'].'/'.$question->alias)}}">Просмотреть ответ</a>
                </div>
            </div>
        </div>
    @empty
        <p class="center-align">
            В этой рубрике еще не задавали вопросов. Будте первым!<br><br>
            <a href="{{url($data['activeAlias'] . '/new-question')}}" class="red btn">Задать вопрос</a>
        </p>
    @endforelse

@endsection