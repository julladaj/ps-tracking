<?php

namespace App\Models;

use App\Casts\LocaleBuddhismDate;
use App\Helpers\Helper;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use Kyslik\ColumnSortable\Sortable;

class Meters extends Model
{
    use HasFactory, Sortable;

    protected $guarded = [];

    protected $casts = [
        'document_date' => LocaleBuddhismDate::class,
    ];

    public function job_type()
    {
        return $this->hasOne(JobTypes::class, 'id', 'job_type_id');
    }

    public function job_status()
    {
        return $this->hasOne(JobStatuses::class, 'id', 'job_status_id');
    }

    public function job_amount()
    {
        return $this->hasOne(JobAmounts::class, 'id', 'job_amount_id');
    }

    public function transformer()
    {
        return $this->hasOne(Transformers::class, 'id', 'transformer_id');
    }

}
