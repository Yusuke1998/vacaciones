<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        User::create([
        	'name' => 'Administrador',
	        'username' => 'admin',
	        'rol' => 'administrador',
	        'email' => 'admin@admin.com',
	        'password' => bcrypt('admin'),
	        'remember_token' => str_random(10),
        ]);
    }
}
