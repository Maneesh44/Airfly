<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        User::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        DB::table('role_user')->truncate();
        



        $adminRole = Role::where('name', 'admin')->first();
        $authorRole = Role::where('name', 'author')->first();
        $userRole = Role::where('name', 'user')->first();

        $admin = User::create([
        	'name' => 'admin',
        	'email' => 'admin@admin.com',
        	'phone' => '1234567890',
        	'password' => bcrypt('admin@admin.com')
        ]);

        $author1 = User::create([
        	'name' => 'owner1',
        	'email' => 'owner1@owner1.com',
        	'phone' => '1112131415',
        	'password' => bcrypt('owner1@owner1.com')
        ]);

        $author2 = User::create([
        	'name' => 'owner2',
        	'email' => 'owner2@owner2.com',
        	'phone' => '1112131415',
        	'password' => bcrypt('owner2@owner2.com')
        ]);

        // $user = User::create([
        // 	'name' => 'user',
        // 	'email' => 'user@user.com',
        // 	'phone' => '1617181920',
        // 	'password' => bcrypt('user')
        // ]);

        $admin->roles()->attach($adminRole);
        $author1->roles()->attach($authorRole);
        $author2->roles()->attach($authorRole);
        // $user->roles()->attach($userRole);
    }
}
