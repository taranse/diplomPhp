@extends('layouts.main')
@section('title', 'задать вопрос')

@section('sidebar')
    <div class="center-align">
        <img class="responsive-img" src="{{url('img/question.jpg')}}" alt="">
    </div>
@endsection
@section('content')
    @if(isset($rubrics))
        <h3>Выберете рубрику</h3>
        <div class="collection with-header" id="sidebar">
            <div class="collection-header"><b>Рубрики</b></div>
            @foreach($rubrics as $link)
                <a class="collection-item" href="{{url($link->alias . '/new-question')}}">{{$link->name}}</a>
            @endforeach
        </div>
    @else
        <h3>Задайте вопрос</h3>
        <form action="{{route('create.question')}}" method="POST">
            <input type="hidden" name="rubric" value="{{$activeRubricId}}">
            <input type="hidden" name="rubric_alias" value="{{$activeRubricAlias}}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="input-field">
                <input id="email" name="name" type="text" required maxlength="60">
                <label for="email">Название вопроса</label>
            </div><br>
            @if($errors->first('name'))
                <span class="red-text">{{$errors->first('name')}}</span>
            @endif
            <div class="input-field">
                <input id="email" name="email" type="email" required>
                <label for="email">Введите свой email</label>
            </div><br>
            <div class="input-field">
                <input id="author" name="author" type="text" required maxlength="20">
                <label for="author">Ваше имя</label>
            </div><br>
            @if($errors->first('text'))
                <span class="red-text">{{$errors->first('text')}}</span>
            @endif
            <textarea required name="text" id="editor1" rows="10" cols="80"></textarea><br>
            <input type="submit" value="Задать" class="btn">
        </form>
        <script>
            CKEDITOR.replace('editor1');
        </script>
    @endif
@endsection