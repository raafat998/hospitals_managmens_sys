
<div class="w-full py-10">

   
      
    <div class="timeline">
        @foreach($patient_records as $index => $patient_record)
            <div class="timeline-item" id="item-{{ $index }}">
                <div class="transition duration-200 inline-flex items-center justify-center h-10 w-10 rounded-full bg-primary text-white">
                    {{ $index + 1 }}
                </div>
                <div class="timeline-content">
                    <h6 class="text-lg font-semibold text-gray-800">تحديث حالة المريض - {{ $patient_record->Doctor->name }}</h6>
                    <hr  style="border: 1px solid grey;">
                    <p class="bg-green-100 text-gray-800 mt-2 rounded-lg p-3">تشخيص: {{ $patient_record->diagnosis }}</p>
                    <div class="flex items-center mt-4 text-gray-500">
                        <i class="fas fa-user-md text-xl"></i>
                        <span class="ml-2 font-medium">{{ $patient_record->Doctor->name }}</span>
                        <span class="ml-auto flex items-center">
                            <i class="fe fe-calendar mr-1"></i>
                            <span class="font-medium">{{ $patient_record->date }}</span>
                        </span>
                    </div>
                </div>
            </div>
           
        @endforeach
    </div>
</div>

<script>
    // إضافة تأثير الحركة عند تحميل الصفحة
    document.addEventListener('DOMContentLoaded', function () {
        const timelineItems = document.querySelectorAll('.timeline-item');
        timelineItems.forEach((item, index) => {
            setTimeout(() => {
                item.classList.add('show'); // إضافة الكلاس لإظهار العنصر
            }, index * 100); // تأخير زمني لكل عنصر
        });
    });
</script>

