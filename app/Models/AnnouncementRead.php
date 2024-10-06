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
        'annoucement_id',
        'read_at',
    ];

    public $rules = [
        'employee_id'  => 'required',
        'annoucement_id'  => 'required',
        'read_at'  => '',
    ];
}
