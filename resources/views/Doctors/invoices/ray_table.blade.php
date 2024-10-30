
        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-12 overflow-x-auto lg:overflow-visible">
            <table class="table table-report -mt-2 min-w-full">
                <thead>
                    <tr style="background-color: rgba(0, 123, 255, 0.2); color: rgba(0, 123, 255, 1);">
                        <th class="whitespace-nowrap">Id</th>
                        <th class="whitespace-nowrap">اسم الخدمه</th>
                        <th >اسم الدكتور</th>
                        <th>اسم موظف الاشعة</th>
                        <th>حالة الكشف</th>
                                <th class="text-center whitespace-nowrap">العمليات</th>
                        
                        
                    </tr>
                   
                </thead>
                <tbody>
                    @foreach($patient_rays as $patient_ray)
                        <tr class="intro-x">
                            <td>{{$loop->iteration}}</td>
                            <td>{{$patient_ray->description}}</td>
                            <td>{{$patient_ray->doctor->name}}</td>
                            <td>{{$patient_ray->employee->name}}</td>


                            @if($patient_ray->case == 0)
                                <td class="text-danger">غير مكتملة</td>
                            @else
                                <td class="text-success"> مكتملة</td>
                            @endif

                            <td class="table-report__action w-56">
                                @if($patient_ray->doctor_id == auth()->user()->id)
                                    @if($patient_ray->case == 0)
                                        <div class="flex justify-center items-center">
                                            <a class="flex items-center mr-3" data-effect="effect-scale" data-tw-toggle="modal" data-tw-target="#edit_xray_conversion{{$patient_ray->id}}" href="javascript:void(0);">
                                                <i data-lucide="check-square" class="w-4 h-4 mr-1"></i> {{ __('sections.Edit') }}
                                            </a>
                                            
                                            <a class="flex items-center text-danger" href="javascript:;" onclick="deleteEmployee('{{ route('rays.destroy', $patient_ray->id) }}')">
                                                <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i> {{ __('sections.Delete') }}
                                            </a>
                                        </div>
                                    @endif
                                @endif
                            </td>
                        </tr>
                        @include('Doctors.invoices.edit_xray_conversion')

                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- END: Data List -->


    <script>


function toggleDropdown2(id) {
    const modal = document.getElementById(`edit_xray_conversion${id}`);
    if (modal) {
        modal.style.display = 'flex';
        modal.classList.add('show');
    }
}

        function changeLanguage(lang) {
            window.location.href = "{{ url('/') }}/" + lang;
        }

   
        function deleteEmployee(actionUrl) {
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
            fetch(actionUrl, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json()) 
            .then(data => {
                if (data.success) {
                    Swal.fire('Deleted!', data.success, 'success').then(() => {
                        window.location.href = "{{ route('rays.index') }}"; 
                    });
                } else if (data.error) {
                    Swal.fire('Failed', data.error, 'error'); 
                } else {
                    Swal.fire('Failed', 'Something went wrong!', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire('Failed', 'An error occurred while deleting!', 'error');
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

