@extends('layout/side-menu')

@section('subhead')
    <title>{{ __('insurances.Create New Insurance Company') }}</title>
@endsection

@section('subcontent')
<div class="intro-y box">
    <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
        <h2 class="font-medium text-base mr-auto">{{ __('insurances.Create New Insurance Company') }}</h2>
        <a class="btn btn-primary" href="{{ route('insurances.index') }}"> Back </a>
    </div>
    <div id="input" class="p-5">
        <div class="preview">
            <form action="{{ route('insurances.store') }}" method="POST">
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
                    <div class="mb-4">
                        <label for="insurance_code" class="form-label">{{ __('insurances.Insurance Code') }}</label>
                        <input type="text" class="form-control" id="insurance_code" name="insurance_code" required>
                    </div>

                    <div class="mb-4">
                        <label for="discount_percentage" class="form-label">{{ __('insurances.Discount Percentage') }}</label>
                        <input type="number" step="0.01" class="form-control" id="discount_percentage" name="discount_percentage" required>
                    </div>

                    <div class="mb-4">
                        <label for="Company_rate" class="form-label">{{ __('insurances.Company Rate') }}</label>
                        <input type="number" step="0.01" class="form-control" id="Company_rate" name="Company_rate" required>
                    </div>

                    <div class="mb-4">
                        <label for="name" class="form-label">{{ __('insurances.Name') }}</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>

                    <div class="mb-4">
                        <label for="notes" class="form-label">{{ __('insurances.Notes') }}</label>
                        <textarea class="form-control" id="notes" name="notes"></textarea>
                    </div>

                    <div class="mb-4">
                        <label for="status" class="form-label">{{ __('insurances.Status') }}</label>
                        <select class="form-control" id="status" name="status">
                            <option value="1">{{ __('insurances.Active') }}</option>
                            <option value="0">{{ __('insurances.Inactive') }}</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <button type="submit" class="btn btn-primary">{{ __('insurances.Add Insurance Company') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
