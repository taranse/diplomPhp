@extends('layouts.admin')
@section('title', 'Админ панель | Новые вопросы')

@section('content')

    <div class="mar-30"></div>
    <h1>Вопросы</h1>
        @foreach($questions as $question)
            <div class="card z-depth-2">
                <div class="card-content">
                    <span class="card-title left">{{$question->name}}</span>
                    <span class="card-title right">{{$question->author}}</span>
                    <div class="clear"></div>
                    <span>Дата добавления: {{$question->created_at}}</span>
                    <div class="mar-30"></div>
                    <p>{!! $question->text !!}</p>
                </div>
                <div class="card-action">
                    <a href="{{route('show.question', $question->id)}}">Просмотреть</a>
                    <a href="{{url('admin/new-questions/' . $question->id . '/block')}}" class="right red-text">Заблокировать</a>
                </div>
            </div>
        @endforeach
    {{ $questions->links() }}
@endsection