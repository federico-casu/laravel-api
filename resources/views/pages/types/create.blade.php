@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create new Type</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('dashboard.types.store') }}" method="POST">

            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control @error ('name') is-invalid @enderror" name="name" id="name" />

                @error('name')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Create</button>

        </form>
    </div>
@endsection
