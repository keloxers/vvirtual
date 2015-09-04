<?php

class ProfesionalsController extends BaseController {


	/**
	* Display a listing of the resource.
	*
	* @return Response
	*/
	public function index()
	{


		$profesionals = DB::table('profesionals')
		->orderBy('id', 'dec')
		->paginate(10);

		return View::make('profesionals.index', array('profesionals' => $profesionals));

	}


	/**
	* Show the form for creating a new resource.
	*
	* @return Response
	*/
	public function create()
	{
		return View::make('clasificados.create');
	}

	/**
	* Store a newly created resource in storage.
	*
	* @return Response
	*/
	public function store()
	{

		// var_dump(Input::All());
		// die;
		//

		// 'categorias_id' => 'exists:rubros,id'

		$rules = [
			'clasificado' => 'required',
			'precio' => 'required',
			'telefono' => 'required',

		];


		if (! Clasificado::isValid(Input::all(),$rules)) {

			return Redirect::back()->withInput()->withErrors(Clasificado::$errors);

		}

		$clasificado = new Clasificado;

		//$clasificado->users_id = Sentry::getUser()->id;
		$clasificado->users_id = 1;
		$clasificado->operacion = Input::get('operacion');
		$clasificado->clasificadoscategorias_id = Input::get('clasificadoscategorias_id');
		$clasificado->clasificado = Input::get('clasificado');
		$clasificado->precio = Input::get('precio');

		if (is_numeric ($clasificado->precio)) {

		} else {
			$clasificado->precio = 0;
		}

		$clasificado->telefono = Input::get('telefono');
		$clasificado->email = Input::get('email');
		$clasificado->estado = 'espera';
		$url_seo = Input::get('clasificado');
		$url_seo = $this->url_slug($url_seo) . date('ljSFY');

		$clasificado->url_seo = $url_seo;

		$clasificado->save();


		$file = Input::file('file');


		if($file) {


			$filename = $file->getClientOriginalName();
			$extension = $file->getClientOriginalExtension();

			$destinationPath = public_path() . '/uploads/original/';
			$destinationPath_big = public_path() . '/uploads/big/';
			$destinationPath_crop = public_path() . '/uploads/crop/';


			$upload_success = Input::file('file')->move($destinationPath, $filename);

			if ($upload_success) {

				$image = Image::make($destinationPath . $filename)->resize(800, null, true)->save($destinationPath_big . $filename);
				$image = Image::make($destinationPath . $filename)->resize(640, null, true)->crop(240, 160, true)->save($destinationPath_crop . $filename);

				File::delete($destinationPath . $filename);

				$arch = new Archivo;

				$arch->archivo = $filename;
				$arch->descripcion = "";
				$arch->padre_id = $clasificado->id;
				$arch->padre = "clasificado";

				$arch->save();

			}



		}



		return Redirect::to('/clasificadoscategorias/' . Input::get('clasificadoscategorias_id') );

	}

	/**
	* Display the specified resource.
	*
	* @param  int  $id
	* @return Response
	*/
	public function show($id)
	{


		// $clasificado = DB::table('clasificados')
		// 	->where('id', '=', $id)
		// 	->first();

		$clasificado = Clasificado::find($id);



		$clasificado->visitas++;
		$clasificado->save();
		// show the view and pass the nerd to it



		return View::make('clasificados.show', array(
			'clasificado' => $clasificado,
		));
	}




	/**
	* Show the form for editing the specified resource.
	*
	* @param  int  $id
	* @return Response
	*/
	public function edit($id)
	{
		$articulo = Articulo::find($id);
		$title = "Editar Articulo";

		return View::make('articulos.edit', array('title' => $title, 'articulo' => $articulo));
	}

	/**
	* Update the specified resource in storage.
	*
	* @param  int  $id
	* @return Response
	*/
	public function update($id)
	{



		$articulo = Articulo::find($id);

		// $rules = [
		// 	'articulo' => 'required|unique:articulos,articulo,' . $id,
		// 	'rubros_id' => 'exists:rubros,id',
		// 	'proveedors_id' => 'exists:proveedors,id',
		// 	'precio_base' => 'required|numeric',
		// 	'utilidad' => 'required|numeric',
		// 	'precio_publico' => 'required|numeric',
		// 	'iva' => 'required|numeric'
		// ];
		//
		//
		//
		// if (! Articulo::isValid(Input::all(),$rules)) {
		//
		// 	return Redirect::back()->withInput()->withErrors(Articulo::$errors);
		//
		// }


		$articulo->articulo = Input::get('articulo');
		$articulo->categorias_id = Input::get('categorias_id');
		$articulo->copete = Input::get('copete');
		$articulo->tipo = Input::get('tipo');
		$articulo->texto = Input::get('texto');

		$articulo->save();

		return Redirect::to('/articulos/ver');


	}

	/**
	* Remove the specified resource from storage.
	*
	* @param  int  $id
	* @return Response
	*/
	public function destroy($id)
	{

		$input = Input::all();


		$clasificado = Clasificado::find($id)->delete();

		return Redirect::to('/clasificados');
	}


	/**
	* Remove the specified resource from storage.
	*
	* @param  int  $id
	* @return Response
	*/
	public function publicar($id)
	{

		$clasificado = Clasificado::find($id);
		$clasificado->estado = 'publicado';
		$clasificado->save();

		return Redirect::to('/clasificados');
	}


	/**
	* Remove the specified resource from storage.
	*
	* @param  int  $id
	* @return Response
	*/
	public function espera($id)
	{

		$clasificado = Clasificado::find($id);
		$clasificado->estado = 'espera';
		$clasificado->save();

		return Redirect::to('/clasificados');
	}





	/**
	* Display the specified resource.
	*
	* @param  int  $id
	* @return Response
	*/
	public function showcategorias()
	{


		$profesionalscategorias = DB::table('profesionalscategorias')
			->orderby('profesionalscategoria')
			->get();

		return View::make('profesionals.showcategorias', array(
			'profesionalscategorias' => $profesionalscategorias,
		));
	}


		/**
		* Display the specified resource.
		*
		* @param  int  $id
		* @return Response
		*/
		public function showall($profesionalscategoria)
		{


			$profesionalscategorias = DB::table('profesionalscategorias')
				->where('profesionalscategoria',$profesionalscategoria)
				->first();

				if ($profesionalscategorias) {

					$profesionalscategorias_id = $profesionalscategorias->id;

					$profesionals = DB::table('profesionals')
						->where('profesionalscategorias_id',$profesionalscategorias_id)
						->where('estado','publicado')
						->get();

						return View::make('profesionals.showall', array(
							'profesionals' => $profesionals,
							'profesionalscategoria' => $profesionalscategorias->profesionalscategoria,
						));



				}

		}





		/**
		* Display the specified resource.
		*
		* @param  int  $id
		* @return Response
		*/
		public function showprofesional($id)
		{


			$profesional = DB::table('profesionals')
				->where('id',$id)
				->where('estado','publicado')
				->first();

				if ($profesional) {

					$id = $profesional->id;

					$profesional = Profesional::find($id);
					$profesional->visitas = $profesional->visitas + 1;
					$profesional->save();

					$profesionalscategorias = DB::table('profesionalscategorias')
						->where('id',$profesional->profesionalscategorias_id)
						->first();


						return View::make('profesionals.showprofesional', array(
							'profesional' => $profesional,
							'profesionalscategorias' => $profesionalscategorias,
						));



				}

		}

}
