@extends('layouts.admin')

@section('header')
    @include('admin.header')
@endsection

@section('sidebar')
    @include('admin.sidebar')
@endsection

@section('content')
<main class="app-content">
    <div class="app-title">
        <div>
            <h1>
                <i class="fas fa-bars"></i>
                Меню
            </h1>
            <p>
                Показаны все меню на сайте
            </p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item">
                <i class="fa fa-home fa-lg"></i>
            </li>
            <li class="breadcrumb-item">
                <a href="#">
                    Главная
                </a>
            </li>
            <li class="breadcrumb-item">
                Меню
            </li>
        </ul>
    </div>

    @include('admin.widgets')

    <section class="content">
        <div class="card">
            <div class="card-header">
                <a class="btn btn-primary" href="{{ route('menu.create') }}">
                    Добавить
                </a>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                @if($menus->isNotEmpty())
                    <div class="table-responsive">
                        <table class="table table-hover table-fixed mb-0">
                            <thead class="thead-dark">
                                <th class="text-center" style="width: 45px;">Id</th>
                                <th style="width: 120px;">Название</th>
                                <th style="width: 120px;">Алиас</th>
                                <th>Описание</th>
                                <th class="text-center" style="width: 70px;">SEO</th>
                                <th class="text-center" style="width: 70px;">Язык</th>
                                <th class="text-center" style="width: 115px;">Действие</th>
                            </thead>

                            <tbody>
                            @foreach($menus as $menu)
                                <tr>
                                    <td class="text-center">{{ $menu->id }}</td>
                                    <td>
                                        {{ $menu->title }}
                                    </td>
                                    <td>
                                        {{ $menu->alias }}
                                    </td>
                                    <td>
                                        {{ $menu->description }}
                                    </td>
                                    <td class="text-center">
                                        @if($menu->seo)
                                            <span class="text-success">Есть</span>
                                        @else
                                            <span class="text-danger">Нет</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        {{ $menu->language->alias }}
                                    </td>

                                    <td class="text-center">
                                        <div class="btn-group btn-group-sm" role="group" aria-label="Button group with nested dropdown">
                                            @if($menu->is_active)
                                                <a href=""
                                                   class="btn btn-sm btn-success deactivate">
                                                    <i class="fas fa-check"></i>
                                                </a>
                                            @else
                                                <a href=""
                                                   class="btn btn-sm btn-outline-success activate">
                                                    <i class="fas fa-check"></i>
                                                </a>
                                            @endif

                                            <div class="btn-group btn-group-sm" role="group">
                                                <button id="btnGroupDrop1" type="button" class="btn border-left-0 btn-outline-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-sliders-h fa-lg"></i>
                                                </button>

                                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                    <a class="dropdown-item" href="{{ route('menu.edit', $menu->id) }}">
                                                        Редактировать
                                                    </a>
                                                    <a href="{{ route('menu.destroy', $menu->id) }}"
                                                       class="dropdown-item delete">
                                                        Удалить
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <caption>
                        Вы еще не добавили меню
                    </caption>
                @endif
            </div>

            {{ $menus->links('vendor.pagination.bootstrap-4') }}

        </div>
    </section>
</main>
@endsection
