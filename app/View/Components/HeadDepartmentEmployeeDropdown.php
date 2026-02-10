<?php

namespace App\View\Components;

use App\Models\Employee;
use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;

class HeadDepartmentEmployeeDropdown extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $companyId;

    public function __construct($companyId = null)
    {
        $this->companyId = $companyId;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $list = [];

        if ($this->companyId) {
            // Fetch potential heads (employees) from the company
            // Or leave it empty and let Select2 handle it via AJAX?
            // The original component had an empty list.
            // But if we want to support non-AJAX fallback (though 'employee.blade.php' uses x-form.select which might imply select2),
            // we should probably just rely on AJAX or if we want to pre-load some, we can.
            // However, the issue described "jika belum memilih company seharusnya belum bisa mendapat option".
            // If we rely on AJAX and the AJAX endpoint filters by company_id, then passing companyId to the component
            // is mainly to ensure the view knows about it if needed, or if we were populating $list.
            // Since $list was empty, I will keep it empty but ensure the AJAX call knows about the company_ID.
            
            // Wait, if I don't populate $list, then the dropdown is empty initially.
            // The Select2 will query the server.
            // The Key is: The Select2 AJAX request needs the company_id.
            // In form.blade.php, I will add logic to pass company_id to the Select2 AJAX request.
        }

        $label = __($this->label ?? 'Head');

        return view('components.form.employee', [
            'list' => $list,
            'name' => 'head_departmen_id',
            'label' => $label,
            'add_class' => 'manager_id',
            'required' => false,
        ]);
    }
}
