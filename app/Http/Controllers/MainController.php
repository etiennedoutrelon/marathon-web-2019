<?php

namespace App\Http\Controllers;

use App\Serie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    function index() {
        $bests = DB::table('series')->orderByDesc('note')->limit(4)->get();
        $aleatoires = Serie::all()->random(4);

        return view('index', ['bests' => $bests, 'aleatoires' => $aleatoires]);
    }
}
