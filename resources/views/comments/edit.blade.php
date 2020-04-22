@extends('layouts.master')
@section('title', 'Modifier un commentaire')
@section('content')

    <div class="formulaire">
        <form action="{{route('comment.update',$comment->id)}}" method="POST" style="">
            @csrf
            @method('PUT')
            <div class="text-center">
                <h3>Modifier le commentaire #{{$comment->id}} de la série {{$serie->nom}}</h3>
                <hr class="mt-2 mb-2">
            </div>
            <div class="form-group">
                <label for="textarea-input"><strong>Contenu du commentaire</strong></label>
                <textarea name="content" id="content" rows="4" class="form-control"
                          placeholder="Commentaire..." style="font-weight: bold;">{{ $comment->content }}</textarea>
            </div>
            <div class="form-group col-md-3">
                <label for="note"><strong>Note: </strong></label>
                <input type="number" class="form-control" id="note" name="note"
                       value="{{$comment->note}}"
                       placeholder="Note de la série /10">
            </div>
            <div class="row" style="display: block; margin: auto; text-align: center;">
                <button class="btn btn-success" type="submit" style="display: inline; color: whitesmoke; text-decoration: none;">
                    Valider la modification
                </button>
                <a href="{{route('serie.show',$serie->id)}}">
                    <button class="btn btn-danger" type="button" style="display: inline; color: whitesmoke; text-decoration: none;">
                        Annuler la modification
                    </button>
                </a>
            </div>
        </form>
    </div>

    @if ($errors->any())
        <div style="width: 40%; margin: auto; background-color: rgba(232,231,231,0.4); border-radius: 10px; box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.3);">
            <div style="width: 100%; background-color: #F01330; color: white; height: 80px;  text-align: center; border-top-left-radius: 10px; border-top-right-radius: 10px;">
                <i class="fas fa-exclamation-triangle" style="font-size: 50px; margin-top: 15px; padding: auto;"></i>
            </div>
            <div style="padding-bottom: 20px;">
                <h5 style="text-align: center; margin-top: 10px; color: #F01330;">Les erreurs suivantes doivent être corrigées :</h5>
                <ul style="margin-top: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
@endsection
