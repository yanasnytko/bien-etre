<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategorieProposalRequest;
use App\Http\Requests\UpdateCategorieProposalRequest;
use App\Models\CategorieProposal;

class CategorieProposalController extends Controller
{
    public function index()
    {
        $proposals = CategorieProposal::all();
        return view('categorie-proposals.index', compact('proposals'));
    }

    public function create()
    {
        return view('categorie-proposals.create');
    }

    public function store(StoreCategorieProposalRequest $request)
    {
        $validatedData = $request->validated();

        CategorieProposal::create($validatedData);
        return redirect()->route('categorie-proposals.index')->with('success', 'Proposition soumise');
    }

    public function show($id)
    {
        $proposal = CategorieProposal::findOrFail($id);
        return view('categorie-proposals.show', compact('proposal'));
    }

    public function edit($id)
    {
        $proposal = CategorieProposal::findOrFail($id);
        return view('categorie-proposals.edit', compact('proposal'));
    }

    public function update(UpdateCategorieProposalRequest $request, $id)
    {
        $proposal = CategorieProposal::findOrFail($id);
        $validatedData = $request->validated();
        
        $proposal->update($validatedData);
        return redirect()->route('categorie-proposals.index')->with('success', 'Proposition mise à jour');
    }

    public function destroy($id)
    {
        $proposal = CategorieProposal::findOrFail($id);
        $proposal->delete();
        return redirect()->route('categorie-proposals.index')->with('success', 'Proposition supprimée');
    }
}
