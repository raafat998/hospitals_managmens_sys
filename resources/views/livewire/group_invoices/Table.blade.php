<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

<button class="btn btn-primary pull-right" wire:click="show_form_add" type="button">{{ __('groupInvoices.add_invoice') }}</button><br><br>

<div class="intro-y col-span-12 overflow-x-auto lg:overflow-visible">
    <table class="table table-report -mt-2 min-w-full">
        <thead>
            <tr>
                <th>#</th>
                <th>{{ __('groupInvoices.service_name') }}</th>
                <th>{{ __('groupInvoices.patient_name') }}</th>
                <th>{{ __('groupInvoices.invoice_date') }}</th>
                <th>{{ __('groupInvoices.doctor_name') }}</th>
                <th>{{ __('groupInvoices.section') }}</th>
                <th>{{ __('groupInvoices.service_price') }}</th>
                <th>{{ __('groupInvoices.discount_value') }}</th>
                <th>{{ __('groupInvoices.tax_rate') }}</th>
                <th>{{ __('groupInvoices.tax_value') }}</th>
                <th>{{ __('groupInvoices.total_with_tax') }}</th>
                <th>{{ __('groupInvoices.invoice_type') }}</th>
                <th>{{ __('groupInvoices.actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($group_invoices as $group_invoice)
                <tr class="intro-x">
                    <td>{{ $loop->iteration}}</td>

                <td>{{ $group_invoice->Group->name }}</td>

                <td>{{ $group_invoice->Patient->name }}</td>

                <td>{{ $group_invoice->invoice_date }}</td>

                <td>{{ $group_invoice->Doctor->name }}</td>

                <td>{{ $group_invoice->Section->name }}</td>

                <td>{{ number_format($group_invoice->price, 2) }}</td>

                <td>{{ number_format($group_invoice->discount_value, 2) }}</td>

                <td>{{ $group_invoice->tax_rate }}%</td>

                <td>{{ number_format($group_invoice->tax_value, 2) }}</td>

                <td>{{ number_format($group_invoice->total_with_tax, 2) }}</td>

                <td>{{ $group_invoice->type == 1 ? 'نقدي':'اجل' }}</td>

            
                    <td class="table-report__action w-56">
                        <div class="flex justify-center items-center">
                            <a wire:click="print({{ $group_invoice->id }})" class="flex items-center mr-3">
                                <i data-lucide="Printer" class="w-4 h-4 mr-1"></i> {{ __('print') }}
                            </a>
                            <a class="flex items-center mr-3" href="#" wire:click="edit({{ $group_invoice->id }})">
                                <i data-lucide="check-square" class="w-4 h-4 mr-1"></i> {{ __('groupInvoices.edit') }}
                            </a>
                            <a class="flex items-center text-danger" href="javascript:;" onclick="deleteInvoice({{ $group_invoice->id }})" >
                                <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i> {{ __('groupInvoices.delete') }}
                            </a>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<script>
    Livewire.on('RefreshInvoiceList', () => {
        
        location.reload(); 
    });
</script>

<script>
  function deleteInvoice(group_invoice_id) {
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
            Livewire.emit('delete', group_invoice_id);

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