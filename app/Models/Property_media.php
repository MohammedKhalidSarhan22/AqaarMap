<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property_media extends Model
{
public $timestamps = false;
    protected $table = 'property_media';

    protected $fillable = [
        'property_id',
        'file_path',
        'media_type',
        'is_primary'
    ];
    protected $casts = [
        'is_primary' => 'boolean',
    ];
    public function property()
    {
        return $this->belongsTo(Property::class);
    }
    //
}
