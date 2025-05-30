<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobAmounts extends Model
{
    use HasFactory;

    protected $fillable = ['description'];


    public function jobStatuses()
    {
        return $this->belongsToMany(JobStatuses::class)
            ->withPivot('standard_duration');
    }
}
