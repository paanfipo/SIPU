<?php


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

//Links Publicos
Route::post('getAjaxCiudadesDepartamento', 'CiudadController@getAjaxCiudadesDepartamento')->name('ciudad.getAjaxCiudades');
Route::get('linkPublicoRegistro/{convocatoria_id}','ConvocatoriaController@linkPublicoRegistro')->name('convocatoria.linkPublicoRegistro');
Route::post('accionLinkPublicoRegistro','ConvocatoriaController@accionLinkPublicoRegistro')->name('linkPublicoRegistro.registro');
Route::get('email','HomeController@email')->name('HomeController.email');
Route::get('registro/empresa','Auth\RegisterController@empresa')->name('registro.empresa');
Route::post('crear/empresa','Auth\RegisterController@registroEmpresa')->name('crear.empresa');

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

Route::resource('base','BaseController');

//Route::get('email','BaseController@email');

Route::group(['prefix' => 'config', 'middleware' => ['auth', 'verified']], function() {

    //Roles
    Route::resource('roles','RolController');

    //Paquetes
    Route::resource('paquetes','PaqueteController');

    //Modulos
    Route::resource('modulos','ModuloController');

    //Permisos
    Route::resource('permisos','PermisoController');

});

Route::group(['prefix' => 'basicos', 'middleware' => ['auth', 'verified']], function() {

    //Usuarios
    Route::resource('usuarios','UsuarioController');
    Route::get('usuarios/HojaVida/{id}','UsuarioController@showHojaVida')->name('usuario.hojaVida');
    Route::get('usuarios/HojaVida/D10/{id}','UsuarioController@generarD10')->name('usuario.D10');
    Route::post('usuarios/actionHojaVida/{id}','UsuarioController@actionHojaVida')->name('usuario.savecv');

    //Notificaciones
    Route::group(['prefix' => 'usuarios/notificaciones'], function() {
        Route::get('markAsRead', 'UsuarioController@markAsRead')->name('notification.markAsRead');
        Route::get('dowloandEmpresa/{id}/{tipo}', 'UsuarioController@dowloandFIleEmpresa')->name('usuario.fileEmpresa');
    }); 

    //Emprendimientos
    Route::group(['prefix' => 'usuarios/emprendimietos'], function() {
        Route::get('listar/{id}','UsuarioController@emprendimientos')->name('listar.emprendimiento');
        Route::get('crear/{id}','UsuarioController@crearEmprendimiento')->name('crear.emprendimiento');
        Route::post('guardar','UsuarioController@guardarEmprendimiento')->name('guardar.emprendimiento');
        Route::post('ajaxGuardarEmprendimiento','UsuarioController@ajaxGuardarEmprendimiento')->name('emprendimiento.ajaxGuardarEmprendimiento');
        Route::post('ajaxGetEmprendimiento','UsuarioController@ajaxGetEmprendimiento')->name('emprendimiento.ajaxGetEmprendimiento');
        Route::post('ajaxListarEmprendimientos','UsuarioController@ajaxListarEmprendimientos')->name('emprendimiento.ajaxListarEmprendimientos');       
        
    });
    

    //Paises
    Route::resource('paises','PaisController');

    //Departamentos
    Route::resource('departamentos','DepartamentoController');

    //Ciudades
    Route::resource('ciudades','CiudadController');

    //Ajax
    Route::post('ajaxCiudadesPais', 'CiudadController@ajaxCiudadesPais')->name('basicos.ajaxCiudadesPais');

    //Tipo Maestro
    Route::resource('tiposmaestro','TipoMaestroController');

    //Tipo Maestro Item
    Route::resource('tiposmaestroitem','TipoMaestroItemController');

    
});

