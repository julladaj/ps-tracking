<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Meters extends Model
{
    use HasFactory, Sortable;

    protected $guarded = [];
//    protected $casts = [
//        'document_date' => 'date'
//    ];

//    protected $dateFormat = 'Y-m-d';

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

    public function pea_staff()
    {
        return $this->hasOne(PeaStaffs::class, 'id', 'survey_user_id');
    }

    public function getDocumentDateAttribute($value)
    {
        return (new Carbon($value))->format('Y-m-d');
    }
}
