@extends('series/layout')

@section('cabecalho')
    Episódios
@endsection

@section('conteudo')

@include('mensagem',['mensagem' => $mensagem])

    <form method="post" action="/temporadas/{{ $temporadaId }}/episodios/assistir">
        @csrf
        <ul class="list-group">
            @foreach($episodios as $episodio)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                        Episodio {{ $episodio->numero }}
                        <input  type="checkbox" 
                                name="episodios[]" 
                                value="{{ $episodio->id }}"
                                {{ $episodio->assistido ? 'checked' : ''}}
                                @guest
                                disabled
                                @endguest
                                >
                </li>
            @endforeach
        </ul>
        @auth
        <button class="btn btn-primary nt-2 mb-2">Salvar</button>
        @endauth
    </form>
@endsection
