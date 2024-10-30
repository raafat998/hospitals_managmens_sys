@extends('layout/side-menu')

@section('subhead')
    <title>{{ __('services.service List') }}</title>
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

    <h2 class="intro-y text-lg font-medium mt-10">{{ __('services.service List') }}</h2>
    
    <div class="main-content" style="overflow-x: auto; min-height: 100vh;">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
            <a href="{{ route('Service.create') }}">
                <button class="btn btn-primary shadow-md mr-2">{{ __('services.Create New service') }}</button>
            </a>
        </div>

        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-12 overflow-x-auto lg:overflow-visible">
            <table class="table table-report -mt-2 min-w-full">
                <thead>
                    <tr>
                        <th class="whitespace-nowrap">Id</th>
                        <th class="whitespace-nowrap">{{ __('services.service Name') }}</th>
                        <th class="whitespace-nowrap">{{ __('services.Price') }}</th>
                        <th class="whitespace-nowrap">{{ __('services.Description') }}</th>
                        <th class="text-center whitespace-nowrap">{{ __('services.Status') }}</th>
                        <th class="text-center whitespace-nowrap">{{ __('services.EditSTATUS') }}</th>
                        <th></th>
                        <th class="text-center whitespace-nowrap">{{ __('services.Date Added') }}</th>
                        <th class="text-center whitespace-nowrap">{{ __('services.ACTIONS') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($services as $service)
                        <tr class="intro-x">
                            <td class="w-40">{{ $service->id }}</td>
                            <td>{{ $service->name }}</td>
                            <td>{{ $service->price }}</td>
                            <td>{{ $service->description }}</td>
                            <td class="w-40">
                                <div class="flex items-center justify-center {{ $service->status ? 'text-success' : 'text-danger' }}">
                                    <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> {{ $service->status ? 'Active' : 'Inactive' }}
                                </div>
                            </td>
                            <td class="w-40">
                                <form action="{{ route('ServiceupdateStatus', $service->id) }}" method="POST"> 
                                    @csrf
                                    @method('PUT')
                                    <select name="status" class="form-control auto-width-select">
                                        <option value="1" {{ $service->status == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ $service->status == 0 ? 'selected' : '' }}>Inactive</option>
                                    </select>
                            </td>
                            <td>
                                <button type="submit" class="btn btn-primary mt-1">Update</button>
                                </form>
                            </td>                            <td class="text-center">
                                {{ app()->getLocale() == 'ar' ? $service->created_at->locale('ar')->diffForHumans() : $service->created_at->locale('en')->diffForHumans() }}
                            </td>
                            <td class="table-report__action w-56">
                                <div class="flex justify-center items-center">
                                    <a class="flex items-center mr-3" href="{{ route('Service.edit', $service->id) }}">
                                        <i data-lucide="check-square" class="w-4 h-4 mr-1"></i> Edit
                                    </a>
                                    <a class="flex items-center text-danger" href="javascript:;" onclick="deleteService('{{ route('Service.destroy', $service->id) }}')">
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
        function changeLanguage(lang) {
            window.location.href = "{{ url('/') }}/" + lang;
        }

        function deleteService(actionUrl) {
            console.log("Deleting service at URL:", actionUrl);
            
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
                            Swal.fire('Error!', 'There was an error deleting the service.', 'error');
                        }
                    })
                    .catch(error => {
                        Swal.fire('Error!', 'There was an error deleting the service.', 'error');
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
