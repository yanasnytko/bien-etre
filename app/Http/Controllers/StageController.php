<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStageRequest;
use App\Http\Requests\UpdateStageRequest;
use App\Models\Stage;

class StageController extends Controller
{
    public function index()
    {
        $stages = Stage::paginate(12);
        return view('stages.index', compact('stages'));
    }

    public function create()
    {
        // Récupérer le serviceProvider lié à l’utilisateur,
        // ou abort(403) si l’utilisateur n’est pas prestataire
        $user = auth()->user();
        if (! $user || ! $user->is_provider || ! $user->serviceProvider) {
            abort(403, 'Vous devez être prestataire pour créer un stage.');
        }

        $serviceProviderId = $user->serviceProvider->id;

        return view('stages.create', compact('serviceProviderId'));
    }

    public function store(StoreStageRequest $request)
    {
        $validatedData = $request->validated();
        
        Stage::create($validatedData);
        return redirect()->route('stages.index')->with('success', 'Stage créé');
    }

    public function show($id)
    {
        $stage = Stage::with('serviceProvider.user')  // on charge aussi l'user si besoin
                  ->findOrFail($id);

        return view('stages.show', compact('stage'));
    }

    public function edit($id)
    {
        $stage = Stage::findOrFail($id);
        return view('stages.edit', compact('stage'));
    }

    public function update(UpdateStageRequest $request, $id)
    {
        $stage = Stage::findOrFail($id);
        $validatedData = $request->validated();
        
        $stage->update($validatedData);
        return redirect()->route('stages.index')->with('success', 'Stage mis à jour');
    }

    public function destroy($id)
    {
        $stage = Stage::findOrFail($id);
        $stage->delete();
        return redirect()->route('stages.index')->with('success', 'Stage supprimé');
    }
}