Route::group(['prefix' => 'emprendimiento', 'middleware' => ['auth', 'verified']], function() {

    //Convocatorias
    Route::resource('convocatorias','ConvocatoriaController');
    Route::group(['prefix' => 'convocatoria'], function() {
        Route::get('registrarse/{id}','ConvocatoriaController@registrarse')->name('convocatoria.registrarse');
        Route::post('checkin','ConvocatoriaController@checkin')->name('convocatoria.checkin');
        Route::get('avance/{id}','ConvocatoriaController@avance')->name('convocatoria.avance');
        Route::get('upload/{id}','ConvocatoriaController@registroMasivo')->name('convocatoria.registroMasivo');
        Route::post('import','ConvocatoriaController@importRegistro')->name('convocatoria.importRegistro');
        Route::get('downloadFileImport', 'ConvocatoriaController@downloadFileImport')->name('convocatoria.downloadFileImport');
        Route::get('hojaVida/{user_id}/{convocatoria_id}/{etapa_id}', 'ConvocatoriaController@hojaVida')->name('convocatoria.hojaVida');        
        Route::post('ajaxSetEmprendimiento','ConvocatoriaController@ajaxSetEmprendimiento')->name('convocatoria.ajaxSetEmprendimiento');
        Route::get('reporte/{id}','ConvocatoriaController@reporte')->name('convocatorias.reporte');
    });    

    //Etapas
    Route::resource('etapas','EtapaController');

    //Carrera
    Route::resource('carreras','CarreraController');

    //Dependencias
    Route::resource('dependencias','DependenciaController');

    //Actividades
    Route::resource('actividades','ActividadController');

     //Cronograma
     Route::resource('cronogramas','CronogramaController');

     //Asistencia
     Route::resource('asistencias','AsistenciaController');

     Route::group(['prefix' => 'asistencia'], function() {
        Route::post('setAjaxAsistencia','AsistenciaController@setAjaxAsistencia')->name('asistencia.setAjaxAsistencia');
        Route::post('setAjaxAllAsistencia','AsistenciaController@setAjaxAllAsistencia')->name('asistencia.setAjaxAllAsistencia');
        Route::get('caracterizacion/sensibilizacion/{convocatoria}/{user}','AsistenciaController@caracterizacion_sensibilizacion')->name('asistencia.caracterizacion_sensibilizacion');
        Route::post('caracterizacion/sensibilizacion','AsistenciaController@set_caracterizacion_sensibilizacion')->name('asistencia.set_caracterizacion_sensibilizacion');

        Route::get('caracterizacion/empresarial/{convocatoria}/{user}','AsistenciaController@caracterizacion_empresarial')->name('asistencia.caracterizacion_empresarial');
        Route::post('caracterizacion/empresarial','AsistenciaController@set_caracterizacion_empresarial')->name('asistencia.set_caracterizacion_empresarial');

        Route::post('generarAsistencia','AsistenciaController@generarAsistencia')->name('asistencia.generarAsistencia');
        Route::post('ajaxSetAsesor','AsistenciaController@ajaxSetAsesor')->name('asistencia.ajaxSetAsesor');

     });

     //Gestiones
     Route::group(['prefix' => 'gestiones'], function() {
        Route::get('','GestionesController@index')->name('gestiones.index');
        Route::get('tramites/{id}','GestionesController@tramites')->name('gestiones.tramites');
        Route::get('novedades/{cronograma}/{inscripto?}','GestionesController@novedades')->name('gestiones.novedades');
        Route::post('setAjaxNovedad','GestionesController@setAjaxNovedad')->name('gestiones.setAjaxNovedad');
        Route::post('getAjaxNovedad','GestionesController@getAjaxNovedad')->name('gestiones.getAjaxNovedad');
        Route::get('documentacion/{cronograma}','GestionesController@documentacion')->name('gestiones.documentacion');
        Route::post('store-file','GestionesController@uploadFile')->name('gestiones.store-file');
        Route::get('downloadFile/{file?}/{num?}', 'GestionesController@downloadFile')->name('gestiones.downloadFile');
        Route::post('getFileInscripto', 'GestionesController@getFileInscripto')->name('gestiones.getFileInscripto');
     });

});

//Grupo de rutas del paquete Vacantes
Route::group(['prefix' => 'vacantes', 'middleware' => ['auth', 'verified']], function() {

    //Ofertas
    Route::resource('ofertas', 'OfertaController');
    Route::group(['prefix' => 'ofertas'], function() {
        Route::get('{id}/postular','OfertaController@postular')->name('ofertas.postular');
        Route::post('postularEstudiante/{id}','OfertaController@postularEstudiante')->name('ofertas.postularEstudiante');
        Route::get('{id}/retirar','OfertaController@retirar')->name('ofertas.retirar');
        Route::get('downloadFile/{user_id}/{tipo}', 'OfertaController@downloadFile')->name('ofertas.downloadFile');
        Route::get('uploadFileOferta/{id}','OfertaController@uploadFileOferta')->name('ofertas.uploadFileOferta');
        Route::post('uploadFile/{id}','OfertaController@uploadFile')->name('ofertas.uploadFile');
    });

    Route::resource('tramites', 'TramitesController');
    
    Route::group(['prefix' => 'tramites'], function() {
        Route::get('{id}/admitirPostulacion','TramitesController@admitirPostulacion');        
        Route::post('admitirPostulacion','TramitesController@admitirPostulacion')->name('tramites.admitirPostulacion');        
        Route::get('{id}/rechazarPostulacion','TramitesController@rechazarPostulacion')->name('tramites.rechazarPostulacion');        
        Route::get('vinculacion/{user_id}/{id}','TramitesController@vinculacion')->name('tramites.vinculacion');        
    });

});


Route::group(['prefix' => 'programacion', 'middleware' => ['auth', 'verified']], function() {
    Route::resource('salones',    'SalonesController');
    Route::resource('programas',  'ProgramasController');
});