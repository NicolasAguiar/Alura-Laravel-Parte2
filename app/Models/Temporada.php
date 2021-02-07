<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class Temporada extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['numero'];

    public function episodios()
    {
        return $this->hasMany(Episodio::class);
    }

    public function serie()
    {
        return $this->belongsTo(Serie::class);
    }

    public function getEpisodiosAssistidos() 
    {
        return $this->episodios->filter(function (Episodio $episodio) 
        {
            return $episodio->assistido;
        });
    }
}
