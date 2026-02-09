<?php

use App\Models\Employee;
use Illuminate\Support\Str;

// Test Global Filter (Name)
$deptName = \App\Models\EmployeeDepartment::first()->name;
request()->merge(['filter' => ['filter_department_id' => $deptName]]);

$query = Employee::tableQuery();
echo "Global Filter Query: " . $query->toSql() . "\n";
echo "Global Filter Binding: " . json_encode($query->getBindings()) . "\n";

// Test Specific Filter (UUID)
$deptId = \App\Models\EmployeeDepartment::first()->id;
request()->merge(['filter' => ['filter_department_id' => $deptId]]);

$query = Employee::tableQuery();
echo "Specific Filter Query: " . $query->toSql() . "\n"; 
echo "Specific Filter Binding: " . json_encode($query->getBindings()) . "\n";
