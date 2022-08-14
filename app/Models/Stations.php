<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stations extends Model
{
    use HasFactory;

    protected $fillable = ['pea_id', 'station'];

    protected static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->pea_id = auth()->user()->pea_id;
        });

        self::addGlobalScope(function (Builder $builder) {
            $builder->where('pea_id', auth()->user()->pea_id);
        });
    }
}
