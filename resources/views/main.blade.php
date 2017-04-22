@extends('layouts.main', ['main' => $main])
@section('title', 'Главная')

@section('sidebar')
    <img class="responsive-img" src="img/logo.jpg" alt="">
@endsection
@section('content')
    <div class="row">

        @foreach($rubrics as $rubric)
            <div class="col l6">
                <div class="card horizontal">
                    <div class="card-stacked">
                        <div class="card-content">
                            <p>{{$rubric->name}}.</p>
                        </div>
                        <div class="card-action">
                            <a href="{{$rubric->alias}}">Перейти</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

@endsection