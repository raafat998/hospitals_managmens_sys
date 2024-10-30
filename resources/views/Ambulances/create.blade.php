@extends('layout/side-menu')

@section('subhead')
    <title>{{ __('Ambulances.Create New Ambulance') }}</title>
@endsection

@section('subcontent')
<div class="intro-y box">
    <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
        <h2 class="font-medium text-base mr-auto">{{ __('Ambulances.Create New Ambulance') }}</h2>
        <a class="btn btn-primary" href="{{ route('Ambulances.index') }}"> Back </a>
    </div>
    <div id="input" class="p-5">
        <div class="preview">
            <form action="{{ route('Ambulances.store') }}" method="POST">
                @csrf

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="grid grid-cols-1 gap-4 mt-4">
                    <!-- Car Number -->
                    <div class="mb-4">
                        <label for="car_number" class="form-label">{{ __('Ambulances.Car Number') }}</label>
                        <input type="text" class="form-control" id="car_number" name="car_number" required>
                    </div>

                    <!-- Car Model -->
                    <div class="mb-4">
                        <label for="car_model" class="form-label">{{ __('Ambulances.Car Model') }}</label>
                        <input type="text" class="form-control" id="car_model" name="car_model" required>
                    </div>

                    <!-- Car Year Made -->
                    <div class="mb-4">
                        <label for="car_year_made" class="form-label">{{ __('Ambulances.Car Year Made') }}</label>
                        <input type="number" class="form-control" id="car_year_made" name="car_year_made" required>
                    </div>

                    <!-- Driver License Number -->
                    <div class="mb-4">
                        <label for="driver_license_number" class="form-label">{{ __('Ambulances.Driver License Number') }}</label>
                        <input type="text" class="form-control" id="driver_license_number" name="driver_license_number" required>
                    </div>

                    <!-- Driver Phone -->
                    <div class="mb-4">
                        <label for="driver_phone" class="form-label">{{ __('Ambulances.Driver Phone') }}</label>
                        <input type="text" class="form-control" id="driver_phone" name="driver_phone" required>
                    </div>

                    <!-- Car Type -->
                    <div class="mb-4">
                        <label for="car_type" class="form-label">{{ __('Ambulances.Car Type') }}</label>
                        <select class="form-control" id="car_type" name="car_type" required>
                           <option value="1">{{ __('Owned') }}</option>
        <option value="2">{{ __('Rented') }}</option>
                        </select>
                    </div>


                    <!-- Driver Name -->
                    <div class="mb-4">
                        <label for="driver_name" class="form-label">{{ __('Ambulances.Driver Name') }}</label>
                        <input type="text" class="form-control" id="driver_name" name="driver_name" required>
                    </div>

                    <!-- Notes -->
                    <div class="mb-4">
                        <label for="notes" class="form-label">{{ __('Ambulances.Notes') }}</label>
                        <textarea class="form-control" id="notes" name="notes"></textarea>
                    </div>

                    <!-- Submit Button -->
                    <div class="mb-4">
                        <button type="submit" class="btn btn-primary">{{ __('Ambulances.Add Ambulance') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
