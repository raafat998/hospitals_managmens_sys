<!-- BEGIN: Modal Content -->
<div data-tw-backdrop="" aria-hidden="true" tabindex="-1" id="add_review{{ $invoice->id }}" class="modal bg-black/60 w-screen h-screen fixed inset-0 flex items-center justify-center" style="display: none;">
    <div data-tw-merge class="relative bg-white rounded-md shadow-md dark:bg-darkmode-600 transition-transform duration-300" style="width: 800px; max-width: 90%; mx-4 my-8;"> <!-- عرض ثابت 800px -->
        <!-- BEGIN: Modal Header -->
        <div class="flex items-center px-5 py-3 border-b border-slate-200/60 dark:border-darkmode-400">
            <h2 class="mr-auto text-base font-medium"> تديد موعد مراجعة </h2>
            <button type="button" class="close" data-tw-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <!-- END: Modal Header -->

        <form action="{{ route('add_review') }}" method="POST">
            @csrf
            <!-- BEGIN: Modal Body -->
            <div class="p-5">
                <div class="form-group mb-4">
                    <label for="doctor_id" class="inline-block mb-2">اسم المريض</label>
                    <input type="text" id="doctor_id" name="doctor_id" value="{{ $invoice->Patient->name }}" readonly class="form-control w-full border rounded-md shadow-sm bg-gray-100 dark:bg-darkmode-800 dark:border-darkmode-400 cursor-not-allowed">
                </div>

                <div class="form-group mb-4">
                    <label for="medicine" class="inline-block mb-2">الادوية</label>
                    <input data-tw-merge type="text" id="review_date" name="review_date" data-single-mode="true" class="disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent [&[readonly]]:bg-slate-100 [&[readonly]]:cursor-not-allowed [&[readonly]]:dark:bg-darkmode-800/50 [&[readonly]]:dark:border-transparent transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 group-[.form-inline]:flex-1 group-[.input-group]:rounded-none group-[.input-group]:[&:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l group-[.input-group]:last:rounded-r group-[.input-group]:z-10 datepicker datepicker" /> 
                </div>
      

                <input type="hidden" name="invoice_id" value="{{ $invoice->id }}">
                <input type="hidden" name="patient_id" value="{{ $invoice->patient_id }}">
                <input type="hidden" name="doctor_id" value="{{ $invoice->doctor_id }}">
                <div class="form-group mb-4">
                    <label for="diagnosis" class="inline-block mb-2">التشخيص</label>
                    <textarea id="diagnosis" name="diagnosis" class="form-control w-full h-24 border rounded-md shadow-sm focus:ring-4 focus:ring-primary dark:bg-darkmode-800 dark:border-darkmode-400" required></textarea>
                </div>

                <div class="form-group mb-4">
                    <label for="medicine" class="inline-block mb-2">الادوية</label>
                    <textarea id="medicine" name="medicine" class="form-control w-full h-24 border rounded-md shadow-sm focus:ring-4 focus:ring-primary dark:bg-darkmode-800 dark:border-darkmode-400" required></textarea>
                </div>

                {{-- <div class="form-group" style="position:relative;">
                    <label>تاريخ المراجعة</label>
                    <input class="form-control fc-datepicker" id="review_date" name="review_date" type="text" required>
                </div> --}}

            <!-- END: Modal Body -->

            <!-- BEGIN: Modal Footer -->
            <div class="px-5 py-3 border-t border-slate-200/60 dark:border-darkmode-400 text-right">
                <button type="button" class="btn btn-secondary mr-1" data-tw-dismiss="modal">اغلاق</button>
                <button type="submit" class="btn btn-primary">حفظ البيانات</button>
            </div>
            <!-- END: Modal Footer -->
        </form>
    </div>
</div>
<!-- END: Modal Content -->

<script>
// فتح الـ modal
document.querySelectorAll('[data-tw-toggle="modal"]').forEach(function(element) {
    element.addEventListener('click', function(event) {
        event.preventDefault(); // منع السلوك الافتراضي للرابط
        var targetModalId = this.getAttribute('data-tw-target'); // جلب الـ id من data-tw-target
        var modal = document.querySelector(targetModalId); // استخدام الـ id لجلب الـ modal الصحيح
        modal.style.display = 'flex'; // جعل المودال مرئي
        modal.classList.add('show'); // إضافة الكلاس show لتفعيل العرض
    });
});

// إغلاق الـ modal
document.querySelectorAll('[data-tw-dismiss="modal"]').forEach(function(element) {
    element.addEventListener('click', function() {
        var modal = this.closest('.modal'); // جلب أقرب عنصر modal
        modal.style.display = 'none'; // إخفاء المودال
        modal.classList.remove('show'); // إزالة الكلاس show
    });
});

// إغلاق المودال عند النقر خارجها
window.addEventListener('click', function(event) {
    var modals = document.querySelectorAll('.modal'); // جلب كل العناصر التي تحتوي على الكلاس modal
    modals.forEach(function(modal) {
        if (event.target === modal) {
            modal.style.display = 'none'; // إخفاء المودال
            modal.classList.remove('show'); // إزالة الكلاس show
        }
    });
});
</script>
