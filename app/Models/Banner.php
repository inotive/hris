<?php

namespace App\Models;

use App\Traits\CreatedByUserTrait;
use App\Traits\SearchTrait;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    use HasUuids;

    use SearchTrait;
    use CreatedByUserTrait;


    protected $primaryKey = 'id'; // Use 'id' as the primary key
    public $incrementing = false;  // Disable auto-incrementing
    protected $keyType = 'string'; // Since UUID is a string


    public $fillable = [
        'company_id',
        'title',
        'image',
        'link',
    ];

    public $rules = [
        'company_id'  => 'required',
        'title'  => 'required',
        'image'  => 'required',
        'link'  => 'required',
    ];


    public function company()
    {
        return $this->belongsTo(Company::class,'company_id','id');
    }
}