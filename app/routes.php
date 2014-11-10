<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
App::setLocale('es');

// $fecha=date("d-m-Y H:i:s e");
// echo "hoy es el día: ";
// echo $fecha;
// die;

// Session Routes
Route::get('login',  array('as' => 'login', 'uses' => 'SessionController@create'));
Route::get('logout', array('as' => 'logout', 'uses' => 'SessionController@destroy'));
Route::resource('sessions', 'SessionController', array('only' => array('create', 'store', 'destroy')));

// User Routes
Route::get('register', 'UserController@create');
Route::get('users/{id}/activate/{code}', 'UserController@activate')->where('id', '[0-9]+');
Route::get('resend', array('as' => 'resendActivationForm', function()
{
	return View::make('users.resend');
}));
Route::post('resend', 'UserController@resend');
Route::get('forgot', array('as' => 'forgotPasswordForm', function()
{
	return View::make('users.forgot');
}));
Route::post('forgot', 'UserController@forgot');
Route::post('users/{id}/change', 'UserController@change');
Route::get('users/{id}/reset/{code}', 'UserController@reset')->where('id', '[0-9]+');
Route::get('users/{id}/suspend', array('as' => 'suspendUserForm', function($id)
{
	return View::make('users.suspend')->with('id', $id);
}));
Route::post('users/{id}/suspend', 'UserController@suspend')->where('id', '[0-9]+');
Route::get('users/{id}/unsuspend', 'UserController@unsuspend')->where('id', '[0-9]+');
Route::get('users/{id}/ban', 'UserController@ban')->where('id', '[0-9]+');
Route::get('users/{id}/unban', 'UserController@unban')->where('id', '[0-9]+');
Route::resource('users', 'UserController');


// Group Routes
Route::resource('groups', 'GroupController');

App::missing(function($exception)
{

		return Response::view('pages.404');
});



// Index
Route::get( '/', array(
		'as' => 'articulos.index',
		'uses' => 'ArticulosController@index'
) );

Route::get('/pages/{url_seo}', 'PagesController@show');



# Standard User Routes
Route::group(['before' => 'auth|standardUser'], function()
{

		Route::resource('contactos', 'ContactosController');
		Route::get('/contactos/{id}/delete', 'ContactosController@destroy');



		Route::get('/articulos/ver', 'ArticulosController@ver');
		Route::get('/articulos/{id}/delete', 'ArticulosController@destroy');
		Route::get('/articulos/{id}/publicar', 'ArticulosController@publicar');

		Route::get('/articulos/{id}/archivos/{padre}', 'ArchivosController@index');


		Route::resource('archivos', 'ArchivosController');
		Route::get('/archivos/{id}/delete', 'ArchivosController@destroy');



		Route::resource('articulos', 'ArticulosController');

		Route::resource('turnos', 'TurnosController');
		Route::get('/turnos/{id}/delete', 'TurnosController@destroy');


		Route::resource('ofertas', 'OfertasController');

		Route::resource('pages', 'PagesController');
		Route::get('/pages/{id}/delete', 'PagesController@destroy');

		Route::resource('banners', 'BannersController');
		Route::get('/banners/{id}/delete', 'BannersController@destroy');

		Route::get('/clasificados/{id}/delete', 'ClasificadosController@destroy');
		Route::get('/clasificados/{id}/publicar', 'ClasificadosController@publicar');
		Route::get('/clasificados/{id}/espera', 'ClasificadosController@espera');
		Route::get('/clasificados', 'ClasificadosController@index');


});



// Route::resource('clasificados', 'ClasificadosController');

Route::get( '/clasificados/create', array(
		'as' => 'clasificados.create',
		'uses' => 'ClasificadosController@create'
) );

Route::post( '/clasificados/store', array(
		'as' => 'clasificados.store',
		'uses' => 'ClasificadosController@store'
) );

Route::get( '/clasificados/{id}', array(
		'as' => 'clasificados.show',
		'uses' => 'ClasificadosController@show'
) );


Route::get('/articulos/show/{url_seo}', 'ArticulosController@show');
Route::get('/articulo/{url_seo}', 'ArticulosController@show');

Route::get('/', array('as' => 'home', 'uses' => 'ArticulosController@index'));





Route::resource('clasificadoscategorias', 'ClasificadoscategoriasController');






