<!-- BEGIN: Modal Content -->
<div data-tw-backdrop="" aria-hidden="true" tabindex="-1" id="datepicker-modal-preview{{ $invoice->id }}" class="modal bg-black/60 w-screen h-screen fixed inset-0 flex items-center justify-center" style="display: none;">
    <div data-tw-merge class="relative bg-white rounded-md shadow-md dark:bg-darkmode-600 transition-transform duration-300" style="width: 1000px; max-width: 90%; mx-4 my-8;"> <!-- عرض ثابت 800px -->
        <!-- BEGIN: Modal Header -->
        <div class="flex items-center px-5 py-3 border-b border-slate-200/60 dark:border-darkmode-400">
            <h2 class="mr-auto text-base font-medium">تشخيص حالة مريض</h2>
            <button type="button" class="close" data-tw-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <!-- END: Modal Header -->

        <form action="{{route('invoices_ray_employee.update',$invoice->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
        <div class="p-5">
            <div class="form-group mb-4">
                <label for="diagnosis" class="inline-block mb-2 ml-2">التشخيص</label>
                <textarea id="exampleFormControlTextarea1" name="description_employee" class="form-control w-full h-24 border rounded-md shadow-sm focus:ring-4 focus:ring-primary dark:bg-darkmode-800 dark:border-darkmode-400 " required></textarea>
            </div>
            <div class="mt-3">
                <label for="profile_image" class="form-label ml-2" >المرفقات</label>
                <input   class="form-control @error('profile_image') is-invalid @enderror"  type="file" name="photos[]" accept="image/*" multiple >
                @error('profile_image')
                    <span class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
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
