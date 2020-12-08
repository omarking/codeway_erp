
<?php

use App\Models\Permission;


/* Permission permiso del modelo Permission*/
/* Listar todos los permisos */

$permission = Permission::create([
    'name'          => 'List permission',
    'slug'          => 'permission.index',
    'description'   => 'A user can list permission',
]);
/* Agregamos a la variable permission el id del permiso creado */
$permission_all[] = $permission->id;
/* Ver en detalle a un permiso */
$permission = Permission::create([
    'name'          => 'Show permission',
    'slug'          => 'permission.show',
    'description'   => 'A user can see permission',
]);
/* Agregamos a la variable permission el id del permiso creado */
$permission_all[] = $permission->id;
/* Permite crear un nuevo permiso */
$permission = Permission::create([
    'name'          => 'Create permission',
    'slug'          => 'permission.create',
    'description'   => 'A user can create permission',
]);
/* Agregamos a la variable permission el id del permiso creado */
$permission_all[] = $permission->id;
/* Permite editar un permiso */
$permission = Permission::create([
    'name'          => 'Edit permission',
    'slug'          => 'permission.edit',
    'description'   => 'A user can edit permission',
]);
/* Agregamos a la variable permission el id del permiso creado */
$permission_all[] = $permission->id;
/* Permite eliminar un permiso */
$permission = Permission::create([
    'name'          => 'Destroy permission',
    'slug'          => 'permission.destroy',
    'description'   => 'A user can destroy permission',
]);
/* Agregamos a la variable permission el id del permiso creado */
$permission_all[] = $permission->id;
