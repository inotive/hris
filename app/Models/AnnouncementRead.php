<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnnouncementRead extends Model
{
    use HasFactory;

    use HasUuids;



    protected $primaryKey = 'id'; // Use 'id' as the primary key
    public $incrementing = false;  // Disable auto-incrementing
    protected $keyType = 'string'; // Since UUID is a string


    public $fillable = [
        'employee_id',
        'announcement_id',
        'read_at',
    ];

    public $rules = [
        'employee_id'  => 'required',
        'announcement_id'  => 'required',
        'read_at'  => '',
    ];
}
