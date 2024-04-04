@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Projects Types</h1>

        <a class="btn btn-primary my-3" href="{{ route('dashboard.types.create') }}">Create new type</a>

        <div
            class="table-responsive"
        >
            <table
                class="table"
            >
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Slug</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($types as $type)
                        <tr class="">
                            <td>{{ $type->id }}</td>
                            <td>{{ $type->name }}</td>
                            <td><a href="{{ route('dashboard.types.show', $type->id) }}">{{ $type->slug }}</a></td>
                            <td class="d-flex gap-4">
                                <a class="btn btn-primary w-25 mb-3" href="{{ route('dashboard.types.edit', $type->id) }}">Edit</a>

                                <form class="w-100" action="{{ route('dashboard.types.destroy', $type->id) }}" method="POST">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger w-25">Delete</button>

                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
    </div>
@endsection
