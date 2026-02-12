<?php

// Inicio
Breadcrumbs::register('home', function ($breadcrumbs) {
    $breadcrumbs->push('Home', route('home'));
});

//===============================================================Modulos Config

//Roles
Breadcrumbs::register('roles.index', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Roles', route('roles.index'));
});

Breadcrumbs::register('roles.create', function ($breadcrumbs) {
    $breadcrumbs->parent('roles.index');
    $breadcrumbs->push('Crear Rol', route('roles.create'));
});

Breadcrumbs::register('roles.update', function ($breadcrumbs,$rol) {
    $breadcrumbs->parent('roles.index');
    $breadcrumbs->push($rol->name, route('roles.update',$rol->id));
});

//Paquetes
Breadcrumbs::register('paquetes.index', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Paquetes', route('paquetes.index'));
});

Breadcrumbs::register('paquetes.create', function ($breadcrumbs) {
    $breadcrumbs->parent('paquetes.index');
    $breadcrumbs->push('Crear Paquete', route('paquetes.create'));
});

Breadcrumbs::register('paquetes.update', function ($breadcrumbs,$paquete) {
    $breadcrumbs->parent('paquetes.index');
    $breadcrumbs->push($paquete->name, route('paquetes.update',$paquete->id));
});

//Modulos
Breadcrumbs::register('modulos.index', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Modulos', route('modulos.index'));
});

Breadcrumbs::register('modulos.create', function ($breadcrumbs) {
    $breadcrumbs->parent('modulos.index');
    $breadcrumbs->push('Crear Modulo', route('modulos.create'));
});

Breadcrumbs::register('modulos.update', function ($breadcrumbs,$modulo) {
    $breadcrumbs->parent('modulos.index');
    $breadcrumbs->push($modulo->name, route('modulos.update',$modulo->id));
});

//Permisos
Breadcrumbs::register('permisos.index', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Permisos', route('permisos.index'));
});

Breadcrumbs::register('permisos.create', function ($breadcrumbs) {
    $breadcrumbs->parent('permisos.index');
    $breadcrumbs->push('Crear Permiso', route('permisos.create'));
});

Breadcrumbs::register('permisos.update', function ($breadcrumbs,$permiso) {
    $breadcrumbs->parent('permisos.index');
    $breadcrumbs->push($permiso->name, route('permisos.update',$permiso->id));
});

//===============================================================Modulos Basicos

//Tipo Maestro Item
Breadcrumbs::register('tiposmaestroitem.index', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Tipo Maestro Item', route('tiposmaestroitem.index'));
});

Breadcrumbs::register('tiposmaestroitem.create', function ($breadcrumbs) {
    $breadcrumbs->parent('tiposmaestroitem.index');
    $breadcrumbs->push('Crear Tipo Maestro Item', route('tiposmaestroitem.create'));
});

Breadcrumbs::register('tiposmaestroitem.update', function ($breadcrumbs,$tiposmaestroitem) {
    $breadcrumbs->parent('tiposmaestroitem.index');
    $breadcrumbs->push($tiposmaestroitem->nombre, route('tiposmaestroitem.update',$tiposmaestroitem->id));
});

//Tipo Maestro
Breadcrumbs::register('tiposmaestro.index', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Tipo Maestro', route('tiposmaestro.index'));
});

Breadcrumbs::register('tiposmaestro.create', function ($breadcrumbs) {
    $breadcrumbs->parent('tiposmaestro.index');
    $breadcrumbs->push('Crear Tipo Maestro', route('tiposmaestro.create'));
});

Breadcrumbs::register('tiposmaestro.update', function ($breadcrumbs,$tipomaestro) {
    $breadcrumbs->parent('tiposmaestro.index');
    $breadcrumbs->push($tipomaestro->nombre, route('tiposmaestro.update',$tipomaestro->id));
});

//Pais
Breadcrumbs::register('paises.index', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Pais', route('paises.index'));
});

Breadcrumbs::register('paises.create', function ($breadcrumbs) {
    $breadcrumbs->parent('paises.index');
    $breadcrumbs->push('Crear Pais', route('paises.create'));
});

