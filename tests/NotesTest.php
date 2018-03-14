<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Note;
class NotesTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    use DatabaseTransactions;  //para no hacer que se quede el dato en la base de datos
    //en phpunit.xml se puso na nueva base de datos test configurada en config/databases.php

    public function testNotesList()
    {
        //Note::create(['note'=> 'My first note']);
        //Note::create(['note'=> 'My second note']);
        $this->visit('notes')
            ->see('algo');
           // ->see('<strong>HOLA</strong> esto es una nota con html');
    }

    public function testNote()
    {
       $this->visit('notes')
           ->click('Añade una nota')
           ->seePageIs('notes/create')
           ->see('Crear una nota')
           ->type('algo','note')
           ->press('Crear nota')
           ->seePageIs('notes')
           ->see('algo')
           ->seeInDatabase('notes',[
               'note'=>'algo'
           ]);
    }
}
