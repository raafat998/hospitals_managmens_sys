@extends('layouts.app')

@section('head')
    <title>Register - TabeebZone - Admin Dashboard</title>
@endsection

@section('content')
    <div class="container sm:px-10">
        <div class="block xl:grid grid-cols-2 gap-4">
            <!-- BEGIN: Register Info -->
            <div class="hidden xl:flex flex-col min-h-screen">
                <a href="" class="-intro-x flex items-center pt-5">
                    <img alt="TabeebZone - Admin Dashboard" class="w-6" src="{{ asset('build/assets/images/logo.svg') }}">
                    <span class="text-white text-lg ml-3">
                        TabeebZone
                    </span>
                </a>
                <div class="my-auto">
                    <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script> 

                    <dotlottie-player src="https://lottie.host/f6c9e8e6-760b-4780-8059-61f660574ab8/TVSPOwOkzK.json" class="-intro-x w-1/2 -mt-16" background="transparent" speed="1" style="width: 400px; height: 400px;" loop autoplay></dotlottie-player>
                    <div class="-intro-x text-white font-medium text-4xl leading-tight mt-10">A few more clicks to <br> sign up to your account.</div>
                    <div class="-intro-x mt-5 text-lg text-white text-opacity-70 dark:text-slate-400">Manage all your e-commerce accounts in one place</div>
                </div>
            </div>
            <!-- END: Register Info -->
            <!-- BEGIN: Register Form -->
            <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
                <div class="my-auto mx-auto xl:ml-20 bg-white dark:bg-darkmode-600 xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                    <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">Sign Up</h2>
                    <div class="intro-x mt-2 text-slate-400 dark:text-slate-400 xl:hidden text-center">A few more clicks to sign in to your account. Manage all your e-commerce accounts in one place</div>
                    <form style="max-height: 400px; padding-right:100; width:500px; overflow-y: auto;" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf
                    
                        <!-- Name Field -->
                        <div class="form-group">
                            <label for="name">{{ __('Name') }}</label>
                            <input id="name"  type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }} " required autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    
                        <!-- Email Field -->
                        <div class="form-group">
                            <label for="email">{{ __('Email') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    
                        <!-- Phone Field -->
                        <div class="form-group">
                            <label for="phone">{{ __('Phone') }}</label>
                            <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required>
                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <!-- Password Field -->
                        <div class="form-group">
                            <label for="password">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    
                        <!-- Confirm Password Field -->
                        <div class="form-group">
                            <label for="password-confirm">{{ __('Confirm Password') }}</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                        </div>

                    
                        <!-- Role Field -->
                        <div class="form-group">
                            <label for="role_id">{{ __('Role') }}</label>
                            <select id="role_id" class="form-control @error('role_id') is-invalid @enderror" name="role_id" required onchange="toggleFields(this.value)">
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->role_name }}</option>
                                @endforeach
                            </select>
                            @error('role_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    


<!--------------------------- ray-employee-fields (hidden by default)-------------------------------------------------------------------------------------------------- -->
                        
<div id="admin-fields" style="display: none;">

        <!-- Profile Image Field -->
        <div class="mb-4">
            <label for="profile_image" class="block text-gray-700 text-sm font-bold mb-2">{{ __('Profile Image') }}</label>
            <input id="profile_image" type="file" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('profile_image') border-red-500 @enderror" name="profile_image" accept="image/*">
        @error('profile_image')
            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
        @enderror
        </div>
        
</div>

<!--------------------------- doctor-fields (hidden by default)-------------------------------------------------------------------------------------------------- -->
                        
<div id="doctor-fields" style="display: none;">
    <!-- Photo Field -->
        <div class="mt-3">
            <label for="profile_image" class="form-label">{{ trans('doctors.profile_image') }}</label>
            <input id="profile_image" type="file" class="form-control @error('profile_image') is-invalid @enderror" name="profile_image" accept="image/*" onchange="loadFile(event)">
            <img id="output" style="border-radius:50%" width="150px" height="150px"/>
            @error('profile_image')
                <span class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
                        <!-- Section Field -->
                        <div class="mt-3">
                            <label for="section_id" class="form-label">{{ trans('doctors.section') }}</label>
                            <select id="section_id" class="form-control @error('section_id') is-invalid @enderror" name="section_id" >
                                <option value="" disabled selected>------</option>
                                @foreach($sections as $section)
                                    <option value="{{ $section->id }}">{{ $section->name }}</option>
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
            <select id="appointments" class="form-control tom-select @error('appointments') is-invalid @enderror" name="appointments[]" multiple >
                @foreach($appointments as $appointment)
                    <option value="{{ $appointment->id }}">{{ $appointment->name }}</option> <!-- استخدم معرف الموعد -->
                @endforeach
            </select>
            @error('appointments')
                <span class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
</div>

<!--------------------------- ray-employee-fields (hidden by default)-------------------------------------------------------------------------------------------------- -->
                        
                            <div id="ray-employee-fields" style="display: none;">
                                <!-- Photo Field -->
                                    <div class="mt-3">
                                        <label for="profile_image" class="form-label">{{ trans('ray-employee.employee_photo') }}</label>
                                        <input id="profile_image" type="file" class="form-control @error('profile_image') is-invalid @enderror" name="employee_profile_image" accept="image/*" onchange="loadFile(event)">
                                        <img id="output" style="border-radius:50%" width="150px" height="150px"/>
                                        @error('profile_image')
                                            <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                            </div>

                            

<!--------------------------- Patient Fields (hidden by default)-------------------------------------------------------------------------------------------------- -->
                        
                            <div id="patient-fields" style="display: none;">
                            
                                        <div class="form-group mb-3"> <!-- إضافة mb-3 هنا -->
                                            <label for="Date_Birth">{{ __('Patients.date_of_birth') }}</label>
                                            <input type="date" name="Date_Birth" id="Date_Birth" class="form-control" >
                                        </div>

                                        <div class="form-group mb-3"> <!-- إضافة mb-3 هنا -->
                                            <label for="Gender">{{ __('Patients.gender') }}</label>
                                            <select name="Gender" id="Gender" class="form-control" >
                                                <option value="">{{ __('Patients.select_gender') }}</option>
                                                <option value="1">{{ __('Patients.male') }}</option>
                                                <option value="2">{{ __('Patients.female') }}</option>
                                            </select>
                                        </div>

                                        <div class="form-group mb-3"> <!-- إضافة mb-3 هنا -->
                                            <label for="Blood_Group">{{ __('Patients.blood_group') }}</label>
                                            <select name="Blood_Group" id="Blood_Group" class="form-control" >
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

                                        <div class="form-group mb-3"> <!-- إضافة mb-3 هنا -->
                                            <label for="Address">{{ __('Patients.address') }}</label>
                                            <input type="text" name="Address" id="Address" class="form-control" >
                                        </div>

                                        <!-- Photo Field -->
                                        <div class="mt-3">
                                            <label for="profile_image" class="form-label">{{ __('Patients.Patient_photo') }}</label>
                                            <input id="profile_image" type="file" class="form-control @error('profile_image') is-invalid @enderror" name="profile_image" accept="image/*" onchange="loadFile(event)">
                                            <img id="output" style="border-radius:50%" width="150px" height="150px"/>
                                            @error('profile_image')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                        </div>
<!--------------------------------------------------------------------------------------------------------------------------------------->
                        <!-- Submit Button -->
                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Register') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- END: Register Form -->
        </div>
    </div>

    <script>
        function toggleFields(roleId) {
            // إخفاء جميع الحقول أولاً
            document.getElementById('patient-fields').style.display = 'none';
            document.getElementById('doctor-fields').style.display = 'none';
            document.getElementById('ray-employee-fields').style.display = 'none';
            document.getElementById('admin-fields').style.display = 'none';
    
            // إظهار الحقول بناءً على قيمة roleId
            if (roleId == '3') { // Assuming '3' is the ID for 'patient'
                document.getElementById('patient-fields').style.display = 'block';
            } else if (roleId == '4') { // Assuming '4' is the ID for 'ray employee'
                document.getElementById('ray-employee-fields').style.display = 'block';
            } else if (roleId == '2') { // Assuming '2' is the ID for 'doctor'
                document.getElementById('doctor-fields').style.display = 'block';
            } else if (roleId == '1') { // Assuming '1' is the ID for 'admin'
                document.getElementById('admin-fields').style.display = 'block';
            }
        }


    function loadFile(event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
    }


    </script>

@endsection
