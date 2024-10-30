@extends('layout/side-menu')

@section('subhead')
    <title>{{ __('Patients.Patient File') }}</title>
@endsection

@section('subcontent')
<div class="intro-y box">
    <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
        <h2 class="font-medium text-base mr-auto">Patient File</h2>
        <a class="btn btn-primary" href="{{ route('Patients.index') }}"> Back </a>
    </div>
   
      <!-- row opened -->
      <div class="row row-sm">
        <div class="col-lg-12 col-md-12">
            <div class="card" id="basic-alert">
                <div class="card-body">
                    <div class="text-wrap">
                        <div class="example">
                            <div class="panel panel-primary tabs-style-1">
                                <div class=" tab-menu-heading">
                                    <div class="tabs-menu1">
                                        <!-- Tabs -->
                                        <ul class="nav panel-tabs main-nav-line">
                                            <li class="nav-item"><a href="#tab1" class="nav-link active"
                                                                    data-toggle="tab">معلومات المريض</a></li>
                                            <li class="nav-item"><a href="#tab2" class="nav-link" data-toggle="tab">الفواتير</a>
                                            </li>
                                            <li class="nav-item"><a href="#tab3" class="nav-link" data-toggle="tab">المدفوعات</a>
                                            </li>
                                            <li class="nav-item"><a href="#tab4" class="nav-link" data-toggle="tab">كشف
                                                    حساب</a></li>
                                            <li class="nav-item"><a href="#tab5" class="nav-link" data-toggle="tab">الاشعه</a>
                                            </li>
                                            <li class="nav-item"><a href="#tab6" class="nav-link" data-toggle="tab">المختبر</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel-body tabs-menu-body main-content-body-right border-top-0 border">
                                    <div class="tab-content">


                                        {{-- Strat Show Information Patient --}}

                                        <div class="tab-pane active" id="tab1">
                                            <br>
                                            <div class="table-responsive">
                                                <table class="table table-hover text-md-nowrap text-center">
                                                    <thead>
                                                        <tr style="background-color: rgba(0, 123, 255, 0.2); color: rgba(0, 123, 255, 1);">
                                                            <th>#</th>
                                                            <th>اسم المريض</th>
                                                            <th>رقم الهاتف</th>
                                                            <th>البريد الالكتورني</th>
                                                            <th>تاريخ الميلاد</th>
                                                            <th>النوع</th>
                                                            <th>فصيلة الدم</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr style="background-color: rgba(108, 117, 125, 0.1); color: rgba(108, 117, 125, 1);">
                                                            <td>1</td>
                                                            <td>{{$Patient->name}}</td>
                                                            <td>{{$Patient->Phone}}</td>
                                                            <td>{{$Patient->email}}</td>
                                                            <td>{{$Patient->Date_Birth}}</td>
                                                            <td>{{$Patient->Gender == 1 ? 'ذكر' : 'انثي'}}</td>
                                                            <td>{{$Patient->Blood_Group}}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        
                                      

                                        {{-- End Show Information Patient --}}



                                        {{-- Start Invices Patient --}}

                                        <div class="tab-pane" id="tab2">

                                            <div class="table-responsive">
                                                <table class="table table-hover text-md-nowrap text-center">
                                                    <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>اسم الخدمه</th>
                                                        <th>تاريخ الفاتوره</th>
                                                        <th>الاجمالي مع الضريبه</th>
                                                        <th>نوع الفاتوره</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($invoices as $invoice)
                                                        <tr>
                                                            <td>{{$loop->iteration}}</td>

                                                            {{-- ?? = or --}}

                                                            <td>{{$invoice->Service->name ?? $invoice->Group->name}}</td> 
                                                            <td>{{$invoice->invoice_date}}</td>
                                                            <td>{{$invoice->total_with_tax}}</td>
                                                            <td>{{$invoice->type == 1 ? 'نقدي' : 'اجل'}}</td>
                                                        </tr>
                                                        <br>
                                                    @endforeach
                                                    <tr>
                                                        <th colspan="4" scope="row" class="alert relative border rounded-md px-5 py-4 bg-success border-success bg-opacity-20 border-opacity-5 text-success">
                                                            الاجمالي
                                                        </th>
                                                        <td class="alert relative border rounded-md px-5 py-4 bg-primary border-primary bg-opacity-20 border-opacity-5 text-primary">
                                                            {{ number_format($invoices->sum('total_with_tax'), 2) }}
                                                        </td>
                                                    </tr>                                                    
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        {{-- End Invices Patient --}}



                                        {{-- Start Receipt Patient  --}}

                                        <div class="tab-pane" id="tab3">
                                            <div class="table-responsive">
                                                <table class="table table-hover text-md-nowrap text-center">
                                                    <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>تاريخ الاضافه</th>
                                                        <th>المبلغ</th>
                                                        <th>البيان</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($receipt_accounts as $receipt_account)
                                                        <tr>
                                                            <td>{{$loop->iteration}}</td>
                                                            <td>{{$receipt_account->date}}</td>
                                                            <td>{{$receipt_account->amount}}</td>
                                                            <td>{{$receipt_account->description}}</td>
                                                        </tr>
                                                        <br>
                                                    @endforeach
                                                    <tr>
                                                        <th scope="row" class="alert relative border rounded-md px-5 py-4 bg-success border-success bg-opacity-20 border-opacity-5 text-success">
                                                            الاجمالي
                                                        </th>
                                                        <td colspan="4" class="alert relative border rounded-md px-5 py-4 bg-primary border-primary bg-opacity-20 border-opacity-5 text-primary">
                                                            {{ number_format($receipt_accounts->sum('amount'), 2) }}
                                                        </td>
                                                    </tr>                                                    
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        {{-- End Receipt Patient  --}}


                                        {{-- Start payment accounts Patient --}}
                                        <div class="tab-pane" id="tab4">
                                            <div class="table-responsive">
                                                <table class="table table-hover text-md-nowrap text-center" id="example1">
                                                    <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>تاريخ الاضافه</th>
                                                        <th>الوصف</th>
                                                        <th>مدبن</th>
                                                        <th>دائن</th>
                                                        <th>الرصيد النهائي</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($Patient_accounts as $Patient_account)
                                                        <tr>
                                                            <td>{{$loop->iteration}}</td>
                                                            <td>{{$Patient_account->date}}</td>
                                                            <td>
                                                                @if($Patient_account->single_invoice == true)
                                                                    {{$Patient_account->single_invoice->Service->name ?? $Patient_account->single_invoice->Group->name  }}

                                                                @elseif($Patient_account->receipt_id == true)
                                                                    {{$Patient_account->ReceiptAccount->description}}

                                                                @elseif($Patient_account->Payment_id == true)
                                                                    {{$Patient_account->PaymentAccount->description}}
                                                                @endif

                                                            </td>
                                                            <td>{{ $Patient_account->Debit}}</td>
                                                            <td>{{ $Patient_account->credit}}</td>
                                                            <td></td>
                                                        </tr>
                                                        <br>
                                                    @endforeach
                                                    <tr>
                                                        <th colspan="3" scope="row" class="alert relative border rounded-md px-5 py-4 bg-success border-success bg-opacity-20 border-opacity-5 text-success">
                                                            الاجمالي
                                                        </th>
                                                        <td class="alert relative border rounded-md px-5 py-4 bg-primary border-primary bg-opacity-20 border-opacity-5 text-primary">
                                                            {{ number_format($Debit = $Patient_accounts->sum('Debit'), 2) }}
                                                        </td>
                                                        <td class="alert relative border rounded-md px-5 py-4 bg-primary border-primary bg-opacity-20 border-opacity-5 text-primary">
                                                            {{ number_format($credit = $Patient_accounts->sum('credit'), 2) }}
                                                        </td>
                                                        <td class="alert relative border rounded-md px-5 py-4 bg-danger border-danger bg-opacity-20 border-opacity-5 text-danger">
                                                            <span>{{$Debit - $credit}} {{  $Debit - $credit == 0 ? '' : ($Debit - $credit < 0 ? 'دائن' : 'مدين') }}</span>
                                                        </td>
                                                    </tr>
                                                    
                                                    
                                                    </tbody>
                                                </table>

                                            </div>

                                            <br>

                                        </div>

                                        {{-- End payment accounts Patient --}}


                                        <div class="tab-pane" id="tab5">
                                            <p>praesentium voluptatum deleniti atque corrquas molestias excepturi sint
                                                occaecati cupiditate non provident,</p>
                                            <p class="mb-0">similique sunt in culpa qui officia deserunt mollitia animi,
                                                id est laborum et dolorum fuga. Et harum quidem rerum facilis est et
                                                expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi
                                                optio cumque nihil impedit quo minus id quod maxime placeat facere
                                                possimus, omnis voluptas assumenda est, omnis dolor repellendus.</p>
                                        </div>
                                        <div class="tab-pane" id="tab6">
                                            <p>praesentium et quas molestias excepturi sint occaecati cupiditate non
                                                provident,</p>
                                            <p class="mb-0">similique sunt in culpa qui officia deserunt mollitia animi,
                                                id est laborum et dolorum fuga. Et harum quidem rerum facilis est et
                                                expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi
                                                optio cumque nihil impedit quo minus id quod maxime placeat facere
                                                possimus, omnis voluptas assumenda est, omnis dolor repellendus.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Prism Precode -->
                    </div>
                </div>
            </div>
        </div>


    </div>
    </div>
    <!-- /row -->
    </div>
    <!-- Container closed -->
    </div>
 <!-- Add your JS code here -->
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

 <script>
     // Example: Handle tab click and alert based on the tab
     $(document).on('click', '[data-toggle="tab"]', function (e) {
         var tabId = $(this).attr('href');
         if (tabId === '#tab1') {
             alert("You're viewing Patient Information!");
         }
     });

     // Example: Another simple JavaScript function
     function alertPatientInfo() {
         alert("This is a sample alert for the patient information.");
     }

     // Add event listener for a button (example)
     document.addEventListener('DOMContentLoaded', function () {
         const alertButton = document.getElementById('alert-button');
         if (alertButton) {
             alertButton.addEventListener('click', function () {
                 alertPatientInfo();
             });
         }
     });
 </script>
@endsection
