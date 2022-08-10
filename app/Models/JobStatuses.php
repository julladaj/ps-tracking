<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobStatuses extends Model
{
    use HasFactory;

    protected $fillable = ['description'];

    public function jobAmounts()
    {
        return $this->belongsToMany(JobAmounts::class)
            ->withPivot('standard_duration');
    }
}
