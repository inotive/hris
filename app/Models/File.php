<?php

namespace App\Models;

use App\Traits\CreatedByUserTrait;
use App\Traits\HasCompany;
use App\Traits\SearchTrait;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File as FacadesFile;
use Illuminate\Support\Facades\Storage;

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

    public static function boot()
    {
        parent::boot();

        static::creating(function($row){
            $filePath = $row->file ?? null;
            if ($filePath != null) {

                // Get the file extension
                $extension = pathinfo(Storage::path($filePath), PATHINFO_EXTENSION);

                // Get the file size (in bytes)
                $size = Storage::size($filePath);

                // Get the filename with extension
                $filename = pathinfo(Storage::path($filePath), PATHINFO_BASENAME);

                $row->extension = $extension;
                $row->size = $size;
                $row->name = $filename;
            
               
            }
        });
    }

    public function scopeLeave($query, $module_id)
    {
        return $query->where('module', 'leave')->where('module_id', $module_id);
    }


    public function scopeOvertime($query, $module_id)
    {
        return $query->where('module', 'overtime')->where('module_id', $module_id);
    }

    public function scopeReimbursement($query, $module_id)
    {
        return $query->where('module', 'reimburse')->where('module_id', $module_id);
    }
}
