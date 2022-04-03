<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElectricExpands extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function transformer()
    {
        return $this->hasOne(Transformers::class, 'id', 'transformer_id');
    }

    public function env_community()
    {
        return $this->hasOne(EnvCommunities::class, 'id', 'env_community_id');
    }

    public function station()
    {
        return $this->hasOne(Stations::class, 'id', 'station_id');
    }
}
