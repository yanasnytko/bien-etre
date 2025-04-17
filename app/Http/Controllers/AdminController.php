<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Affiche le dashboard administratif.
     */
    public function index()
    {
        // Tu peux charger ici des stats / compteurs d’utilisateurs, prestataires, etc.
        // Par exemple :
        // $usersCount            = \App\Models\User::count();
        // $providersCount        = \App\Models\ServiceProvider::count();
        // $pendingProposalsCount = \App\Models\CategorieProposal::where('status','pending')->count();
        //
        // return view('admin.dashboard', compact('usersCount','providersCount','pendingProposalsCount'));

        return view('admin.dashboard');
    }
}
