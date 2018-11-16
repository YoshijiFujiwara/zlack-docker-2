<?php

namespace App\Model;

use App\Traits\Orderable;
use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    use Orderable;

    protected $fillable = ['name'];

    public function workspace()
    {
        return $this->belongsTo(Workspace::class);
    }

    public function messages()
    {
        return $this->morphMany(Message::class, 'messageable');
    }
}
