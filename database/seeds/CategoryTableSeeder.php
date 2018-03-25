<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create(['name'=>'Tareas']);
        Category::create(['name'=>'Recordatorios']);
        Category::create(['name'=>'Recursos']);
        Category::create(['name'=>'Eventos']);
    }
}
