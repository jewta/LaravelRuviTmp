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
                <i class="fas fa-language"></i>
                Языки
            </h1>
            <p>
                Показаны все языки для сайта
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
                Языки
            </li>
        </ul>
    </div>

    @include('admin.widgets')

    <section class="content">
        <div class="card">
            <div class="card-header">
                <a class="btn btn-primary" href="{{ route('languages.create') }}">
                    Добавить
                </a>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                @if($languages->isNotEmpty())
                    <div class="table-responsive">
                        <table class="table table-hover table-fixed mb-0">
                            <thead class="thead-dark">
                                <th class="text-center" style="width: 45px;">Id</th>
                                <th >Название</th>
                                <th >Алиас</th>
                                <th class="text-center" style="width: 115px;">Действие</th>
                            </thead>

                            <tbody>
                            @foreach($languages as $language)
                                <tr>
                                    <td class="text-center">{{ $language->id }}</td>
                                    <td>
                                        {{ $language->title }}
                                    </td>
                                    <td>
                                        {{ $language->alias }}
                                    </td>

                                    <td class="text-center">
                                        <div class="btn-group btn-group-sm" role="group" aria-label="Button group with nested dropdown">
                                            <div class="btn-group btn-group-sm" role="group">
                                                <button id="btnGroupDrop1" type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-sliders-h fa-lg"></i>
                                                </button>

                                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                    <a class="dropdown-item" href="{{ route('languages.edit', $language->id) }}">
                                                        Редактировать
                                                    </a>
                                                    <a href="{{ route('languages.destroy', $language->id) }}"
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
                        Вы еще не добавили язык
                    </caption>
                @endif
            </div>

        </div>
    </section>
</main>
@endsection
