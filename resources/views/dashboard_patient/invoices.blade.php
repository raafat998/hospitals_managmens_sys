@extends('layout/side-menu')

@section('subhead')
    <title>{{ __('sections.Section List') }}</title>
    <style>
        .auto-width-select {
            width: auto; 
            min-width: 120px; 
            padding: 5px; 
            display: inline-block; 
        }
    </style>
@endsection

@section('subcontent')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
{{-- --------------------------------------------------------------------------------------------------------------------------- --}}


<div class="main-content" style="overflow-x: auto; min-height: 100vh;">
        

    <!-- BEGIN: Data List -->
    <div class="intro-y col-span-12 overflow-x-auto lg:overflow-visible">
        <table class="table table-report -mt-2 min-w-full">
            <thead>
                <tr>
                    <th class="whitespace-nowrap">#</th>
                    <th class="whitespace-nowrap">تاريخ الفاتورة</th>
                    <th class="whitespace-nowrap">اسم الدكتور</th>
                    <th class="whitespace-nowrap"> اسم الخدنة</th>
                    <th class="whitespace-nowrap"> الا جمالي</th>
                </tr>
            </thead>
            <tbody>
                @foreach($invoices as $invoice)
                    <tr class="intro-x">
                        <td>{{$loop->iteration}}</td>
                        <td>{{$invoice->invoice_date}}</td>
                        <td>{{$invoice->doctor->name}}</td>
                        <td>{{$invoice->service ? $invoice->service->name : $invoice->groupservice->name }}</td>
                        <td>{{$invoice->total_with_tax}}</td>
                        

                        
                    </tr>
                    
                   
                @endforeach
            </tbody>
        </table>
    </div>

</div>








{{-- --------------------------------------------------------------------------------------------------------------------------- --}}

    <script>
        function changeLanguage(lang) {
            window.location.href = "{{ url('/') }}/" + lang;
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
