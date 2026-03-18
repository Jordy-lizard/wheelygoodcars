@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1>Mijn Aanbod</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Kenteken</th>
                    <th>Merk</th>
                    <th>Model</th>
                    <th>Bouwjaar</th>
                    <th>Prijs (€)</th>
                    <th>Acties</th>
                </tr>
            </thead>
            <tbody>
                @forelse($cars as $car)
                    <tr>
                        <td>{{ $car->license_plate }}</td>
                        <td>{{ $car->brand }}</td>
                        <td>{{ $car->model }}</td>
                        <td>{{ $car->year }}</td>
                        <td>€{{ number_format($car->price, 2) }}</td>
                        <td>
                            <!-- Edit Button -->
                            <a href="{{ route('cars.edit', $car->id) }}" class="btn btn-warning btn-sm">Bewerken</a>

                            <!-- Delete Button -->
                            <form action="{{ route('cars.destroy', $car->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Weet je zeker dat je deze auto wilt verwijderen?')">Verwijderen</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Je hebt nog geen auto's toegevoegd.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
