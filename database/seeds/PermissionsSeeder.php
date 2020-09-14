<?php
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    /**
     * Create the initial roles and permissions.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'edit users']);
        Permission::create(['name' => 'delete users']);
        Permission::create(['name' => 'disable users']);

        // create roles and assign existing permissions
        $role1 = Role::create(['name' => 'HR']);
        $role1->givePermissionTo('create users');
        $role1->givePermissionTo('edit users');
        $role1->givePermissionTo('delete users');
        $role1->givePermissionTo('disable users');

        $role2 = Role::create(['name' => 'Manager']);
        $role4 = Role::create(['name' => 'Employee']);

        $role3 = Role::create(['name' => 'Super Admin']);
        // gets all permissions via Gate::before rule; see AuthServiceProvider

        // create demo users
        $user = Factory(App\User::class)->create([
            'name' => 'Example HR',
            'email' => 'hr@example.com',
        ]);
        $user->assignRole($role1);

        $user = Factory(App\User::class)->create([
            'name' => 'Manager User',
            'email' => 'manager@example.com',
        ]);
        $user->assignRole($role4);
        $user->assignRole($role2);

        $user = Factory(App\User::class)->create([
            'name' => 'Employee',
            'email' => 'employee@example.com',
        ]);
        $user->assignRole($role4);

        $user = Factory(App\User::class)->create([
            'name' => 'Mandar Thosar',
            'email' => 'mandathosar@example.com',
        ]);
        $user->assignRole($role3);

        $user = Factory(App\User::class)->create([
            'name' => 'Meet Thosar',
            'email' => 'meetthosar@example.com',
        ]);
        $user->assignRole($role3);
    }
}
