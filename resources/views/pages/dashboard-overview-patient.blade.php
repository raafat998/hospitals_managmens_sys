@extends('layout/side-menu')


@section('subhead')
    <title>Dashboard - Midone - Tailwind HTML Admin Template</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v6.6.0/css/all.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.6.0/css/sharp-duotone-solid.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.6.0/css/all.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.6.0/css/sharp-solid.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.6.0/css/sharp-regular.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.6.0/css/sharp-thin.css">

    @endsection

@section('subcontent')
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 2xl:col-span-9">
            <div class="grid grid-cols-12 gap-6">
                <!-- BEGIN: General Report -->
                <div class="col-span-12 mt-8">
                    <div class="intro-y flex items-center h-10">
                        <h2 class="text-lg font-medium truncate mr-5">General Report</h2>
                        <a href="" class="ml-auto flex items-center text-primary">
                            <i data-lucide="refresh-ccw" class="w-4 h-4 mr-3"></i> Reload Data
                        </a>
                    </div>
                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="col-span-12 sm:col-span-6 xl:col-span-4 intro-y">
                            <div class="report-box zoom-in">
                                <div class="box p-5">
                                    <div class="flex">
                                        <i class="fa-solid fa-file-invoice-dollar fa-bounce fa-4x" style="color: #FFD43B;"></i>                                      
                                        <div class="ml-auto">
                                            <div class="report-box__indicator bg-success tooltip cursor-pointer" title="33% Higher than last month">
                                                33% <i data-lucide="chevron-up" class="w-4 h-4 ml-0.5"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-3xl font-medium leading-8 mt-6">{{App\Models\Invoice::where('patient_id',auth()->user()->id)->count()}}</div>
                                    <div class="text-base text-slate-500 mt-1"> اجمالي عدد الفواتير</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 sm:col-span-6 xl:col-span-4 intro-y">
                            <div class="report-box zoom-in">
                                <div class="box p-5">
                                    <a href="{{ route('payments.patient') }}">
                                    <div  class="flex">
                                        {{-- <i class="fa-duotone fa-solid fa-money-bills fa-beat-fade" style="--fa-primary-color: #166a24; --fa-secondary-color: #2c511f;"></i> --}}
                                        <i class="fa-duotone fa-money-bills fa-beat fa-4x" style="--fa-primary-color: #5cb450; --fa-secondary-color: #327b33;"></i>
                                        <div class="ml-auto">
                                            <div class="report-box__indicator bg-danger tooltip cursor-pointer" title="2% Lower than last month">
                                                2% <i data-lucide="chevron-down" class="w-4 h-4 ml-0.5"></i>
                                            </div>
                                            
                                        </div>
                                        <div>
                                            
                                        </div>
                                    </div>
                                </a>
                                    <div class="text-3xl font-medium leading-8 mt-6">{{App\Models\PatientAccount::where('patient_id',auth()->user()->id)->sum('credit')}}</div>
                                    <div class="text-base text-slate-500 mt-1"> اجمالي المدفوعات

                                        <span style="float: right">اضغط هنا لعرض المدفوعات</span>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 sm:col-span-6 xl:col-span-4 intro-y">
                            <div class="report-box zoom-in">
                                <div class="box p-5">
                                    <div class="flex">
                                        <i data-lucide="FileTextIcon" class="FileText text-warning"></i>
                                        <i class="fa-duotone fa-hand-holding-circle-dollar fa-beat fa-4x" style="--fa-primary-color: #296638; --fa-secondary-color: #296638;"></i>
                                        <div class="ml-auto">
                                            <div class="report-box__indicator bg-success tooltip cursor-pointer" title="12% Higher than last month">
                                                12% <i data-lucide="FileText"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-3xl font-medium leading-8 mt-6">{{ App\Models\PatientAccount::where('patient_id', auth()->user()->id)->sum('Debit') - App\Models\PatientAccount::where('patient_id', auth()->user()->id)->sum('Credit') }} JD</div>
                                    <div class="text-base text-slate-500 mt-1">المبلغ المطلوب</div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <!-- END: General Report -->
             
                <!-- END: General Report -->
                <!-- BEGIN: Weekly Top Products -->
                <div class="col-span-12 mt-6">
                    <div class="intro-y block sm:flex items-center h-10">
                        <h2 class="text-lg font-medium truncate mr-5">Last Five Diagnostics</h2>
                        <div class="flex items-center sm:ml-auto mt-3 sm:mt-0">
                            <button class="btn box flex items-center text-slate-600 dark:text-slate-300">
                                <i data-lucide="file-text" class="hidden sm:block w-4 h-4 mr-2"></i> Export to Excel
                            </button>
                            <button class="ml-3 btn box flex items-center text-slate-600 dark:text-slate-300">
                                <i data-lucide="file-text" class="hidden sm:block w-4 h-4 mr-2"></i> Export to PDF
                            </button>
                        </div>
                    </div>
                    <div class="intro-y col-span-12 overflow-x-auto lg:overflow-visible">
                        <table class="table table-report -mt-2 min-w-full">
                            <thead>
                                <tr>
                                    <th class="whitespace-nowrap">#</th>
                                    <th class="whitespace-nowrap">تاريخ الفاتورة</th>
                                    <th class="whitespace-nowrap">اسم المريض</th>
                                    <th class="whitespace-nowrap">اسم الدكتور</th>
                                    <th class="whitespace-nowrap">حالة الفاتورة</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse(\App\Models\Invoice::latest()->take(5)->where('patient_id',auth()->user()->id)->get() as $invoice )
                                    <tr class="intro-x">
                                        <td>{{$loop->iteration}}</td>
                                        <td class="tx-right tx-medium tx-inverse">{{$invoice->created_at}}</td>
                                        <td class="tx-right tx-medium tx-danger">{{$invoice->patient->name}}</td>
                                        <td class="tx-right tx-medium tx-inverse">{{$invoice->doctor->name}}</td>
                                        
                                        <td >
                                            @if($invoice->case == 0)
                                            <span class='text-danger'>تحت الاجراء</span>
                                            @else
                                                <span class='text-success'>مكتملة</span>
                                            @endif
                                        </td>
            
                                        
                                    </tr>
                                    @empty
                                        لا يوجد بيانات
                                    
                                        
                                   
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
                <!-- END: Weekly Top Products -->
            </div>
        </div>
        <div class="col-span-12 2xl:col-span-3">
            <div class="2xl:border-l -mb-10 pb-10">
                
            </div>
        </div>
    </div>
@endsection
