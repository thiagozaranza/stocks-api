<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

use Spatie\Permission\Exceptions\RoleDoesNotExist;
use Spatie\Permission\Exceptions\PermissionDoesNotExist;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use App\Models\User;

class CreateRolesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'roles:sync';
    private $permissions_dict;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create permissions and roles';

    public function handle()
    {
        $this->alert('roles:sync');
/*
        DB::statement("truncate public.acl_permissions CASCADE");
        DB::statement("truncate public.acl_roles CASCADE");

        Cache::forget('spatie.permission.cache');

        $this->permissions_dict = $this->parsePermissions();

        $role_tree = Config::get('permission.roles');

        $roles = [];

        $this->getChildRoles($roles, $role_tree);

        $permissions = [];

        $this->getPermissionsForRole($permissions, $roles, $role_tree);

        foreach ($permissions as $role=>$_permissions) {

            try {
                $role = Role::findByName($role);
            } catch(RoleDoesNotExist $e) {
                $role = Role::create(['name' => $role]);
            }

            $this->warn($role->name);

            $role_permissions = [];

            foreach ($_permissions as $_permission) {

                $this->info($_permission);

                try {
                    $role_permission = Permission::findByName($_permission);
                } catch(PermissionDoesNotExist $e) {
                    $role_permission = Permission::create(['name' => $_permission]);
                }

                $role_permissions[] = $role_permission;
            }

            $role->syncPermissions($role_permissions);
        }*/

        $user = User::findOrFail(2);

        if(!$user->hasRole('guest'))
            $user->assignRole('guest');

    }

    private function getPermissionsForRole(&$permissions, &$roles, $node)
    {
        foreach ($node as $key=>$value) {

            $role_name = (is_numeric($key))? $node[$key] : $key;

            if (array_key_exists($role_name, $this->permissions_dict))
                $permissions[$role_name] = $this->permissions_dict[$role_name];
            else
                $permissions[$role_name] = [];

            if (is_array($node[$key])) {

                $childs = [];
                $this->getChildRoles($childs, $node[$key]);

                foreach ($childs as $child) {
                    if (array_key_exists($child, $this->permissions_dict))
                        $permissions[$role_name] = array_unique(array_merge($permissions[$role_name], $this->permissions_dict[$child]));
                }

                $this->getPermissionsForRole($permissions, $roles, $node[$key]);
            }
        }
    }

    private function getChildRoles(&$roles, $node)
    {
        foreach ($node as $key=>$value) {
            $role_name = (is_numeric($key))? $node[$key] : $key;
            $roles[] = $role_name;
            if (is_array($node[$key]))
                $this->getChildRoles($roles, $node[$key]);
        }
    }

    private function parsePermissions() 
    {
        $permissions_dict = Config::get('permission.permissions');

        $_permissions = [];

        foreach($permissions_dict as $role=>$value) {
            
            if(!array_key_exists($role, $_permissions))
                $_permissions[$role] = [];

            foreach($value as $class=>$actions) {
                foreach($actions as $action) {
                    $_permissions[$role][] = $action . ' ' . $class;
                }
            }
        }

        return $_permissions;
    }
}
