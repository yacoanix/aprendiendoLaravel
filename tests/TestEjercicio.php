<?php

use App\Note;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TestEjercicio extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {

        $text =  'Inicio de nota. Voluptatem eveniet sit alias repellendus. Quaerat quia dolor eum illo. Reprehenderit et delectus possimus molestiae.';
        $text .='fin de nota';

        $note = Note::create(['note'=>$text]);

        $this->visit('notes')
            ->see('Inicio de nota')
            ->seeInElement('.label','Default')
            ->dontSee('fin de nota')
            ->seeLink('ver nota')
            ->click('ver nota')
            ->see($text);
    }
}
