# SIPU Architecture

SIPU is developed with Laravel and follows the Model View Controller pattern.

The platform is organized through packages, modules, roles and permissions. Packages group modules that belong to the same business domain. Modules represent specific application features. Roles group permissions and control user access to the system.

When modules are created, the system generates base permissions associated with listing, creating and updating operations. The dynamic menu reflects the permissions assigned to the authenticated user.

## Main Components

- Config package.
- Basic data package.
- Entrepreneurship package.
- User management.
- Role and permission management.
- Package and module management.
- Base file generation.
- Notifications.
- Reports.

## Functional Organization

The configurable platform supports packages, modules, permissions, roles, users, alerts, notifications and emails. Functional packages are implemented on top of this base. The entrepreneurship package manages calls, participants, stages, activities, schedules, attendance, progression, updates and documentation.

## Permission Flow

1. An administrator creates or configures packages and modules.
2. The system generates base permissions for the main module operations.
3. Permissions are assigned to roles.
4. Roles are assigned to users.
5. The dynamic menu displays options according to the permissions of the authenticated user.
