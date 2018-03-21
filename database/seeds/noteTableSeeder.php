<?php

use Illuminate\Database\Seeder;
use App\Note;
use App\Category;
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
        $categories = Category::all();
        $notes = factory(Note::class)->times(100)->make();

        foreach($notes as $note){
            $category=$categories->random();

            $category->notes()->save($note);
        }
    }
}
