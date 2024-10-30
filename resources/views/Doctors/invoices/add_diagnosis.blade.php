<!-- BEGIN: Modal Content -->
<div data-tw-backdrop="" aria-hidden="true" tabindex="-1" id="datepicker-modal-preview{{ $invoice->id }}" class="modal bg-black/60 w-screen h-screen fixed inset-0 flex items-center justify-center" style="display: none;">
    <div data-tw-merge class="relative bg-white rounded-md shadow-md dark:bg-darkmode-600 transition-transform duration-300" style="width: 800px; max-width: 90%; mx-4 my-8;"> <!-- عرض ثابت 800px -->
        <!-- BEGIN: Modal Header -->
        <div class="flex items-center px-5 py-3 border-b border-slate-200/60 dark:border-darkmode-400">
            <h2 class="mr-auto text-base font-medium">تشخيص حالة مريض</h2>
            <button type="button" class="close" data-tw-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <!-- END: Modal Header -->

        <form action="{{ route('Diagnostics.store') }}" method="POST">
            @csrf
            <!-- BEGIN: Modal Body -->
            <div class="p-5">
                <div class="form-group mb-4">
                    <label for="doctor_id" class="inline-block mb-2">اسم المريض</label>
                    <input type="text" id="doctor_id" name="doctor_id" value="{{ $invoice->Patient->name }}" readonly class="form-control w-full border rounded-md shadow-sm bg-gray-100 dark:bg-darkmode-800 dark:border-darkmode-400 cursor-not-allowed">
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
            </div>
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
