# Pruebas funcionales

| Código | Funcionalidad | Pasos generales | Resultado esperado |
| --- | --- | --- | --- |
| RE001 | Crear paquete | Iniciar sesión como administrador, abrir la gestión de paquetes y registrar un nuevo paquete. | El paquete queda registrado y visible en el menú dinámico. |
| RE002 | Crear módulo | Crear un módulo y asociarlo a un paquete existente. | El módulo queda asociado al paquete seleccionado. |
| RE003 | Crear permisos base | Guardar un módulo nuevo y revisar los permisos generados. | El sistema genera permisos de listar, crear y actualizar. |
| RE004 | Autogenerar archivos base | Ejecutar el flujo de creación de archivos base para un módulo. | El sistema genera modelo, controlador, vista y rutas base. |
| RE005 | Gestionar permisos | Crear, consultar o actualizar permisos desde la interfaz administrativa. | Los permisos quedan disponibles para asignación a roles. |
| RE007 | Gestionar roles | Crear o actualizar un rol y asignarle permisos. | El rol conserva los permisos seleccionados. |
| RE008 | Asignar roles | Asignar un rol a un usuario registrado. | El usuario obtiene acceso según los permisos del rol. |
| RE015 | Registrar usuario | Completar el registro de un usuario nuevo. | El usuario queda creado y recibe verificación por correo cuando el correo está configurado. |
| RE016 | Iniciar sesión | Ingresar credenciales válidas. | El sistema autentica al usuario y muestra el panel correspondiente. |
| RE017 | Recuperar contraseña | Solicitar recuperación desde la pantalla de acceso. | El usuario recibe el correo de recuperación cuando el correo está configurado. |
| RE021 | Usar buscador | Buscar registros desde una vista listable. | El sistema filtra resultados según el criterio ingresado. |
| RE022 | Listar y ordenar | Abrir una tabla de registros y cambiar el orden. | Los registros se listan y ordenan correctamente. |
| RE024 | Recibir notificaciones | Generar una acción que produzca una notificación. | La notificación queda registrada para el usuario correspondiente. |
| REQ001L | Crear convocatoria | Registrar una convocatoria de emprendimiento con información básica. | La convocatoria queda registrada con etapas asociadas. |
| REQ002L | Avanzar convocatoria | Ejecutar el avance de una convocatoria entre etapas. | La convocatoria cambia de etapa según las reglas definidas. |
| REQ003L | Registrar participante | Inscribir un participante en una convocatoria. | El participante queda asociado a la convocatoria. |
| REQ004L | Registro público | Completar el formulario público de inscripción. | La inscripción pública queda almacenada en el sistema. |
| REQ008L | Asignar cronograma | Programar una actividad con fecha, hora y responsable. | La actividad queda programada con fecha, hora y responsable. |
| REQ009L | Marcar asistencia | Registrar asistencia de participantes a una actividad. | El sistema registra asistencia y permite apoyar el avance de etapa. |
| REQ010L | Gestionar novedades | Enviar una novedad o documentación asociada al proceso. | El sistema almacena novedades y documentación. |
