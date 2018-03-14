<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds. ------------> php artisan db:seed
     *
     * @return void
     */
    public function run()
    {
         $this->call(noteTableSeeder::class);
    }
}
