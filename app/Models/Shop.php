<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
protected $primaryKey = 'property_id';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'property_id',
        'facade_width',
        'street_width'
    ];

    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id');
    }
}
