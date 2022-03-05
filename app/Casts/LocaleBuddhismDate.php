<?php

namespace App\Casts;

use Carbon\Carbon;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Support\Facades\Config;

class LocaleBuddhismDate implements CastsAttributes
{
    public function get($model, $key, $value, $attributes)
    {
        $value = (new Carbon($value));
        if (Config::get('app.locale') === 'th') {
            return $value->addYear(543)->translatedFormat('d F Y');
        }
        return $value->translatedFormat('d F Y');
    }

    public function set($model, $key, $value, $attributes)
    {
        $value = (new Carbon($value));
        if (Config::get('app.locale') === 'th') {
            return [$key => $value->subYear(543)];
        }
        return [$key => $value];
    }
}