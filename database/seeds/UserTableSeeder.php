<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // factory(App\User::class,2)->create();
        User::create([
        	'name' => 'Administrador',
	        'username' => 'admin',
	        'rol' => 'administrador',
	        'email' => 'admin@admin.com',
	        'password' => bcrypt('admin'),
	        // 'api_token' => str_random(50),
	        'remember_token' => str_random(10),
        ]);

    }
}
