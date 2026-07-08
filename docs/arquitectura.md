# Arquitectura de SIPU

SIPU está desarrollado sobre Laravel y sigue el patrón Modelo Vista Controlador.

La plataforma se organiza mediante paquetes, módulos, roles y permisos. Los paquetes agrupan módulos de un mismo modelo de negocio. Los módulos representan funcionalidades específicas. Los roles agrupan permisos y permiten controlar el acceso de los usuarios.

La creación de módulos genera permisos base asociados a las operaciones de listar, crear y actualizar. El sistema refleja los cambios en el menú dinámico según los permisos del usuario autenticado.

## Componentes principales

- Paquete Config.
- Paquete Básicos.
- Paquete Emprendimiento.
- Gestión de usuarios.
- Gestión de roles y permisos.
- Gestión de paquetes y módulos.
- Autogeneración de archivos base.
- Notificaciones.
- Reportes.

## Organización funcional

La plataforma configurable permite administrar paquetes, módulos, permisos, roles, usuarios, alertas, notificaciones y correos. Sobre esta base se implementan paquetes funcionales, como el paquete de emprendimiento, que gestiona convocatorias, participantes, actividades, cronogramas, asistencias, avances, novedades y documentación.

## Flujo general de permisos

1. Un administrador crea o configura paquetes y módulos.
2. El sistema genera permisos base para las operaciones principales del módulo.
3. Los permisos se asignan a roles.
4. Los roles se asignan a usuarios.
5. El menú dinámico muestra las opciones disponibles según los permisos del usuario autenticado.
