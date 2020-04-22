@extends('layouts.master')
@section('title', 'Statistiques')
@section('content')
    <div class="container" style="margin-top: 3%; padding-bottom: 1%;">
        <div class="row justify-content-center">
            <div class="col-md-8 border border-light p-4">
                @if(Auth::user()->avatar != null)
                    <img src="{{url(Auth::user()->avatar)}}" class="avatar">
                    <br/>
                @endif
                <h3 class="font-weight-bold teal-text text-uppercase text-center">{{$user->name}}</h3>
                <hr/>
                <h4 class="font-weight-bold teal-text text-uppercase text-center">Mes Statistiques</h4>
                    <ul>
                        <li class="teal-text">Nombre de séries regardés : {{count($series)}}</li>
                        <li class="teal-text">Nombre d'épisodes regardés : {{count($seens)}}</li>
                        <li class="teal-text">Minutes totales regardées : {{$seens->sum('duree')}} minutes</li>
                        <li class="teal-text">Nombre d'avis postés : {{$comments->count('id')}}</li>
                    </ul>
            </div>
        </div>
    </div>

@endsection
