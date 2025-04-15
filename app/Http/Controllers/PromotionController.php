<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePromotionRequest;
use App\Http\Requests\UpdatePromotionRequest;
use App\Models\Promotion;

class PromotionController extends Controller
{
    public function index()
    {
        $promotions = Promotion::paginate(12);
        return view('promotions.index', compact('promotions'));
    }

    public function create()
    {
        return view('promotions.create');
    }

    public function store(StorePromotionRequest $request)
    {
        $validatedData = $request->validated();
        
        Promotion::create($validatedData);
        return redirect()->route('promotions.index')->with('success', 'Promotion créée');
    }

    public function show($id)
    {
        $promotion = Promotion::findOrFail($id);
        return view('promotions.show', compact('promotion'));
    }

    public function edit($id)
    {
        $promotion = Promotion::findOrFail($id);
        return view('promotions.edit', compact('promotion'));
    }

    public function update(UpdatePromotionRequest $request, $id)
    {
        $promotion = Promotion::findOrFail($id);
        $validatedData = $request->validated();
        
        $promotion->update($validatedData);
        return redirect()->route('promotions.index')->with('success', 'Promotion mise à jour');
    }

    public function destroy($id)
    {
        $promotion = Promotion::findOrFail($id);
        $promotion->delete();
        return redirect()->route('promotions.index')->with('success', 'Promotion supprimée');
    }
}
