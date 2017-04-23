@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="mar-30"></div>
        <div class="mar-30"></div>
        <div class="row">
            <div class="col l3"></div>
            <form class="col l6" role="form" method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}
                <div class="input-field col l12{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name">Login</label>
                    <input id="name" type="text" autocomplete="off" name="name" required autofocus>
                    @if ($errors->has('name'))
                        <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                    @endif
                </div>
                <div class="input-field col l12{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password">Password</label>
                    <input id="password" autocomplete="off" type="password" name="password" required>
                    @if ($errors->has('password'))
                        <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                    @endif
                </div>
                <div class="col l12">
                    <input type="checkbox" id="test5" name="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label for="test5">Запомнить меня</label>
                </div>
                <div class="col l12">
                    <div class="mar-30"></div>
                    <button type="submit" class="btn">
                        Войти
                    </button>
                </div>
            </form>
            <div class="col l3"></div>
        </div>
    </div>
@endsection
