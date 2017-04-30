@extends('layouts.admin')
@section('title', 'Админ панель')

@section('content')
    <div class="center-align">
        <h3>Администраторы</h3>
    </div>
    <div class="col l12">
        @if(Auth::user()->group == 1 )
            <div id="swipe-2" class="col s12">
                <div class="col l4">
                    <form action="{{url('admin/register')}}" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="input-field">
                            <input type="text" id="name" name="name" class="validate" pattern="[A-Za-z]{4,20}">
                            <label for="name" data-error="Не правильный логин" data-success="Верно">Логин</label>
                        </div>
                        @if ($errors->has('name'))
                            <span>{{ $errors->first('name') }}</span>
                        @endif
                        <div class="input-field">
                            <input type="password" id="password" name="password" class="validate">
                            <label for="password">Пароль</label>
                        </div>
                        @if ($errors->has('password'))
                            <span>{{ $errors->first('password') }}</span>
                        @endif
                        <div class="input-field">
                            <input type="password" id="password_repeat" name="password_confirmation" class="validate">
                            <label for="password_repeat">Повторить пароль</label>
                        </div>
                        <label style="font-size: 1rem;">Группа администратора <br>
                            <select name="group" class="browser-default">
                                <option value="" disabled selected>Выберете группу</option>
                                <option value="1">Администратор</option>
                                <option value="2">Модератор</option>
                                <option value="3">Автор</option>
                            </select>
                        </label>
                        @if ($errors->has('group'))
                            <span>{{ $errors->first('group') }}</span><br>
                        @endif
                        <br>
                        <button class="btn">Создать</button>
                    </form>
                </div>
            </div>
        @endif
        <div class="clear"></div>
            <br>
        <div id="swipe-1" class="col s12">

            <table class="bordered">
                <thead>
                <tr>
                    <th>Логин</th>
                    <th>Группа</th>
                    <th colspan="2">Редактирование</th>
                    <th>Группа</th>
                </tr>
                </thead>

                <tbody>
                @foreach($admins as $admin)
                    <tr>
                        <td>{{$admin->name}}</td>
                        <td>{{$admin->group}}</td>
                        @if(Auth::user()->group == 1 and Auth::user()->name != $admin->name)
                            <td>
                                <form action="{{route('destroy.admin', $admin->id)}}" method="POST">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="submit" class="btn red" value="Удалить">
                                </form>
                            </td>
                        @else
                            <td></td>
                        @endif
                        <td>
                        @if(Auth::user()->name == $admin->name)
                                <form action="{{route('update.admin', Auth::user()->id)}}" method="POST">
                                    <input type="hidden" name="_method" value="PUT">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="input-field inline">
                                        <input type="password" id="password{{Auth::user()->id}}" name="password" class="validate"
                                               pattern="[A-Za-z-0-9]{4,20}">
                                        <label for="password{{Auth::user()->id}}" data-error="Не верный пароль" data-success="Верно">Сменить
                                            пароль</label>
                                    </div>
                                    &nbsp;
                                    <input type="submit" class="btn" value="Сменить">

                                </form>
                        @endif
                        @if(Auth::user()->group == 1 && Auth::user()->name !== $admin->name)

                                <form action="{{route('update.admin', $admin->id)}}" method="POST">
                                    <input type="hidden" name="_method" value="PUT">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="input-field inline">
                                        <input type="password" id="password{{$admin->id}}" name="password" class="validate"
                                               pattern="[A-Za-z-0-9]{4,20}">
                                        <label for="password{{$admin->id}}" data-error="Не верный пароль" data-success="Верно">Сменить
                                            пароль</label>
                                    </div>
                                    &nbsp;
                                    <input type="submit" class="btn" value="Сменить">

                                </form>
                        @endif
                        </td>
                        <td>
                            @if($admin->group == 1)
                                Администратор
                            @elseif($admin->group == 2)
                                Модератор
                            @else
                                Автор
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>
    <style>

        table input {
            margin: 0;
        }

    </style>

@endsection