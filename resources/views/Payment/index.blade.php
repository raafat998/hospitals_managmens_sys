@extends('layout/side-menu')

@section('subhead')
    <title>{{ __('Payment Accounts.Payment List') }}</title>
@endsection

@section('subcontent')
<meta name="csrf-token" content="{{ csrf_token() }}">

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

<h2 class="intro-y text-lg font-medium mt-10">{{ __('Payment Accounts.Payment List') }}</h2>

<div class="main-content" style="overflow-x: auto; min-height: 100vh;">
    <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
        <a href="{{ route('Payment.create') }}">
            <button class="btn btn-primary shadow-md mr-2">{{ __('Payment Accounts.Add New Payment') }}</button>
        </a>

        <div class="dropdown">
            <button class="dropdown-toggle btn px-2 box" aria-expanded="false" data-tw-toggle="dropdown">
                <span class="w-5 h-5 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="plus" class="lucide lucide-plus w-4 h-4" data-lucide="plus"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                </span>
            </button>
            <div class="dropdown-menu w-40">
                <ul class="dropdown-content">
                    <li><a href="" class="dropdown-item"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="printer" data-lucide="printer" class="lucide lucide-printer w-4 h-4 mr-2"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 01-2-2v-5a2 2 0 012-2h16a2 2 0 012 2v5a2 2 0 01-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg> Print</a></li>
                    <li><a href="" class="dropdown-item"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="file-text" data-lucide="file-text" class="lucide lucide-file-text w-4 h-4 mr-2"><path d="M14.5 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V7.5L14.5 2z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><line x1="10" y1="9" x2="8" y2="9"></line></svg> Export to Excel</a></li>
                    <li><a href="" class="dropdown-item"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="file-text" data-lucide="file-text" class="lucide lucide-file-text w-4 h-4 mr-2"><path d="M14.5 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V7.5L14.5 2z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><line x1="10" y1="9" x2="8" y2="9"></line></svg> Export to PDF</a></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- BEGIN: Data List -->
    <div class="intro-y col-span-12 overflow-x-auto lg:overflow-visible">
        <table class="table table-report -mt-2 min-w-full">
            <thead>
                <tr>
                    <th class="whitespace-nowrap">{{ __('Payment Accounts.ID') }}</th>
                    <th class="whitespace-nowrap">{{ __('Payment Accounts.Patient ID') }}</th>
                    <th class="whitespace-nowrap">{{ __('Payment Accounts.amount Amount') }}</th>
                    <th class="whitespace-nowrap">{{ __('Payment Accounts.Description') }}</th>
                    <th class="text-center whitespace-nowrap">{{ __('Payment Accounts.Actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($payments as $Payment)
                    <tr class="intro-x">
                        <td class="w-40">{{ $Payment->id }}</td>
                        <td>{{ $Payment->patient_id }}</td>
                        <td>{{ $Payment->amount }}</td>
                        <td>{{ $Payment->description }}</td>
                        <td class="table-report__action w-56">
                            <div class="flex justify-center items-center">
                                <a class="flex items-center mr-3" href="{{ route('Payment.show', $Payment->id) }}">
                                    <i data-lucide="Printer" class="w-4 h-4 mr-1"></i> {{ __('print') }}
                                </a>
                                <!-- Edit Button -->
                                <a class="flex items-center mr-3" href="{{ route('Payment.edit', $Payment->id) }}">
                                    <i data-lucide="check-square" class="w-4 h-4 mr-1"></i> {{ __('Edit') }}
                                </a>
                                <!-- Delete Button -->
                                <form action="{{ route('Payment.destroy', $Payment->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <a class="flex items-center text-danger" href="javascript:void(0);" onclick="deletePayment('{{ route('Payment.destroy', $Payment->id) }}')">
                                        <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i> {{ __('Delete') }}
                                    </a>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- END: Data List -->
</div>

<script>
    function deletePayment(actionUrl) {
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
                fetch(actionUrl, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire('Deleted!', data.success, 'success').then(() => {
                            window.location.reload();
                        });
                    } else {
                        Swal.fire('Error!', data.error || 'There was an error deleting the ambulance.', 'error');
                    }
                })
                .catch(error => {
                    Swal.fire('Error!', 'There was an error deleting the ambulance.', 'error');
                });
            }
        });
    }
    
</script>

@endsection
