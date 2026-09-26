<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $fillable =
    ['city_id',
     'name',
      'type'
      ];

    public function city()
    {
        return $this->belongsTo(Cities::class);
    }
    public function properties()
    {
        return $this->hasMany(Property::class); //[cite: 1, 3]
    }
}
