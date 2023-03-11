<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserRolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            ['Administrator','dev@luxodev.com','lux0dev0', 0],

        ];

        $roles = [
            'Administrator'
        ];

        $permissions = [

        ];

        $permissions = [
            $permissions
        ];

        $permission_ids = [];

        foreach($permissions as $moduls) {
            foreach($moduls as $val) {
                $permission = Permission::where('name', $val)->first();
                if(!$permission) {
                    $permission = new Permission;
                    $permission->name = $val;
                    $permission->save();
                    $this->command->info('PERMISSION [new] - ' . json_encode($permission));
                } else {
                    $this->command->line('PERMISSION       - ' . json_encode($permission));
                }
                $permission_ids[] = $permission->id;
            }
        }
        Permission::whereNotIn('id', $permission_ids)->delete();


        foreach($roles as $val) {
            $item = Role::where('name', $val)->first();
            if(!$item) {
                $item = new Role;
                $item->name = $val;
                $item->save();
                $this->command->info('ROLE [new] - ' . json_encode($item));
            } else {
                $this->command->line('ROLE       - ' . json_encode($item));
            }

            if($val == 'Administrator' || $val == 'Administrator'){
                $item->syncPermissions(Permission::all());
            }
        }

        foreach($users as $user) {
            $us = User::where('email', $user[1])->first();
            if(!$us) {
                $us = new User;
                $us->name = $user[0];
                $us->email = $user[1];
                $us->password = bcrypt($user[2]);
                $us->visible = $user[3];
                $us->save();
                $new = true;
                $this->command->info('USER [new] - ' . json_encode($us));
            } else {
                $this->command->line('USER       - ' . json_encode($us));
            }
            if(!$us->visible) {
                $super_admin_role = Role::where('name', 'Administrator')->first();
                $us->assignRole($super_admin_role);
            }
        }
    }
}
