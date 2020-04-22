@extends("layouts.master")
@section('title', "{$serie->nom}")
@section("content")
    <style>
        .td-title{
            font-weight: bold;
        }

    </style>
    <div>
        @if(!empty($episodes))
            @foreach ($episodes as $episode)
                <table class="table table-striped table-hover table-bordered" style="margin-left: auto; margin-right: auto; margin-top: 2%;">
                    <thead>
                    <tr>
                        <td colspan="6" style="text-align: center; font-size: larger; font-family: 'Trebuchet MS;', sans-serif">
                            Episode {{$episode->numero}} de la saison {{$episode->saison}} de {{$serie->nom}}
                        </td>
                    </tr>
                    <tr style="text-align: center;">
                        <td colspan="6"><img src="{{asset($episode->urlImage)}}"></td>
                    </tr>
                    <tr>
                        <td style="text-align: center; font-size: larger;">
                            Numéro
                        </td>
                        <td style="text-align: center; font-size: larger;">
                            Nom
                        </td>
                        <td style="text-align: center; font-size: larger;">
                            Résumé
                        </td>
                        <td style="text-align: center; font-size: larger;">
                            Durée
                        </td>
                        <td style="text-align: center; font-size: larger;">
                            Première diffusion
                        </td>
                        <td style="text-align: center; font-size: larger;">
                            Voir l'épisode
                        </td>
                    </tr>
                    </thead>
                    <tr>
                        <td>{{$episode->numero}}</td>
                        <td>{{$episode->nom}}</td>
                        <td>{!!$episode->resume!!}</td>
                        <td>{{$episode->duree}}</td>
                        <td>{{$episode->premiere}}</td>
                        <td><a href="{{route('episode.show', $episode->id)}}"><button class="btn btn-sm btn-orange font-weight-bold">Info</button> </a></td>
                    </tr>
                </table>
            @endforeach
        @endif
        <a href="{{route('serie.show', $episode->serie_id)}}"><button class="btn btn-outline-blue font-weight-bold">Retour sur {{$serie->nom}}</button> </a>
        <form method="get" action="{{route('hasSeenSeason')}}" style="display: inline;">
            @csrf
            @method('GET')
            <input type="hidden" value="{{$episode->serie_id}}" name="serie_id">
            <input type="hidden" value="{{$episode->saison}}" name="saison">
            @if(!$seasonSeen)
                <button type="submit" class="btn btn-orange font-weight-bold">J'ai vu cette saison !</button>
            @endif
        </form>
    </div>

@endsection
