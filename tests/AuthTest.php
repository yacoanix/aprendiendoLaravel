<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AuthTest extends TestCase
{

    public function testAutentication()
    {
        $this->visit('/welcome')
          ->see('E-Mail Address');
    }

    public function testAutenticated()
    {
        Auth::loginUsingId(1);
        $this->visit('/welcome')
            ->see('Bienvenido');
    }
}
