<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Config;

/**
 * Convert date to the locale buddhism format (if locale is TH)
 *
 * @param $value
 * @return string
 */
function buddhismDate($value)
{
    $value = (new Carbon($value));
    if (Config::get('app.locale') === 'th') {
        return $value->addYear(543)->translatedFormat('d F Y');
    }
    return $value->translatedFormat('d F Y');
}
