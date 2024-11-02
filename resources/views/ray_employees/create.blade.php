@extends('layout/side-menu')



@section('subcontent')
<div class="intro-y box">
    <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
        <h2 class="font-medium text-base mr-auto">{{ __('ray_employee.Create New Employee') }}</h2>
        <a class="btn btn-primary" href="{{ route('ray_employee.index') }}">Back</a>
    </div>

    <div id="input" class="p-5">
        <div class="preview">
            <form action="{{ route('ray_employee.store') }}" method="post" autocomplete="off" enctype="multipart/form-data">
                {{ csrf_field() }}

                <!-- Name Field -->
                <div>
                    <label for="name" class="form-label">{{ trans('ray_employee.name') }}</label>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" required>
                    @error('name')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Email Field -->
                <div class="mt-3">
                    <label for="email" class="form-label">{{ trans('ray_employee.email') }}</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" required>
                    @error('email')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Password Field -->
                <div class="mt-3">
                    <label for="password" class="form-label">{{ trans('ray_employee.password') }}</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                    @error('password')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Password Confirmation Field -->
                <div class="mt-3">
                    <label for="password_confirmation" class="form-label">{{ trans('ray_employee.password_confirmation') }}</label>
                    <input id="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" required>
                    @error('password_confirmation')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Phone Field -->
                <div class="mt-3">
                    <label for="phone" class="form-label">{{ trans('ray_employee.phone') }}</label>
                    <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" required>
                    @error('phone')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>




                <!-- Photo Field -->
                <div class="mt-3">
                    <label for="photo" class="form-label">{{ trans('ray_employee.photo') }}</label>
                    <input id="photo" type="file" class="form-control @error('photo') is-invalid @enderror" name="photo" accept="image/*" onchange="loadFile(event)">
                    <img id="output" style="border-radius:50%" width="150px" height="150px"/>
                    @error('photo')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="mt-5">
                    <button type="submit" class="btn btn-primary">{{ trans('ray_employee.submit') }}</button>
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