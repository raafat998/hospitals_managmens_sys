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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <h2 class="intro-y text-lg font-medium mt-10">Diagnostics in progress</h2>
    
    
    <div class="main-content" style="overflow-x: auto; min-height: 150vh;">
        

        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-12 overflow-x-auto lg:overflow-visible">
            <table class="table table-report -mt-2 min-w-full">
                <thead>
                    <tr>
                        <th class="whitespace-nowrap">#</th>
                        <th class="whitespace-nowrap">تاريخ الفاتورة</th>
                        <th class="whitespace-nowrap">اسم المريض</th>
                        <th class="whitespace-nowrap">اسم الدكتور</th>
                        <th class="whitespace-nowrap"> المطلوب</th>
                        <th class="whitespace-nowrap">حالة الفاتورة</th>
                        <th class="text-center whitespace-nowrap">العمليات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($invoices as $invoice)
                        <tr class="intro-x">
                            <td>{{ $loop->iteration}}</td>
                            <td>{{ $invoice->created_at }}</td>
                            <td>{{ $invoice->Patient->name }}</td>
                            <td>{{ $invoice->doctor->name }}</td>
                            <td>{{ $invoice->description }}</td>
                            
                            <td >
                                @if($invoice->case == 0)
                                <span class='text-danger'>تحت الاجراء</span>
                                @else
                                    <span class='text-success'>مكتملة</span>
                                @endif
                            </td>

                            <td  class="table-report__action w-56">
                                <div class="relative inline-block text-left mr-3">
                                    <button onclick="toggleDropdown2()" data-tw-merge class="transition duration-200 border shadow-sm inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&:hover:not(:disabled)]:bg-opacity-90 [&:hover:not(:disabled)]:border-opacity-90 [&:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-secondary/70 border-secondary/70 text-slate-500 dark:border-darkmode-400 dark:bg-darkmode-400 dark:text-slate-300 [&:hover:not(:disabled)]:bg-slate-100 [&:hover:not(:disabled)]:border-slate-100 [&:hover:not(:disabled)]:dark:border-darkmode-300/80 [&:hover:not(:disabled)]:dark:bg-darkmode-300/80 shadow-md mb-2 mr-1  mb-2 mr-3 mt-2">

                                        <a>
                                            Processes
                                        </a>
                                        <i data-tw-merge data-lucide="chevron-down" class="stroke-1.5 w-5 h-5 ml-2 h-4 w-4 ml-2 h-4 w-4"></i></button>    
                                    </button>
                                    <div id="dropdownMenu2" class="hidden absolute right-0 z-10 w-40 bg-white border border-gray-300 rounded-md shadow-lg">
                                        <ul class="py-1">
                                            <li>
                                                <a class="cursor-pointer flex items-center p-2 transition duration-300 ease-in-out rounded-md hover:bg-slate-200/60 dark:bg-darkmode-600 dark:hover:bg-darkmode-400 dropdown-item" 
                                                   data-tw-merge 
                                                   data-tw-toggle="modal" 
                                                   data-tw-target="#datepicker-modal-preview{{$invoice->id}}" 
                                                   href="#"
                                                   >
                                                    <i class="text-primary fa fa-stethoscope mr-3"></i>
                                                    &nbsp;&nbsp;اضافة تشخيص
                                                </a>
                                            </li>
                                        
                                        </ul>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @include('dashboard_LaboratorieEmployee.invoices.add_diagnosis')

                    @endforeach
                </tbody>
            </table>
        </div>
        

       

    </div>

    
    <script>
        function changeLanguage(lang) {
            window.location.href = "{{ url('/') }}/" + lang;
        }

 


    function toggleDropdown2() {
        const dropdown = document.getElementById('dropdownMenu2');
        dropdown.classList.toggle('hidden');
    }

    
    window.onclick = function(event) {
        if (!event.target.matches('.btn-primary')) {
            const dropdowns = document.getElementsByClassName("absolute2");
            for (let i = 0; i < dropdowns.length; i++) {
                const openDropdown = dropdowns[i];
                if (openDropdown.classList.contains('hidden')) {
                    openDropdown.classList.add('hidden');
                }
            }
        }
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
