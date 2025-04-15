<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

    /**
     * Recherche des prestataires selon divers critères.
     */
    public function search(Request $request)
    {
        // Commencer la requête sur le modèle ServiceProvider
        $query = ServiceProvider::query();

        // Filtre par catégorie de service (on suppose que la relation "services" existe)
        if ($request->filled('service_id')) {
            $serviceId = $request->input('service_id');
            $query->whereHas('services', function($q) use ($serviceId) {
                $q->where('services.id', $serviceId);
            });
        }

        // Filtre par localité
        // On suppose ici que le prestataire a une relation vers son adresse ou localité
        // Si vous avez une relation par exemple "address.localite"
        if ($request->filled('localite')) {
            $localite = $request->input('localite');
            $query->whereHas('address.localite', function($q) use ($localite) {
                $q->where('city', 'like', '%' . $localite . '%');
            });
        }

        // Filtre par nom du prestataire
        if ($request->filled('name')) {
            $name = $request->input('name');
            $query->where('company_name', 'like', '%' . $name . '%');
        }

        // Si aucun critère n'est renseigné, la requête retourne tous les prestataires
        // paginer les résultats (par exemple, 12 par page)
        $serviceProviders = $query->paginate(12);

        // Retourner la vue index avec les prestataires filtrés.
        // Vous pouvez utiliser la même vue que pour l'index classique.
        return view('service-providers.index', compact('serviceProviders'));
    }
}
