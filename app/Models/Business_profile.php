<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Business_profile extends Model
{
protected $fillable = [
    'user_id',
    'commercial_name',
    'specialty',
    'portfolio_url'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
