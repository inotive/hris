<x-form.index :title="__('Add') . ' ' . __('Payslip Generate')" :action="route('employee-payslip-generate.store')" :cancel="route('employee-payslip-generate.index')">


    <x-slot name="body">

        <x-company-dropdown />


        <div class="table-responsive" id="employee_list">
            <table class="table table-bordered table-hover">
                <thead class="thead-light">
                    <tr>
                        <th scope="col"><input type="checkbox" id="select-all"></th>
                        <th scope="col">Name</th>
                    </tr>
                </thead>
                <tbody id="employee_list_body">
                   
                </tbody>
            </table>
        </div>

    </x-slot>
</x-form.index>
