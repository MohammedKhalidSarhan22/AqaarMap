<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    protected $primaryKey = 'property_id';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'property_id',
         'rooms_count',
          'floor_number',
          'finishing_level'
    ];

    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id');
    }
}
