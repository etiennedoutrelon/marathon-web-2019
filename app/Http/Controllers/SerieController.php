<?php

namespace App\Http\Controllers;

use App\Episode;
use App\Serie;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SerieController extends Controller
{
    public function index(Request $request) {
        $cat = $request->query('cat', 'All');
        if ($cat != 'All') {
            $series = \App\Serie::where('langue', $cat)->get();
        } else {
            $series = \App\Serie::get();
        }
        $langues = \App\Serie::distinct('langue')->pluck('langue');
        if($request->get('search') != null){
            $search = $request->get('search');
            $series = DB::table('series')->where('nom','like','%'.$search.'%')->get();
        }
        return view('serie.index', ['series' => $series, 'cat' => $cat, 'langues' => $langues]);
    }

    public function show(Request $request, $id)
    {
        $order = $request->query('order', 'None');
        if ($order != 'None') {
            if($order == 'desc'){
                $comments = Serie::findOrFail($id)->comments()->orderBy('note', 'desc')->get();
            }
            else{
                $comments = Serie::findOrFail($id)->comments()->orderBy('note', 'asc')->get();
            }
        } else {
            $comments = Serie::findOrFail($id)->comments()->get()->all();
        }
        $serie = Serie::findOrFail($id);
        $genres = Serie::findOrFail($id)->genres()->get()->all();
        $episodes = Serie::findOrFail($id)->episodes()->get()->all();
        $moyenne = Serie::findOrFail($id)->comments()->where('validated', 1)->avg('note');
        $saisons = Serie::findOrFail($id)->episodes()->distinct('saison')->pluck('saison');
        $nbEpisodes = count($episodes);
        $seens = Auth::user()->seen()->get();
        $nbSeens = 0;
        $nbUsersSeen = 0;
        $serieSeen = false;
        $nbComments = count($comments);
        $users = User::all();
        foreach ($users as $user){
            $nbSeensTmp = 0;
            $tmpSeens = $user->seen()->get();
            foreach ($tmpSeens as $seen){
                if($seen->serie_id == $serie->id){
                    $nbSeensTmp++;
                }
            }
            if($nbSeensTmp == $nbEpisodes){
                $nbUsersSeen++;
            }
        }
        foreach ($seens as $seen){
            if($seen->serie_id == $serie->id){
                $nbSeens++;
            }
        }
        if($nbSeens == $nbEpisodes) $serieSeen = true;
        $auteurs = [];
        foreach ($comments as $comment){
            $auteur = User::findOrFail($comment->user_id);
            $auteurs[$comment->id] = $auteur->name;
        }
        return view('serie.show', ['serie' => $serie, 'genres' => $genres, 'episodes' => $episodes, 'comments' => $comments, 'auteurs' => $auteurs, "moyenne" => round($moyenne,2), 'saisons' => $saisons, 'hasSeen' => $serieSeen, 'usersHasSeen' => $nbUsersSeen, 'nbComments' => $nbComments, 'order' => $order]);
    }
    public function hasSeenSerie(Request $request){
        $id = $request->id;
        $user = User::findOrFail(Auth::user()->getAuthIdentifier());
        $episodes = Serie::findOrFail($id)->episodes()->pluck('id');
        $alreadyIn = $user->seen()->pluck('episode_id')->toArray();
        foreach ($episodes as $episode){
            if(!in_array($episode, $alreadyIn)){
                $user->seen()->attach($episode);
            }
        }
        return back()->with('success', 'Vous avez vu toute cette série !');
    }
    public function hasSeenSeason(Request $request){
        $serie_id = $request->serie_id;
        $user = User::findOrFail(Auth::user()->getAuthIdentifier());
        $episodes = Serie::findOrFail($serie_id)->episodes()->where('saison', $request->saison)->pluck('id');
        $alreadyIn = $user->seen()->pluck('episode_id')->toArray();
        $user->seen()->detach($episodes);
        $user->seen()->attach($episodes);
        /*foreach ($episodes as $episode){
            if(!in_array($episode, $alreadyIn)){
                $user->seen()->attach($episode);
            }
        }*/
        return back()->with('success', 'Vous avez vu toute cette saison !');
    }

    public function adAvis(Request $request){
        $serie = Serie::find($request->serie_id);
        return view("serie.adAvis", ['serie'=>$serie]);
    }

    public function store(Request $request)
    {
        $id = $request->serie_id;
        $this->validate(
            $request,
            [
                'avis'=>'required'

            ]
        );

        $serie = Serie::find($id);
        $serie->avis = $request->avis;

        /*
        if ($request->hasFile('urlAvis')  && $request->file('urlAvis')->isValid()) {
            $file = $request->file('urlAvis');
            $base = $serie->name;
            $nom = sprintf("%s.%s",$base,$file->extension());


            $file->storeAs('urlAvis',$nom);
            $serie->urlAvis='storage/urlAvis/'.$nom;
        }
        */

        $serie->save();
        return redirect()->route('serie.show',[$serie->id]);
    }


}
