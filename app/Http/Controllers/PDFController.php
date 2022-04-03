<?php

namespace App\Http\Controllers;

use App\Models\Meters;
use Barryvdh\DomPDF\Facade\Pdf;

class PDFController extends Controller
{
    public function show(Meters $meter)
    {
        return PDF::loadView('meters.pdf', [
            'meter' => $meter,
            'meter_extra' => $meter->meter_extra_keys()
        ])->stream();
    }
}
