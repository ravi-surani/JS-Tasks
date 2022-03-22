<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class tasks extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];

    public function project()
    {
        return $this->hasOne(project::class, 'id', 'project_id');
    }
    public function users()
    {
        return $this->hasMany(projectuser::class,);
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
