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
					Редактировать меню сайта
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
					<a href="{{ route('menu.index') }}">
						Меню
					</a>
				</li>
				<li class="breadcrumb-item">
					Редактировать
				</li>
			</ul>
		</div>

		@include('admin.widgets')

		<section class="content">
			<div class="card">

				<form action="{{ route('menu.update', $menu->id) }}" method="post">

					@csrf
					@method('put')

					<div class="card-header">
						<h4 class="mb-0 ">
							Редактировать меню
						</h4>
					</div>

					<div class="card-body">

						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="title">
									Название
								</label>

								<input type="text"
								       name="title"
								       class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
								       id="title"
								       placeholder="Введите название меню"
								       value="{{ $menu->title }}">

								@if ($errors->has('title'))
									<div class="invalid-feedback">
										{{ $errors->first('title') }}
									</div>
								@endif
							</div>

							<div class="form-group col-md-6">
								<label for="alias">
									Алиас
								</label>

								<input type="text"
								       name="alias"
								       class="form-control {{ $errors->has('alias') ? 'is-invalid' : '' }}"
								       id="alias"
								       placeholder="Введите алиас меню"
								       value="{{ $menu->alias }}">

								<small id="aliasHelp" class="form-text text-muted">
									Заполнится автоматически
								</small>

								@if ($errors->has('alias'))
									<div class="invalid-feedback">
										{{ $errors->first('alias') }}
									</div>
								@endif
							</div>
						</div>

						<div class="form-group">
							<label for="description">
								Описание
							</label>

							<textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"
							          name="description"
							          id="description"
							          placeholder="Введите описание для меню">{{ $menu->description }}</textarea>

							@if ($errors->has('description'))
								<div class="invalid-feedback">
									{{ $errors->first('description') }}
								</div>
							@endif
						</div>

						<div class="form-row">
							<div class="form-group col-md-3">
								<label for="language_id">
									Выбрать язык
								</label>

								<select id="language_id" name="language_id" class="form-control {{ $errors->has('language_id') ? 'is-invalid' : '' }}">
									<option selected disabled>Выбрать...</option>
									@foreach($languages as $language)
										<option {{ ($menu->language->id == $language->id) ? 'selected' : '' }}
										        value="{{ $language->id }}">
											{{ $language->title }}
										</option>
									@endforeach
								</select>

								@if ($errors->has('language_id'))
									<div class="invalid-feedback">
										{{ $errors->first('language_id') }}
									</div>
								@endif
							</div>
						</div>

						<div class="form-group">
							<div class="custom-control custom-checkbox">
								<input type="checkbox"
								       {{ ($menu->seo) ? 'checked' : ''}}
								       data-toggle="collapse"
								       role="button"
								       aria-expanded="false"
								       aria-controls="collapse_seo"
								       class="custom-control-input"
								       name="add_seo"
								       id="add_seo">

								<label class="custom-control-label" for="add_seo">
									Добавить Seo
								</label>
							</div>
						</div>

						<div class="collapse {{ ($menu->seo) ? 'show' : ''}}" id="collapse_seo">
							<div class="form-row">
								<div class="form-group col-md-6">
									<label for="seo_title">
										Seo title
									</label>

									<input type="text"
									       name="{{ ($menu->seo) ? 'seo_title' : ''}}"
									       class="form-control {{ $errors->has('seo_title') ? 'is-invalid' : '' }}"
									       id="seo_title"
									       placeholder="Введите title для seo"
									       value="{{ $menu->seo->seo_title ?? '' }}">

									<small id="seo_titleHelp" class="form-text text-muted">
										Необязательно
									</small>

									@if ($errors->has('seo_title'))
										<div class="invalid-feedback">
											{{ $errors->first('seo_title') }}
										</div>
									@endif
								</div>

								<div class="form-group col-md-6">
									<label for="seo_keywords">
										Seo keywords
									</label>

									<input type="text"
									       name="{{ ($menu->seo) ? 'seo_keywords' : ''}}"
									       class="form-control {{ $errors->has('seo_keywords') ? 'is-invalid' : '' }}"
									       id="seo_keywords"
									       placeholder="Введите keywords для seo"
									       value="{{ $menu->seo->seo_keywords ?? '' }}">

									<small id="seo_keywordsHelp" class="form-text text-muted">
										Необязательно
									</small>

									@if ($errors->has('seo_keywords'))
										<div class="invalid-feedback">
											{{ $errors->first('seo_keywords') }}
										</div>
									@endif
								</div>
							</div>

							<div class="form-group">
								<label for="seo_description">
									Seo description
								</label>

								<textarea class="form-control {{ $errors->has('seo_description') ? 'is-invalid' : '' }}"
								          name="{{ ($menu->seo) ? 'seo_description' : ''}}"
								          id="seo_description"
								          placeholder="Введите description для seo">{{ $menu->seo->seo_description ?? '' }}</textarea>

								<small id="seo_descriptionHelp" class="form-text text-muted">
									Необязательно
								</small>

								@if ($errors->has('seo_description'))
									<div class="invalid-feedback">
										{{ $errors->first('seo_description') }}
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
