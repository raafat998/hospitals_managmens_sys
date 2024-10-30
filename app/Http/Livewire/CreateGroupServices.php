<?php

namespace App\Http\Livewire;

use App\Models\Group;
use App\Models\Service;
use Livewire\Component;
use Illuminate\Support\Collection;

class CreateGroupServices extends Component
{
    public $GroupsItems = [];
    public Collection $allServices; // تعديل هنا لتحديد النوع كـ Collection
    public $discount_value = 0;
    public $taxes = 17;
    public $name_group;
    public $notes;
    public $ServiceSaved = false;

    public $serviceUpdate = false;
    public $show_table=true;

    public $updateMode=false;

    public $group_id;

    protected $listeners = ['deleteGroup'];

    public function mount()
    {
        $this->allServices = Service::all(); // هذا سيعيد مجموعة من كائنات Service
    }

    public function render()
    {
        $total = 0;
        foreach ($this->GroupsItems as $groupItem) {
            if ($groupItem['is_saved'] && $groupItem['service_price'] && $groupItem['quantity']) {
                $total += $groupItem['service_price'] * $groupItem['quantity'];
            }
        }

        return view('livewire.GroupServices.create-group-services', [
            'groups'=>Group::all(),
            'subtotal' => $Total_after_discount = $total - ((is_numeric($this->discount_value) ? $this->discount_value : 0)),
            'total' => $Total_after_discount * (1 + (is_numeric($this->taxes) ? $this->taxes : 0) / 100)
        ]);
    }

    public function addService()
    {
        foreach ($this->GroupsItems as $key => $groupItem) {
            if (!$groupItem['is_saved']) {
                $this->addError('GroupsItems.' . $key, 'يجب حفظ هذا الخدمة قبل إنشاء خدمة جديدة.');
                return;
            }
        }

        $this->GroupsItems[] = [
            'service_id' => '',
            'quantity' => 1,
            'is_saved' => false,
            'service_name' => '',
            'service_price' => 0
        ];

        $this->ServiceSaved = false;
    }

    public function editService($index)
    {
        foreach ($this->GroupsItems as $key => $groupItem) {
            if (!$groupItem['is_saved']) {
                $this->addError('GroupsItems.' . $key, 'This line must be saved before editing another.');
                return;
            }
        }

        $this->GroupsItems[$index]['is_saved'] = false;
    }

    public function saveService($index)
{
    $this->resetErrorBag();

    // تحقق من البيانات المدخلة
    if (!isset($this->GroupsItems[$index]['quantity'])) {
        $this->addError('GroupsItems.' . $index . '.quantity', 'Quantity is not set.');
        return;
    }

    $product = $this->allServices->find($this->GroupsItems[$index]['service_id']);

    if (!$product) {
        $this->addError('GroupsItems.' . $index . '.service_id', 'Service not found.');
        return; // إذا لم يتم العثور على الخدمة، أوقف العملية
    }

    if ($this->GroupsItems[$index]['quantity'] <= 0) {
        $this->addError('GroupsItems.' . $index . '.quantity', 'Quantity must be greater than zero.');
        return; // إذا كانت الكمية غير صالحة، أوقف العملية
    }

    // إذا كانت جميع الشروط صحيحة
    $this->GroupsItems[$index]['service_name'] = $product->name;
    $this->GroupsItems[$index]['service_price'] = $product->price;
    $this->GroupsItems[$index]['is_saved'] = true;
}

    

    

    public function removeService($index)
    {
        unset($this->GroupsItems[$index]);
        $this->GroupsItems = array_values($this->GroupsItems);
    }

    public function saveGroup()
    {
       if( $this->updateMode){
        $Groups = Group::findOrFail($this->group_id);
        $total = 0;
    
        foreach ($this->GroupsItems as $groupItem) {
            if ($groupItem['is_saved'] && $groupItem['service_price'] && $groupItem['quantity']) {
                $total += $groupItem['service_price'] * $groupItem['quantity'];
            }
        }
    
        $Groups->Total_before_discount = $total;
        $Groups->discount_value = $this->discount_value;
        $Groups->Total_after_discount = $total - ((is_numeric($this->discount_value) ? $this->discount_value : 0));
        $Groups->tax_rate = $this->taxes;
        $Groups->Total_with_tax = $Groups->Total_after_discount * (1 + (is_numeric($this->taxes) ? $this->taxes : 0) / 100);
    
        $Groups->name = $this->name_group;
        $Groups->notes = $this->notes;
        $Groups->save();  
        
        foreach ($this->GroupsItems as $GroupsItem) {
            if ($GroupsItem['is_saved']) {
                $Groups->service_group()->attach($GroupsItem['service_id'], [
                    'quantity' => $GroupsItem['quantity'] // تأكد من تمرير الكمية
                ]);
            }
        }
    
        // إعادة تعيين القيم
        $this->reset('GroupsItems', 'name_group', 'notes');
        $this->discount_value = 0;

        $this->ServiceSaved =false;
        $this->serviceUpdate=true;
       }
       
       else{
        $Groups = new Group();
        $total = 0;
    
        foreach ($this->GroupsItems as $groupItem) {
            if ($groupItem['is_saved'] && $groupItem['service_price'] && $groupItem['quantity']) {
                $total += $groupItem['service_price'] * $groupItem['quantity'];
            }
        }
    
        $Groups->Total_before_discount = $total;
        $Groups->discount_value = $this->discount_value;
        $Groups->Total_after_discount = $total - ((is_numeric($this->discount_value) ? $this->discount_value : 0));
        $Groups->tax_rate = $this->taxes;
        $Groups->Total_with_tax = $Groups->Total_after_discount * (1 + (is_numeric($this->taxes) ? $this->taxes : 0) / 100);
    
        $Groups->name = $this->name_group;
        $Groups->notes = $this->notes;
        $Groups->save();  
        
        foreach ($this->GroupsItems as $GroupsItem) {
            if ($GroupsItem['is_saved']) {
                $Groups->service_group()->attach($GroupsItem['service_id'], [
                    'quantity' => $GroupsItem['quantity'] // تأكد من تمرير الكمية
                ]);
            }
        }
    
        // إعادة تعيين القيم
        $this->reset('GroupsItems', 'name_group', 'notes');
        $this->discount_value = 0;
        $this->ServiceSaved = true;
       }
    }
    
    public function show_form_add(){
        $this->show_table=false;
    }

    public function edit($id)
    {
        $this->show_table = false;
        $this->updateMode = true;
        $group = Group::where('id',$id)->first();
        $this->group_id = $id;

        $this->reset('GroupsItems', 'name_group', 'notes');
        $this->name_group= $group->name;
        $this->notes= $group->notes;

        $this->discount_value = intval($group->discount_value);
        $this->ServiceSaved = false;

        foreach ($group->service_group as $serviceGroup)
        {
            $this->GroupsItems[] = [
                'service_id' => $serviceGroup->id,
                'quantity' => $serviceGroup->pivot->quantity,
                'is_saved' => true,
                'service_name' => $serviceGroup->name,
                'service_price' => $serviceGroup->price
            ];
        }
    }

    
    public function deleteGroup($id){

        Group::destroy($id);

        // تحديث البيانات بدون إعادة تحميل الصفحة
        $this->emit('refreshGroupList');
    }
}
