<?php

namespace App\Models;

use App\Traits\CreatedByUserTrait;
use App\Traits\HasCompany;
use App\Traits\SearchTrait;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
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
        'title',
        'content',
        'reference',
        'notes',
    ];

    public $rules = [
        'company_id'  => 'required',
        'title'  => 'required',
        'content'  => 'required',
        'reference'  => '',
        'notes'  => '',
    ];


    public static function boot()
    {
        parent::boot();

        static::created(function($model){
            $employees = Employee::where('company_id', $model->company_id)->get();

            foreach($employees as $k => $v) {
                AnnouncementRead::create([
                    'employee_id'   => $v->id,
                    'announcement_id'   => $model->id,
                ]);
            }
        });
    }


    public static function dummy_data() : array
    {
        return [];
    }
}
