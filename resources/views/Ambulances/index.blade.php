@extends('layout/side-menu')

@section('subhead')
    <title>{{ __('Ambulances.Ambulance_list') }}</title>
@endsection

@section('subcontent')
<meta name="csrf-token" content="{{ csrf_token() }}">

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

<h2 class="intro-y text-lg font-medium mt-10">{{ __('Ambulances.Ambulance_list') }}</h2>

<div class="main-content" style="overflow-x: auto; min-height: 100vh;">
    <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
        <a href="{{ route('Ambulances.create') }}">
            <button class="btn btn-primary shadow-md mr-2">{{ __('Ambulances.create_new_Ambulance') }}</button>
        </a>
    </div>

    <!-- BEGIN: Data List -->
    <div class="intro-y col-span-12 overflow-x-auto lg:overflow-visible">
        <table class="table table-report -mt-2 min-w-full">
            <thead>
                <tr>
                    <th class="whitespace-nowrap">Id</th>
                    <th class="whitespace-nowrap">{{ __('Ambulances.Car Number') }}</th>
                    <th class="whitespace-nowrap">{{ __('Ambulances.Car Model') }}</th>
                    <th class="whitespace-nowrap">{{ __('Ambulances.Car Year Made') }}</th>
                    <th class="whitespace-nowrap">{{ __('Ambulances.Car Type') }}</th>
                    <th class="text-center whitespace-nowrap">{{ __('Ambulances.Driver Name') }}</th>
                    <th class="text-center whitespace-nowrap">{{ __('Ambulances.Driver Phone') }}</th>
                    <th class="whitespace-nowrap">{{ __('Insurances.status') }}</th>
                    <th class="text-center whitespace-nowrap">{{ __('Insurances.EditSTATUS') }}</th>
                    <th></th>
                    <th class="text-center whitespace-nowrap">{{ __('Ambulances.ACTIONS') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ambulances as $ambulance)
                    <tr class="intro-x">
                        <td class="w-40">{{ $ambulance->id }}</td>
                        <td>{{ $ambulance->car_number }}</td>
                        <td>{{ $ambulance->car_model }}</td>
                        <td>{{ $ambulance->car_year_made }}</td>
                        <td>{{ $ambulance->car_type == 1 ? 'ملك' : 'إيجار' }}</td> <!-- Assuming 1 = ملك, 0 = إيجار -->
                        <td class="text-center">{{ $ambulance->driver_name }}</td>
                        <td class="text-center">{{ $ambulance->driver_phone }}</td>
                        <td class="w-40">
                            <div class="flex items-center justify-center {{ $ambulance->is_available ? 'text-success' : 'text-danger' }}">
                                <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> {{ $ambulance->is_available ? 'Available' : 'Not Available' }}
                            </div>
                        </td>
                        <td class="w-40">
                            <form action="{{ route('AmbulanceStatus', $ambulance->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <select name="status" class="form-control auto-width-select">
                                    <option value="1" {{ $ambulance->is_available == 1 ? 'selected' : '' }}>Available</option>
                                    <option value="0" {{ $ambulance->is_available == 0 ? 'selected' : '' }}>Not Available</option>
                                </select>
                        </td>
                        <td>
                            <button type="submit" class="btn btn-primary mt-1">Update</button>
                            </form>
                        </td>
                        <td class="table-report__action w-56">
                            <div class="flex justify-center items-center">
                                <!-- Edit Button -->
                                <a class="flex items-center mr-3" href="{{ route('Ambulances.edit', $ambulance->id) }}">
                                    <i data-lucide="check-square" class="w-4 h-4 mr-1"></i> Edit
                                </a>
                                <!-- Delete Button -->
                                <a class="flex items-center text-danger" href="javascript:;" onclick="deleteAmbulance('{{ route('Ambulances.destroy', $ambulance->id) }}')">
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
    function deleteAmbulance(actionUrl) {
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
                        Swal.fire('Error!', data.error || 'There was an error deleting the ambulance.', 'error');
                    }
                })
                .catch(error => {
                    Swal.fire('Error!', 'There was an error deleting the ambulance.', 'error');
                });
            }
        });
    }
</script>

@endsection
