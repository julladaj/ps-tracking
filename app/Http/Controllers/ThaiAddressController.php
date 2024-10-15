<?php

namespace App\Http\Controllers;

use App\Models\Amphure;
use App\Models\District;
use App\Models\Geography;
use App\Models\Province;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ThaiAddressController extends Controller
{
    public function provinces(Request $request): JsonResponse
    {
        $provinces = Province::query();

        $geographyId = $request->get('geography_id');
        if ($geographyId) {
            $provinces->where('geography_id', $geographyId);
        }

        return response()->json($provinces->get());
    }

    public function amphures(Request $request): JsonResponse
    {
        $amphures = Amphure::query();

        $provinceId = $request->get('province_id');
        if ($provinceId) {
            $amphures->where('province_id', $provinceId);
        }

        return response()->json($amphures->get());
    }

    public function districts(Request $request): JsonResponse
    {
        $districts = District::query();

        $amphureId = $request->get('amphure_id');
        if ($amphureId) {
            $districts->where('amphure_id', $amphureId);
        }

        return response()->json($districts->get());
    }

    public function geographies(Request $request): JsonResponse
    {
        return response()->json(Geography::all());
    }
}
