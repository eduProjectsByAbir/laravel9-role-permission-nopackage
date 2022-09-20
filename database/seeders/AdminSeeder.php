<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userRole = Role::create(['name' => 'user']);
        $adminRole = Role::create(['name' => 'admin']);
        $authorRole = Role::create(['name' => 'author']);

        // admin id
        User::create([
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            'password' => bcrypt('password'), //password
            'email_verified_at' => now(),
            'role_id' => $adminRole->id,
        ]);
        // user id
        User::create([
            'name' => 'User',
            'email' => 'user@mail.com',
            'password' => bcrypt('password'), //password
            'email_verified_at' => now(),
            'role_id' => $userRole->id,
        ]);
        // author id
        User::create([
            'name' => 'Author',
            'email' => 'author@mail.com',
            'password' => bcrypt('password'), //password
            'email_verified_at' => now(),
            'role_id' => $authorRole->id,
        ]);

        $permissions = ['view-any-post', 'view-post', 'create-post', 'update-post', 'delete-post'];

        foreach($permissions as $permission){
            Permission::create([
                'name' => $permission
            ]);
        }
    }
}
