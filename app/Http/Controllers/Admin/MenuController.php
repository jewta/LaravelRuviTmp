<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\MainController;
use Illuminate\Validation\Rule;

use App\Models\Menu;

class MenuController extends MainController
{
	/**
	 * Показывает страницу со всеми меню
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$menus = Menu::orderBy('created_at', 'deck')->paginate(20);
		return view('admin.menu.index', compact('menus'));
	}

	/**
	 * Показывает страницу добавления нового меню
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return view('admin.menu.add');
	}

	/**
	 * Создает новое меню на сайте
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		if($request->isMethod('post')){

			$this->_validate($request);

			$input = $request->except(['_token', 'add_seo', 'seo_title', 'seo_keywords', 'seo_description']);
			$input['is_active'] = true;
			$input['alias'] = ($request->alias)
				? $request->alias
				: $this->_translit($request->title);

			if($menu = Menu::create($input)){
				if($request->add_seo){
					$menu->seo()->create(
						$request->only(['seo_title', 'seo_keywords', 'seo_description', 'language_id'])
					);
				}

				return redirect(route('menu.index'))->with('success', 'Вы добавили новое меню на сайт');
			}
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Menu  $menu
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Menu $menu)
	{
		return view('admin.menu.edit', compact('menu'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\Menu  $menu
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Menu $menu)
	{
		if($request->isMethod('put')){
			$this->_validate($request, $menu->id);

			$menu->title = $request->title;
			$menu->alias = ($request->alias) ? $request->alias : $this->_translit($request->title);
			$menu->description = $request->description;
			$menu->language_id = $request->language_id;

			if($menu->update()){
				if($request->add_seo){
					if($menu->seo){
						$menu->seo()->update(
							$request->only(['seo_title', 'seo_keywords', 'seo_description', 'language_id'])
						);
					}
					else{
						$menu->seo()->create(
							$request->only(['seo_title', 'seo_keywords', 'seo_description', 'language_id'])
						);
					}
				}
				return redirect(route('menu.index'))->with('success', 'Вы отредактировали меню сайта');
			}
		}
	}

	/**
	 * Удаляет меню сайта
	 *
	 * @param  Request  $request
	 * @param  \App\Models\Menu  $menu
	 */
	public function destroy(Request $request, Menu $menu)
	{
		if($request->isMethod('delete')){
			$menu->seo()->delete();
			$menu->delete();

			return redirect(route('menu.index'))->with('success', 'Вы удалили меню');
		}
	}

	/**
	 * Валидация
	 *
	 * @param  Request  $request
	 * @param  string  $id=null
	 * @return \Illuminate\Http\Response
	 */
	protected function _validate($request, $id=null)
	{
		$rules = [
			'title' => 'required|string|min:3|max:255',
			'language_id' => 'required',
		];

		if($request->description) $rules['description'] = 'string|min:3|max:255';
		if($request->seo_title) $rules['seo_title'] = 'string|min:3|max:255';
		if($request->seo_keywords) $rules['seo_keywords'] = 'string|min:3|max:255';
		if($request->seo_description) $rules['seo_description'] = 'string|min:3|max:255';

		if($request->alias){
			$rules['alias'] = ($id)
				? ['string', 'min:1', 'max:255', Rule::unique('menus')->ignore($id),]
				: 'string|min:1|max:255|unique:menus';
		}

		$this->validate($request, $rules);
	}
}
