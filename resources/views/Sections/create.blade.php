@extends('layout/side-menu')

@section('subhead')
    <title>Create New Section - Your App</title>
@endsection

@section('subcontent')
<div class="intro-y box">
    <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
        <h2 class="font-medium text-base mr-auto">Create New Section</h2>
        <a class="btn btn-primary" href="{{ route('Section.index') }}"> Back </a>
    </div>
    <div id="input" class="p-5">
        <div class="preview">
            {!! Form::open(array('route' => 'Section.store', 'method' => 'POST')) !!}

            <div>
                <label for="name" class="form-label">{{ __('Section Name') }}</label>
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autofocus>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- زر الإرسال -->
            <div class="mt-5">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>

            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
