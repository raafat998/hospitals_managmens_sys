@extends('layout/side-menu')

@section('subhead')
    <title>{{ __('Patients.edit Patient information') }}</title>
@endsection

@section('subcontent')
<div class="intro-y box">
    <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
        <h2 class="font-medium text-base mr-auto">{{ __('Edit Patient Information') }}</h2>
        <a class="btn btn-primary" href="{{ route('Patients.index') }}"> Back </a>
    </div>
    <div id="input" class="p-5">
        <div class="preview">
            <form action="{{ route('Patients.update', $Patient->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" value="{{ $Patient->id }}">

                <!-- Patient Name -->
                <div class="form-group mb-3"> 
                    <label for="name">{{ __('Patients.patient_name') }}</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $Patient->name) }}" required>
                </div>
            
                <!-- Email -->
                <div class="form-group mb-3"> 
                    <label for="email">{{ __('Patients.email') }}</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $Patient->email) }}" required>
                </div>
            
                <!-- Phone -->
                <div class="form-group mb-3">
                    <label for="Phone">{{ __('Patients.phone') }}</label>
                    <input type="text" name="Phone" id="Phone" class="form-control" value="{{ old('Phone', $Patient->Phone) }}" required>
                </div>
            
                <!-- Date of Birth -->
                <div class="form-group mb-3"> 
                    <label for="Date_Birth">{{ __('Patients.date_of_birth') }}</label>
                    <input type="date" name="Date_Birth" id="Date_Birth" class="form-control" value="{{ old('Date_Birth', $Patient->Date_Birth) }}" required>
                </div>
            
                <!-- Gender -->
                <div class="form-group mb-3"> 
                    <label for="Gender">{{ __('Patients.gender') }}</label>
                    <select name="Gender" id="Gender" class="form-control" required>
                        <option value="">{{ __('Patients.select_gender') }}</option>
                        <option value="1" {{ old('Gender', $Patient->Gender) == '1' ? 'selected' : '' }}>{{ __('Patients.male') }}</option>
                        <option value="2" {{ old('Gender', $Patient->Gender) == '2' ? 'selected' : '' }}>{{ __('Patients.female') }}</option>
                    </select>
                </div>
            
                <!-- Blood Group -->
                <div class="form-group mb-3"> 
                    <label for="Blood_Group">{{ __('Patients.blood_group') }}</label>
                    <select name="Blood_Group" id="Blood_Group" class="form-control" required>
                        <option value="">{{ __('Patients.select_blood_group') }}</option>
                        <option value="A+" {{ old('Blood_Group', $Patient->Blood_Group) == 'A+' ? 'selected' : '' }}>A+</option>
                        <option value="A-" {{ old('Blood_Group', $Patient->Blood_Group) == 'A-' ? 'selected' : '' }}>A-</option>
                        <option value="B+" {{ old('Blood_Group', $Patient->Blood_Group) == 'B+' ? 'selected' : '' }}>B+</option>
                        <option value="B-" {{ old('Blood_Group', $Patient->Blood_Group) == 'B-' ? 'selected' : '' }}>B-</option>
                        <option value="O+" {{ old('Blood_Group', $Patient->Blood_Group) == 'O+' ? 'selected' : '' }}>O+</option>
                        <option value="O-" {{ old('Blood_Group', $Patient->Blood_Group) == 'O-' ? 'selected' : '' }}>O-</option>
                        <option value="AB+" {{ old('Blood_Group', $Patient->Blood_Group) == 'AB+' ? 'selected' : '' }}>AB+</option>
                        <option value="AB-" {{ old('Blood_Group', $Patient->Blood_Group) == 'AB-' ? 'selected' : '' }}>AB-</option>
                    </select>
                </div>
            
                <!-- Address -->
                <div class="form-group mb-3"> 
                    <label for="Address">{{ __('Patients.address') }}</label>
                    <input type="text" name="Address" id="Address" class="form-control" value="{{ old('Address', $Patient->Address) }}" required>
                </div>
            
                <!-- Photo Field -->
                <div class="mt-3">
                    <label for="photo" class="form-label">{{ trans('Patients.Patient_photo') }}</label>
                    <input id="photo" type="file" class="form-control @error('photo') is-invalid @enderror" name="photo" accept="image/*" onchange="loadFile(event)">
                    <img id="output" style="border-radius:50%" width="150px" height="150px" src="{{ old('photo', $Patient->photo ? asset('storage/' . $Patient->photo) : '') }}" />
                    @error('photo')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">{{ __('Patients.update_patient') }}</button>
            </form>
        </div>
    </div>
</div>
@endsection
