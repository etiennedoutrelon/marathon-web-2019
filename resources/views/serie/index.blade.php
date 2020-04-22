@extends('layouts.master')
@section('title', 'Les séries')
@section('content')
    <div class="row justify-content-center">
        <div style="margin-top: 1%;">
            <form action="{{route("serie")}}" method="get" class="form-inline my-2 my-lg-0">
                <div class="input-group">
                    <input type="search" name="search" class="form-control mr-sm-2" type="text" placeholder="Rechercher une série..." style="width: 200px; margin-top: 2%;">
                    <span class="input-group-prepend">
                        <button type="submit" class="btn btn-md btn-teal">Rechercher</button>
                    </span>
                </div>
            </form>
        </div>
        <div style="margin-top: 1%; margin-left: 2%;">
            <form action="{{route("serie")}}" method="get" class="form-inline my-2 my-lg-0">
                <select class="custom-select" name="cat" style="width: 200px;">
                    <option value="All" @if($cat == 'All') selected @endif>Toutes les langues</option>
                    @foreach($langues as $langue)
                        <option value="{{$langue}}"  @if($cat == $langue) selected @endif>{{$langue}}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-md btn-teal" style="margin-left: 20px;">Trier</button>
            </form>
        </div>
    </div>
    <hr/>
    <div class="text-center teal-text h1 text-uppercase">Les séries</div>
    <div class="serie-container"> <!-- ajout d'une div pour toutes les series -->
    @if(!empty($series))
        @foreach($series as $serie)
            <div class="card" style="display: inline-block;">
                <a href="{{route('serie.show', $serie->id)}}">
                    <img src="{{asset($serie->urlImage)}}" class="card-img-top">
                </a>
                <div class="card-body" style="text-align: center">
                    <a href="{{route('serie.show', $serie->id)}}">
                        <h5 class="card-title">{{$serie->nom}}</h5>
                    </a>
                    <p class="card-text">{{$serie->langue}}</p>
                </div>
            </div>
        @endforeach
    @else
        <h3>Aucunes Série</h3>
    @endif
    </div>
    <!-- </div> -->
@endsection
