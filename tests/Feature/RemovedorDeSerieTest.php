<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Services\CriadorDeSerie;
use App\Serie;
use App\Services\RemovedorDeSerie;

class RemovedorDeSerieTest extends TestCase
{

    use RefreshDatabase;
    
    private Serie $serie;

    protected function setUp(): void
    {
            parent::setUp();
            $criadorDeSerie = new CriadorDeSerie();
            $this->serie = $criadorDeSerie->criarSerie('Nome da série', 1, 1);

    }

    public function testRemoverUmaSerie()
    {
        $this->assertDatabaseHas('series', ['id' => $this->serie->id]);
        
        $removedorDeSerie = new RemovedorDeSerie();
        $nomeSerie = $removedorDeSerie->removerSerie($this->serie->id);
        
        $this->assertIsString($nomeSerie);
        $this->assertEquals('Nome da série', $this->serie->nome);
        $this->assertDatabaseMissing('series', ['id' => $this->serie->id]);
    }
}
