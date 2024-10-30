@extends('layout/side-menu')

@section('subhead')
    <title>Edit Service - Your App</title>
@endsection

@section('subcontent')
<div class="intro-y box">
    <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
        <h2 class="font-medium text-base mr-auto">Edit Service</h2>
        <a class="btn btn-primary" href="{{ route('Service.index') }}"> Back </a>
    </div>
    <div id="input" class="p-5">
        <div class="preview">
            <form action="{{ route('Service.update', $service->id) }}" method="POST" autocomplete="off">
                @csrf
                @method('PUT') <!-- استخدم PUT لتحديث البيانات -->
                <input type="hidden" name="id" value="{{ $service->id }}">

                <div>
                    <label for="name" class="form-label">{{ __('Service Name') }}</label>
                    <input id="name" type="text" name="name" value="{{ old('name', $service->name) }}" class="form-control @error('name') is-invalid @enderror" required autofocus>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mt-4">
                    <label for="description" class="form-label">{{ __('Service Description') }}</label>
                    <textarea id="description" name="description" rows="5" class="form-control @error('description') is-invalid @enderror">{{ old('description', $service->description) }}</textarea>
                    @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mt-4">
                    <label for="price" class="form-label">{{ __('Service Price') }}</label>
                    <input id="price" type="number" name="price" value="{{ old('price', $service->price) }}" class="form-control @error('price') is-invalid @enderror">
                    @error('price')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- زر الإرسال -->
                <div class="mt-5">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
