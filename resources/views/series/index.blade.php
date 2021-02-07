@extends('series/layout')

@section('cabecalho')
    Séries
@endsection

@section('conteudo')

@include('mensagem',['mensagem' => $mensagem])
    @auth
        <a href="{{route('form_criar_serie')}}" class="btn btn-dark mb-2">Adicionar</a>

    @endauth


    <ul class="list-group">
        @foreach($series as $serie)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span id="nome-serie-{{ $serie->id }}">{{ $serie->nome }}</span>

                <div class="input-group w-50" hidden id="input-nome-serie-{{ $serie->id }}">
                    <input type="text" class="form-control" id="{{ $serie->id }}" value="{{ $serie->nome }}">
                    <div class="input-group-append">
                        <button class="btn btn-primary" onclick="editarSerie({{ $serie->id }})">
                            <i class="fas fa-check"></i>
                        </button>
                        @csrf
                    </div>
                </div>

            <span class="d-flex">
                @auth
                <button class="btn btn-info btn-sm mr-1" onclick="toggleInput({{ $serie->id }})">
                    <i class="fas fa-edit"></i>
                </button>
                @endauth
                <a href="/series/{{ $serie->id }}/temporadas" class="btn btn-info btn-sm mr-1">
                    <i class="fas fa-external-link-alt"></i>
                </a>
                @auth
                <form method="post" action="/series/{{ $serie->id }}"
                    onsubmit="return confirm('Tem certeza que deseja remover {{ addslashes($serie->nome) }}?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">
                        <i class="far fa-trash-alt"></i>
                    </button>
                </form>
                @endauth
            </span>
        </li>
        @endforeach
    </ul>

    <script> 
    
    function toggleInput(serieId) {
        idElement = 'input-nome-serie-' + serieId;
        if(document.getElementById(idElement).hidden == true){
            document.getElementById(idElement).removeAttribute('hidden');
            idElement = 'nome-serie-' + serieId;
            document.getElementById(idElement).hidden = true;
        } else {
            document.getElementById(idElement).hidden = true;
            idElement = 'nome-serie-' + serieId;
            document.getElementById(idElement).removeAttribute('hidden');
        }
    }
    
    function editarSerie(serieId){
        //nome = document.getElementById(serieId).value;
        //alert(nome);

        let formData = new FormData();

        aux = '#input-nome-serie-' + serieId +'  > input';
        const nome = document.querySelector(aux).value;
        const token = document.querySelector('input[name="_token"]').value;
        
        formData.append('nome', nome);
        formData.append('_token', token);
        const url = '/series/' + serieId + '/editaNome';
        aux = 'nome-serie-' + serieId;

        fetch(url, {
            body:   formData,
            method: 'POST'

        }).then(() => { 
            toggleInput(serieId);
            document.getElementById(aux).textContent = nome;
        });
    }

    </script>

@endsection