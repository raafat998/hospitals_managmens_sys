@extends('layout.side-menu')

@section('subhead')
    <title>{{ __('sections.edit_section') }} - Your App</title>
@endsection

@section('subcontent')
<div class="intro-y box">
    <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
        <h2 class="font-medium text-base mr-auto">{{ __('sections.edit_section') }}</h2>
        <a class="btn btn-primary" href="{{ route('Section.index') }}">{{ __('sections.back') }}</a>
    </div>
    <div id="input" class="p-5">
        <div class="preview">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ __('sections.success_message') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {!! Form::model($section, ['route' => ['Section.update', $section->id], 'method' => 'PUT']) !!}

            <!-- Name Field -->
            <div class="mt-3">
                <label for="name" class="form-label">{{ __('sections.name') }}</label>
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $section->name) }}" required autofocus>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- Hidden ID Field -->
            <input type="hidden" name="id" value="{{ $section->id }}">

            <!-- Submit & Cancel Buttons -->
            <div class="mt-5">
                <button type="submit" class="btn btn-primary">{{ __('sections.update') }}</button>
                <a href="{{ route('Section.index') }}" class="btn btn-secondary">{{ __('sections.cancel') }}</a>
            </div>

            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
