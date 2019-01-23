<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\MainController;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Models\Language;

class LanguagesController extends MainController
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$languages = Language::all();
		return view('admin.languages.index', compact('languages'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return view('admin.languages.add');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		if($request->isMethod('post')){

			$this->_validate($request);

			Language::create($request->except('_token'));
			return redirect(route('languages.index'))->with('success', 'Вы добавили новый язык для сайта');
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  Language  $language
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Language $language)
	{
		return view('admin.languages.edit', compact('language'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  Language  $language
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Language $language)
	{
		if($request->isMethod('put')){

			$this->_validate($request, $language->id);

			$language->title = $request->title;
			$language->alias = $request->alias;

			if($language->update()){
				return redirect(route('languages.index'))->with('success', 'Вы добавили новый язык для сайта');
			}
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  Request  $request
	 * @param  Language  $language
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Request $request, Language $language)
	{
		if($request->isMethod('delete')){
			$language->delete();
			return redirect(route('languages.index'))->with('success', 'Вы удалили язык для сайта');
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
			'alias' => ($id)
				?  ['required', 'string', 'min:1', 'max:255', Rule::unique('languages')->ignore($id),]
				: 'required|string|min:1|max:255|unique:languages',
		];

		$this->validate($request, $rules);
	}
}
