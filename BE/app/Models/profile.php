<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class profile extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'full_name',
        'age',
        'nationality',
        'user_id'

    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
