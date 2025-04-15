<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreServiceProviderRequest;
use App\Http\Requests\UpdateServiceProviderRequest;
use App\Models\ServiceProvider;

class ServiceProviderController extends Controller
{
    /**
     * Affiche la liste des prestataires.
     */
    public function index()
    {
        $serviceProviders = ServiceProvider::paginate(12);
        return view('service-providers.index', compact('serviceProviders'));
    }

    /**
     * Affiche le formulaire de création d'un nouveau prestataire.
     */
    public function create()
    {
        return view('service-providers.create');
    }

    /**
     * Stocke un nouveau prestataire en base de données.
     */
    public function store(StoreServiceProviderRequest $request)
    {
        $validatedData = $request->validated();
        
        ServiceProvider::create($validatedData);
        return redirect()->route('service-providers.index')
                         ->with('success', 'Prestataire créé avec succès');
    }

    /**
     * Affiche les détails d'un prestataire.
     */
    public function show($id)
    {
        // Charge également la relation 'comments' (et éventuellement 'comments.user' pour obtenir le nom de l'auteur)
        $serviceProvider = ServiceProvider::with([
            'comments' => function($query) {
                $query->doesntHave('abuses');
            },
            'comments.user'
        ])->findOrFail($id);
    
        return view('service-providers.show', compact('serviceProvider'));
    }

    /**
     * Affiche le formulaire de modification d'un prestataire.
     */
    public function edit($id)
    {
        $serviceProvider = ServiceProvider::findOrFail($id);
        return view('service-providers.edit', compact('serviceProvider'));
    }

    /**
     * Met à jour un prestataire existant.
     */
    public function update(UpdateServiceProviderRequest $request, $id)
    {
        $serviceProvider = ServiceProvider::findOrFail($id);

        // On vérifie ici avec la policy que l'utilisateur authentifié peut mettre à jour ce prestataire.
        if (auth()->user()->cannot('update', $serviceProvider)) {
            abort(403, 'Vous n\'êtes pas autorisé à modifier ce prestataire.');
        }
        
        $validatedData = $request->validated();

        $serviceProvider->update($validatedData);
        return redirect()->route('service-providers.index')
                         ->with('success', 'Prestataire mis à jour');
    }

    /**
     * Supprime un prestataire.
     */
    public function destroy($id)
    {
        $serviceProvider = ServiceProvider::findOrFail($id);
        $serviceProvider->delete();
        return redirect()->route('service-providers.index')
                         ->with('success', 'Prestataire supprimé');
    }
}
