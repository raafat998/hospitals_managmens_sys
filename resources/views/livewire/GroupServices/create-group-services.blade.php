<div class="container mx-auto">

    <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
        <h2 class="font-medium text-base mr-auto">{{ __('GroupServices.create_new_group') }}</h2>
        <a class="transition duration-200 border shadow-sm inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&:hover:not(:disabled)]:bg-opacity-90 [&:hover:not(:disabled)]:border-opacity-90 [&:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-primary border-primary text-white dark:border-primary mb-2 mr-1" href="{{ route('Section.index') }}">{{ __('GroupServices.back') }}</a>
    </div>

@if($show_table)

@include('livewire.GroupServices.index')

@else


{{-- ########################################################################################################################### --}}
    <div id="input" class="p-5">
        <div class="preview">
            <form wire:submit.prevent="saveGroup" autocomplete="off">
                @csrf

                @if ($ServiceSaved)
                    <div class="alert alert-info">تم حفظ البيانات بنجاح.</div>
                @endif

                @if ($serviceUpdate)
                <div class="alert alert-info">تم تعديل البيانات بنجاح.</div>
                @endif

                <div class="form-group mb-4">
                    <label class="font-weight-bold">{{ __('GroupServices.group_name') }}</label>
                    <input wire:model="name_group" type="text" name="name_group" class="form-control" required placeholder="{{ __('GroupServices.enter_group_name') }}">
                </div>
                
                <div class="form-group mb-4">
                    <label class="font-weight-bold">{{ __('GroupServices.notes') }}</label>
                    <textarea wire:model="notes" name="notes" class="form-control" rows="5" placeholder="{{ __('GroupServices.enter_notes') }}"></textarea>
                </div>

                <div class="card mt-4">
                    <div class="card-header">
                        <div class="col-md-12">
                            <button type="button" class="transition duration-200 border shadow-sm inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&:hover:not(:disabled)]:bg-opacity-90 [&:hover:not(:disabled)]:border-opacity-90 [&:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-primary border-primary text-white dark:border-primary mb-2 mr-1" wire:click.prevent="addService">{{ __('GroupServices.add_sub_service') }}</button>
                        </div>
                    </div>
                
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr class="table-primary">
                                        <th>{{ __('GroupServices.service_name') }}</th>
                                        <th width="200">{{ __('GroupServices.quantity') }}</th>
                                        <th width="200">{{ __('GroupServices.actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($GroupsItems as $index => $groupItem)
                                        <tr>
                                            <td>
                                                @if($groupItem['is_saved'])
                                                    <input type="hidden" name="GroupsItems[{{$index}}][service_id]" wire:model="GroupsItems.{{$index}}.service_id"/>
                                                    @if($groupItem['service_name'] && $groupItem['service_price'])
                                                        {{ $groupItem['service_name'] }} ({{ number_format($groupItem['service_price'], 2) }})
                                                    @endif
                                                @else
                                                    <select name="GroupsItems[{{$index}}][service_id]" class="form-control{{ $errors->has('GroupsItems.' . $index) ? ' is-invalid' : '' }}" wire:model="GroupsItems.{{$index}}.service_id">
                                                        <option value="">{{ __('GroupServices.select_service') }}</option>
                                                        @foreach ($allServices as $service)
                                                            <option value="{{ $service->id }}">
                                                                {{ \App\Models\ServiceTranslation::where(['Service_id' => $service->id])->pluck('name')->first() }} ({{ number_format($service->price, 2) }})
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @if($errors->has('GroupsItems.' . $index))
                                                        <em class="invalid-feedback">{{ $errors->first('GroupsItems.' . $index) }}</em>
                                                    @endif
                                                @endif
                                            </td>
                                            <td>
                                                @if($groupItem['is_saved'])
                                                    <!-- حقل مخفي للاحتفاظ بالكمية المحفوظة -->
                                                    <input type="hidden" name="GroupsItems[{{$index}}][quantity]" wire:model="GroupsItems.{{$index}}.quantity"/>
                                                    {{ $groupItem['quantity'] }}
                                                @else
                                                    <!-- حقل إدخال لإدخال الكمية -->
                                                    <input type="number" name="GroupsItems[{{$index}}][quantity]" class="form-control" wire:model="GroupsItems.{{$index}}.quantity" placeholder="أدخل الكمية" min="1" required />
                                                @endif
                                            </td>
                                            
                                            <td class="d-grid gap-3">
                                                @if($groupItem['is_saved'])
                                                    <button type="button" class="transition duration-200 border shadow-sm inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&:hover:not(:disabled)]:bg-opacity-90 [&:hover:not(:disabled)]:border-opacity-90 [&:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-warning border-warning text-slate-900 dark:border-warning" wire:click.prevent="editService({{ $index }})">{{ __('GroupServices.edit') }}</button>
                                                @elseif($groupItem['service_id'])
                                                    <button type="button" class="transition duration-200 border shadow-sm inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&:hover:not(:disabled)]:bg-opacity-90 [&:hover:not(:disabled)]:border-opacity-90 [&:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-success border-success text-slate-900" wire:click.prevent="saveService({{ $index }})">{{ __('GroupServices.confirm') }}</button>
                                                @endif
                                                <button type="button" class="transition duration-200 border shadow-sm inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&:hover:not(:disabled)]:bg-opacity-90 [&:hover:not(:disabled)]:border-opacity-90 [&:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-danger border-danger text-white" wire:click.prevent="removeService({{ $index }})">{{ __('GroupServices.remove') }}</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                
                        <div class="col-lg-4 ml-auto text-right mt-4">
                            <table class="table pull-right">
                                <tr>
                                    <td style="color: red">{{ __('GroupServices.total') }}</td>
                                    <td>{{ number_format($subtotal, 2) }}</td>
                                </tr>
                                <tr>
                                    <td style="color: red">{{ __('GroupServices.discount_value') }}</td>
                                    <td width="125">
                                        {!! Form::number('discount_value', null, ['class' => 'form-control w-75 d-inline', 'wire:model' => 'discount_value', 'placeholder' => __('GroupServices.enter_discount_value')]) !!}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="color: red">{{ __('GroupServices.tax_rate') }}</td>
                                    <td>
                                        <div class="input-group">
                                            {!! Form::number('taxes', null, ['class' => 'form-control', 'min' => 0, 'max' => 100, 'wire:model' => 'taxes', 'placeholder' => __('GroupServices.enter_tax_rate'), 'style' => 'width: auto;']) !!}
                                            <span class="input-group-text">%</span>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="color: red">{{ __('GroupServices.total_with_tax') }}</td>
                                    <td>{{ number_format($total, 2) }}</td>
                                </tr>
                            </table>
                        </div> <br/>
                        <div>
                            <input class="btn btn-outline-success" type="submit" value="{{ __('GroupServices.confirm_data') }}">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endif
</div>

