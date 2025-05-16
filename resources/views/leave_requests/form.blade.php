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
    <h4>Approver</h4>
    {{ $form->request->title ?? '-' }}
    <div class="table-responsive">
        <table class="table table-bordered">
            <tr>
                <th>No</th>
                <th>Level</th>
                <th>Approval</th>
                <th>Position</th>
                <th>Department</th>
            </tr>
            @foreach ($form->request->approvers as $key => $value)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $value->employee->full_name }}</td>
                </tr>
            @endforeach
        </table>
    </div>
    @endif
</div>
