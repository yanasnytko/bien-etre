<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Affiche la liste des catégories.
     */
    public function index()
    {
        $services = Service::paginate(12);
        return view('services.index', compact('services'));
    }

    /**
     * Affiche le formulaire de création d'une nouvelle catégorie.
     */
    public function create()
    {
        return view('services.create');
    }

    /**
     * Stocke une nouvelle catégorie.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name'  => 'required|string|max:200',
            'description' => 'nullable|string',
        ]);
        
        Service::create($validatedData);
        return redirect()->route('services.index')->with('success', 'Catégorie créée');
    }

    /**
     * Affiche les détails d'une catégorie.
     */
    public function show($id)
    {
        $service = Service::findOrFail($id);
        return view('services.show', compact('service'));
    }

    /**
     * Affiche le formulaire pour modifier une catégorie.
     */
    public function edit($id)
    {
        $service = Service::findOrFail($id);
        return view('services.edit', compact('service'));
    }

    /**
     * Met à jour une catégorie.
     */
    public function update(Request $request, $id)
    {
        $service = Service::findOrFail($id);
        $validatedData = $request->validate([
            'name'        => 'required|string|max:200',
            'description' => 'nullable|string',
        ]);
        
        $service->update($validatedData);
        return redirect()->route('services.index')->with('success', 'Catégorie mise à jour');
    }

    /**
     * Supprime une catégorie.
     */
    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        $service->delete();
        return redirect()->route('services.index')->with('success', 'Catégorie supprimée');
    }
}
