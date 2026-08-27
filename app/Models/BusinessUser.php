<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessUser extends Model
{
    public $timestamps = false;
    protected $table = 'business_user';
    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
