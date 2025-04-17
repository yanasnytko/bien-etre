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
        $serviceProviders = ServiceProvider::with('user.address.localite')
                                       ->paginate(12);
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
            'comments' => function ($query) {
                $query->doesntHave('abuses');
            },
            'comments.user',
            'stages',         // charge les stages associés
            'promotions',     // charge les promotions associées
            'services'        // si vous souhaitez aussi charger les services associés pour les catégories par exemple
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

        if (!auth()->check()) {
            // Par exemple, rediriger vers la page de connexion ou afficher un message personnalisé
            return redirect()->route('login')->with('error', 'Vous devez être connecté pour effectuer cette opération.');
        }
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
        $query = ServiceProvider::query();

        // Filtre par service_id (pivot)
        if ($serviceId = $request->input('service_id')) {
            $query->whereHas('services', function($q) use ($serviceId) {
                $q->where('services.id', $serviceId);
            });
        }

        // Filtre par localisation (on cherche dans Localite::city)
        if ($localite = $request->input('localite')) {
            $query->whereHas('user.address.localite', function($q) use ($localite) {
                $q->where('city', 'LIKE', "%{$localite}%");
            });
        }

        // Filtre par nom du prestataire
        if ($name = $request->input('name')) {
            $query->where('company_name', 'LIKE', "%{$name}%");
        }

        $serviceProviders = $query->paginate(12);
        $services         = \App\Models\Service::all();

        return view('service-providers.index', compact('serviceProviders', 'services'));
    }
}
