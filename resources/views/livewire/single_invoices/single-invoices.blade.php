<div style="overflow-x: auto;">
    <style>
        .input-height { height: 40px; padding: 10px; }
        .form-control { box-shadow: none; }
        .mb-3 { margin-bottom: 20px; }
        label { display: block; margin-bottom: 5px; }
    </style>

@if ($catchError)
<div class="alert alert-danger" id="success-danger">
    <button type="button" class="close" data-dismiss="alert">x</button>
    {{ $catchError }}
</div>
@endif

    @if ($InvoiceSaved)
        <div class="alert alert-info">{{ __('SingleInvoices.success_save') }}</div>
    @endif

    @if ($InvoiceUpdated)
        <div class="alert alert-info">{{ __('SingleInvoices.success_update') }}</div>
    @endif

    @if($show_table)
        @include('livewire.single_invoices.Table')
    @else
        <form wire:submit.prevent="store" autocomplete="off">
            @csrf
            <div class="row mb-4">
                <div class="col-md-6 mb-3">
                    <label>{{ __('SingleInvoices.patient_name') }}</label>
                    <select wire:model="patient_id" class="form-control input-height" required>
                        <option value="">{{ __('SingleInvoices.select_from_list') }}</option>
                        @foreach($Patients as $Patient)
                            <option value="{{$Patient->id}}">{{$Patient->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label>{{ __('SingleInvoices.doctor_name') }}</label>
                    <select wire:model="doctor_id" wire:change="get_section" class="form-control input-height" required>
                        <option value="">{{ __('SingleInvoices.select_from_list') }}</option>
                        @foreach($Doctors as $Doctor)
                            <option value="{{$Doctor->id}}">{{$Doctor->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-6 mb-3">
                    <label>{{ __('SingleInvoices.section') }}</label>
                    <input wire:model="section_id" type="text" class="form-control input-height" readonly>
                </div>

                <div class="col-md-6 mb-3">
                    <label>{{ __('SingleInvoices.invoice_type') }}</label>
                    <select wire:model="type" class="form-control input-height">
                        <option value="">{{ __('SingleInvoices.select_from_list') }}</option>
                        <option value="1">{{ __('SingleInvoices.cash') }}</option>
                        <option value="2">{{ __('SingleInvoices.on_credit') }}</option>
                    </select>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            <h4 class="card-title mg-b-0">{{ __('SingleInvoices.services_details') }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped text-center">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{ __('SingleInvoices.service_name') }}</th>
                                            <th>{{ __('SingleInvoices.service_price') }}</th>
                                            <th>{{ __('SingleInvoices.discount_value') }}</th>
                                            <th>{{ __('SingleInvoices.tax_rate') }}</th>
                                            <th>{{ __('SingleInvoices.tax_value') }}</th>
                                            <th>{{ __('SingleInvoices.total_with_tax') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>
                                                <select wire:model="Service_id" class="form-control input-height" wire:change="get_price" style="min-width: 200px;"> 
                                                    <option value="">{{ __('SingleInvoices.select_service') }}</option>
                                                    @foreach($Services as $Service)
                                                        <option value="{{$Service->id}}">{{$Service->name}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td><input wire:model="price" type="text" class="form-control input-height" readonly></td>
                                            <td><input wire:model="discount_value" type="text" class="form-control input-height"></td>
                                            <td><input wire:model="tax_rate" type="text" class="form-control input-height"></td>
                                            <td><input type="text" class="form-control input-height" value="{{$tax_value}}" readonly></td>
                                            <td><input type="text" class="form-control input-height" readonly value="{{$subtotal + $tax_value}}"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <input class="btn btn-outline-success" type="submit" value="{{ __('SingleInvoices.confirm_data') }}">
        </form>
    @endif
</div>
