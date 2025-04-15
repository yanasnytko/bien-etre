<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Abuse;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::paginate(12);
        return view('comments.index', compact('comments'));
    }

    public function create()
    {
        return view('comments.create');
    }

    public function store(Request $request)
    {
        // Valider les champs du formulaire
        $validatedData = $request->validate([
            'service_provider_id' => 'required|exists:service_providers,id',
            'title'               => 'required|string|max:255',
            'content'             => 'required|string',
        ]);

        // Créer le commentaire associé à l'utilisateur authentifié
        $validatedData['user_id'] = auth()->id();
        $validatedData['date'] = now();

        Comment::create($validatedData);

        return redirect()->back()->with('success', 'Votre commentaire a été envoyé.');
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

    /**
     * Enregistre le signalement d'un commentaire dans la table "abuses".
     *
     * @param int $id L'ID du commentaire à signaler.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function report($id, Request $request)
    {
        $comment = Comment::findOrFail($id);

        // Valider le champ "reason" si fourni (optionnel)
        $data = $request->validate([
            'reason' => 'nullable|string'
        ]);

        // Enregistrer l'abus en utilisant le modèle Abuse
        Abuse::create([
            'comment_id'         => $comment->id,
            'reported_by_user_id'=> auth()->id(),
            'reason'             => $data['reason'] ?? 'Signalement effectué via le site.',
            'status'             => 'pending',  // Par défaut, l'abus est en attente de traitement
        ]);

        return redirect()->back()->with('success', 'Le commentaire a été signalé.');
    }
}
