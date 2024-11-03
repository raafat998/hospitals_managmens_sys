@extends('layout/side-menu')

@section('subhead')

    <style>
        .auto-width-select {
            width: auto; 
            min-width: 120px; 
            padding: 5px; 
            display: inline-block; 
        }
    </style>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
@endsection

@section('subcontent')


    <div class="main-content" style="overflow-x: auto; min-height: 100vh;">

        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">

            <h2 class="intro-y text-lg font-medium mt-10">Payments List</h2>

        </div>

        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-12 overflow-x-auto lg:overflow-visible">
            <table class="table table-report -mt-2 min-w-full">
                <thead>
                    <tr>
                        <th class="whitespace-nowrap">#</th>
                        <th class="whitespace-nowrap">تاريخ الدفع</th>
                        <th class="whitespace-nowrap">المبلغ</th>
                        <th class="whitespace-nowrap">البيان</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($payments as $payment)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$payment->date}}</td>
                        <td>{{$payment->Debit}}</td>
                        <td>{{$payment->description}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

 

    <script>
     function deleteUser(actionUrl) {
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
                                window.location.href = "{{ route('user-mangment') }}";
                            });
                        } else {
                            Swal.fire('Failed', data.message || 'Something went wrong!', 'error');
                        }
                    })
                    .catch(error => {
                        Swal.fire('Failed', 'An error occurred while deleting!', 'error');
                    });
                }
            });
        }

        document.getElementById('searchInput').addEventListener('keyup', function() {
            var searchText = this.value.toLowerCase();
            var rows = document.querySelectorAll('table tbody tr');
            rows.forEach(function(row) {
                let rowContainsSearchText = row.innerText.toLowerCase().includes(searchText);
                row.style.display = rowContainsSearchText ? '' : 'none';
            });
        });
    </script>

@endsection
