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

    <h2 class="intro-y text-lg font-medium mt-10">{{ __('sections.Section List') }}</h2>
    
    <div class="main-content" style="overflow-x: auto; min-height: 100vh;">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
            <a href="{{ route('Section.create') }}">
                <button class="btn btn-primary shadow-md mr-2">{{ __('sections.Create New Section') }}</button>
            </a>

            <div class="ml-auto">
                <select id="language-switcher" class="auto-width-select" onchange="changeLanguage(this.value)">
                    <option value="en" {{ app()->getLocale() == 'en' ? 'selected' : '' }}>English</option>
                    <option value="ar" {{ app()->getLocale() == 'ar' ? 'selected' : '' }}>العربية</option>
                </select>
            </div>
        </div>

        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-12 overflow-x-auto lg:overflow-visible">
            <table class="table table-report -mt-2 min-w-full">
                <thead>
                    <tr>
                        <th class="whitespace-nowrap">Id</th>
                        <th class="whitespace-nowrap">{{ __('sections.Section Name') }}</th>
                        <th class="text-center whitespace-nowrap">{{ __('sections.Date Added') }}</th>
                        <th class="text-center whitespace-nowrap">{{ __('sections.ACTIONS') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sections as $section)
                        <tr class="intro-x">
                            <td class="w-40">{{ $section->id }}</td>
                            <td><a href="{{ route('Section.show',$section->id) }}" class="font-medium whitespace-nowrap">{{ $section->name }}</a></td>
                            <td class="text-center">
                                {{ app()->getLocale() == 'ar' ? $section->created_at->locale('ar')->diffForHumans() : $section->created_at->locale('en')->diffForHumans() }}
                            </td>
                            <td class="text-center">
                                <div class="flex justify-center items-center">

                                    <a class="flex items-center mr-3" href="{{ route('Section.edit', $section->id) }}">
                                        <i data-lucide="Eye" class="w-4 h-4 mr-1"></i> {{ __('sections.show') }}
                                    </a>
                                    <a class="flex items-center mr-3" href="{{ route('Section.edit', $section->id) }}">
                                        <i data-lucide="check-square" class="w-4 h-4 mr-1"></i> {{ __('sections.Edit') }}
                                    </a>
                                    <a class="flex items-center text-danger" href="javascript:;" onclick="deleteSection('{{ route('Section.destroy', $section->id) }}')">
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
                    'Content-Type': 'application/json', // تغيير إلى application/json
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
@endsection