Breadcrumbs::register('paises.update', function ($breadcrumbs,$pais) {
    $breadcrumbs->parent('paises.index');
    $breadcrumbs->push($pais->nombre, route('paises.update',$pais->id));
});


//Departamentos
Breadcrumbs::register('departamentos.index', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Departamentos', route('departamentos.index'));
});

Breadcrumbs::register('departamentos.create', function ($breadcrumbs) {
    $breadcrumbs->parent('departamentos.index');
    $breadcrumbs->push('Crear Departamento', route('departamentos.create'));
});

Breadcrumbs::register('departamentos.update', function ($breadcrumbs,$departamento) {
    $breadcrumbs->parent('departamentos.index');
    $breadcrumbs->push($departamento->nombre, route('departamentos.update',$departamento->id));
});

//Ciudades
Breadcrumbs::register('ciudades.index', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Ciudades', route('ciudades.index'));
});

Breadcrumbs::register('ciudades.create', function ($breadcrumbs) {
    $breadcrumbs->parent('ciudades.index');
    $breadcrumbs->push('Crear Ciudad', route('ciudades.create'));
});

Breadcrumbs::register('ciudades.update', function ($breadcrumbs,$ciudad) {
    $breadcrumbs->parent('ciudades.index');
    $breadcrumbs->push($ciudad->nombre, route('ciudades.update',$ciudad->id));
});

//Usuarios
Breadcrumbs::register('usuarios.index', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Usuarios', route('usuarios.index'));
});

Breadcrumbs::register('usuarios.create', function ($breadcrumbs) {
    $breadcrumbs->parent('usuarios.index');
    $breadcrumbs->push('Crear Usuario', route('usuarios.create'));
});

Breadcrumbs::register('usuarios.update', function ($breadcrumbs,$usuario) {
    $breadcrumbs->parent('usuarios.index');
    $breadcrumbs->push($usuario->name, route('usuarios.update',$usuario->id));
});

Breadcrumbs::register('usuario.hojaVida', function ($breadcrumbs,$usuario) {
    $breadcrumbs->parent('usuarios.index');
    $breadcrumbs->push('Hoja de vida', route('usuario.hojaVida',$usuario->id));
});

Breadcrumbs::register('listar.emprendimiento', function ($breadcrumbs,$usuario) {
    $breadcrumbs->parent('usuarios.index');
    $breadcrumbs->push('Emprendimientos', route('listar.emprendimiento',$usuario->id));
});

Breadcrumbs::register('crear.emprendimiento', function ($breadcrumbs,$usuario) {
    $breadcrumbs->parent('listar.emprendimiento',$usuario);
    $breadcrumbs->push('Crear Emprendimiento', route('crear.emprendimiento',$usuario->id));
});

//Carreras
Breadcrumbs::register('carreras.index', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Carreras', route('carreras.index'));
});

Breadcrumbs::register('carreras.create', function ($breadcrumbs) {
    $breadcrumbs->parent('carreras.index');
    $breadcrumbs->push('Crear Carrera', route('carreras.create'));
});

Breadcrumbs::register('carreras.update', function ($breadcrumbs,$carrera) {
    $breadcrumbs->parent('carreras.index');
    $breadcrumbs->push($carrera->nombre, route('carreras.update',$carrera->id));
});

//Dependencias
Breadcrumbs::register('dependencias.index', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Dependencias', route('dependencias.index'));
});

Breadcrumbs::register('dependencias.create', function ($breadcrumbs) {
    $breadcrumbs->parent('dependencias.index');
    $breadcrumbs->push('Crear Dependencia', route('dependencias.create'));
});

Breadcrumbs::register('dependencias.update', function ($breadcrumbs, $dependencia) {
    $breadcrumbs->parent('dependencias.index');
    $breadcrumbs->push($dependencia->nombre, route('dependencias.update',$dependencia->id));
});

//===============================================================Modulos SIPU

//Convocatoria
Breadcrumbs::register('convocatorias.index', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Convocatorias', route('convocatorias.index'));
});

Breadcrumbs::register('convocatorias.create', function ($breadcrumbs) {
    $breadcrumbs->parent('convocatorias.index');
    $breadcrumbs->push('Crear Convocatoria', route('convocatorias.create'));
});

