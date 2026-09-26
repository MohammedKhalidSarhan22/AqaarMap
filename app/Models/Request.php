<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    const UPDATED_AT = null; // الجدول يحتوي على created_at فقط بناءً على المخطط

    protected $fillable = [
        'user_id',
        'property_id',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}
