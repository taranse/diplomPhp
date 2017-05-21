@extends('layouts.admin')
@section('title', 'Блок лист')

@section('content')

    <div class="mar-30"></div>
    <h1>Запрещенные слова</h1>
    <form action="{{route('store.block-list')}}" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="author" value="{{ Auth::user()->id }}">
        <div class="input-field inline" style="width: 30% !important">
            <input type="text" id="name" name="word">
            <label for="name" class="text-nowrap">Слово или словосочетание</label>
        </div>
        @if($errors->first('word'))
            <p>{{$errors->first('word')}}</p>
        @endif
        &nbsp;
        <input type="submit" class="btn" value="Добавить слово">
    </form>

    <table class="bordered highlight col l8">
        <thead>
        <tr>
            <th style="width: 50%">Слово</th>
            <th style="width: 50%">Автор</th>
            @if(Auth::user()->group < 3)
                <th>
                    Удалить
                </th>
            @endif
        </tr>
        </thead>

        <tbody>
        @foreach($blockWords as $word)
            <tr>
                <td>{{$word->word}}</td>
                <td>{{$word->getAuthor->name}}</td>
                @if(Auth::user()->group < 3)
                    <td>
                        <form action="{{route('destroy.block-list', $word->id)}}" method="POST">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="submit" class="btn red" value="Удалить">
                        </form>
                    </td>
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $blockWords->links() }}
@endsection