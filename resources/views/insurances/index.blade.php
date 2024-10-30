@extends('layout/side-menu')

@section('subhead')
    <title>{{ __('Insurances.insurance_list') }}</title>
@endsection

@section('subcontent')
<meta name="csrf-token" content="{{ csrf_token() }}">

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <h2 class="intro-y text-lg font-medium mt-10">{{ __('Insurances.insurance_list') }}</h2>
    
    <div class="main-content" style="overflow-x: auto; min-height: 100vh;">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
            <a href="{{ route('insurances.create') }}">
                <button class="btn btn-primary shadow-md mr-2">{{ __('Insurances.create_new_insurance') }}</button>
            </a>
        </div>

        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-12 overflow-x-auto lg:overflow-visible">
            <table class="table table-report -mt-2 min-w-full">
                <thead>
                    <tr>
                        <th class="whitespace-nowrap">ID</th>
                        <th class="whitespace-nowrap">{{ __('Insurances.insurance_code') }}</th>
                        <th class="whitespace-nowrap">{{ __('Insurances.discount_percentage') }}</th>
                        <th class="whitespace-nowrap">{{ __('Insurances.company_rate') }}</th>
                        <th class="whitespace-nowrap">{{ __('Insurances.status') }}</th>
                        <th class="text-center whitespace-nowrap">{{ __('Insurances.EditSTATUS') }}</th>
                        <th></th>
                        <th class="text-center whitespace-nowrap">{{ __('sections.ACTIONS') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($insurances as $insurance)
                        <tr class="intro-x">
                            <td class="w-40">{{ $insurance->id }}</td>
                            <td>{{ $insurance->insurance_code }}</td>
                            <td>{{ $insurance->discount_percentage }}%</td>
                            <td>{{ $insurance->Company_rate }}%</td>
                            <td class="w-40">
                                <div class="flex items-center justify-center {{ $insurance->status ? 'text-success' : 'text-danger' }}">
                                    <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> {{ $insurance->status ? 'Active' : 'Inactive' }}
                                </div>
                            </td>
                            <td class="w-40">
                                <form action="{{ route('InsuranceStatus', $insurance->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <select name="status" class="form-control auto-width-select">
                                        <option value="1" {{ $insurance->status == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ $insurance->status == 0 ? 'selected' : '' }}>Inactive</option>
                                    </select>
                            </td>
                            <td>
                                <button type="submit" class="btn btn-primary mt-1">Update</button>
                                </form>
                            </td>
                            <td class="table-report__action w-56">
                                <div class="flex justify-center items-center">
                                    <a class="flex items-center mr-3" href="{{ route('insurances.edit', $insurance->id) }}">
                                        <i data-lucide="check-square" class="w-4 h-4 mr-1"></i> {{ __('insurances.Edit') }}
                                    </a>
                                    <a class="flex items-center text-danger" href="javascript:;" onclick="deleteInsurance('{{ route('insurances.destroy', $insurance->id) }}')">
                                        <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i> {{ __('insurances.Delete') }}
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
  function changeLanguage(lang) {
            window.location.href = "{{ url('/') }}/" + lang;
        }

      function deleteInsurance(actionUrl) {
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
                    'Content-Type': 'application/json', // تغيير إلى application/json
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => {
                return response.json().then(data => {
                    if (response.ok) {
                        Swal.fire('Deleted!', data.success, 'success').then(() => {
                            window.location.href = "{{ route('insurances.index') }}"; // توجيه بعد الحذف
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



    </script>
@endsection
