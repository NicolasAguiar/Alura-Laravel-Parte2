<?php

namespace Tests\Unit;

use App\Models\Episodio;
use App\Models\Temporada;
//use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TemporadaTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */

    private $temporada;

    protected function setUp(): void
    {
        parent::setUp();

        $temporada = new Temporada();

        $episodio1 = new Episodio();
        $episodio1->assistido = true;

        $episodio2 = new Episodio();
        $episodio2->assistido = false;

        $episodio3 = new Episodio();
        $episodio3->assistido = true;

        $temporada->episodios->add($episodio1);
        $temporada->episodios->add($episodio2);
        $temporada->episodios->add($episodio3);

        $this->temporada = $temporada;
    }

    public function testBuscaPorEpisodiosAssistidos()
    {

        $episodiosAsistidos = $this->temporada->getEpisodiosAssistidos();
    
        $this->assertCount(2,$episodiosAsistidos);

        foreach($episodiosAsistidos as $episodioAsistido)
        {
            $this->assertTrue($episodioAsistido->assistido);    
        } 
    }

    public function testBuscaTodosOsEpisodios()
    {
        $episodios = $this->temporada->episodios;
        $this->assertCount(3,$episodios);
    }  

}
