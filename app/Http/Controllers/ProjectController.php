<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::all();

        return view('pages.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $types = Type::all();
        $technologies = Technology::all();

        return view('pages.projects.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        $validated_data = $request->validated();

        $validated_data['repo_name'] = Project::generateRepoName($validated_data['title']);

        // dd($request);


        if ($request->hasFile('cover_image')) {

            $path = Storage::disk('public')->put('project_covers', $request->cover_image);

            $validated_data['cover_image'] = $path;

            // dd($validated_data, $path);

        }


        $newProject = Project::create($validated_data);

        if ($request->has('technologies')) {
            $newProject->technologies()->attach($request->technologies);
        }

        return redirect()->route('dashboard.projects.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('pages.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        $technologies = Technology::all();

        return view('pages.projects.edit', compact('project', 'types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $validated_data = $request->validated();

        $validated_data['repo_name'] = Project::generateRepoName($request->title);


        if ($request->hasFile('cover_image')) {
            if ($project->cover_image) {
                Storage::delete($project->cover_image);
            }

            $path = Storage::disk('public')->put('project_covers', $request->cover_image);

            $validated_data['cover_image'] = $path;
        }


        $project->update($validated_data);

        if ($request->has('technologies')) {
            $project->technologies()->sync($request->technologies);
        }

        return redirect()->route('dashboard.projects.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->technologies()->sync([]);

        if ($project->cover_image) {
            Storage::delete($project->cover_image);
        }

        $project->delete();

        return redirect()->route('dashboard.projects.index');
    }
}
