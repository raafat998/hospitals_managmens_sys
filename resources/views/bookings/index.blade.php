@extends('layout.side-menu')

@section('subhead')
    <title>Bookings List - Your App</title>
@endsection

@section('subcontent')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <h2 class="intro-y text-lg font-medium mt-10">Bookings</h2>
    <div class="grid grid-cols-12 gap-6 mt-5">

        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
            <a href="{{ route('bookings.create') }}">
                <button class="btn btn-primary shadow-md mr-2">Add New Booking</button>
            </a>
            <div class="dropdown">
                <button class="dropdown-toggle btn px-2 box" aria-expanded="false" data-tw-toggle="dropdown">
                    <span class="w-5 h-5 flex items-center justify-center">
                        <i class="w-4 h-4" data-lucide="plus"></i>
                    </span>
                </button>
                <div class="dropdown-menu w-40">
                    <ul class="dropdown-content">
                        <li>
                            <a href="" class="dropdown-item">
                                <i data-lucide="printer" class="w-4 h-4 mr-2"></i> Print
                            </a>
                        </li>
                        <li>
                            <a href="" class="dropdown-item">
                                <i data-lucide="file-text" class="w-4 h-4 mr-2"></i> Export to Excel
                            </a>
                        </li>
                        <li>
                            <a href="" class="dropdown-item">
                                <i data-lucide="file-text" class="w-4 h-4 mr-2"></i> Export to PDF
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="hidden md:block mx-auto text-gray-500">Showing {{ $bookings->count() }} of {{ $totalBookings }} entries</div>
            <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                <div class="relative text-gray-500">
                    <input type="text" id="searchInput" class="form-control w-56 box pr-10 border-gray-300 rounded-md shadow-sm" placeholder="Search...">
                    <i class="w-4 h-4 absolute inset-y-0 right-0 mr-3 flex items-center" data-lucide="search"></i>
                </div>
            </div>
        </div>

        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
            <table class="table table-report -mt-2 w-full border border-gray-200">
                <thead>
                    <tr class="bg-gray-100 text-gray-600">
                        <th class="py-2 px-4 border-b">ID</th>
                        <th class="py-2 px-4 border-b">Client</th>
                        <th class="py-2 px-4 border-b">Property</th>
                        <th class="py-2 px-4 border-b">Start Date</th>
                        <th class="py-2 px-4 border-b">End Date</th>
                        <th class="py-2 px-4 border-b">Total Price</th>
                        <th class="py-2 px-4 border-b">Payment Status</th>
                        <th class="py-2 px-4 border-b">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bookings as $key => $booking)
                        <tr class="border-b">
                            <td class="py-2 px-4">{{ $booking->id }}</td>
                            <td class="py-2 px-4">{{ $booking->client->client_name }}</td>
                            <td class="py-2 px-4">{{ $booking->property->property_name }}</td>
                            <td class="py-2 px-4">{{ $booking->start_date }}</td>
                            <td class="py-2 px-4">{{ $booking->end_date }}</td>
                            <td class="py-2 px-4">{{ $booking->total_price }}</td>
                            <td class="py-2 px-4">{{ $booking->payment_status }}</td>
                           
                            <td>
                                <a class="btn btn-primary" href="{{ route('bookings.edit',  $booking->id) }}">Edit</a>
                                {!! Form::open(['method' => 'DELETE', 'route' => ['bookings.destroy',$booking->id], 'style' => 'display:inline', 'class' => 'delete-form']) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                {!! Form::close() !!}
                            </td>
                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- END: Data List -->

    </div>

    <script>
      document.querySelectorAll('form').forEach(function(form) {
    form.addEventListener('submit', function(e) {
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
                fetch(form.action, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: new URLSearchParams(new FormData(form)).toString()
                })
                .then(response => {
                    if (response.status >= 200 && response.status < 300) {
                        Swal.fire(
                            'Deleted!',
                            'The booking has been deleted.',
                            'success'
                        ).then(() => {
                            window.location.href = "{{ route('bookings.index') }}";
                        });
                    } else {
                        return response.json().then(data => {
                            Swal.fire(
                                'Error!',
                                data.error || 'There was an error deleting the booking.',
                                'error'
                            );
                        });
                    }
                })
                .catch(error => {
                    Swal.fire(
                        'Error!',
                        'There was an error deleting the booking.',
                        'error'
                    );
                });
            }
        });
    });
});


        document.getElementById('searchInput').addEventListener('keyup', function() {
            var searchText = this.value.toLowerCase();
            var rows = document.querySelectorAll('table tbody tr');
            
            rows.forEach(function(row) {
                let rowContainsText = false;
                var columns = row.querySelectorAll('td');
                
                columns.forEach(function(column) {
                    var columnText = column.textContent.toLowerCase();
                    if (columnText.indexOf(searchText) !== -1) {
                        rowContainsText = true;
                    }
                });
                
                if (rowContainsText) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>

@endsection
