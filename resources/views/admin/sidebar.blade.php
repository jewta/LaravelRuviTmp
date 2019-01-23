<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <div class="app-sidebar__user">

        <img class="app-sidebar__user-avatar" src="https://s3.amazonaws.com/uifaces/faces/twitter/jsa/48.jpg" alt="User Image">

        <div>
            <p class="app-sidebar__user-name">
                John Doe
            </p>
            <p class="app-sidebar__user-designation">
                Frontend Developer
            </p>
        </div>
    </div>
    <ul class="app-menu">
        <li>
            <a class="app-menu__item" href="">
                <i class="app-menu__icon fas fa-home"></i>
                <span class="app-menu__label">
                    Главная
                </span>
            </a>
        </li>
        <li>
            <a class="app-menu__item {{ url()->current() == route('menu.index') ? 'active' : '' }}"
               href="{{ route('menu.index') }}">
                <i class="app-menu__icon fas fa-bars"></i>
                <span class="app-menu__label">
                    Меню
                </span>
            </a>
        </li>
        <li>
            <a class="app-menu__item" href="">
                <i class="app-menu__icon fas fa-users"></i>
                <span class="app-menu__label">
                    Пользователи
                </span>
            </a>
        </li>
        <li>
            <a class="app-menu__item" href="">
                <i class="app-menu__icon far fa-comment-alt"></i>
                <span class="app-menu__label">
                    Обратная связь
                </span>
            </a>
        </li>
        <li class="treeview">
            <a class="app-menu__item" href="#" data-toggle="treeview">
                <i class="app-menu__icon fa fa-laptop"></i>
                <span class="app-menu__label">
                    Настройки
                </span>
                <i class="treeview-indicator fa fa-angle-right"></i>
            </a>
            <ul class="treeview-menu">
                <li>
                    <a class="treeview-item" href="{{ route('languages.index') }}">
                        <i class="icon fas fa-language"></i>
                        Языки
                    </a>
                </li>
                <li>
                    <a class="treeview-item" href="">
                        <i class="icon fas fa-chart-line"></i>
                        Seo оптимизация
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a class="app-menu__item" href="">
                <i class="app-menu__icon fas fa-external-link-alt"></i>
                <span class="app-menu__label">
                    Сайт
                </span>
            </a>
        </li>
    </ul>
</aside>
