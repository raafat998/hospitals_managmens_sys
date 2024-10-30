<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

<h2 class="intro-y text-lg font-medium mt-10">Group List</h2>

        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
            <button class="btn btn-primary shadow-md mr-2" wire:click="show_form_add" type="button">Create New Group</button>
        </div>

        @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
        @endif

    <!-- BEGIN: Data List -->
    <div class="intro-y col-span-12 overflow-x-auto lg:overflow-visible">
        <table class="table table-report -mt-2 min-w-full">
            <thead>
                <tr>
                    <th class="whitespace-nowrap">ID</th>
                    <th class="whitespace-nowrap">Group Name</th>
                    <th class="whitespace-nowrap">Notes</th>
                    <th class="whitespace-nowrap">Tax Rate</th>
                    <th class="whitespace-nowrap">Total With Tax</th>
                    <th class="text-center whitespace-nowrap">Date Added</th>
                    <th class="text-center whitespace-nowrap">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($groups as $group)
                <tr class="intro-x">
                    <td class="w-40">{{ $group->id }}</td>
                    <td>
                        <a href="#" class="font-medium whitespace-nowrap">
                            {{ $group->translateOrNew(app()->getLocale())->name }}
                        </a>
                    </td>
                    <td>
                        {{ $group->translateOrNew(app()->getLocale())->notes }}
                    </td>
                    <td>{{ $group->tax_rate }}%</td>
                    <td>{{ $group->Total_with_tax }}</td>
                    <td class="text-center">{{ $group->created_at->diffForHumans() }}</td>
                    <td class="text-center">
                        <div class="flex justify-center items-center">
                            <a  wire:click="print({{ $group->id }})" class="flex items-center mr-3">
                                <i data-lucide="Printer" class="w-4 h-4 mr-1"></i> {{ __('print') }}
                            </a>
                            <a class="flex items-center mr-3" href="#">
                                <i data-lucide="check-square" class="w-4 h-4 mr-1" wire:click="edit({{ $group->id  }})"></i> Edit
                            </a>
                            <a class="flex items-center text-danger" href="javascript:;" onclick="deleteSection({{ $group->id }})">
                                <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i> Delete
                            </a>
                        </div>
                    </td>
                </tr>
               
            </tbody>
        </table>
        @endforeach
    </div>
    <!-- END: Data List -->
<script>
    Livewire.on('refreshGroupList', () => {
        
        location.reload(); 
    });
</script>

<script>
    function changeLanguage(lang) {
        alert('Language changed to: ' + lang);
    }

    function deleteSection(groupId) {
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
            // استدعاء Livewire لحذف المجموعة بدون إعادة تحميل الصفحة
            Livewire.emit('deleteGroup', groupId);

            // إظهار رسالة تأكيد عند الحذف
            Swal.fire(
                'Deleted!',
                'Group has been deleted.',
                'success'
            );
        }
    });
}


</script>
