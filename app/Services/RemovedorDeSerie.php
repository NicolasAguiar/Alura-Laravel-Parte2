<?php

namespace  App\Services;

use App\Serie;
use App\Models\Temporada;
use App\Models\Episodio;
use Illuminate\Support\Facades\DB;

class RemovedorDeSerie
{

    public function removerSerie(int $serieId): string 
    { 
        
        $nomeSerie = '';
        DB::transaction( function () use ($serieId, &$nomeSerie){

            $serie = Serie::find($serieId);
            $nomeSerie = $serie->nome;
            $this->removerTemporadas($serie);
            $serie->delete();

        }); 
        
        return $nomeSerie;
    }

    private function removerTemporadas(Serie $serie)
    {
        $serie->temporadas->each(function (Temporada $temporada) {

           $this->removerEpisodios($temporada);
           $temporada->delete();

        });


    }

    private function removerEpisodios(Temporada $temporada)
    {
        $temporada->episodios()->each(function (Episodio $episodio) {
            $episodio->delete();
        });

    }

}