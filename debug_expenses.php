<?php
require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\ReimbursementExpense;
use App\Models\User;
use Illuminate\Support\Facades\DB;

// Use the ID from the user screenshot
$expenseId = 'a10cf8cd-80c9-4679-96ac-eacf61686c78';

echo "Checking Expense ID: $expenseId\n";

// 1. Check if expense exists mostly (ignoring scopes)
$expenseRaw = DB::table('reimbursement_expenses')->where('id', $expenseId)->first();
if ($expenseRaw) {
    echo "Found raw record in DB:\n";
    echo "ID: " . $expenseRaw->id . "\n";
    echo "Company ID: " . $expenseRaw->company_id . "\n";
} else {
    echo "NOT FOUND in raw DB.\n";
    exit;
}

// 2. Check with Model (and potential scopes)
// Authenticate as a user from that company to mimic the controller environment
$user = User::where('company_id', $expenseRaw->company_id)->first();
if ($user) {
    auth()->login($user);
    echo "Authenticated as User: " . $user->name . " (Company: " . $user->company_id . ")\n";
    
    $expenseModel = ReimbursementExpense::find($expenseId);
    if ($expenseModel) {
        echo "Found via Model::find()\n";
    } else {
        echo "NOT FOUND via Model::find() - likely scope issue.\n";
    }
} else {
    echo "No user found for company " . $expenseRaw->company_id . "\n";
}

// 3. Simulate the Controller Logic with Form-Data structure
// Sometimes form-data libraries send:
// expenses[0][expenses_id] = ...
// expenses[0][value] = ...
// But if PHP parses it, it might be string keys if not careful, or maybe the value is not matching type?
$expensesInput = [
    "0" => [
        'expenses_id' => $expenseId,
        'value' => "100000" // String value
    ]
];

echo "Simulating form data (attempt 2)...\n";
$expenses_temp = collect($expensesInput)->pluck('expenses_id')->unique()->toArray();
echo "Extracted IDs: " . implode(', ', $expenses_temp) . "\n";
echo "Count extracted: " . count($expenses_temp) . "\n";

$count_in = ReimbursementExpense::whereIn('id', $expenses_temp)->count();
echo "Count In: " . $count_in . "\n";

// Attempt 3: What if the key is missing?
$expensesInputMissing = [
    "0" => [
        'value' => "100000" 
    ]
];
$expenses_temp_missing = collect($expensesInputMissing)->pluck('expenses_id')->unique()->filter()->toArray();
echo "Extracted IDs (Missing): " . count($expenses_temp_missing) . "\n";
