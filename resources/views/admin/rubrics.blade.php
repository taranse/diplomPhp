@extends('layouts.admin')
@section('title', 'Админ панель | Рубрики')

@section('content')
    <div class="mar-30"></div>

    @if(Auth::user()->group < 3)
        <form action="{{route('store.rubric')}}" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="author" value="{{ Auth::user()->id }}">
            <div class="input-field inline">
                <input type="text" id="name" name="name">
                <label for="name">Имя рубрики</label>
            </div>
            &nbsp;
            <div class="input-field inline">
                <input type="text" id="alias" name="alias">
                <label for="alias">Алиас</label>
            </div>
            &nbsp;
            <input type="submit" class="btn" value="Создать рубрику">
            @if($errors->first('name'))
                <p>{{$errors->first('name')}}</p>
            @endif
            @if($errors->first('alias'))
                <p>{{$errors->first('alias')}}</p>
            @endif
        </form>
    @endif

    <div class="mar-30"></div>
    <h1>Рубрики</h1>
    <table class="bordered highlight">
        <thead>
        <tr>
            <th>Имя</th>
            <th>Алиас</th>
            <th>Новые вопросы</th>
            <th>Опубликованные вопросы</th>
            <th>Заблокированные вопросы</th>
            <th>Автор</th>
            <th>
                @if(Auth::user()->group < 3)
                    Удалить
                @endif
            </th>
        </tr>
        </thead>

        <tbody>
        @foreach($rubrics as $rubric)
            <tr onclick="window.location =  '{{ route('show.rubric', $rubric->alias) }}'">
                <td>{{$rubric->name}}</td>
                <td>{{$rubric->alias}}</td>
                <td>{{$rubric->newQuestions}}</td>
                <td>{{$rubric->oldQuestions}}</td>
                <td>{{$rubric->blockQuestions}}</td>
                <td>{{$rubric->authorName}}</td>
                <td>
                    @if(Auth::user()->group < 3)
                        <form action="{{route('destroy.rubric', $rubric->id)}}" method="POST">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="submit" class="btn red" value="Удалить">
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $rubrics->links() }}
    <style>
        tbody tr {cursor: pointer}
    </style>
@endsection