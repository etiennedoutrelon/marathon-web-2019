@extends("layouts.master")
@section('title', "{$serie->nom}")
@section("content")
    <style>
        .td-title{
            font-weight: bold;
        }
    </style>

    <div>
        <table class="table table-striped table-hover table-bordered" style="margin-left: auto; margin-right: auto; width: 100%; margin-top: 3%;">
            <thead>
            <tr>
                <td colspan="2" style="text-align: center; font-size: larger; font-family: 'Trebuchet MS;',sans-serif">
                    Épisode {{$episode->numero}} : {{$episode->nom}} de la saison {{$episode->saison}} de la série {{$serie->nom}}
                </td>
            </tr>
            </thead>
            @if($episode->urlImage !== null)
                <tr>
                    <td colspan="2"><img src="{{asset($episode->urlImage)}}" style="margin: auto; display: block; max-width: 100%; max-height: 40vh;"></td>
                </tr>
            @endif
            <tr>
                <td class="td-title">Résumé</td>
                <td>{!!$episode->resume !!}</td>
            </tr>
            <tr>
                <td class="td-title">Durée de l'épisode</td>
                <td>{{$episode->duree}} minutes</td>
            </tr>
            <tr>
                <td class="td-title">Première</td>
                <td>{{$episode->premiere}}</td>
            </tr>
        </table>
        <a href="{{route('episode.show', $episode->id-1)}}"><button class="btn btn-outline-blue font-weight-bold">Episode précédent</button></a>
        <a href="{{route('episode.show', $episode->id+1)}}"><button class="btn btn-outline-blue font-weight-bold">Episode suivant</button></a>
        <a href="{{route('episode.index').'?serie='.$serie->id.'&saison='.$episode->saison}}"><button class="btn btn-orange font-weight-bold">Saison {{$episode->saison}}</button></a>
        @if(count($seen) == 0)
            <form method="post" action="{{route('hasSeenEpisode')}}" style="display: inline;">
                @csrf
                @method('GET')
                <input type="hidden" value="{{$episode->id}}" name="id">
                <button type="submit" class="btn btn-orange font-weight-bold">J'ai vu cet épisode !</button>
            </form>
        @endif
    </div>
@endsection
