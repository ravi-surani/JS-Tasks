<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class projectuser extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function user()
    {
        return $this->hasManyThrough(User::class, project::class, 'id', 'project_id', 'id', 'user_id');
    }
    public function project()
    {
        return $this->hasManyThrough(project::class, User::class, 'id', 'user_id', 'id', 'project_id');
    }
    public function projectUserList()
    {
        return $this->hasMany(user::class, 'id', 'user_id');
    }
    public function taskUserList()
    {
        return $this->hasMany(user::class, 'id', 'user_id');
    }
}
