<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

<button class="btn btn-primary pull-right" wire:click="show_form_add" type="button">{{ __('SingleInvoices.add_invoice') }}</button><br><br>

<div class="intro-y col-span-12 overflow-x-auto lg:overflow-visible">
    <table class="table table-report -mt-2 min-w-full">
        <thead>
            <tr>
                <th>#</th>
                <th>{{ __('SingleInvoices.service_name') }}</th>
                <th>{{ __('SingleInvoices.patient_name') }}</th>
                <th>{{ __('SingleInvoices.invoice_date') }}</th>
                <th>{{ __('SingleInvoices.doctor_name') }}</th>
                <th>{{ __('SingleInvoices.section') }}</th>
                <th>{{ __('SingleInvoices.service_price') }}</th>
                <th>{{ __('SingleInvoices.discount_value') }}</th>
                <th>{{ __('SingleInvoices.tax_rate') }}</th>
                <th>{{ __('SingleInvoices.tax_value') }}</th>
                <th>{{ __('SingleInvoices.total_with_tax') }}</th>
                <th>{{ __('SingleInvoices.invoice_type') }}</th>
                <th>{{ __('SingleInvoices.actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($single_invoices as $single_invoice)
                <tr class="intro-x">
                    <td class="w-40">{{ $loop->iteration }}</td>
                    <td>{{ $single_invoice->Service->name }}</td>
                    <td>{{ $single_invoice->Patient->name }}</td>
                    <td>{{ $single_invoice->invoice_date }}</td>
                    <td>{{ $single_invoice->Doctor->name }}</td>
                    <td>{{ $single_invoice->Section->name }}</td>
                    <td>{{ number_format($single_invoice->price, 2) }}</td>
                    <td>{{ number_format($single_invoice->discount_value, 2) }}</td>
                    <td>{{ $single_invoice->tax_rate }}%</td>
                    <td>{{ number_format($single_invoice->tax_value, 2) }}</td>
                    <td>{{ number_format($single_invoice->total_with_tax, 2) }}</td>
                    <td>{{ $single_invoice->type == 1 ? __('SingleInvoices.cash') : __('SingleInvoices.on_credit') }}</td>
                    <td class="table-report__action w-56">
                        <div class="flex justify-center items-center">
                            <a  wire:click="print({{ $single_invoice->id }})" class="flex items-center mr-3">
                                <i data-lucide="Printer" class="w-4 h-4 mr-1"></i> {{ __('print') }}
                            </a>
                            <a class="flex items-center mr-3" href="#" wire:click="edit({{ $single_invoice->id }})">
                                <i data-lucide="check-square" class="w-4 h-4 mr-1"></i> {{ __('SingleInvoices.edit') }}
                            </a>
                            <a class="flex items-center text-danger" href="javascript:;" onclick="deleteInvoice({{ $single_invoice->id }})" >
                                <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i> {{ __('SingleInvoices.delete') }}
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
  function deleteInvoice(single_invoice_id) {
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
            Livewire.emit('delete', single_invoice_id);

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