# Pruebas funcionales

| Codigo | Funcionalidad | Pasos generales | Resultado esperado |
| --- | --- | --- | --- |
| RE001 | Crear paquete | Iniciar sesion como administrador, abrir la gestion de paquetes y registrar un nuevo paquete. | El paquete queda registrado y visible en el menu dinamico. |
| RE002 | Crear modulo | Crear un modulo y asociarlo a un paquete existente. | El modulo queda asociado al paquete seleccionado. |
| RE003 | Crear permisos base | Guardar un modulo nuevo y revisar los permisos generados. | El sistema genera permisos de listar, crear y actualizar. |
| RE004 | Autogenerar archivos base | Ejecutar el flujo de creacion de archivos base para un modulo. | El sistema genera modelo, controlador, vista y rutas base. |
| RE005 | Gestionar permisos | Crear, consultar o actualizar permisos desde la interfaz administrativa. | Los permisos quedan disponibles para asignacion a roles. |
| RE007 | Gestionar roles | Crear o actualizar un rol y asignarle permisos. | El rol conserva los permisos seleccionados. |
| RE008 | Asignar roles | Asignar un rol a un usuario registrado. | El usuario obtiene acceso segun los permisos del rol. |
| RE015 | Registrar usuario | Completar el registro de un usuario nuevo. | El usuario queda creado y recibe verificacion por correo cuando el correo esta configurado. |
| RE016 | Iniciar sesion | Ingresar credenciales validas. | El sistema autentica al usuario y muestra el panel correspondiente. |
| RE017 | Recuperar contrasena | Solicitar recuperacion desde la pantalla de acceso. | El usuario recibe el correo de recuperacion cuando el correo esta configurado. |
| RE021 | Usar buscador | Buscar registros desde una vista listable. | El sistema filtra resultados segun el criterio ingresado. |
| RE022 | Listar y ordenar | Abrir una tabla de registros y cambiar el orden. | Los registros se listan y ordenan correctamente. |
| RE024 | Recibir notificaciones | Generar una accion que produzca una notificacion. | La notificacion queda registrada para el usuario correspondiente. |
| REQ001L | Crear convocatoria | Registrar una convocatoria de emprendimiento con informacion basica. | La convocatoria queda registrada con etapas asociadas. |
| REQ002L | Avanzar convocatoria | Ejecutar el avance de una convocatoria entre etapas. | La convocatoria cambia de etapa segun las reglas definidas. |
| REQ003L | Registrar participante | Inscribir un participante en una convocatoria. | El participante queda asociado a la convocatoria. |
| REQ004L | Registro publico | Completar el formulario publico de inscripcion. | La inscripcion publica queda almacenada en el sistema. |
| REQ008L | Asignar cronograma | Programar una actividad con fecha, hora y responsable. | La actividad queda programada con fecha, hora y responsable. |
| REQ009L | Marcar asistencia | Registrar asistencia de participantes a una actividad. | El sistema registra asistencia y permite apoyar el avance de etapa. |
| REQ010L | Gestionar novedades | Enviar una novedad o documentacion asociada al proceso. | El sistema almacena novedades y documentacion. |

## Plan de prueba integral por roles

Este plan sirve para probar el flujo completo en un ambiente de pruebas o en Railway despues de un despliegue. Se recomienda ejecutarlo con datos nuevos para no mezclar resultados con convocatorias reales.

### Preparacion

1. Confirmar que el ambiente este desplegado y que se pueda entrar a `/login`.
2. Confirmar que los usuarios base existan y esten activos. Si se tiene acceso a consola, se pueden normalizar con:

```bash
php artisan sipu:reset-access-passwords "ClavePrueba2026"
```

3. Usar una sola clave temporal para todos los usuarios de prueba y cambiarla antes de usar datos reales.
4. Crear una hoja de control con columnas: rol, usuario, accion, resultado esperado, resultado obtenido, captura, observacion.
5. En cada paso guardar evidencia: captura de pantalla, URL, mensaje mostrado y hora aproximada.

### Usuarios minimos

