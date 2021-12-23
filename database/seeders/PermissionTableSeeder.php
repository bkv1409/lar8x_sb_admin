<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
//use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $configPermissions = [
            'role-list','role-create','role-edit','role-delete',
            'user-list','user-create','user-edit','user-delete',
            'activity-log-list',
            'system-config-list','system-config-create','system-config-edit','system-config-delete',
        ];

        foreach ($configPermissions as $configPermission){
            $permission = Permission::where('name', $configPermission)->first();
            if (empty($permission)) {
                $permission = new Permission();
            }
//            $permission = new Permission();
            $permission->name = $configPermission;
            $permission->guard_name = 'web';
            $permission->save();
        }

    }
}
