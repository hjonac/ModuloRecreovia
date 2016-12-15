<?php
session_start();
/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/personas', '\Idrd\Usuarios\Controllers\PersonaController@index');
Route::get('/personas/service/obtener/{id}', '\Idrd\Usuarios\Controllers\PersonaController@obtener');
Route::get('/personas/service/buscar/{key}', '\Idrd\Usuarios\Controllers\PersonaController@buscar');
Route::get('/personas/service/ciudad/{id_pais}', '\Idrd\Usuarios\Controllers\LocalizacionController@buscarCiudades');
Route::post('/personas/service/procesar/', '\Idrd\Usuarios\Controllers\PersonaController@procesar');

Route::get('/parques/service/buscar/{key}', '\Idrd\Parques\Controllers\ParqueController@buscar');

Route::any('/logout', 'MainController@logout');
Route::any('/', 'MainController@index');

//rutas con filtro de autenticación
Route::group(['middleware' => ['web']], function() 
{
	Route::get('/welcome', 'MainController@welcome');

	route::get('/jornadas', 'Recreovia\JornadaController@index');
	route::get('/jornadas/crear', 'Recreovia\JornadaController@crear');
	route::get('/jornadas/{id}/editar', 'Recreovia\JornadaController@editar');
	route::get('/jornadas/{id}/eliminar', 'Recreovia\JornadaController@eliminar');
	route::post('/jornadas/procesar', 'Recreovia\JornadaController@procesar');

	Route::get('/puntos', 'Recreovia\PuntosController@index');
	Route::get('/puntos/service/buscar/{key}', 'Recreovia\PuntosController@buscar');
	Route::get('/puntos/service/obtener/{id}', 'Recreovia\PuntosController@obtener');
	Route::get('/puntos/crear/', 'Recreovia\PuntosController@crear');
	Route::get('/puntos/{id}/editar', 'Recreovia\PuntosController@editar');
	Route::get('/puntos/{id}/eliminar', 'Recreovia\PuntosController@eliminar');
	Route::post('/puntos/procesar/', 'Recreovia\PuntosController@procesar');
	
	Route::get('/profesores', 'Recreovia\ProfesoresController@index');
	Route::get('/profesores/service/buscar/{key}/{strict?}', 'Recreovia\ProfesoresController@buscar');
	Route::get('/profesores/service/obtener/{id}', 'Recreovia\ProfesoresController@obtener');
	Route::get('/profesores/crear', 'Recreovia\ProfesoresController@crear');
	Route::get('/profesores/{id}/editar', 'Recreovia\ProfesoresController@editar');
	Route::get('/profesores/{id}/eliminar', 'Recreovia\ProfesoresController@eliminar');
	Route::post('/profesores/procesar', 'Recreovia\ProfesoresController@procesar');

	Route::get('/localidades/administrar', 'Recreovia\LocalidadController@index');
	Route::get('/localidades/{id_localidad}/administrar/{id_punto?}', 'Recreovia\LocalidadController@editar');
	Route::get('/localidades/{id_localidad}/punto/{id_punto}/personal/{id_persona}/remover', 'Recreovia\LocalidadController@removerPersonal');
	Route::post('/localidades/personal/agregar', 'Recreovia\LocalidadController@agregarPersonal');

	route::get('/programacion', 'Recreovia\ProgramacionController@index');
	route::get('/programacion/crear', 'Recreovia\ProgramacionController@crear');
	route::get('/programacion/{id_cronograma}/editar', 'Recreovia\ProgramacionController@editar');
	route::get('/programacion/{id_cronograma}/eliminar', 'Recreovia\ProgramacionController@eliminar');
	route::post('/programacion/procesar', 'Recreovia\ProgramacionController@procesar');

	route::get('/gestores/sesiones', 'Recreovia\SesionController@sesionesGestor');
	route::get('/gestores/{id_cronograma}/sesiones', 'Recreovia\SesionController@crearSesionesGestor');
	route::get('/gestores/{id_cronograma}/sesiones/{id_sesion}/editar', 'Recreovia\SesionController@editarSesionesGestor');
	route::get('/gestores/{id_cronograma}/sesiones/{id_sesion}/eliminar', 'Recreovia\SesionController@eliminarSesionesGestor');
	route::post('/gestores/sesiones/procesar', 'Recreovia\SesionController@procesarGestor');
	route::get('/gestores/sesiones/{id_sesion}/editar', 'Recreovia\SesionController@editarSesionGestor');

	route::get('/profesores/sesiones', 'Recreovia\SesionController@sesionesProfesor');
	route::get('/profesores/sesiones/{id_sesion}/editar', 'Recreovia\SesionController@editarSesionProfesor');
	route::post('/sesiones/procesar', 'Recreovia\SesionController@procesarProfesor');
});
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/