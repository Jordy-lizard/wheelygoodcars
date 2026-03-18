@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <!-- Progress Bar -->
        <div class="progress" style="height: 20px;">
            <div class="progress-bar" role="progressbar" style="width: 33%;" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100"></div>
        </div>

        <h1>Stap 2: Gegevens Invullen</h1>

        <form action="{{ route('cars.opslaan') }}" method="POST" enctype="multipart/form-data" id="formStep2">
            @csrf
            <input type="hidden" name="license_plate" value="{{ $carData['license_plate'] }}">

            <div class="form-group">
                <label for="brand">Merk:</label>
                <input type="text" name="brand" class="form-control" value="{{ $carData['brand'] }}" required>
            </div>

            <div class="form-group">
                <label for="model">Model:</label>
                <input type="text" name="model" class="form-control" value="{{ $carData['model'] }}" required>
            </div>

            <div class="form-group">
                <label for="year">Bouwjaar:</label>
                <input type="number" name="year" class="form-control" value="{{ $carData['year'] }}" required>
            </div>

            <div class="form-group">
                <label for="price">Prijs (€):</label>
                <input type="number" name="price" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="photo">Foto van de auto:</label>
                <input type="file" name="photo" class="form-control">
                @error('photo')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary mt-3">Auto Opslaan</button>
        </form>
    </div>

    <style>
        .progress {
            width: 100%;
            background-color: #f3f3f3;
            border-radius: 5px;
            overflow: hidden;
        }

        .progress-bar {
            background-color: #007bff;
            height: 100%;
            width: 0;
            transition: width 0.3s ease;
        }

        .step {
            display: none;
        }

        .step.active {
            display: block;
        }

        .step button {
            margin-top: 20px;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const progressBar = document.querySelector('.progress-bar');
            const form = document.querySelector('#formStep2');
            const fields = form.querySelectorAll('input');
            const totalFields = fields.length;
            let filledFields = 0;

            // Check input fields to update progress
            fields.forEach((input) => {
                input.addEventListener('input', updateProgress);
            });

            function updateProgress() {
                filledFields = 0;
                fields.forEach((input) => {
                    if (input.value.trim() !== '') {
                        filledFields++;
                    }
                });

                // Calculate percentage for progress bar
                const percentage = (filledFields / totalFields) * 100;
                progressBar.style.width = `${percentage}%`;
            }

            // Update progress bar on page load if there are pre-filled values
            updateProgress();
        });
    </script>
@endsection
