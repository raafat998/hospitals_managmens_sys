@extends('layout/side-menu')

@section('subhead')
    <title>{{ __('Receipt Accounts.Update Receipt Account') }}</title>
@endsection

@section('subcontent')
<div class="intro-y box">
    <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
        <h2 class="font-medium text-base mr-auto">{{ __('Receipt Accounts.Update Receipt Account') }}</h2>
        <a class="btn btn-primary" href="{{ route('Receipt.index') }}"> Back </a>
    </div>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    
    <div id="input" class="p-5">
        <div class="preview">
            <form action="{{ route('Receipt.update', $receipt_accounts->id) }}" method="POST">
                @csrf
                @method('PUT')

            
                <input type="hidden" name="id" value="{{ $receipt_accounts->id }}">
                <div class="grid grid-cols-1 gap-4 mt-4">
                    <!-- Patient ID -->
                    <div class="mb-4">
                        <label for="patient_id" class="form-label">{{ __('Receipt Accounts.Patient ID') }}</label>
                        <input type="text" class="form-control" id="patient_id" name="patient_id" value="{{ old('patient_id', $receipt_accounts->patient_id) }}" required>
                    </div>

                    <!-- amount Amount -->
                    <div class="mb-4">
                        <label for="amount" class="form-label">{{ __('Receipt Accounts.amount Amount') }}</label>
                        <input type="number" class="form-control" id="Debit" name="Debit" step="0.01" value="{{ old('Debit', $receipt_accounts->Debit) }}" required>
                    </div>

                    <!-- Description -->
                    <div class="mb-4">
                        <label for="description" class="form-label">{{ __('Receipt Accounts.Description') }}</label>
                        <textarea class="form-control" id="description" name="description" required>{{ old('description', $receipt_accounts->description) }}</textarea>
                    </div>

                    <!-- Submit Button -->
                    <div class="mb-4">
                        <button type="submit" class="btn btn-primary">{{ __('Receipt Accounts.Update Receipt') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
