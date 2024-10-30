@extends('layout/side-menu')

@section('subhead')
    <title>Edit User Information- Admin Dashboard</title>
@endsection

@section('subcontent')
    <div class="intro-y box">
        <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
            <h2 class="font-medium text-base mr-auto">Edit User Information</h2>
            <a class="btn btn-primary" href="{{ route('users.index') }}">Back</a>
        </div>

        <div id="input" class="p-5">
            <div class="preview">
                
                {!! Form::model($user, ['method' => 'PATCH', 'route' => ['users.update', $user->id], 'enctype' => 'multipart/form-data']) !!}
                
                <!-- Name Field -->
                <div>
                    <label for="name" class="form-label">{{ __('Name') }}</label>
                    {!! Form::text('name', old('name', $user->name), ['placeholder' => 'Name', 'class' => 'form-control']) !!}
                </div>

                <!-- Email Field -->
                <div class="mt-3">
                    <label for="email" class="form-label">{{ __('Email') }}</label>
                    {!! Form::text('email', old('email', $user->email), ['placeholder' => 'Email', 'class' => 'form-control']) !!}
                </div>

                <!-- Password Field -->
                <div class="mt-3">
                    <label for="password" class="form-label">{{ __('Password') }}</label>
                    {!! Form::password('password', ['placeholder' => 'Password', 'class' => 'form-control']) !!}
                </div>

                <!-- Confirm Password Field -->
                <div class="mt-3">
                    <label for="confirm-password" class="form-label">{{ __('Confirm Password') }}</label>
                    {!! Form::password('confirm-password', ['placeholder' => 'Confirm Password', 'class' => 'form-control']) !!}
                </div>

                <!-- Profile Image Field -->
                <div class="mt-3">
                    <label for="profile_image" class="form-label">{{ __('Profile Image') }}</label>
                    {!! Form::file('profile_image', ['class' => 'form-control']) !!}
                    @if($user->profile_image)
                        <img src="{{ Storage::url($user->profile_image) }}" alt="Profile Image" width="100">
                    @endif
                </div>

                <!-- Status Field -->
                <div class="mt-3">
                    <label for="status" class="form-label">{{ __('Status') }}</label>
                    <select name="active" class="form-control">
                        <option value="1" {{ $user->active ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ !$user->active ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <!-- Role Field -->
                <div class="mt-3">
                    <label for="role_id" class="form-label">{{ __('Role') }}</label>
                    <select name="role_id" class="form-control">
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>{{ $role->role_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mt-5 text-center">
                    <button type="submit" id="edit" class="btn btn-primary">Submit</button>
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>

    <script>
        $(document).on('click','#edit',function (e){
            e.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    );
                }
            });
        });
    </script>
@endsection
