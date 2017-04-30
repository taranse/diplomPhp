@extends('layouts.admin')
@section('title', 'Админ панель | Новые вопросы')

@section('content')

    <div class="mar-30"></div>
    <h1>Вопросы</h1>
        @forelse($questions as $question)
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
                    <div>
                        <a href="{{route('show.question', $question->id)}}">Просмотреть</a>
                        @if($question->block == 0)
                            <a href="{{url('admin/questions/' . $question->id . '/block')}}" class="right red-text">Заблокировать</a>
                        @else
                            <a href="{{url('admin/questions/' . $question->id . '/unblock')}}" class="right green-text">Разблокировать</a>
                        @endif
                    </div>
                    <form action="{{route('destroy.question', $question->id)}}" method="POST">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="submit" class="btn red" value="Удалить">
                    </form>
                </div>
            </div>
        @empty
            <h4>Вопросов пока что нет.</h4>
        @endforelse
    {{ $questions->links() }}
@endsection