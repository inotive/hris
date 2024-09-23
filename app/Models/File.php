<?php

namespace App\Models;

use App\Traits\CreatedByUserTrait;
use App\Traits\HasCompany;
use App\Traits\SearchTrait;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;    
    use HasUuids;

    use SearchTrait;

    use HasCompany;


    protected $primaryKey = 'id'; // Use 'id' as the primary key
    public $incrementing = false;  // Disable auto-incrementing
    protected $keyType = 'string'; // Since UUID is a string


    public $fillable = [
        'company_id',
        'module',
        'name',
        'file',
        'url',
        'extension',
        'size',
        'employee_id',
        'module_id',
    ];


    public function scopeLeave($query, $module_id)
    {
        return $query->where('module', 'leave')->where('module_id', $module_id);
    }
}
