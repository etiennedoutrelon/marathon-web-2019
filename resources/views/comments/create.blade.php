@extends('layouts.master')
@section('title', 'Ajouter un commentaire')
@section('content')
    <div style="background-color:rgba(232,231,231,0.4); border:  1px solid black; border-radius: 5px; width: 80%; margin: auto; margin-top: 2rem; margin-bottom: 5rem">
        <form action="{{route('comment.store')}}" method="POST">
            @csrf
            <div class="text-center" style="margin-top: 2rem">
                <h3>Ajouter un commentaire </h3>
                <hr class="mt-2 mb-2">
            </div>
            <input type="hidden" name="serie_id" value="{{$id}}" required>
            <div class="form-group">
                <textarea name="content" id="content" rows="6" class="form-control"
                          placeholder="content ..">{{ old('content') }}</textarea>
            </div>
            <div class="form-group col-md-3">
                <label for="note"><strong>Note: </strong></label>
                <input type="number" class="form-control" id="note" name="note"
                       value="{{ old('note') }}"
                       placeholder="Note de la série /10">
            </div>
            <div style="text-align: center;margin-top: 20px;">

                <button class="btn btn-success" type="submit" style="margin-right: 10px; font-size: larger;"><i class="fas fa-plus-square" style="margin-right: 10px; font-size: larger;"></i>
                    Ajouter
                </button>
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