| Rol | Usuario sugerido | Objetivo de prueba |
| --- | --- | --- |
| Administrador | soporte.nortecauca@correounivalle.edu.co | Configuracion, usuarios, roles, permisos y datos maestros. |
| Coordinador de emprendimiento | coordinadoremprendimiento@gmail.com | Crear convocatoria, etapas, actividades, cronogramas, asistencia, avance y reportes. |
| Asesor | rafael.guauna@correounivalle.edu.com | Gestionar inscritos asignados, novedades, documentacion y asesorias. |
| General / Emprendedor | generaluser@gmail.com | Registrarse en convocatoria, emprendimiento, caracterizacion y seguimiento. |
| Coordinador proyeccion social | coordinadordeproyeccionsocial@gmail.com | Crear y gestionar ofertas. |
| Coordinador de practicas | coordinadordepracticas@gmail.com | Crear y gestionar ofertas de practicas. |
| Empresa | empresa@gmail.com | Crear ofertas y revisar postulaciones. |
| Estudiante | Crear usuario con rol Estudiante | Postularse a ofertas y retirar postulaciones. |
| Director de programa | directordeprograma@gmail.com | Revisar tramites y aprobar o rechazar postulaciones. |
| Profesor de apoyo | profesordeapoyo@gmail.com | Revisar tramites y apoyar aprobaciones/rechazos. |

### Flujo A: configuracion inicial

| Paso | Rol | Accion | Resultado esperado |
| --- | --- | --- | --- |
| A1 | Administrador | Iniciar sesion. | Entra al panel sin pedir verificacion por correo. |
| A2 | Administrador | Abrir Configuracion > Roles. | Lista roles existentes. |
| A3 | Administrador | Abrir Configuracion > Permisos. | Lista permisos existentes. |
| A4 | Administrador | Abrir Basicos > Usuarios. | Lista usuarios y permite crear/editar segun permisos. |
| A5 | Administrador | Crear un usuario de prueba Estudiante. | El usuario queda activo y puede iniciar sesion. |
| A6 | Administrador | Crear o revisar Pais, Departamento y Ciudad. | Los combos dependientes cargan correctamente. |

### Flujo B: convocatoria de emprendimiento completa

| Paso | Rol | Accion | Resultado esperado |
| --- | --- | --- | --- |
| B1 | Coordinador de emprendimiento | Crear o revisar etapas: Sensibilizacion, Preincubacion, Incubacion y Aceleracion. | Las etapas existen y se pueden listar. |
| B2 | Coordinador de emprendimiento | Crear actividades para la primera etapa. | Cada actividad queda asociada a su etapa. |
| B3 | Coordinador de emprendimiento | Crear convocatoria abierta con fechas vigentes y etapas en orden. | La convocatoria aparece en el listado. |
| B4 | Coordinador de emprendimiento | Crear cronograma para actividades de la primera etapa. | El cronograma queda dentro del rango de fechas de la convocatoria. |
| B5 | Coordinador de emprendimiento | Abrir Avance de la convocatoria. | La pantalla carga sin error 500. |
| B6 | Coordinador de emprendimiento | Generar asistencia. | Se crean registros de asistencia sin error. |
| B7 | General / Emprendedor | Entrar a Convocatorias y abrir Registrarse. | Si la convocatoria esta abierta y la primera etapa tiene cronograma, aparece el boton Grabar. |
| B8 | General / Emprendedor | Registrarse en la convocatoria, con o sin emprendimiento seleccionado. | El usuario queda inscrito y aparece en avance de la convocatoria. |
| B9 | Coordinador de emprendimiento | Abrir Avance y revisar al inscrito. | El inscrito aparece en la primera etapa. |
| B10 | Coordinador de emprendimiento | Si el inscrito no tiene emprendimiento, abrir icono de emprendimiento, crear uno y asignarlo. | No aparece 403; el emprendimiento queda asociado al inscrito. |
| B11 | Coordinador de emprendimiento | Abrir Asistencia de la convocatoria. | Lista inscritos y actividades. |
| B12 | Coordinador de emprendimiento | Asignar asesor al inscrito. | Muestra mensaje de exito, no "Oops". |
| B13 | Asesor | Entrar a Gestiones. | Ve los inscritos asignados. |
| B14 | Asesor | Registrar novedad para el inscrito. | La novedad se guarda y queda visible. |
| B15 | Asesor | Subir documentacion del inscrito. | El archivo se guarda y se puede descargar. |
| B16 | Coordinador de emprendimiento | Marcar asistencia del inscrito. | La asistencia se guarda sin error 500. |
| B17 | Coordinador o Asesor | Abrir caracterizacion de Sensibilizacion para el inscrito. | El formulario carga aunque el pivote no tenga emprendimiento previo. |
| B18 | Coordinador o Asesor | Completar caracterizacion de Sensibilizacion. | Guarda datos del emprendimiento y marca caracterizacion. |
| B19 | Coordinador de emprendimiento | Marcar todas las asistencias requeridas de la primera etapa. | Al cumplir asistencia + caracterizacion, el inscrito avanza a la siguiente etapa. |
| B20 | Coordinador de emprendimiento | Abrir Avance y revisar Preincubacion. | El inscrito aparece en Preincubacion y no desaparece por actualizacion del pivote. |
| B21 | Coordinador de emprendimiento | Crear cronogramas de Preincubacion y generar asistencia. | Se generan asistencias de la nueva etapa. |
| B22 | Coordinador o Asesor | Completar caracterizacion empresarial cuando aplique. | La etapa queda caracterizada y puede avanzar si cumple asistencia. |
| B23 | Coordinador de emprendimiento | Abrir reporte de convocatoria. | El reporte carga y muestra registrados/finalizados por etapa. |

