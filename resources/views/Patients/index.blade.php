@extends('layout/side-menu')

@section('subhead')
    <title>{{ __('Patientes.Patiente_list') }}</title>
@endsection

@section('subcontent')
<meta name="csrf-token" content="{{ csrf_token() }}">

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

<h2 class="intro-y text-lg font-medium mt-10">{{ __('Patientes.Patiente_list') }}</h2>

<div class="main-content" style="overflow-x: auto; min-height: 100vh;">
    <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
        <a href="{{ route('Patients.create') }}">
            <button class="btn btn-primary shadow-md mr-2">{{ __('Patients.create_new_Patiente') }}</button>
        </a>
    </div>

    <!-- BEGIN: Data List -->
    <div class="intro-y col-span-12 overflow-x-auto lg:overflow-visible">
        <table class="table table-report -mt-2 min-w-full">
            <thead>
                <tr>
                    <th class="whitespace-nowrap">Id</th>
                    <th class="text-center whitespace-nowrap">{{ __('Patients.image') }}</th> 
                    <th class="whitespace-nowrap">{{ __('Patients.Name') }}</th>
                    <th class="whitespace-nowrap">{{ __('Patients.Email') }}</th>
                    <th class="whitespace-nowrap">{{ __('Patients.Date of Birth') }}</th>
                    <th class="whitespace-nowrap">{{ __('Patients.Phone') }}</th>
                    <th class="whitespace-nowrap">{{ __('Patients.Gender') }}</th>
                    <th class="whitespace-nowrap">{{ __('Patients.Blood Group') }}</th>
                  
                    <th class="text-center whitespace-nowrap">{{ __('Patients.Actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($Patients as $Patient)
                    <tr class="intro-x">
                        <td class="w-40">{{ $Patient->id }}</td>
                        <td class="w-40"> <!-- عمود الصورة -->
                            <div class="flex">
                                <div class="w-10 h-10 image-fit zoom-in">
                                    @php
                                        // جلب الصورة للطبيب
                                        $PatientImage = $Patient->image; 
                                        
                                        // الحصول على المسار الكامل
                                        $imagePath = $PatientImage ? asset('storage/properties/Patient/' . $PatientImage->filename) : asset('default-image.jpg');
                                    @endphp
                                    <img alt="Patient Image" class="tooltip rounded-full" src="{{ $imagePath }}" title="مسار الصورة" />
                                </div>
                            </div>
                        </td>
                        <td>{{ $Patient->name }}</td>
                        <td>{{ $Patient->email }}</td>
                        <td>{{ $Patient->Date_Birth }}</td>
                        <td>{{ $Patient->Phone }}</td>
                        <td>{{ $Patient->Gender == 'M' ? 'Male' : 'Female' }}</td>
                        <td>{{ $Patient->Blood_Group }}</td>
                      
                        <td class="table-report__action w-56">
                            <div class="flex justify-center items-center">
                                <a class="flex items-center mr-3" href="{{ route('Patients.show',$Patient->id) }}">
                                    <i data-lucide="Eye" class="w-4 h-4 mr-1"></i> {{ __('Patients.show') }}
                                </a>
                                <!-- Edit Button -->
                                <a class="flex items-center mr-3" href="{{ route('Patients.edit', $Patient->id) }}">
                                    <i data-lucide="check-square" class="w-4 h-4 mr-1"></i> Edit
                                </a>
                                <!-- Delete Button -->
                                <a class="flex items-center text-danger" href="javascript:;" onclick="deletePatiente('{{ route('Patients.destroy', $Patient->id) }}')">
                                    <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i> Delete
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

<script>
    function deletePatiente(actionUrl) {
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
                            window.location.reload();
                        });
                    } else {
                        Swal.fire('Error!', data.error || 'There was an error deleting the Patiente.', 'error');
                    }
                })
                .catch(error => {
                    Swal.fire('Error!', 'There was an error deleting the Patiente.', 'error');
                });
            }
        });
    }
</script>

@endsection
