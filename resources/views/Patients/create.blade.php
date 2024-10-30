@extends('layout/side-menu')

@section('subhead')
    <title>{{ __('Patients.Create New Patient') }}</title>
@endsection

@section('subcontent')
<div class="intro-y box">
    <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
        <h2 class="font-medium text-base mr-auto">{{ __('Patients.Create New Patient') }}</h2>
        <a class="btn btn-primary" href="{{ route('Patients.index') }}"> Back </a>
    </div>
    <div id="input" class="p-5">
        <div class="preview">
            <form action="{{ route('Patients.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-3">
                    <label for="name">{{ __('Patients.patient_name') }}</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>
            
                <div class="form-group mb-3">
                    <label for="email">{{ __('Patients.email') }}</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>
            

                                    <!-- Password Field -->
                                    <div class="mt-3">
                                        <label for="password" class="form-label">{{ trans('Patients.password') }}</label>
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                                        @error('password')
                                            <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                
                                    <!-- Password Confirmation Field -->
                                    <div class="mt-3">
                                        <label for="password_confirmation" class="form-label">{{ trans('Patients.password_confirmation') }}</label>
                                        <input id="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" required>
                                        @error('password_confirmation')
                                            <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>


                <div class="form-group mb-3">
                    <label for="Phone">{{ __('Patients.phone') }}</label>
                    <input type="text" name="Phone" id="Phone" class="form-control" required>
                </div>
            
                <div class="form-group mb-3">
                    <label for="Date_Birth">{{ __('Patients.date_of_birth') }}</label>
                    <input type="date" name="Date_Birth" id="Date_Birth" class="form-control" required>
                </div>
            
                <div class="form-group mb-3">
                    <label for="Gender">{{ __('Patients.gender') }}</label>
                    <select name="Gender" id="Gender" class="form-control" required>
                        <option value="">{{ __('Patients.select_gender') }}</option>
                        <option value="1">{{ __('Patients.male') }}</option>
                        <option value="2">{{ __('Patients.female') }}</option>
                    </select>
                </div>
            
                <div class="form-group mb-3">
                    <label for="Blood_Group">{{ __('Patients.blood_group') }}</label>
                    <select name="Blood_Group" id="Blood_Group" class="form-control" required>
                        <option value="">{{ __('Patients.select_blood_group') }}</option>
                        <option value="A+">A+</option>
                        <option value="A-">A-</option>
                        <option value="B+">B+</option>
                        <option value="B-">B-</option>
                        <option value="O+">O+</option>
                        <option value="O-">O-</option>
                        <option value="AB+">AB+</option>
                        <option value="AB-">AB-</option>
                    </select>
                </div>
            
                <div class="form-group mb-3">
                    <label for="Address">{{ __('Patients.address') }}</label>
                    <input type="text" name="Address" id="Address" class="form-control" required>
                </div>
            
                <!-- Photo Field -->
                <div class="mt-3">
                    <label for="photo" class="form-label">{{ trans('Patients.Patient_photo') }}</label>
                    <input id="photo" type="file" class="form-control" name="photo" accept="image/*" onchange="loadFile(event)">
                    <img id="output" style="border-radius:50%" width="150px" height="150px"/>
                </div>
            
                <button type="submit" class="btn btn-primary">{{ __('Patients.add_patient') }}</button>
            </form>
            
        </div>
    </div>
</div>
@endsection
