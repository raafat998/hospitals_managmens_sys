@extends('../layout/' . $layout)

@section('subhead')
    <title>{{ __('GroupInvoices.invoice_title') }}</title>
@endsection

@section('subcontent')
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">{{ __('GroupInvoices.single_service_invoice') }}</h2>
        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
            <button class="btn btn-primary shadow-md mr-2" id="print_Button" onclick="printDiv()">{{ __('GroupInvoices.export_to_pdf') }}</button>
            <div class="dropdown ml-auto sm:ml-0">
                <button class="dropdown-toggle btn px-2 box" aria-expanded="false" data-tw-toggle="dropdown">
                    <span class="w-5 h-5 flex items-center justify-center">
                        <i class="w-4 h-4" data-lucide="plus"></i>
                    </span>
                </button>
                <div class="dropdown-menu w-40">
                    <div class="dropdown-content">
                        <a href="" class="dropdown-item">
                            <i data-lucide="file" class="w-4 h-4 mr-2"></i> {{ __('GroupInvoices.export_to_word') }}
                        </a>
                        <a href="" class="dropdown-item">
                            <i data-lucide="file" class="w-4 h-4 mr-2"></i> {{ __('GroupInvoices.export_to_pdf') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="print" class="intro-y box overflow-hidden mt-5">
        <div class="flex flex-col lg:flex-row pt-10 px-5 sm:px-20 sm:pt-20 lg:pb-20 text-center sm:text-left border-b">
            <div class="font-semibold text-primary text-3xl">{{ __('GroupInvoices.single_service_invoice') }}</div>
            <div class="mt-20 lg:mt-0 lg:ml-auto lg:text-right">
                <div class="text-xl text-primary font-medium">{{ Request::get('doctor_id') }}</div>
                <div class="mt-1">{{ __('GroupInvoices.invoice_date') }}: {{ Request::get('invoice_date') }}</div>
                <div class="mt-1">{{ __('GroupInvoices.section_name') }}: {{ Request::get('section_id') }}</div>
                <div class="mt-1">{{ __('GroupInvoices.invoice_type') }}: {{ Request::get('type') == 1 ? __('GroupInvoices.invoice_type_cash') : __('GroupInvoices.invoice_type_credit') }}</div>
            </div>
        </div>

        <div class="flex flex-col lg:flex-row border-b px-5 sm:px-20 pt-10 pb-10 sm:pb-20 text-center sm:text-left">
            <div>
                <div class="text-base text-slate-500">{{ __('GroupInvoices.patient_details') }}</div>
                <div class="text-lg font-medium text-primary mt-2">{{ Request::get('patient_name') }}</div>
                <div class="mt-1">{{ __('GroupInvoices.email') }}: {{ Request::get('patient_email') }}</div>
                <div class="mt-1">{{ __('GroupInvoices.phone') }}: {{ Request::get('patient_phone') }}</div>
                <div class="mt-1">{{ __('GroupInvoices.gender') }}: {{ Request::get('patient_gender') }}</div>
                <div class="mt-1">{{ __('GroupInvoices.birth_date') }}: {{ Request::get('patient_birth') }}</div>
                <div class="mt-1">{{ __('GroupInvoices.blood_group') }}: {{ Request::get('patient_blood_group') }}</div>
            </div>
            <div class="mt-10 lg:mt-0 lg:ml-auto lg:text-right">
                <div class="text-base text-slate-500">{{ __('GroupInvoices.receipt_number') }}</div>
                <div class="text-lg text-primary font-medium mt-2">#{{ Request::get('id') }}</div>
                <div class="mt-1">{{ __('GroupInvoices.invoice_date') }}: {{ Request::get('invoice_date') }}</div>
            </div>
        </div>

        <div class="px-5 sm:px-16 py-10 sm:py-20">
            <div class="overflow-x-auto">
                <table class="table">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border-b-2 dark:border-darkmode-400 whitespace-nowrap">{{ __('GroupInvoices.service_description') }}</th>
                            <th class="border-b-2 dark:border-darkmode-400 text-right whitespace-nowrap">{{ __('GroupInvoices.quantity') }}</th>
                            <th class="border-b-2 dark:border-darkmode-400 text-right whitespace-nowrap">{{ __('GroupInvoices.price') }}</th>
                            <th class="border-b-2 dark:border-darkmode-400 text-right whitespace-nowrap">{{ __('GroupInvoices.total') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="border-b dark:border-darkmode-400">
                                <div class="font-medium whitespace-nowrap">{{ Request::get('Service_id') }}</div>
                                <div class="text-slate-500 text-sm mt-0.5 whitespace-nowrap">{{ __('GroupInvoices.service_description') }}</div>
                                <div class="font-medium whitespace-nowrap">{{ Request::get('Group_id') }}</div>

                            </td>
                            <td class="text-right border-b dark:border-darkmode-400 w-32">1</td>
                            <td class="text-right border-b dark:border-darkmode-400 w-32">{{ Request::get('price') }} د.أ</td>
                            <td class="text-right border-b dark:border-darkmode-400 w-32 font-medium">{{ Request::get('price') }} د.أ</td>
                        </tr>
                        <tr>
                            <td class="border-b dark:border-darkmode-400" colspan="2">{{ __('GroupInvoices.total_amount') }}</td>
                            <td class="text-right border-b dark:border-darkmode-400 w-32">{{ __('GroupInvoices.total_amount') }}</td>
                            <td class="text-right border-b dark:border-darkmode-400 w-32 font-medium">{{ number_format(Request::get('price'), 2) }} د.أ</td>
                        </tr>
                        <tr>
                            <td class="border-b dark:border-darkmode-400" colspan="2">{{ __('GroupInvoices.discount_value') }}</td>
                            <td class="text-right border-b dark:border-darkmode-400 w-32"></td>
                            <td class="text-right border-b dark:border-darkmode-400 w-32 font-medium">{{ Request::get('discount_value') }} د.أ</td>
                        </tr>
                        <tr>
                            <td class="border-b dark:border-darkmode-400" colspan="2">{{ __('GroupInvoices.tax_rate') }}</td>
                            <td class="text-right border-b dark:border-darkmode-400 w-32">% {{ Request::get('tax_rate') }}</td>
                            <td class="text-right border-b dark:border-darkmode-400 w-32"></td>
                        </tr>
                        <tr>
                            <td class="border-b dark:border-darkmode-400" colspan="2">{{ __('GroupInvoices.total_with_tax') }}</td>
                            <td class="text-right border-b dark:border-darkmode-400 w-32"></td>
                            <td class="text-right border-b dark:border-darkmode-400 w-32 font-medium">{{ number_format(Request::get('total_with_tax'), 2) }} د.أ</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="px-5 sm:px-20 pb-10 sm:pb-20 flex flex-col-reverse sm:flex-row">
            <div class="text-center sm:text-left mt-10 sm:mt-0">
                <div class="text-base text-slate-500">{{ __('GroupInvoices.bank_transfer') }}</div>
                <div class="text-lg text-primary font-medium mt-2">{{ __('GroupInvoices.payment_method') }}</div>
                <div class="mt-1">{{ __('GroupInvoices.account_number') }}: {{ Request::get('bank_account') }}</div>
                <div class="mt-1">{{ __('GroupInvoices.bank_code') }}: {{ Request::get('bank_code') }}</div>
            </div>
            <div class="text-center sm:text-right sm:ml-auto">
                <div class="text-base text-slate-500">{{ __('GroupInvoices.total_amount_due') }}</div>
                <div class="text-xl text-primary font-medium mt-2">{{ number_format(Request::get('total_with_tax'), 2) }} د.أ</div>
                <div class="mt-1">{{ __('GroupInvoices.including_tax') }}</div>
            </div>
        </div>
    </div>

    <style>
        @media print {
            @page {
                size: A4; /* حجم الصفحة A4 */
                margin: 5mm; /* هوامش صغيرة لتناسب المحتوى */
            }

            body {
                margin: 0; /* إزالة الهوامش من الجسم */
            }

            #print {
                width: 100%; /* اجعل الفاتورة بعرض الصفحة */
                page-break-inside: avoid; /* تجنب تقسيم الفاتورة عبر الصفحات */
            }

            body * {
                display: none; /* إخفاء كل العناصر */
            }

            #print, #print * {
                display: block; /* إظهار الفاتورة فقط */
            }

            /* تقليل حجم الخط والمسافات بين العناصر */
            #print {
                font-size: 10px; /* حجم الخط أصغر */
            }

            #print th, #print td {
                padding: 2px; /* تقليل padding */
            }

            #print .text-primary {
                font-size: 12px; /* تعديل حجم الخط للعناوين */
            }
        }
    </style>

    <script>
        function printDiv() {
            var printContents = document.getElementById('print').innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            location.reload(); // لإعادة تحميل الصفحة بعد الطباعة
        }
    </script>
@endsection
