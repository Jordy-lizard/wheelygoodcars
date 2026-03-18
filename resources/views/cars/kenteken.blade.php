@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1>Stap 1: Kenteken Invoeren</h1>

        <form action="{{ route('cars.checkKenteken') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="license_plate">Kenteken:</label>
                <input type="text" name="license_plate" class="form-control" value="{{ old('license_plate') }}" required>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Volgende</button>
        </form>
    </div>
@endsection
