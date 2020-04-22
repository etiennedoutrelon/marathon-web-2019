<?php
namespace App\Http\Controllers;
use App\Comment;
use App\Episode;
use App\Genre;
use App\Serie;
use App\User;
use Illuminate\Http\Request;
class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $nbSeries = Serie::all()->count();
        $nbEpisodes = Episode::all()->count();
        $nbComments = Comment::all()->count();
        $nbGenres = Genre::all()->count();
        $nbUsers = User::all()->count();
        return view('admin.index', ['nbSeries' => $nbSeries, 'nbComments' => $nbComments, 'nbEpisodes' => $nbEpisodes, 'nbUsers' => $nbUsers, 'nbGenres' => $nbGenres]);
    }
    public function members()
    {
        $members = User::all();
        return view('admin.members', ['members' => $members]);
    }
    public function update(Request $request){
        $user = User::findOrFail($request->id);
        if($user->administrateur === 1)
            $user->administrateur = User::DEFAULT_TYPE;
        else
            $user->administrateur = User::ADMIN_TYPE;
        $user->save();
        return redirect(route('admin.members'));
    }
}
