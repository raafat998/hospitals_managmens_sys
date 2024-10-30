@extends('layout/side-menu')

@section('subhead')
    <title>Create New Booking - Your App</title>
@endsection

@section('subcontent')
<div class="intro-y box">
    <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
        <h2 class="font-medium text-base mr-auto">Create Booking</h2>
    </div>
    <div id="input" class="p-5">
        <div class="preview">
            <form action="{{ route('bookings.store') }}" method="POST">
                @csrf
                <div class="mt-3">
                    <label for="client_id" class="form-label">Client</label>
                    <select name="client_id" id="client_id" class="form-control" required>
                        @foreach ($clients as $client)
                            <option value="{{ $client->id }}">{{ $client->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mt-3">
                    <label for="property_id" class="form-label">Available Property</label>
                    <select name="property_id" id="property_id" class="form-control" required>
                        @foreach ($properties as $property)
                            <option value="{{ $property->id }}">{{ $property->property_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mt-3">
                    <label for="start_date" class="form-label">Start Date</label>
                    <input type="month" name="start_date" id="start_date" class="form-control" required>
                </div>
                <div class="mt-3">
                    <label for="end_date" class="form-label">End Date</label>
                    <input type="month" name="end_date" id="end_date" class="form-control" required>
                </div>
               
                <div class="mt-3">
                    <label for="payment_status" class="form-label">Payment Status</label>
                    <select name="payment_status" id="payment_status" class="form-control" required>
                        <option value="paid">Paid</option>
                        <option value="pending">Pending</option>
                    </select>
                </div>
                <div class="mt-5">
                    <button type="submit" class="btn btn-primary">Create Booking</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
