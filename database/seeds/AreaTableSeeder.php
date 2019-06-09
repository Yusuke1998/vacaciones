<?php

use Illuminate\Database\Seeder;
use App\Area;

class AreaTableSeeder extends Seeder
{
    public function run()
    {
    	$areas = ['Contabilidad','Informatica','Nomina','Compras','Bienes'];
        foreach ($areas as $key => $value) {
        	Area::create([
        		'name'			=>	$value,
        		'description'	=>	"Aqui va la descripcion referente a $value",
        	]);
        }
    }
}
