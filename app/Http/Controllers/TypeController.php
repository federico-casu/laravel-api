<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTypeRequest;
use App\Http\Requests\UpdateTypeRequest;
use App\Models\Project;
use App\Models\Type;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = Type::all();

        return view('pages.types.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTypeRequest $request)
    {
        $validated_data = $request->validated();

        $validated_data['slug'] = Project::generateRepoName($validated_data['name']);

        $newType = Type::create($validated_data);

        return redirect()->route('dashboard.types.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Type $type)
    {
        return view('pages.types.show', compact('type'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Type $type)
    {
        return view('pages.types.edit', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTypeRequest $request, Type $type)
    {
        $validated_data = $request->validated();

        $validated_data['slug'] = Project::generateRepoName($request->name);


        $type->update($validated_data);

        return redirect()->route('dashboard.types.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Type $type)
    {
        $type->delete();

        return redirect()->route('dashboard.types.index');
    }
}