Breadcrumbs::register('convocatorias.update', function ($breadcrumbs,$convocatoria) {
    $breadcrumbs->parent('convocatorias.index');
    $breadcrumbs->push($convocatoria->nombre, route('convocatorias.update',$convocatoria->id));
});

Breadcrumbs::register('convocatoria.registrarse', function ($breadcrumbs,$id) {
    $breadcrumbs->parent('convocatorias.index');
    $breadcrumbs->push("Registrarse", route('convocatoria.registrarse',$id));
});

Breadcrumbs::register('convocatorias.avance', function ($breadcrumbs,$convocatoria) {
    $breadcrumbs->parent('convocatorias.index');
    $breadcrumbs->push("Avance ".$convocatoria->nombre, route('convocatoria.avance',$convocatoria->id));
});

Breadcrumbs::register('convocatorias.hojaVida', function ($breadcrumbs,$user,$convocatoria,$etapa) {
    $breadcrumbs->parent('convocatorias.avance',$convocatoria);
    $breadcrumbs->push("Hoja de vida ".$user->name, route('convocatoria.hojaVida',[$user->id,$convocatoria->id,$etapa->id]));
});

Breadcrumbs::register('convocatorias.import', function ($breadcrumbs,$convocatoria) {
    $breadcrumbs->parent('convocatorias.index');
    $breadcrumbs->push("Registro masivo ".$convocatoria->nombre, route('convocatoria.registroMasivo',$convocatoria->id));
});

Breadcrumbs::register('convocatorias.reporte', function ($breadcrumbs,$convocatoria) {
    $breadcrumbs->parent('convocatorias.index');
    $breadcrumbs->push("Reporte ".$convocatoria->nombre, route('convocatorias.reporte',$convocatoria->id));
});



//Etapa
Breadcrumbs::register('etapas.index', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Etapas', route('etapas.index'));
});

Breadcrumbs::register('etapas.create', function ($breadcrumbs) {
    $breadcrumbs->parent('etapas.index');
    $breadcrumbs->push('Crear Etapa', route('etapas.create'));
});

Breadcrumbs::register('etapas.update', function ($breadcrumbs,$etapa) {
    $breadcrumbs->parent('etapas.index');
    $breadcrumbs->push($etapa->nombre, route('etapas.update',$etapa->id));
});

//Actividades
Breadcrumbs::register('actividades.index', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Actividades', route('actividades.index'));
});

Breadcrumbs::register('actividades.create', function ($breadcrumbs) {
    $breadcrumbs->parent('actividades.index');
    $breadcrumbs->push('Crear Actividad', route('actividades.create'));
});

Breadcrumbs::register('actividades.update', function ($breadcrumbs,$actividad) {
    $breadcrumbs->parent('actividades.index');
    $breadcrumbs->push($actividad->nombre, route('actividades.update',$actividad->id));
});

//Cronogramas
Breadcrumbs::register('cronogramas.index', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Cronogramas', route('cronogramas.index'));
});

Breadcrumbs::register('cronogramas.create', function ($breadcrumbs) {
    $breadcrumbs->parent('actividades.index');
    $breadcrumbs->push('Crear Cronograna', route('cronogramas.create'));
});

Breadcrumbs::register('cronogramas.update', function ($breadcrumbs,$cronograma) {
    $breadcrumbs->parent('cronogramas.index');
    $breadcrumbs->push('Nombre cronograma', route('cronogramas.update',$cronograma->id));
});

Breadcrumbs::register('cronogramas.show', function ($breadcrumbs,$convocatoria) {
    $breadcrumbs->parent('cronogramas.index');
    $breadcrumbs->push('Crear Cronograna', route('cronogramas.show',$convocatoria->id));
});

//Asistencia
Breadcrumbs::register('asistencias.index', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Asistencia', route('asistencias.index'));
});

Breadcrumbs::register('asistencias.update', function ($breadcrumbs,$convocatoria) {
    $breadcrumbs->parent('asistencias.index');
    $breadcrumbs->push($convocatoria->nombre, route('asistencias.show',$convocatoria->id));
});

Breadcrumbs::register('asistencia.caracterizacion_sensibilizacion', function ($breadcrumbs,$convocatoria,$user) {
    $breadcrumbs->parent('asistencias.update',$convocatoria);
    $breadcrumbs->push('Caracterización Sensibilización', route('asistencia.caracterizacion_sensibilizacion',[$convocatoria->id,$user]));
});

