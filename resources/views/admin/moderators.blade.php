@extends('layouts.admin')
@section('title', 'Админ панель')

@section('content')
    <div class="center-align">
        <h3>Администраторы</h3>
    </div>
    <div class="col l12">
        <ul id="tabs-swipe-demo" class="tabs">
            <li class="tab col s4"><a href="#swipe-1" class=" black-text">Список администраторов</a></li>
            <li class="tab col s4"><a href="#swipe-2" class=" black-text">Создать</a></li>
        </ul>
        <div id="swipe-1" class="col s12">

            <table class="bordered highlight">
                <thead>
                <tr>
                    <th>Логин</th>
                    <th>Группа</th>
                    @if(Auth::user()->group == 1)
                        <th colspan="2">Редактирование</th>
                    @endif
                </tr>
                </thead>

                <tbody>
                @foreach($admins as $admin)
                    <tr>
                        <td>{{$admin->name}}</td>
                        <td>{{$admin->group}}</td>
                        @if(Auth::user()->group == 1 and Auth::user()->name != $admin->name)
                            <td>Удалить</td>
                        @else
                            <td></td>
                        @endif
                        @if(Auth::user()->name == $admin->name)
                            <td>
                                <form action="{{url('admin/update', Auth::user()->id)}}" method="POST">
                                    <input type="hidden" name="_method" value="PUT">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="input-field inline">
                                        <input type="password" id="password{{Auth::user()->id}}" name="password" class="validate" pattern="[A-Za-z-0-9]{4,20}">
                                        <label for="password{{Auth::user()->id}}" data-error="Не верный пароль" data-success="Верно">Сменить пароль</label>
                                    </div>
                                    <input type="submit" class="btn" value="Сменить">

                                </form>
                            </td>

                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div id="swipe-2" class="col s12">
            <div class="col l4">
                <a href="" class="btn">Создать</a>
            </div>
        </div>

    </div>
    <style>

        table input {
            margin: 0;
        }

    </style>

@endsection