<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index() {

        // $projects = Project::all();

        $projects = Project::with('type', 'technologies')->paginate(3);

        return response()->json([
            'success' => true,
            'projects' => $projects
        ]);
    }

    public function show( $repo_name ) {
        $project = Project::with('type', 'technologies')->where('repo_name', $repo_name)->first();

        if ($project) {
            return response()->json([
                'success' => true,
                'project' => $project
            ]);
        } else {
            return response()->json([
                'success' => false,
                'error' => "Non c'é il Progetto che hai cercato"
            ]);
        }
    }
}
