<div class="row">


    <x-company-dropdown  :value="old('company_id', $form->company_id ?? '')" />
    <x-employee-dropdown :value="old('employee_id', $form->employee_id ?? '')" />

        
    <x-leave-type-dropdown :value="old('leave_type_id', $form->leave_type_id ?? '')" />
    <x-form.datepicker required label="Start Date" name="start_date" :value="old('date', $form->start_date ?? '')"  />
    <x-form.datepicker required label="End Date" name="end_date" :value="old('date', $form->end_date ?? '')"  />

    {{-- <x-manager-dropdown label="Approver" :value="old('manager_id', $form->manager_id ?? '')" /> --}}

    <x-form.textarea :label="__('Reason')" name="reason" :value="old('reason', $form->reason ?? '')" />


    <div class="row">
        <div class="col-12 col-lg-6">
            <x-form.attachment required class="" label="Files" name="files" :files="$files ?? []"  folder="leave_request" />
        </div>
    </div>

    @if ($form != null)
    
    <h4 class="mt-3">Approver</h4>
    <p>{{ $form->request->title ?? '-' }}</p>
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <tr>
                <th><b>No</b></th>
                <th><b>Name</b></th>
                <th><b>Level</b></th>
                <th><b>Approval</b></th>
                <th><b>Position</b></th>
                <th><b>Department</b></th>
            </tr>
            @foreach ($form->request->approvers as $key => $value)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $value->employee->full_name }}</td>
                    <td>{{ $value->approver_level }}</td>
                    <td>{{ $value->approver_status }}</td>
                    <td>{{ $value->employee->position->name ?? '-' }}</td>
                    <td>{{ $value->employee->department->name ?? '-' }}</td>
                </tr>
            @endforeach
        </table>
    </div>
    @endif
</div>
