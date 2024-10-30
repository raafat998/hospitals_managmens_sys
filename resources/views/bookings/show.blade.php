@extends('layout/side-menu')

@section('subhead')
    <title>Show Booking - Your App</title>
@endsection

@section('subcontent')
    <div class="container mx-auto mt-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-3xl font-bold text-gray-800">Booking Details</h2>
            <a href="{{ route('bookings.index') }}" class="btn btn-primary">
                <svg class="w-4 h-4 mr-2 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Back
            </a>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-lg border border-gray-200">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="mb-4">
                    <strong class="block text-gray-700 font-medium">Client Name:</strong>
                    <p class="text-gray-900 text-lg">{{ $booking->client->client_name }}</p>
                </div>
                <div class="mb-4">
                    <strong class="block text-gray-700 font-medium">Property Name:</strong>
                    <p class="text-gray-900 text-lg">{{ $booking->property->property_name }}</p>
                </div>
                <div class="mb-4">
                    <strong class="block text-gray-700 font-medium">Start Date:</strong>
                    <p class="text-gray-900 text-lg">{{ \Carbon\Carbon::parse($booking->start_date)->format('F Y') }}</p>
                </div>
                <div class="mb-4">
                    <strong class="block text-gray-700 font-medium">End Date:</strong>
                    <p class="text-gray-900 text-lg">{{ \Carbon\Carbon::parse($booking->end_date)->format('F Y') }}</p>
                </div>
                <div class="mb-4">
                    <strong class="block text-gray-700 font-medium">Payment Status:</strong>
                    <span class="inline-block px-3 py-1 text-sm font-medium text-white {{ $booking->payment_status == 'paid' ? 'bg-green-500' : 'bg-yellow-500' }} rounded-full">
                        {{ ucfirst($booking->payment_status) }}
                    </span>
                </div>
                <div class="mb-4">
                    <strong class="block text-gray-700 font-medium">Total Price:</strong>
                    <p class="text-gray-900 text-lg">{{ number_format($booking->total_price, 2) }} USD</p>
                </div>
            </div>
        </div>
    </div>
@endsection
