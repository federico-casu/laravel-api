@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Project</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('dashboard.projects.update', $project) }}" method="POST" enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title"
                    value="{{ old('title') ?? $project->title }}" />

                @error('title')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">

                <label for="cover_image" class="form-label">Cover image</label>
                @if ($project->cover_image)
                    <img class="d-block mb-3" src="{{ asset('/storage/' . $project->cover_image) }}"
                        alt="{{ $project->title }}">
                @endif

                <input type="file" class="form-control" name="cover_image" id="cover_image"
                    value="{{ old('cover_image') ?? $project->cover_image }}" />
            </div>

            <div class="mb-3">
                <label for="type_id" class="form-label">Type</label>
                <select class="form-select form-select-lg @error('type_id') is_invalid @enderror" name="type_id"
                    id="type_id">
                    <option selected value="">Select one</option>
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}"
                            {{ $type->id == old('type_id', $project->type ? $project->type->id : '') ? 'selected' : '' }}>
                            {{ $type->name }}</option>
                    @endforeach
                </select>
            </div>


            <div class="mb-3">
                <span class="form-label d-block">Technologies</span>
                @forelse ($technologies as $technology)
                    @if ($errors->any())
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="technologies" name="technologies[]"
                                value="{{ $technology->id }}" {{ in_array($technology->id, old('technologies', [])) ? 'checked' : '' }} />
                            <label class="form-check-label" for="technologies">{{ $technology->name }}</label>
                        </div>
                    @else
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="technologies" name="technologies[]"
                                value="{{ $technology->id }}" {{ $project->technologies->contains($technology->id) ? 'checked' : '' }} />
                            <label class="form-check-label" for="technologies">{{ $technology->name }}</label>
                        </div>
                    @endif
                @empty

                    <span>There are no technologies</span>
                @endforelse
            </div>


            <div class="mb-3">
                <label for="repo_link" class="form-label">Repository link</label>
                <input type="text" class="form-control" name="repo_link" id="repo_link"
                    value="{{ old('repo_link') ?? $project->repo_link }}" />
            </div>


            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" name="description" id="description" rows="3">{{ old('description') ?? $project->description }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>

        </form>
    </div>
@endsection
