
        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-12 overflow-x-auto lg:overflow-visible">
            <table class="table table-report -mt-2 min-w-full">
                <thead>
                    <tr style="background-color: rgba(0, 123, 255, 0.2); color: rgba(0, 123, 255, 1);">
                        <th class="whitespace-nowrap">Id</th>
                        <th class="whitespace-nowrap">اسم الخدمه</th>
                        <th >اسم الدكتور</th>

                                <th class="text-center whitespace-nowrap">العمليات</th>
                        
                        
                    </tr>
                   
                </thead>
                <tbody>
                    @foreach($patient_rays as $patient_ray)
                        <tr class="intro-x">
                            <td>{{$loop->iteration}}</td>
                            <td>{{$patient_ray->description}}</td>
                            <td>{{$patient_ray->doctor->name}}</td>
                            <td class="table-report__action w-56">
                                @if($patient_ray->doctor_id == auth()->user()->id)

                                <div class="flex justify-center items-center">
                                    <a class="flex items-center mr-3" href="">
                                        <i data-lucide="check-square" class="w-4 h-4 mr-1"></i> {{ __('sections.Edit') }}
                                    </a>
                                    <a class="flex items-center text-danger" href="javascript:;" onclick="deleteSection('')">
                                        <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i> {{ __('sections.Delete') }}
                                    </a>
                                </div>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- END: Data List -->
    

    <script>
        function changeLanguage(lang) {
            window.location.href = "{{ url('/') }}/" + lang;
        }

      function deleteSection(actionUrl) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            // Send delete request via AJAX
            fetch(actionUrl, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json', 
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => {
                return response.json().then(data => {
                    if (response.ok) {
                        Swal.fire('Deleted!', data.success, 'success').then(() => {
                            window.location.href = "{{ route('Section.index') }}"; // توجيه بعد الحذف
                        });
                    } else {
                        Swal.fire('Error!', data.error || 'There was an error deleting the section.', 'error');
                    }
                });
            })
            .catch(error => {
                Swal.fire('Error!', 'There was an error deleting the section.', 'error');
            });
        }
    });
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

