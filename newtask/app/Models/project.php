<?php

namespace App\Models;

use Attribute;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class project extends Model
{
    protected $dates = ['start_date','end_date'];

    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];

    public function users()
    {
        return $this->hasMany(projectuser::class);
    }


    public function tasks()
    {
        return $this->hasMany(tasks::class);
    }


    public function getStartDateAttribute()
    {
        return date('d/m/Y', strtotime($this->attributes['start_date']));
    }
    public function getEndDateAttribute()
    {
        return date('d/m/Y', strtotime($this->attributes['end_date']));
    }
}
