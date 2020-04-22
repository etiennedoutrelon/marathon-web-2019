<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Serie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{

    public function valide($id){
        $comment = Comment::findOrFail($id);
        $comment->validated = 1;
        $comment->save();
        return back();

    }

    public function unvalide($id){
        $comment = Comment::findOrFail($id);
        $comment->validated = 0;
        $comment->save();
        return back();

    }

    public function create($id_serie)
    {
        return view('comments.create',["id"=>$id_serie]);
    }

    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'content' => 'required',
            ]
        );

        $comment = new Comment();
        $comment->content = $request->get('content');
        if ($request->note === null){
            $comment->note = 'pas de note';
        }
        else{
            $comment->note = $request->note;
        }
        $comment->validated = 0;
        $comment->user_id = Auth::user()->getAuthIdentifier();
        $comment->serie_id = $request->serie_id;


        $comment->save();

        return redirect('/serie/'.$request->serie_id);
    }

    public function destroy(Request $request,$id) {
        if ($request->delete == 'valide') {
            $coment = Comment::find($id);
            $coment->delete();
        }
        return redirect()->back();
    }

    public function edit($id)
    {
        $comment = Comment::findOrFail($id);
        $serie = Serie::findOrFail($comment->serie_id);
        return view('comments.edit', ['comment' => $comment, 'serie' => $serie]);
    }

    public function update(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'content' => 'required',
            ]
        );
        $comment = Comment::findOrFail($id);
        $comment->content = $request->get('content');
        if ($request->note === null){
            $comment->note = 'pas de note';
        }
        else{
            $comment->note = $request->note;
        }
        $comment->save();
        return redirect('/serie/'.$comment->serie_id);
    }
}
