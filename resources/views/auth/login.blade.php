@extends('layouts.admin')

@section('content')
    <section class="material-half-bg">
        <div class="cover"></div>
    </section>
    <section class="login-content">
        <div class="logo">
            <h1>
                LaravelRuviTmp
            </h1>
        </div>

        <div class="login-box">
            <form class="login-form" action="{{ route('login') }}" method="post" aria-label="{{ __('Login') }}">

                @csrf

                <h3 class="login-head">
                    <i class="fa fa-lg fa-fw fa-user"></i>
                    Авторизация
                </h3>

                <div class="form-group">
                    <label class="control-label" for="email">
                        Email адрес
                    </label>

                    <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                           id="email"
                           type="email"
                           name="email"
                           value="{{ old('email') }}"
                           placeholder="Email"
                           required autofocus>

                    @if($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>
                                {{ $errors->first('email') }}
                            </strong>
                        </span>
                    @endif

                    @if(session('not_active'))
                        <span class="invalid-feedback" style="display: block;" role="alert">
                            <strong>
                                {{ session('not_active') }}
                            </strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <label class="control-label" for="password">
                        Пароль
                    </label>

                    <input type="password"
                           name="password"
                           id="password"
                           class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                           placeholder="Password" required>

                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                        <strong>
                            {{ $errors->first('password') }}
                        </strong>
                    </span>
                    @endif
                </div>

                <div class="form-group">
                    <div class="utility">
                        <div class="custom-control custom-checkbox">

                            <input type="checkbox"
                                   class="custom-control-input"
                                   name="remember"
                                   {{ old('remember') ? 'checked' : '' }}
                                   id="remember">

                            <label class="custom-control-label"
                                   for="remember">
                                Запомнить?
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group btn-container">
                    <button class="btn btn-primary btn-block" type="submit">
                        <i class="fas fa-sign-in-alt fa-lg fa-fw"></i>
                        Войти
                    </button>
                </div>
            </form>
        </div>
    </section>
@endsection
