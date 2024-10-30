<div>

    @if ($InvoiceSaved)

        <div role="alert" class="alert relative border rounded-md px-5 py-4 bg-success border-success bg-opacity-20 border-opacity-5 text-success dark:border-success dark:border-opacity-20 mb-2 flex items-center"><i data-tw-merge data-lucide="alert-triangle" class="stroke-1.5 w-5 h-5 mr-2 h-6 w-6 mr-2 h-6 w-6"></i>
            تم حفظ البيانات بنجاح.
        </div>
        
    @endif

    @if ($InvoiceUpdated)

    <div role="alert" class="alert relative border rounded-md px-5 py-4 bg-warning border-warning bg-opacity-20 border-opacity-5 text-warning dark:border-warning dark:border-opacity-20 mb-2 flex items-center"><i data-tw-merge data-lucide="alert-circle" class="stroke-1.5 w-5 h-5 mr-2 h-6 w-6 mr-2 h-6 w-6"></i>
        تم تعديل البيانات بنجاح.
    </div>
    
    @endif

    @if($show_table)
        @include('livewire.group_invoices.Table')
    @else
        <form wire:submit.prevent="store" autocomplete="off">
            @csrf
            <div class="container">
                <style>
                    .input-height { height: 40px; padding: 10px; }
                    .form-control { box-shadow: none; }
                    .mb-3 { margin-bottom: 20px; }
                    label { display: block; margin-bottom: 5px; }
                </style>
            
                <div class="row mb-4">
                    <div class="col-md-6 mb-3">
                        <label for="patientSelect">اسم المريض</label>
                        <select wire:model="patient_id" id="patientSelect" class="form-control input-height" required>
                            <option value="">-- اختار من القائمة --</option>
                            @foreach($Patients as $Patient)
                                <option value="{{$Patient->id}}">{{$Patient->name}}</option>
                            @endforeach
                        </select>
                    </div>
            
                    <div class="col-md-6 mb-3">
                        <label for="doctorSelect">اسم الدكتور</label>
                        <select wire:model="doctor_id" wire:change="get_section" id="doctorSelect" class="form-control input-height" required>
                            <option value="">-- اختار من القائمة --</option>
                            @foreach($Doctors as $Doctor)
                                <option value="{{$Doctor->id}}">{{$Doctor->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            
                <div class="row mb-4">
                    <div class="col-md-6 mb-3">
                        <label for="sectionInput">القسم</label>
                        <input wire:model="section_id" type="text" id="sectionInput" class="form-control input-height" readonly>
                    </div>
            
                    <div class="col-md-6 mb-3">
                        <label for="invoiceType">نوع الفاتورة</label>
                        <select wire:model="type" id="invoiceType" class="form-control input-height" {{$updateMode ? 'disabled' : ''}}>
                            <option value="">-- اختار من القائمة --</option>
                            <option value="1">نقدي</option>
                            <option value="2">اجل</option>
                        </select>
                    </div>
                </div>
            </div>
            

            <div class="card mb-4">
                <div class="card-header">
                    <h4 class="card-title">تفاصيل الخدمة</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped text-center">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>اسم الخدمة</th>
                                    <th>سعر الخدمة</th>
                                    <th>قيمة الخصم</th>
                                    <th>نسبة الضريبة</th>
                                    <th>قيمة الضريبة</th>
                                    <th>الاجمالي مع الضريبة</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>
                                        <select wire:model="Group_id" class="form-control input-height" wire:change="get_price">
                                            <option value="">-- اختار الخدمة --</option>
                                            @foreach($Groups as $Group)
                                                <option value="{{$Group->id}}">{{$Group->name}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td><input wire:model="price" type="text" class="form-control input-height" readonly></td>
                                    <td><input wire:model="discount_value" type="text" class="form-control input-height" readonly></td>
                                    <td><input wire:model="tax_rate" type="text" class="form-control input-height" readonly></td>
                                    <td><input type="text" class="form-control input-height" value="{{$tax_value}}" readonly></td>
                                    <td><input type="text" class="form-control input-height" value="{{$subtotal + $tax_value}}" readonly></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div>
                <input class="btn btn-outline-success" type="submit" value="{{ __('SingleInvoices.confirm_data') }}">
            </div>
        </form>
    @endif

</div>

<style>
    .input-height {
        height: 40px; /* قم بتعديل القيمة حسب الحاجة */
        padding: 10px; /* إضافة padding لتحسين الشكل */
        margin-bottom: 10px; /* تباعد بين العناصر */
    }

    .form-control {
        box-shadow: none; /* إزالة الظلال الافتراضية */
    }
</style>
