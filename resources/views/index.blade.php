@extends('layouts.master')
@section('title', 'Accueil')
@section('content')
    <div style="width: 100%">
        <h1 class="text-center text-uppercase teal-text" style="margin: 2%;">Les mieux notées</h1>
        <div class="serie-container">
            @if(!empty($bests))
                @foreach($bests as $best)
                    <div class="card" style="display: inline-block;">
                        <a href="{{route('serie.show', $best->id)}}">
                            <img src="{{asset($best->urlImage)}}" class="card-img-top">
                        </a>
                        <div class="card-body" style="text-align: center">
                            <a href="{{route('serie.show', $best->id)}}">
                                <h5 class="card-title">{{$best->nom}}</h5>
                            </a>
                            <p class="card-text">{{$best->langue}}</p>
                            <p>{{$best->note}}/10</p>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
        <hr/>
        <h1 class="text-center text-uppercase teal-text" style="margin: 2%;">A découvrir !</h1>
        <div  class="serie-container">
            @if(!empty($aleatoires))
                @foreach($aleatoires as $aleatoire)
                    <div class="card">
                        <a href="{{route('serie.show', $aleatoire->id)}}">
                            <img src="{{asset($aleatoire->urlImage)}}" class="card-img-top">
                        </a>
                        <div class="card-body" style="text-align: center">
                            <a href="{{route('serie.show', $aleatoire->id)}}">
                                <h5 class="card-title">{{$aleatoire->nom}}</h5>
                            </a>
                            <p class="card-text">{{$aleatoire->langue}}</p>
                        </div>
                    </div>
                @endforeach
        @endif
        </div>
    </div>
@endsection
