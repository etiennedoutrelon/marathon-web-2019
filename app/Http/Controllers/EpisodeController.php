<?php

namespace App\Http\Controllers;

use App\Episode;
use App\Serie;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EpisodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $id = $request->get("serie");
        $serie = Serie::findOrFail($id);
        $episodes = Serie::findOrFail($id)->episodes()->where('saison', $request->get("saison"))->get();
        $episodesSeen = Auth::user()->seen()->get();
        $nbEpisodesSeen = 0;
        $seasonSeen = false;
        foreach ($episodesSeen as $episodeSeen){
            if($episodeSeen->saison == $request->get("saison") && $episodeSeen->serie_id == $serie->id){
                $nbEpisodesSeen++;
            }
        }
        if($nbEpisodesSeen == count($episodes)) $seasonSeen = true;
        return view('episode.index', ['episodes' => $episodes, 'serie' => $serie, 'seasonSeen' => $seasonSeen]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $episode = Episode::findOrFail($id);
        $serie = Serie::findOrFail($episode->serie_id);
        $seen = Auth::user()->seen()->where('episode_id', $episode->id)->get();
        return view('episode.show', ['episode' => $episode, 'serie' => $serie, 'seen' => $seen]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function hasSeenEpisode(Request $request){
        $episode = Episode::findOrFail($request->id);
        $user = User::findOrFail(Auth::user()->getAuthIdentifier());
        $alreadyIn = $user->seen()->pluck('episode_id')->toArray();
        if(!in_array($episode->id, $alreadyIn)){
            $user->seen()->attach($episode);
        }
        return back()->with('success', 'Vous avez vu cet épisode !');
    }
    public function hasSeenSeason(Request $request){
        $serie = $request->get('serie');
        $user = User::findOrFail(Auth::user()->getAuthIdentifier());
        $episodes = Serie::findOrFail($serie)->episodes()->where('saison', $request->saison)->pluck('id');
        $alreadyIn = $user->seen()->pluck('episode_id')->toArray();
        foreach ($episodes as $episode){
            if(!in_array($episode, $alreadyIn)){
                $user->seen()->attach($episode);
            }
        }
        return back()->with('success', 'Vous avez vu toute cet saison !');
    }
}
