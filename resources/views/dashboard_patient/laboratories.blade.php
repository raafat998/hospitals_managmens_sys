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
                    <th class="whitespace-nowrap">المطلوب</th>
                    <th class="whitespace-nowrap">اسم الدكتور</th>
                    <th class="whitespace-nowrap">اسم دكتور المختبر</th>
                    <th class="whitespace-nowrap">ملاحظة المختبر</th>
                    <th>العمليات</th>
                </tr>
            </thead>
            <tbody>
                @foreach($laboratories as $laboratorie)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$laboratorie->description}}</td>
                    <td>{{$laboratorie->doctor->name}}</td>
                    <td>{{$laboratorie->employee->name}}</td>
                    <td>{{$laboratorie->description_employee}}</td>
                    <td>
                        @if($laboratorie->employee_id !== null)
                            <a class="btn btn-primary btn-sm" href="{{route('laboratories.view',$laboratorie->id)}}" role="button">عرض التحليل</a>
                        @endif                                                   </td>
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
