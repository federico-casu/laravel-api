@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>My projects</h1>

        <a class="btn btn-primary my-3" href="{{ route('dashboard.projects.create') }}">Create new project</a>

        <div
            class="table-responsive"
        >
            <table
                class="table"
            >
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Title</th>
                        <th scope="col">Repo Name</th>
                        <th scope="col">Repo Link</th>
                        <th scope="col">Description</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($projects as $project)
                        <tr class="">
                            <td>{{ $project->id }}</td>
                            <td>{{ $project->title }}</td>
                            <td>{{ $project->repo_name }}</td>
                            <td><a href="{{ route('dashboard.projects.show', $project->repo_name) }}">{{ $project->repo_link }}</a></td>
                            <td>{{ $project->description }}</td>
                            <td>
                                <a class="btn btn-primary w-100 mb-3" href="{{ route('dashboard.projects.edit', $project->repo_name) }}">Edit</a>

                                <form action="{{ route('dashboard.projects.destroy', $project->repo_name) }}" method="POST">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger w-100">Delete</button>

                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
    </div>
@endsection
