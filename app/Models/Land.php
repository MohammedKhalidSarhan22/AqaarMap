<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Land extends Model
{
protected $primaryKey = 'property_id';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = [
        'property_id',
         'zoning_type'
    ];
    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id');
    }
}