Route::group(['prefix' => 'api', 'after' => 'allowOrigin'], function() {

    Route::get('/polls/{page}', function ($page) {
        return Response::json(['status' => 200,'polls' => Poll::skip(($page - 1) * 5)
                ->take(5)
                ->get(['id', 'question'])->toArray()
        ]);
    });

    Route::get('/poll/{id}', function ($id) {
        $poll = Poll::find($id);
        //out going format: {"status":200,"poll":{"id":"1","question":"What is your preferred framework for 2014 ?","options":["Laravel","PhalconPHP","CakePHP"]}}
        return Response::json(['status' => 200, 'poll' => $poll->toArray()]);
    });

    Route::post('/poll/{id}/option', function ($id) {
        $option = Input::get('option');
        $poll = Poll::find($id);
        $options = implode(',', $poll->options);
        $rules = [
            'option' => 'in:' . $options,
        ];
        $valid = Validator::make(compact('option'), $rules);
        if ($valid->passes()) {
            $poll->stats()->where('option','=',$option)->increment('vote_count');
            return Response::json(['status' => 200, 'mesg' => 'saved successfully!']);
        } else
            return Response::json(['status' => 400, 'mesg' => 'option not allowed!'],400);

    });

    Route::get('/noticias', function () {

				$articulos = DB::table('articulos')
													->where('estado', '=', 'publicado')
													->orderBy('id', 'desc')->paginate(10);

				$result  = array();
				foreach ($articulos as $articulo) {

							$archivos = DB::table('archivos')
																->where('padre_id', '=', $articulo->id)
																->where('padre', '=', 'articulo')
																->first();

							$file_name = "";
							if ($archivos) {
								$file_name = $archivos->archivo;
							}

		    			$result[] = array(
							    "id_articulo" => $articulo->id,
							    "fecha" => $articulo->created_at,
							    "title" => $articulo->articulo,
									"copete" => $articulo->copete,
							    "visitas" => $articulo->visitas,
									"file_name" => $file_name
							);
				};

				header('HTTP/1.1 200 OK');
				header('Content-type: text/html');

				echo json_encode($result);
        return;
    });


		Route::get('/noticias/{id}', function ($id) {

				$articulo = DB::table('articulos')
													->where('id', '=', $id)
													->first();

				$archivo = DB::table('archivos')
													->where('padre_id', '=', $articulo->id)
													->where('padre', '=', 'articulo')
													->first();
				$file_name = "";
				if ($archivo) {
					$file_name = $archivo->archivo;
				}

							$result[] = array(
									"id_articulo" => $articulo->id,
									"fecha" => $articulo->created_at,
									"title" => $articulo->articulo,
									"copete" => $articulo->copete . " " . $articulo->texto,
									"visitas" => $articulo->visitas,
									"file_name" => $file_name
							);


				header('HTTP/1.1 200 OK');
				header('Content-type: text/html');

				echo json_encode($result);
				return;
		});



				Route::get('/clasificados', function () {

						$clasificados = DB::table('clasificados')
															->where('estado', '=', 'publicado')
															->orderBy('id', 'desc')->paginate(20);

						$result  = array();
						foreach ($clasificados as $clasificado) {

									$archivos = DB::table('archivos')
																		->where('padre_id', '=', $clasificado->id)
																		->where('padre', '=', 'clasificado')
																		->first();

						$clasificadoscategorias = DB::table('clasificadoscategorias')
															->where('id', '=', $clasificado->clasificadoscategorias_id)
															->first();

									$result[] = array(
											"id_clasificado" => $clasificado->id,
											"fecha" => $clasificado->created_at,
											"operacion" => $clasificado->operacion,
											"oferta" => $clasificado->clasificado,
											"precio" => $clasificado->precio,
											"email" => $clasificado->email,
											"telefono" => $clasificado->telefono,
											"categoria" => $clasificadoscategorias->clasificadoscategoria
									);
						};

						header('HTTP/1.1 200 OK');
						header('Content-type: text/html');

						echo json_encode($result);
						return;
				});



				Route::post('/enviarclasificado', function () {


					$result = var_dump(Input::All());

// // die;
// //
//
// // 'categorias_id' => 'exists:rubros,id'
//
// $rules = [
// 	'clasificado' => 'required',
// 	'precio' => 'required',
// 	'telefono' => 'required',
// ];
//
//
// if (! Clasificado::isValid(Input::all(),$rules)) {
//
// 	return Redirect::back()->withInput()->withErrors(Clasificado::$errors);
//
// }
//
// $clasificado = new Clasificado;
//
// //$clasificado->users_id = Sentry::getUser()->id;
// $clasificado->users_id = 1;
// $clasificado->operacion = Input::get('operacion');
// $clasificado->clasificadoscategorias_id = Input::get('clasificadoscategorias_id');
// $clasificado->clasificado = Input::get('clasificado');
// $clasificado->precio = Input::get('precio');
// $clasificado->telefono = Input::get('telefono');
// $clasificado->email = Input::get('email');
// $clasificado->estado = 'espera';
// $url_seo = Input::get('clasificado');
// $url_seo = $this->url_slug($url_seo) . date('ljSFY');
//
// $clasificado->url_seo = $url_seo;
//
// $clasificado->save();
//
//
// 						$clasificados = DB::table('clasificados')
// 															->where('estado', '=', 'publicado')
// 															->orderBy('id', 'desc')->paginate(20);
//
//

						header('HTTP/1.1 200 OK');
						header('Content-type: text/html');

						echo json_encode($result);
						return;
				});


});
