@extends('layout.side-menu')

@section('subhead')
    <title>{{ __('employees.Employee List') }}</title>
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

    <h2 class="intro-y text-lg font-medium mt-10">{{ __('employees.Employee List') }}</h2>
    
    <div class="main-content" style="overflow-x: auto; min-height: 100vh;">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
            <a href="{{ route('ray_employee.create') }}">
                <button class="btn btn-primary shadow-md mr-2">{{ __('employees.Create New Employee') }}</button>
            </a>
        </div>

        <div class="intro-y col-span-12 overflow-x-auto lg:overflow-visible">
            <table class="table table-report -mt-2 min-w-full">
                <thead>
                    <tr>
                        <th class="whitespace-nowrap">ID</th>
                        <th class="text-center whitespace-nowrap">{{ __('employees.Photo') }}</th> 
                        <th class="whitespace-nowrap">{{ __('employees.Name') }}</th>
                        <th class="text-center whitespace-nowrap">{{ __('employees.Email') }}</th>
                        <th class="text-center whitespace-nowrap">{{ __('employees.Phone') }}</th>
                        <th class="text-center whitespace-nowrap">{{ __('employees.Status') }}</th>
                        <th class="text-center whitespace-nowrap">Edit STATUS</th>
                        <th class="text-center whitespace-nowrap">{{ __('employees.Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ray_employees as $employee)
                        <tr class="intro-x">
                            <td class="w-40">{{ $employee->id }}</td>
                            <td class="w-40">
                                <div class="flex">
                                    <div class="w-10 h-10 image-fit zoom-in">
                                        @php
                                            $employeeImage = $employee->image;
                                            $imagePath = $employeeImage ? asset('storage/properties/Ray_employee/' . $employeeImage->filename) : asset('default-image.jpg');
                                        @endphp
                                        <img alt="Employee Image" class="tooltip rounded-full" src="{{ $imagePath }}" title="Employee Image" />
                                    </div>
                                </div>
                            </td>
                            <td><a href="" class="font-medium whitespace-nowrap">{{ $employee->name }}</a></td>
                            <td class="text-center">{{ $employee->email }}</td>
                            <td class="text-center">{{ $employee->phone }}</td>
                            <td class="w-40">
                                <div class="flex items-center justify-center {{ $employee->active ? 'text-success' : 'text-danger' }}">
                                    <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> {{ $employee->active ? 'Active' : 'Inactive' }}
                                </div>
                            </td>
                            <td class="w-40">
                                <form action="{{ route('EmployeeUpdateStatus', $employee->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <select name="active" class="form-control auto-width-select">
                                        <option value="1" {{ $employee->active == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ $employee->active == 0 ? 'selected' : '' }}>Inactive</option>
                                    </select>
                            </td>
                            <td>
                                <button type="submit" class="btn btn-primary mt-1">Update</button>
                                </form>
                            </td>
                            <td class="table-report__action w-56">
                                <div class="flex justify-center items-center">
                                    <a class="flex items-center mr-3" href="{{ route('ray_employee.edit', $employee->id) }}">
                                        <i data-lucide="check-square" class="w-4 h-4 mr-1"></i> {{ __('employees.Edit') }}
                                    </a>
                                    <a class="flex items-center text-danger" href="javascript:;" onclick="deleteEmployee('{{ route('ray_employee.destroy', $employee->id) }}')">
                                        <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i> {{ __('employees.Delete') }}
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        

    </div>
    
    <script>
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
                                window.location.href = "{{ route('ray_employee.index') }}";
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
    </script>
@endsection