Breadcrumbs::register('asistencia.caracterizacion_incubacion', function ($breadcrumbs,$convocatoria,$user) {
    $breadcrumbs->parent('asistencias.update',$convocatoria);
    $breadcrumbs->push('Caracterización Incubación', route('asistencia.caracterizacion_empresarial',[$convocatoria->id,$user]));
});

//===============================================================VACANTES

//Laborales
Breadcrumbs::register('ofertas.index', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Ofertas', route('ofertas.index'));
});

Breadcrumbs::register('ofertas.create', function ($breadcrumbs) {
    $breadcrumbs->parent('ofertas.index');
    $breadcrumbs->push('Crear Oferta', route('ofertas.create'));
});

Breadcrumbs::register('ofertas.update', function ($breadcrumbs,$oferta) {
    $breadcrumbs->parent('ofertas.index');
    $breadcrumbs->push($oferta->nombre_empresa_dependencia, route('ofertas.update',$oferta->id));
});

Breadcrumbs::register('ofertas.uploadFile', function ($breadcrumbs,$oferta) {
    $breadcrumbs->parent('ofertas.index');
    $breadcrumbs->push($oferta->nombre_empresa_dependencia, route('ofertas.uploadFile',$oferta->id));
});



//tramites
Breadcrumbs::register('tramites.index', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Trámites', route('tramites.index'));
});

Breadcrumbs::register('tramites.show', function ($breadcrumbs,$oferta,$user) {
    $breadcrumbs->parent('tramites.index');
    $breadcrumbs->push('Postulación', route('tramites.show',[$oferta->id,'user_id'=>$user->id,'tipo'=>$oferta->tipoOferta->nombre]));
});

Breadcrumbs::register('tramites.vinculacion', function ($breadcrumbs,$oferta,$user) {
    $breadcrumbs->parent('tramites.index');
    $breadcrumbs->push('Vinculación', route('tramites.vinculacion',[$user->id,$oferta->id]));
});


/////////////////////////////////////////////////////////////////////////////////////////

//Gestiones
Breadcrumbs::register('gestiones.index', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Gestiones', route('gestiones.index'));
});
Breadcrumbs::register('gestiones.tramites', function ($breadcrumbs,$convocatoria) {
    $breadcrumbs->parent('gestiones.index');
    $breadcrumbs->push('Tramites', route('gestiones.tramites',$convocatoria->id));
});
Breadcrumbs::register('gestiones.novedades', function ($breadcrumbs,$cronograma) {
    $breadcrumbs->parent('gestiones.tramites',$cronograma->convocatoria);
    $breadcrumbs->push('Novedades', route('gestiones.novedades',$cronograma->id));
});
Breadcrumbs::register('gestiones.documentacion', function ($breadcrumbs,$cronograma) {
    $breadcrumbs->parent('gestiones.tramites',$cronograma->convocatoria);
    $breadcrumbs->push('Documentación', route('gestiones.documentacion',$cronograma->id));
});

//////////////////////////////////////////////////////////////////
//Salones
Breadcrumbs::register('salones.index', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Salones', route('salones.index'));
});

Breadcrumbs::register('salones.create', function ($breadcrumbs) {
    $breadcrumbs->parent('salones.index');
    $breadcrumbs->push('Crear Salones', route('salones.create'));
});

Breadcrumbs::register('salones.update', function ($breadcrumbs, $salones) {
    $breadcrumbs->parent('salones.index');
    $breadcrumbs->push($salones->numero, route('salones.update',$salones->id));
});

//Programacion academica
Breadcrumbs::register('programas.index', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Programas', route('programas.index'));
});

Breadcrumbs::register('programas.create', function ($breadcrumbs) {
    $breadcrumbs->parent('programas.index');
    $breadcrumbs->push('Crear Programas', route('programas.create'));
});

Breadcrumbs::register('programas.update', function ($breadcrumbs, $programas) {
    $breadcrumbs->parent('programas.index');
    $breadcrumbs->push($programas->nombre, route('programas.update',$programas->id));
});
