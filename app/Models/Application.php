<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = ['user_id', 'portal_id', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function portal()
    {
        return $this->belongsTo(Portal::class,'portal_id');
    }

}
