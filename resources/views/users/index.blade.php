@extends('layout/side-menu')

@section('subhead')
    <title>User List - Your App</title>
    <style>
        .auto-width-select {
            width: auto; 
            min-width: 120px; 
            padding: 5px; 
            display: inline-block; 
        }
    </style>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
@endsection

@section('subcontent')


    <h2 class="intro-y text-lg font-medium mt-10">User List</h2>
    <div class="main-content" style="overflow-x: auto; min-height: 100vh;">

        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
            <a href="{{ route('users.create') }}">
                <button class="btn btn-primary shadow-md mr-2">Create New User</button>
            </a>

            <div class="dropdown">
                <button class="dropdown-toggle btn px-2 box" aria-expanded="false" data-tw-toggle="dropdown">
                    <span class="w-5 h-5 flex items-center justify-center">
                        <i class="w-4 h-4" data-lucide="plus"></i>
                    </span>
                </button>
                <div class="dropdown-menu w-40">
                    <ul class="dropdown-content">
                        <li><a href="" class="dropdown-item"><i data-lucide="printer" class="w-4 h-4 mr-2"></i> Print</a></li>
                        <li><a href="" class="dropdown-item"><i data-lucide="file-text" class="w-4 h-4 mr-2"></i> Export to Excel</a></li>
                        <li><a href="" class="dropdown-item"><i data-lucide="file-text" class="w-4 h-4 mr-2"></i> Export to PDF</a></li>
                    </ul>
                </div>
            </div>
            <div class="hidden md:block mx-auto text-slate-500">Showing {{ $users->count() }} of {{ $totalUsers }} entries</div>
            <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                <div class="w-56 relative text-slate-500">
                    <input type="text" id="searchInput" class="form-control w-56 box pr-10" placeholder="Search...">
                    <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-lucide="search"></i>
                </div>
            </div>
        </div>

        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-12 overflow-x-auto lg:overflow-visible">
            <table class="table table-report -mt-2 min-w-full">
                <thead>
                    <tr>
                        <th class="whitespace-nowrap">IMAGE</th>
                        <th class="whitespace-nowrap">USER NAME</th>
                        <th class="text-center whitespace-nowrap">PHONE</th>
                        <th class="text-center whitespace-nowrap">EMAIL</th>
                        <th class="text-center whitespace-nowrap">ROLE</th>
                        <th class="text-center whitespace-nowrap">STATUS</th>
                        <th class="text-center whitespace-nowrap">Edit STATUS</th>
                        <th></th>
                        <th class="text-center whitespace-nowrap">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="intro-x">
                            <td class="w-40">
                                <div class="flex">
                                    <div class="w-10 h-10 image-fit zoom-in">

                                        @if ($user->role_id == 1)
                                        <img alt="User Image" class="tooltip rounded-full" src="{{ $user->profile_image ? asset($user->profile_image) : asset('default-image.jpg') }}" title="User Image">
                                    @elseif($user->role_id == 2)
                                    <img alt="User Image" class="tooltip rounded-full" 
                                    src="{{ $user->doctor && $user->doctor->image ? asset('storage/properties/doctors/' . $user->doctor->image->filename) : asset('default-image.jpg') }}" 
                                    title="User Image">
                                    @elseif($user->role_id == 3)
                                    <img alt="User Image" class="tooltip rounded-full" 
                                    src="{{ $user->patient && $user->patient->image ? asset('storage/properties/Patient/' . $user->patient->image->filename) : asset('default-image.jpg') }}" 
                                    title="User Image">
                                    @endif
                                    </div>
                                </div>
                            </td>
                            <td><a href="" class="font-medium whitespace-nowrap">{{ $user->name }}</a></td>
                            <td class="text-center">{{ $user->phone }}</td>
                            <td class="text-center">{{ $user->email }}</td>
                            <td class="text-center">
                                @if ($user->role->id == 1) Admin
                                @elseif ($user->role->id == 2) User
                                @elseif ($user->role->id == 3) Doctor
                                @else Unknown
                                @endif
                            </td>
                            <td class="w-40">
                                <div class="flex items-center justify-center {{ $user->active ? 'text-success' : 'text-danger' }}">
                                    <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> {{ $user->active ? 'Active' : 'Inactive' }}
                                </div>
                            </td>
                            <td class="w-40">
                                <form action="{{ route('user.updateStatus', $user->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <select name="active" class="form-control auto-width-select">
                                        <option value="1" {{ $user->active == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ $user->active == 0 ? 'selected' : '' }}>Inactive</option>
                                    </select>
                            </td>
                            <td>
                                <button type="submit" class="btn btn-primary mt-1">Update</button>
                                </form>
                            </td>
                            <td class="table-report__action w-56">
                                <div class="flex justify-center items-center">
                                    <a class="flex items-center mr-3" href="{{ route('users.edit', $user->id) }}">
                                        <i data-lucide="check-square" class="w-4 h-4 mr-1"></i> Edit
                                    </a>
                                    <a class="flex items-center text-danger" href="javascript:;" onclick="deleteUser('{{ route('users.destroy', $user->id) }}')">
                                        <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i> Delete
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination Links -->
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center mt-4">
            <nav class="w-full sm:w-auto sm:mr-auto">
                {{ $users->onEachSide(1)->links('pagination::default') }}
            </nav>
            <select class="w-20 form-select box mt-3 sm:mt-0">
                <option>10</option>
                <option>25</option>
                <option>35</option>
                <option>50</option>
            </select>
        </div>
    </div>

    <script>
     function deleteUser(actionUrl) {
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
                                window.location.href = "{{ route('user-mangment') }}";
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
