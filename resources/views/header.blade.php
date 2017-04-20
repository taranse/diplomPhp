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
    <div class="nav-wrapper">
        <div class="container">
            <div class="row">
                <div class="col s12">
                    @if($main)
                        <span class="breadcrumb">Главная</span>
                    @else
                        <a href="/" class="breadcrumb">Главная</a>
                        <span class="breadcrumb">{{$active->name}}</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</nav>
<div class="mar-30"></div>