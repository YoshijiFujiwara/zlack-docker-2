<?php

namespace App\Model;

use App\Traits\Orderable;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Workspace extends Model
{
    use Orderable;

    protected $fillable = ['name'];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function channels()
    {
        return $this->hasMany(Channel::class);
    }
}
