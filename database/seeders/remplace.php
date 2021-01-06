
<?php

use App\Models\Permission;


/*
Categoria permiso del modelo Category
Listar todos los categorys
*/
$permission = Permission::create([
    'name'          => 'List category',
    'slug'          => 'category.index',
    'description'   => 'A user can list category',
]);
/* Agregamos a la variable permission el id del permiso creado */
$permission_all[] = $permission->id;
/* Ver en detalle a un categoria */
$permission = Permission::create([
    'name'          => 'Show category',
    'slug'          => 'category.show',
    'description'   => 'A user can see category',
]);
/* Agregamos a la variable permission el id del permiso creado */
$permission_all[] = $permission->id;
/* Permite crear un nuevo categoria */
$permission = Permission::create([
    'name'          => 'Create category',
    'slug'          => 'category.create',
    'description'   => 'A user can create category',
]);
/* Agregamos a la variable permission el id del permiso creado */
$permission_all[] = $permission->id;
/* Permite editar un categoria */
$permission = Permission::create([
    'name'          => 'Edit category',
    'slug'          => 'category.edit',
    'description'   => 'A user can edit category',
]);
/* Agregamos a la variable permission el id del permiso creado */
$permission_all[] = $permission->id;
/* Permite eliminar un categoria */
$permission = Permission::create([
    'name'          => 'Destroy category',
    'slug'          => 'category.destroy',
    'description'   => 'A user can destroy category',
]);
/* Agregamos a la variable permission el id del permiso creado */
$permission_all[] = $permission->id;
