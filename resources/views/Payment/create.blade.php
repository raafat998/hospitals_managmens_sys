@extends('layout/side-menu')

@section('subhead')
    <title>{{ __('Payment Accounts.Create New Payment Account') }}</title>
@endsection

@section('subcontent')
<div class="intro-y box">
    <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
        <h2 class="font-medium text-base mr-auto">{{ __('Payment Accounts.Create New Payment Account') }}</h2>
        <a class="btn btn-primary" href="{{ route('Payment.index') }}"> Back </a>
    </div>
    <div id="input" class="p-5">
        <div class="preview">
            <form action="{{ route('Payment.store') }}" method="POST" enctype="multipart/form-data">
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

                <div class="row row-xs align-items-center mg-b-20">
                    <div class="col-md-2">
                        <label for="patient_id" class="form-label">{{ __('Payment Accounts.Patient ID') }}</label>
                    </div>
                    <div class="col-md-10">
                        <select class="form-control select2" id="patient_id" name="patient_id" required>
                            <option value=""></option>
                            @foreach($Patients as $Patient)
                                <option value="{{ $Patient->id }}">{{ $Patient->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row row-xs align-items-center mg-b-20">
                    <div class="col-md-2">
                        <label for="amount" class="form-label">{{ __('Payment Accounts.amount Amount') }}</label>
                    </div>
                    <div class="col-md-10">
                        <input type="number" class="form-control" id="credit" name="credit" step="0.01" required>
                    </div>
                </div>

                <div class="row row-xs align-items-center mg-b-20">
                    <div class="col-md-2">
                        <label for="description" class="form-label">{{ __('Payment Accounts.Description') }}</label>
                    </div>
                    <div class="col-md-10">
                        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                    </div>
                </div>

                <div class="row row-xs align-items-center mg-b-20">
                    <div class="col-md-12 text-right">
                        <button type="submit" class="btn btn-primary">{{ __('Payment Accounts.Add Payment') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection