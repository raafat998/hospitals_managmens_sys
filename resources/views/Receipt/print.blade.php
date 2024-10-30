@extends('../layout/' . $layout)

@section('subhead')
    <title>{{ __('receipt.title') }}</title>
@endsection

@section('subcontent')

    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">{{ __('receipt.title') }}</h2>
        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
            <button id="printButton" class="btn btn-primary shadow-md mr-2">{{ __('receipt.print') }}</button>
            <div class="dropdown ml-auto sm:ml-0">
                <button class="dropdown-toggle btn px-2 box" aria-expanded="false" data-tw-toggle="dropdown">
                    <span class="w-5 h-5 flex items-center justify-center">
                        <i class="w-4 h-4" data-lucide="plus"></i>
                    </span>
                </button>
                <div class="dropdown-menu w-40">
                    <div class="dropdown-content">
                        <a href="" class="dropdown-item">
                            <i data-lucide="file" class="w-4 h-4 mr-2"></i> {{ __('receipt.export_word') }}
                        </a>
                        <a href="" class="dropdown-item">
                            <i data-lucide="file" class="w-4 h-4 mr-2"></i> {{ __('receipt.export_pdf') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- BEGIN: Invoice -->
    <div class="intro-y box overflow-hidden mt-5" id="print">
        <div class="flex flex-col lg:flex-row pt-10 px-5 sm:px-20 sm:pt-20 lg:pb-20 text-center sm:text-left">
            <div class="font-semibold text-primary text-2xl">{{ __('receipt.title') }}</div>
            <div class="mt-20 lg:mt-0 lg:ml-auto lg:text-right">
                <div class="text-lg text-primary font-medium">{{ __('receipt.company_name') }}</div>
                <div class="mt-1">{{ __('receipt.email') }}</div>
                <div class="mt-1">{{ __('receipt.address') }}</div>
                <div class="mt-1">{{ __('receipt.tel') }}</div>
            </div>
        </div>

        <div class="flex flex-col lg:flex-row border-b px-5 sm:px-20 pt-10 pb-10 sm:pb-20 text-center sm:text-left">
            <div>
                <div class="text-base text-slate-500">{{ __('receipt.receipt_info') }}</div>
                <div class="text-lg font-medium text-primary mt-2">{{$receipt->patients->name}}</div>
                <div class="mt-1">{{$receipt->patients->email ?? __('receipt.no_email') }}</div>
            </div>
            <div class="mt-10 lg:mt-0 lg:ml-auto lg:text-right">
                <div class="text-base text-slate-500">{{ __('receipt.issue_date') }}</div>
                <div class="text-lg text-primary font-medium mt-2">{{$receipt->date}}</div>
            </div>
        </div>

        <div class="px-5 sm:px-16 py-10 sm:py-20">
            <div class="overflow-x-auto">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="border-b-2 dark:border-darkmode-400 whitespace-nowrap">#</th>
                            <th class="border-b-2 dark:border-darkmode-400 whitespace-nowrap">{{ __('receipt.notes') }}</th>
                            <th class="border-b-2 dark:border-darkmode-400 text-right whitespace-nowrap">{{ __('receipt.amount') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="border-b dark:border-darkmode-400">1</td>
                            <td class="border-b dark:border-darkmode-400">{{$receipt->description}}</td>
                            <td class="border-b dark:border-darkmode-400 text-right">{{ number_format($receipt->amount, 2) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="px-5 sm:px-20 pb-10 sm:pb-20 flex flex-col-reverse sm:flex-row">
            <div class="text-center sm:text-left mt-10 sm:mt-0">
                <div class="text-base text-slate-500">{{ __('receipt.bank_transfer') }}</div>
                <div class="text-lg text-primary font-medium mt-2">{{$receipt->patients->name}}</div>
            </div>
            <div class="text-center sm:text-right sm:ml-auto">
                <div class="text-base text-slate-500">{{ __('receipt.total_amount') }}</div>
                <div class="text-xl text-primary font-medium mt-2">{{ number_format($receipt->amount, 2) }}</div>
                <div class="mt-1">{{ __('receipt.tax_included') }}</div>
            </div>
        </div>
    </div>
    <!-- END: Invoice -->

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
        document.getElementById('printButton').addEventListener('click', function() {
            var printContent = document.getElementById('print').innerHTML;
            var originalContent = document.body.innerHTML;

            document.body.innerHTML = printContent;
            window.print();
            document.body.innerHTML = originalContent;
            location.reload(); // لإعادة تحميل الصفحة بعد الطباعة
        });
    </script>

@endsection
