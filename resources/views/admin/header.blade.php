<script>
    window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
</script>
<nav class="blue-grey darken-1">
    <div class="container">
        <div class="row">
            <div class="col s12">
                <div class="nav-wrapper">
                    <ul class="left hide-on-med-and-down">
                        <li><a style="height: 63px" href="{{ url('/') }}"><img src="{{ url('img/logo-admin.png') }}" alt=""></a></li>
                        <li><a href="{{ url('admin/moderators') }}">Администраторы</a></li>
                        <li><a href="{{ route('admin.rubrics') }}">Рубрики</a></li>
                        <li>
                            <a href="{{url('admin/new-questions')}}">
                                Новые вопросы
                                @if(\App\Question::newQuestions())
                                    <span class="new badge blue">{{\App\Question::newQuestions()}}</span>
                                @endif
                            </a>
                        </li>
                        <li>
                            <a href="{{url('admin/block-questions')}}">
                                Заблокированные
                                @if(\App\Question::blockQuestions())
                                    <span class="badge white-text count red darken-4">{{\App\Question::blockQuestions()}}</span>
                                @endif
                            </a>
                        </li>
                        <li>
                            <a href="{{route('all.block-list')}}">
                                Блок-лист
                            </a>
                        </li>
                    </ul>
                    <ul class="right">
                        <li>
                            <a href="{{url('admin')}}" class="btn transparent z-depth-0">{{Auth::user()->name}}</a>
                        </li>
                        <li class="valign-wrapper">
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                            <div class=" center-align">
                                <input type="submit" form="logout-form" value="Выход" class="blue btn">
                            </div>

                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>