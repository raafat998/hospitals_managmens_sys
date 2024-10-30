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

    <h2 class="intro-y text-lg font-medium mt-10">{{ __('Doctors.doctor_list') }}</h2>
    
    
    <div class="main-content" style="overflow-x: auto; min-height: 100vh;">
        

        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-12 overflow-x-auto lg:overflow-visible">
            <table class="table table-report -mt-2 min-w-full">
                <thead>
                    <tr>
                        <th class="whitespace-nowrap">#</th>
                        <th class="whitespace-nowrap">تاريخ الفاتورة</th>
                        <th class="whitespace-nowrap">اسم الخدمة</th>
                        <th class="whitespace-nowrap">اسم المريض</th>
                        <th class="whitespace-nowrap">سعر الخدمة</th>
                        <th class="whitespace-nowrap">قيمة الخصم</th>
                        <th class="whitespace-nowrap">نسبة الضريبة</th>
                        <th class="whitespace-nowrap">قيمة الضريبة</th>
                        <th class="whitespace-nowrap">الاجمالي مع الضريبة</th>
                        <th class="text-center whitespace-nowrap">حالة الفاتورة</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($invoices as $invoice)
                        <tr class="intro-x">
                            <td >{{ $loop->iteration}}</td>
                            <td >{{ $invoice->invoice_date }} </td>
                            <td>{{ $invoice->Service->name ?? $invoice->Group->name }}</td>
                            <td><a href="{{route('Diagnostics.show',$invoice->patient_id)}}">{{ $invoice->Patient->name }}</a></td>
                            <td class="text-center">{{ number_format($invoice->price, 2) }}</td>
                            <td >{{ number_format($invoice->discount_value, 2) }}</td>
                            <td >{{ $invoice->tax_rate }}%</td>
                            <td>{{ number_format($invoice->tax_value, 2) }}</td>
                            <td >{{ number_format($invoice->total_with_tax, 2) }}</td>
                            <td >
                                @if($invoice->invoice_status == 1)
                                <span class='text-danger'>تحت الاجراء</span>
                                @elseif($invoice->invoice_status == 2)
                                        <span class="text-warning">مراجعة</span>
                                @else
                                    <span class='text-success'>مكتملة</span>
                                @endif
                            </td>

                            
                        </tr>
                        @include('Doctors.invoices.add_diagnosis')
                    @endforeach
                </tbody>
            </table>
        </div>
        

       

    </div>

    
    <script>
        function changeLanguage(lang) {
            window.location.href = "{{ url('/') }}/" + lang;
        }
    </script>
@endsection
