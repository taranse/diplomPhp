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
                        <li><a href="{{ url('admin/moderators') }}">Администраторы</a></li>
                        <li><a href="{{ url('admin/rubrics') }}">Рубрики</a></li>
                        <li><a href="admin/new-questions">Новые вопросы<span class="new badge blue">14</span></a></li>
                    </ul>
                    <ul class="right">
                        <li style="margin-right: 20px;font-size: 1.5rem;">Админ панель</li>
                        <li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                            <input type="submit" form="logout-form" value="Выход" class="blue btn">
                        </li>
                    </ul>

                </div>
            </div>
        </div>
    </div>
</nav>