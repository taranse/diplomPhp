<header class="teal darken-2 white-text">
    <div class="container">
        <div class="row">
            <div class="col s12 center-align">
                <h1>Список вопросов</h1>
                @if(!$create)
                    @if($main and count($breadcrumbs) == 1)
                        <a href="{{url('new-question')}}" class="red btn">Задать вопрос</a>
                    @else
                        <a href="{{url($data['activeAlias'] . '/new-question')}}" class="red btn">Задать вопрос</a>
                    @endif
                @endif
            </div>
        </div>
    </div>
</header>
<nav class="teal">
    <div class="container">
        <div class="row">
            <div class="nav-wrapper">
                <div class="col s12">

                    @if($main)
                        <span class="breadcrumb">Главная</span>
                    @else
                        <a href="/" class="breadcrumb">Главная</a>
                        @foreach($breadcrumbs as $name => $alias)
                            <a class="breadcrumb" href="{{url($alias)}}">{{$name}}</a>
                        @endforeach
                        {{--@if(isset($data['activeName']))--}}
                            {{--@if(isset($data['activeQuestionName']))--}}
                                {{--<a href="{{url($data['activeRubricAlias'])}}" class="breadcrumb">{{$data['activeRubricName']}}</a>--}}
                                {{--<span class="breadcrumb">{{$data['activeQuestionName']}}</span>--}}
                            {{--@else--}}
                                {{--<span class="breadcrumb">{{$data['activeRubricName']}}</span>--}}
                            {{--@endif--}}
                        {{--@elseif($create)--}}
                            {{--<a href="{{url($activeRubricAlias)}}" class="breadcrumb">{{$activeRubricName}}</a>--}}
                            {{--<span class="breadcrumb">Задать вопрос</span>--}}
                        {{--@else--}}
                            {{--<span class="breadcrumb">Рубрики</span>--}}
                        {{--@endif--}}
                    @endif
                    @if(Auth::guest())
                        <a href="{{url('login')}}" class="brand-logo right" style="font-size: 1.3rem">Вход</a>
                    @else
                        <a href="{{url('admin')}}" class="brand-logo right" style="font-size: 1.3rem">Админ панель</a>
                    @endif

                </div>
            </div>
        </div>
    </div>
</nav>
<div class="mar-30"></div>