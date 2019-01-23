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
                    Добавить новый язык для сайта
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
                    <a href="{{ route('languages.index') }}">
                        Языки
                    </a>
                </li>
                <li class="breadcrumb-item">
                    Добавить
                </li>
            </ul>
        </div>

        @include('admin.widgets')

        <section class="content">
            <div class="card">

                <form action="{{ route('languages.store') }}" method="post">

                    @csrf

                    <div class="card-header">
                        <h4 class="mb-0 ">
                            Добавить новый язык
                        </h4>
                    </div>

                    <div class="card-body">

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="title">
                                    Название
                                </label>

                                <input type="text"
                                       name="title"
                                       class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
                                       id="title"
                                       placeholder="Введите название меню"
                                       value="{{ old('title') }}">

                                @if ($errors->has('title'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('title') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="alias">
                                    Алиас
                                </label>

                                <input type="text"
                                       name="alias"
                                       class="form-control {{ $errors->has('alias') ? 'is-invalid' : '' }}"
                                       id="alias"
                                       placeholder="Введите алиас меню"
                                       value="{{ old('alias') }}">

                                @if ($errors->has('alias'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('alias') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                    </div>

                    <div class="card-footer">
                        <a href="{{ url()->previous() }}" class="btn btn-secondary">
                            Назад
                        </a>
                        <button type="submit" class="btn btn-primary">
                            Добавить
                        </button>
                    </div>

                </form>

            </div>
        </section>
    </main>
@endsection