### Flujo C: registro publico

| Paso | Rol | Accion | Resultado esperado |
| --- | --- | --- | --- |
| C1 | Coordinador de emprendimiento | Copiar link publico de una convocatoria abierta. | El enlace abre sin requerir sesion. |
| C2 | Visitante | Completar formulario publico con correo nuevo. | Crea usuario, detalle y emprendimiento sin error de notificacion. |
| C3 | Visitante | Intentar registrar el mismo correo otra vez. | El sistema informa que ya existe o evita duplicado. |
| C4 | Coordinador de emprendimiento | Ver avance de convocatoria. | El usuario del registro publico aparece inscrito. |

### Flujo D: ofertas, practicas y tramites

| Paso | Rol | Accion | Resultado esperado |
| --- | --- | --- | --- |
| D1 | Coordinador proyeccion social | Crear oferta. | La oferta queda visible en listado. |
| D2 | Coordinador de practicas | Crear oferta de practica. | La oferta queda visible y editable. |
| D3 | Empresa | Crear o actualizar una oferta. | La empresa ve sus ofertas. |
| D4 | Estudiante | Completar hoja de vida/curriculum. | La informacion se guarda. |
| D5 | Estudiante | Postularse a una oferta. | La postulacion queda registrada. |
| D6 | Estudiante | Retirar postulacion. | La postulacion cambia de estado o se retira. |
| D7 | Empresa | Revisar tramites/postulaciones. | Ve postulantes asociados a sus ofertas. |
| D8 | Director de programa | Abrir tramite y admitir o rechazar postulacion. | El tramite cambia de estado. |
| D9 | Profesor de apoyo | Abrir tramite y revisar vinculacion. | Puede ver informacion y tomar acciones permitidas. |

### Flujo E: pruebas negativas

| Paso | Rol | Accion | Resultado esperado |
| --- | --- | --- | --- |
| E1 | General / Emprendedor | Intentar registrarse en una convocatoria cerrada. | No aparece el boton Grabar y se muestra mensaje de convocatoria cerrada. |
| E2 | General / Emprendedor | Intentar registrarse dos veces en la misma convocatoria. | El sistema impide duplicado. |
| E3 | Coordinador de emprendimiento | Crear convocatoria sin cronograma de primera etapa y abrir registro. | No aparece Grabar y se muestra que falta cronograma de la primera etapa. |
| E4 | Asesor | Intentar entrar a modulo administrativo no permitido. | Recibe 403 o no ve la opcion en menu. |
| E5 | General / Emprendedor | Intentar acceder a avance de convocatoria. | No puede acceder si no tiene permiso. |
| E6 | Visitante | Abrir link publico de convocatoria cerrada. | El formulario no permite registrar. |
| E7 | Usuario no autenticado | Abrir una ruta protegida de emprendimiento. | Redirige a login. |

### Criterios de aprobacion

- No hay errores 500 durante el recorrido.
- Los 403 solo aparecen cuando el rol realmente no tiene permiso.
- Los mensajes de exito no muestran titulos de error.
- Los botones criticos aparecen cuando las reglas de negocio se cumplen.
- Un inscrito avanza de Sensibilizacion a Preincubacion al completar asistencia y caracterizacion.
- El registro publico y el registro autenticado crean usuarios/inscripciones sin depender del correo.
- Los archivos subidos se pueden listar y descargar.
- Los reportes cargan sin errores.

### Evidencias recomendadas

| Evidencia | Donde tomarla |
| --- | --- |
| Login por rol | Pantalla inicial despues de iniciar sesion. |
| Menu por rol | Captura del menu lateral de cada rol. |
| Convocatoria creada | Listado de convocatorias y detalle. |
| Cronograma creado | Listado de cronogramas por convocatoria. |
| Inscripcion | Avance de convocatoria con el inscrito visible. |
| Asistencia generada | Pantalla de asistencias con filas creadas. |
| Avance de etapa | Pantalla de avance mostrando al usuario en la etapa siguiente. |
| Novedad/documentacion | Vista de gestiones con novedad o archivo visible. |
| Oferta/postulacion | Listado de ofertas y tramite creado. |
| Errores controlados | Capturas de mensajes esperados en pruebas negativas. |
