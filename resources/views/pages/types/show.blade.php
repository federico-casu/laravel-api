@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $type->name }}</h1>
        <h4 class="">{{ $type->slug }}</h4>
    </div>
@endsection