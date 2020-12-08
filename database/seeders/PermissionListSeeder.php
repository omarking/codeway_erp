<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* Variable que almacenara a los permisos que se manejaran en el sistema */
        $permission_all = [];

        /* Rol permiso del modelo Role*/
        /* Listar todos los roles */
        $permission = Permission::create([
            'name'          => 'List role',
            'slug'          => 'role.index',
            'description'   => 'A user can list role',
        ]);
        /* Agregamos a la variable permission el id del permiso creado */
        $permission_all[] = $permission->id;
        /* Ver en detalle a un rol */
        $permission = Permission::create([
            'name'          => 'Show role',
            'slug'          => 'role.show',
            'description'   => 'A user can see role',
        ]);
        /* Agregamos a la variable permission el id del permiso creado */
        $permission_all[] = $permission->id;
        /* Permite crear un nuevo rol */
        $permission = Permission::create([
            'name'          => 'Create role',
            'slug'          => 'role.create',
            'description'   => 'A user can create role',
        ]);
        /* Agregamos a la variable permission el id del permiso creado */
        $permission_all[] = $permission->id;
        /* Permite editar un rol */
        $permission = Permission::create([
            'name'          => 'Edit role',
            'slug'          => 'role.edit',
            'description'   => 'A user can edit role',
        ]);
        /* Agregamos a la variable permission el id del permiso creado */
        $permission_all[] = $permission->id;
        /* Permite eliminar un rol */
        $permission = Permission::create([
            'name'          => 'Destroy role',
            'slug'          => 'role.destroy',
            'description'   => 'A user can destroy role',
        ]);
        /* Agregamos a la variable permission el id del permiso creado */
        $permission_all[] = $permission->id;

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
    }
}
