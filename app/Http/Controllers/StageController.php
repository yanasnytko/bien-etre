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
        return view('stages.create');
    }

    public function store(StoreStageRequest $request)
    {
        $validatedData = $request->validated();
        
        Stage::create($validatedData);
        return redirect()->route('stages.index')->with('success', 'Stage créé');
    }

    public function show($id)
    {
        $stage = Stage::findOrFail($id);
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
