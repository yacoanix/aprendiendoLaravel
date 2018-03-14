<?php

use Illuminate\Database\Seeder;
use App\Note;
class noteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * composer dumpautoload si fallan los seeds
     *
     * @return void
     */
    public function run()
    {
        factory(Note::class)->times(100)->create();
    }
}
