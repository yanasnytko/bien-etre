<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Comment;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::all();
        return view('comments.index', compact('comments'));
    }

    public function create()
    {
        return view('comments.create');
    }

    public function store(StoreCommentRequest $request)
    {
        $validatedData = $request->validated();

        Comment::create($validatedData);
        return redirect()->route('comments.index')->with('success', 'Commentaire créé');
    }

    public function show($id)
    {
        $comment = Comment::findOrFail($id);
        return view('comments.show', compact('comment'));
    }

    public function edit($id)
    {
        $comment = Comment::findOrFail($id);
        return view('comments.edit', compact('comment'));
    }

    public function update(UpdateCommentRequest  $request, $id)
    {
        $comment = Comment::findOrFail($id);
        $validatedData = $request->validated();
        
        $comment->update($validatedData);
        return redirect()->route('comments.index')->with('success', 'Commentaire mis à jour');
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();
        return redirect()->route('comments.index')->with('success', 'Commentaire supprimé');
    }
}
