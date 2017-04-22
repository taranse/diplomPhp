<header class="teal darken-2 white-text">
    <div class="container">
        <div class="row">
            <div class="col s12">
                <h1>Список вопросов</h1>
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
                        @if($activeQuestion)
                            <a href="{{$activeRubric->link}}" class="breadcrumb">{{$activeRubric->name}}</a>
                        @else
                            <span class="breadcrumb">{{$activeRubric->name}}</span>
                        @endif
                    @endif
                    <a href="/admin" class="brand-logo right" style="font-size: 1.3rem">Вход</a>
                </div>
            </div>
        </div>
    </div>
</nav>
<div class="mar-30"></div>