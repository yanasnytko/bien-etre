<?php

namespace App\Http\Controllers;

use App\Models\Abuse;
use Illuminate\Http\Request;

class AbuseController extends Controller
{
    /**
     * Affiche la liste des abus signalés.
     */
    public function index()
    {
        // Charger avec pagination et en eager loading pour afficher les détails liés, par exemple l'élément commenté et l'utilisateur qui a signalé.
        $abuses = Abuse::with(['comment', 'reportedBy'])->paginate(15);
        return view('abuses.index', compact('abuses'));
    }

    /**
     * Affiche le détail d'un abus signalé.
     */
    public function show($id)
    {
        $abuse = Abuse::with(['comment', 'reportedBy'])->findOrFail($id);
        return view('abuses.show', compact('abuse'));
    }

    /**
     * Met à jour le statut d'un abus.
     */
    public function update(Request $request, $id)
    {
        $abuse = Abuse::findOrFail($id);

        $validatedData = $request->validate([
            'status' => 'required|in:pending,approved,rejected',
        ]);

        $abuse->update($validatedData);

        return redirect()->route('abuses.index')->with('success', 'Abus mis à jour avec succès.');
    }

    /**
     * Supprime un abus.
     */
    public function destroy($id)
    {
        $abuse = Abuse::findOrFail($id);
        $abuse->delete();
        return redirect()->route('abuses.index')->with('success', 'Abus supprimé avec succès.');
    }

    // Les méthodes create() et store() ne sont généralement pas nécessaires,
    // car les abus sont générés via l'action "signaler" d'un commentaire.
}
