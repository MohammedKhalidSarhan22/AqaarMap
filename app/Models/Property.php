<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $fillable = [
        'user_id',
        'region_id',
        'title',
        'description',
        'price',
        'area',
        'offer_type',
        'property_type',
        'status',
        'latitude',
        'longitude'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function apartment()
    {
        return $this->hasOne(Apartment::class, 'property_id');
    }
    public function shop()
    {
        return $this->hasOne(Shop::class, 'property_id');
    }
    public function land()
    {
        return $this->hasOne(Land::class, 'property_id');
    }

    public function media()
    {
        return $this->hasMany(Property_Media::class);
    }

    public function requests()
    {
        return $this->hasMany(Request::class);
    }
}
