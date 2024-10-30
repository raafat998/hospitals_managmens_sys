@extends('layout/side-menu')

@section('subhead')
    <title>{{ __('sections.Section List') }}</title>
    <style>
        .auto-width-select {
            width: auto; 
            min-width: 120px; 
            padding: 5px; 
            display: inline-block; 
        }
    </style>
@endsection

@section('subcontent')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <h2 class="intro-y text-lg font-medium mt-10">{{ __('Doctors.doctor_list') }}</h2>
    
    <div class="main-content" style="overflow-x: auto; min-height: 100vh;">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
            <a href="{{ route('Doctors.create') }}">
                <button class="btn btn-primary shadow-md mr-2">{{ __('Doctors.create_new_doctor') }}</button>
            </a>
        </div>

        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-12 overflow-x-auto lg:overflow-visible">
            <table class="table table-report -mt-2 min-w-full">
                <thead>
                    <tr>
                        <th class="whitespace-nowrap">Id</th>
                        <th class="text-center whitespace-nowrap">{{ __('Doctors.image') }}</th> 
                        <th class="whitespace-nowrap">{{ __('Doctors.name') }}</th>
                        <th class="text-center whitespace-nowrap">{{ __('Doctors.email') }}</th>
                        <th class="text-center whitespace-nowrap">{{ __('Doctors.phone') }}</th>
                        <th class="text-center whitespace-nowrap">{{ __('Doctors.status') }}</th>
                        <th class="text-center whitespace-nowrap">Edit STATUS</th>
                        <th></th>
                        <th class="text-center whitespace-nowrap">{{ __('Doctors.appointments') }}</th>
                        <th class="text-center whitespace-nowrap">{{ __('sections.ACTIONS') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($doctors as $doctor)
                        <tr class="intro-x">
                            <td class="w-40">{{ $doctor->id }}</td>
                            <td class="w-40"> <!-- عمود الصورة -->
                                <div class="flex">
                                    <div class="w-10 h-10 image-fit zoom-in">
                                        @php
                                            // جلب الصورة للطبيب
                                            $doctorImage = $doctor->image; 
                                            
                                            // الحصول على المسار الكامل
                                            $imagePath = $doctorImage ? asset('storage/properties/doctors/' . $doctorImage->filename) : asset('default-image.jpg');
                                        @endphp
                                    
                                        <img alt="Doctor Image" class="tooltip rounded-full" src="{{ $imagePath }}" title="مسار الصورة" />
                                    </div>
                                    
                                    
                                    
                                    
                                    
                                </div>
                            </td>
                            
                            
                            
                            <td><a href="" class="font-medium whitespace-nowrap">{{ $doctor->name }}</a></td>
                            <td class="text-center">{{ $doctor->email }}</td>
                            <td class="text-center">{{ $doctor->phone }}</td>
                            {{-- <td class="text-center">{{ $doctor->active == 1 ? 'نشط' : 'غير نشط' }}</td> --}}
                            <td class="w-40">
                                <div class="flex items-center justify-center {{ $doctor->active ? 'text-success' : 'text-danger' }}">
                                    <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> {{ $doctor->active ? 'Active' : 'Inactive' }}
                                </div>
                            </td>
                            <td class="w-40">
                                <form action="{{ route('DoctorupdateStatus', $doctor->id) }}" method="POST"> 
                                    @csrf
                                    @method('PUT')
                                    <select name="active" class="form-control auto-width-select">
                                        <option value="1" {{ $doctor->active == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ $doctor->active == 0 ? 'selected' : '' }}>Inactive</option>
                                    </select>
                            </td>
                            <td>
                                <button type="submit" class="btn btn-primary mt-1">Update</button>
                                </form>
                            </td>
                            <td class="text-center">
                               @forEach($doctor->doctorappointments as $appointment)
                               {{ $appointment->name}}
                               @endforeach
                            </td>
                            <td></td>
                            <td  class="table-report__action w-56">
                                <div class="flex justify-center items-center">
                                    <a class="flex items-center mr-3" href="{{ route('Doctors.edit', $doctor->id) }}">
                                        <i data-lucide="check-square" class="w-4 h-4 mr-1"></i> {{ __('sections.Edit') }}
                                    </a>
                                    <a class="flex items-center text-danger" href="javascript:;" onclick="deleteSection('{{ route('Doctors.destroy', $doctor->id) }}')">
                                        <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i> {{ __('sections.Delete') }}
                                    </a>
                                    
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- END: Data List -->
    </div>
 <!-- Pagination Links -->
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center mt-4">
            <nav class="w-full sm:w-auto sm:mr-auto">
                {{ $doctors->onEachSide(1)->links('pagination::default') }}
            </nav>
        </div>
    </div>
    
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
            fetch(actionUrl, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json()) // تحليل الاستجابة كـ JSON
            .then(data => {
                if (data.success) {
                    Swal.fire('Deleted!', data.success, 'success').then(() => {
                        window.location.href = "{{ route('Doctors.index') }}"; // إعادة التوجيه بعد الحذف
                    });
                } else {
                    Swal.fire('Failed', data.message || 'Something went wrong!', 'error');
                }
            })
            .catch(error => {
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
@endsection
