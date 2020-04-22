@extends("layouts.master")
@section('title', "{$serie->nom}")
@section("content")
    <div>
        <table class="table table-striped table-hover table-bordered" style="margin-left: auto; margin-right: auto; width: 100%; margin-top: 3%;">
            <thead>
            <tr>
                <td colspan="3" class="titreSerie" style="text-align: center">
                    {{$serie->nom}}
                </td>
            </tr>
            </thead>
            @if($serie->urlImage !== null)
                <td rowspan="11"><img class="img" src="{{asset($serie->urlImage)}}"></td>
            @endif
            <tr>
                <td style="width: 160px;" class="td-title">Identifiant série</td>
                <td>{{$serie->id}}</td>
            </tr>
            <tr>
                <td class="td-title">Langue</td>
                <td>{{$serie->langue}}</td>
            </tr>
            <tr>
                <td class="td-title">Note</td>
                <td>{{$serie->note}}/10</td>
            </tr>
            <tr>
                <td class="td-title">Première</td>
                <td>{{$serie->premiere}}</td>
            </tr>
            <tr>
                <td class="td-title">Résumé</td>
                <td>{!!$serie->resume!!}</td>
            </tr>
            <tr>
                <td class="td-title">Statut</td>
                <td>
                    {{$serie->statut}}
                </td>
            </tr>
            <tr>
                <td class="td-title">Nombre d'avis</td>
                <td>
                    {{$nbComments}}
                </td>
            </tr>
            <tr>
                <td class="td-title">Utilisateur ayant regardé cette série</td>
                <td>
                    {{$usersHasSeen}}
                </td>
            </tr>
            @if($serie->avis != null)
                <tr>
                    <td class="td-title">Avis rédaction</td>
                    <td>
                        {{$serie->avis}}
                    </td>
                </tr>
            @endif
            @if($serie->urlAvis != null)
                <tr>
                    <td class="td-title">Avis vidéo</td>
                    <td>
                        {{$serie->urlAvis}}
                    </td>
                </tr>
            @endif
        </table>
    </div>
    <div class="backToPage">
        <a href="{{route('home')}}"><button class="btn btn-blue">Home</button></a> <!-- ajout de la class btnSearch-->
        @if(!$hasSeen)
        <form method="post" action="{{route('hasSeenSerie')}}" style="display: inline;">
            @csrf
            @method('GET')
            <input type="hidden" value="{{$serie->id}}" name="id">
            <button type="submit" class="btn btn-orange font-weight-bold">J'ai vu cette série !</button>
        </form>
        @endif
        <br/><br/>
        @foreach($saisons as $saison)
            <a href="{{route('episode.index').'?serie='.$serie->id.'&saison='.$saison}}"><button class="btn btn btn-orange font-weight-bold">Saison {{$saison}}</button></a>
        @endforeach
        <br/><br/>
        <h2>Moyenne de cette série : {{$moyenne}}/10</h2>
        <form action="{{route("serie.show", $serie->id)}}" method="get" class="form-inline my-2 my-lg-0 justify-content-center">
            <select class="custom-select" name="order" style="width: 200px;">
                <option value="None" @if($order == 'None') selected @endif>Pas de tri</option>
                <option value="asc"  @if($order == 'asc') selected @endif>Ordre croissant des notes</option>
                <option value="desc"  @if($order == 'desc') selected @endif>Ordre décroissant des notes</option>
            </select>
            <button type="submit" class="btn btn-sm btn-orange font-weight-bold my-2 my-sm-0" style="margin-left: 20px;">OK</button>
        </form>
        @if(!empty($comments))
            @foreach ($comments as $comment)
                @if($comment->validated === 1)
                    <table class="table table-striped table-hover table-bordered" style="margin-left: auto; margin-right: auto; margin-top: 2%;">
                        <thead>
                        <tr>
                            <td colspan="2"  class="titreSerie" style="text-align: center">
                                Commentaire #{{$comment->id}}
                                @auth
                                    @if(\Illuminate\Support\Facades\Auth::user()->getAuthIdentifier()==$comment->user_id)
                                        <form action="{{route('comment.destroy',[$comment->id])}}" method="POST" style="display: inline !important;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" name="delete" class="float-right" value="valide" style="padding-right: 2%; background-color: white; border: none; color: rgba(255,47,56,0.71);"><i class="fas fa-times" style="color: rgba(255,47,56,0.71);"></i></button>
                                        </form>
                                        <div class="float-left" style="padding-left: 2%;">
                                            <a href="{{route('comment.edit', $comment->id)}}">
                                                <i class="fas fa-edit" style="color: rgba(255,116,55,0.71);"></i>
                                            </a>
                                        </div>
                                    @endif
                                @endauth
                            </td>
                        </tr>
                        </thead>
                        <tr>
                            <td style="width: 160px;" class="td-title">Contenu</td>
                            <td>{{$comment->content}}</td>
                        </tr>
                        <tr>
                            <td style="width: 160px;" class="td-title">Note</td>
                            <td>{{$comment->note}}/10</td>
                        </tr>
                        <tr>
                            <td style="width: 160px;" class="td-title">Auteur</td>
                            <td>{{$auteurs[$comment->id]}}</td>
                        </tr>
                        <tr>
                            <td style="width: 160px;" class="td-title">Série</td>
                            <td>{{$serie->nom}}</td>
                        </tr>
                        <tr>
                            <td style="width: 160px;" class="td-title">Créé le</td>
                            <td>{{$comment->created_at->format('l jS \\of F Y h:i:s A')}}</td>
                        </tr>
                        @if($comment->created_at != $comment->updated_at)
                            <tr>
                                <td style="width: 160px;" class="td-title">Édité le</td>
                                <td>{{$comment->updated_at->format('l jS \\of F Y h:i:s A')}}</td>
                            </tr>
                        @endif
                        @if(Auth::user()->isAdmin())
                            <tr>
                                <td style="width: 160px;" class="td-title">Action</td>
                                <td>
                                    @if($comment->validated === 1)
                                        <a href="{{route('commentaireUnvalide',$comment->id)}}">
                                            <button class="btn btn-danger">Dévalider</button>
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endif
                    </table>
                @endif
            @endforeach
            @if(Auth::user()->isAdmin())
                @foreach ($comments as $comment)
                    @if($comment->validated != 1)
                            <table class="table table-striped table-hover table-bordered" style="margin-left: auto; margin-right: auto; margin-top: 2%;">
                                <thead>
                                <tr>
                                    <td colspan="2" style="text-align: center; font-size: larger; font-family: 'Trebuchet MS;', sans-serif">
                                        Commentaire #{{$comment->id}}
                                        @auth
                                            @if(\Illuminate\Support\Facades\Auth::user()->getAuthIdentifier()==$comment->user_id)
                                                <form action="{{route('comment.destroy',[$comment->id])}}" method="POST" style="display: inline !important;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" name="delete" class="float-right" value="valide" style="padding-right: 2%; background-color: white; border: none; color: rgba(255,47,56,0.71);"><i class="fas fa-times" style="color: rgba(255,47,56,0.71);"></i></button>
                                                </form>
                                                <div class="float-left" style="padding-left: 2%;">
                                                    <a href="{{route('comment.edit', $comment->id)}}">
                                                        <i class="fas fa-edit" style="color: rgba(255,116,55,0.71);"></i>
                                                    </a>
                                                </div>
                                            @endif
                                        @endauth
                                    </td>
                                </tr>
                                </thead>
                                <tr>
                                    <td style="width: 160px;" class="td-title">Contenu</td>
                                    <td>{{$comment->content}}</td>
                                </tr>
                                <tr>
                                    <td style="width: 160px;" class="td-title">Note</td>
                                    <td>{{$comment->note}}/10</td>
                                </tr>
                                <tr>
                                    <td style="width: 160px;" class="td-title">Auteur</td>
                                    <td>{{$auteurs[$comment->id]}}</td>
                                </tr>
                                <tr>
                                    <td style="width: 160px;" class="td-title">Série</td>
                                    <td>{{$serie->nom}}</td>
                                </tr>
                                <tr>
                                    <td style="width: 160px;" class="td-title">Créé le</td>
                                    <td>{{$comment->created_at->format('l jS \\of F Y h:i:s A')}}</td>
                                </tr>
                                @if($comment->created_at != $comment->updated_at)
                                    <tr>
                                        <td style="width: 160px;" class="td-title">Édité le</td>
                                        <td>{{$comment->updated_at->format('l jS \\of F Y h:i:s A')}}</td>
                                    </tr>
                                @endif
                                    <td style="width: 160px;" class="td-title">Action</td>
                                    <td>
                                        @if($comment->validated === 0)
                                            <a href="{{route('commentaireValide',$comment->id)}}">
                                                <button class="btn btn-success">Valider</button>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                    @endif
                @endforeach
            @endif
            <div>
                <a href="{{route('comment.create',[$serie->id])}}">
                    <button class="btn btn-green">Ajouter un commentaire</button>
                </a>
                @if(\Illuminate\Support\Facades\Auth::user()->isAdmin())
                <a href="{{route('adAvis',['serie_id'=>$serie->id])}}">
                    <button class="btn btn-teal">Ajouter un avis</button>
                </a>
                @endif
            </div>
        @else
            <h5 style="text-align: center; color: rgb(218, 43, 14);">Aucun commentaire pour cette série actuellement.</h5>
        @endif
    </div>

@endsection
