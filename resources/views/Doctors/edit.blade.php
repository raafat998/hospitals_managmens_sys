@extends('layout/side-menu')

@section('subhead')
    <title>{{ __('doctors.Edit Doctor') }}</title>
@endsection

@section('subcontent')
<div class="intro-y box">
    <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
        <h2 class="font-medium text-base mr-auto">{{ __('doctors.Edit Doctor') }}</h2>
        <a class="btn btn-primary" href="{{ route('Doctors.index') }}">{{ __('common.back') }}</a>
    </div>

    <div id="input" class="p-5">
        <div class="preview">
            <form action="{{ route('Doctors.update', $doctor->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Name Field -->
                <div class="mt-3">
                    <label for="name" class="form-label">{{ trans('doctors.name') }}</label>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $doctor->name) }}" required>
                    @error('name')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Email Field -->
                <div class="mt-3">
                    <label for="email" class="form-label">{{ trans('doctors.email') }}</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $doctor->email) }}" required>
                    @error('email')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Phone Field -->
                <div class="mt-3">
                    <label for="phone" class="form-label">{{ trans('doctors.phone') }}</label>
                    <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone', $doctor->phone) }}" required>
                    @error('phone')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Section Field -->
                <div class="mt-3">
                    <label for="section_id" class="form-label">{{ trans('doctors.section') }}</label>
                    <select id="section_id" class="form-control @error('section_id') is-invalid @enderror" name="section_id" required>
                        <option value="" disabled>------</option>
                        @foreach($sections as $section)
                            <option value="{{ $section->id }}" {{ $section->id == $doctor->section_id ? 'selected' : '' }}>
                                {{ $section->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('section_id')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Appointments Field -->
                <div class="mt-3">
                    <label for="appointments" class="form-label">{{ trans('doctors.appointments') }}</label>
                    <select id="appointments" class="form-control tom-select @error('appointments') is-invalid @enderror" name="appointments[]" multiple required>
                        @foreach($appointments as $appointment)
                        <option value="{{ $appointment->id }}" {{ in_array($appointment->id, $doctor->doctorappointments->pluck('id')->toArray()) ? 'selected' : '' }}>
                            {{ $appointment->name }}
                        </option>
                        @endforeach
                    </select>
                    @error('appointments')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Photo Field -->
                <div class="mt-3">
                    <label for="photo" class="form-label">{{ trans('doctors.doctor_photo') }}</label>
                    <input id="photo" type="file" class="form-control @error('photo') is-invalid @enderror" name="photo" accept="image/*" onchange="loadFile(event)">
                    <img id="output" style="border-radius:50%" width="150px" height="150px" src="{{ $doctor->image ? asset('storage/properties/doctors/' . $doctor->image->filename) : asset('images/default-avatar.png') }}" />
                    @error('photo')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Submit & Cancel Buttons -->
                <div class="mt-5">
                    <button type="submit" class="btn btn-primary">{{ __('doctors.save_changes') }}</button>
                    <a href="{{ route('Doctors.index') }}" class="btn btn-secondary">{{ __('common.cancel') }}</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function loadFile(event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
    }
</script>
@endsection
