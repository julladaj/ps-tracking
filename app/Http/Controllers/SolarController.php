<?php

namespace App\Http\Controllers;

use App\Models\Amphure;
use App\Models\District;
use App\Models\Province;
use Illuminate\Http\Request;

class SolarController extends Controller
{
    public function index()
    {
        $pageConfigs = ['bodyCustomClass' => 'bg-full-screen-image'];
        $provinces = Province::where('geography_id', 1)->get();

        return view('meters.solar', [
            'pageConfigs' => $pageConfigs,
            'provinces' => $provinces,
        ]);
    }

    public function lineNotify(Request $request)
    {
        $now = date("F j, Y, G:i");
        $name = $request->get('name', '');

        $fullAddress = [];
        $fullAddress[] = $request->get('address', '');

        if ($districtId = $request->get('district_id')) {
            $district = District::findOrFail($districtId);
            $fullAddress[] = 'ต.' . $district->name_th;
        }

        if ($amphureId = $request->get('amphure_id')) {
            $amphure = Amphure::findOrFail($amphureId);
            $fullAddress[] = 'อ.' . $amphure->name_th;
        }

        if ($provinceId = $request->get('province_id')) {
            $province = Province::findOrFail($provinceId);
            $fullAddress[] = $province->name_th;
        }

        if ($postcode = $request->get('postcode')) {
            $fullAddress[] = $postcode;
        }

        $address = implode(', ', $fullAddress);
        $telephone = $request->get('telephone', '');
        $description = $request->get('description', '');

        $availableList = [];
        if ($request->get('available_morning')) {
            $availableList[] = 'ช่วงเช้า (9:00 - 12:00 น.)';
        }
        if ($request->get('available_midday')) {
            $availableList[] = 'ช่วงกลางวัน (13:00 - 16:00 น.)';
        }
        if ($request->get('available_evening')) {
            $availableList[] = 'ช่วงเย็น (16:00 - 19:00 น.)';
        }
        $available = implode(', ', $availableList);

        $message = <<<TXT
PEA Solar support:     
    วันที่ลงทะเบียน: 
    {$now}
    
    👤 ชื่อลูกค้า: 
    {$name}
    
    🏠 สถานที่ติดตั้ง: 
    {$address}
    
    📱 เบอร์ติดต่อ: 
    {$telephone}
    
    ⏰ เวลาที่สะดวกให้ติดต่อกลับ: 
    {$available}
    
    📝 รายละเอียด: 
    {$description}
    
    👇 ดูรายละเอียดเพิ่มเติม: 
    https://peasolar.pea.co.th/nocodb/
TXT;

        $line_token = 'I4gZOMPtRlpNfmGupBPVDUMAJLyU7b4efs8guSztPvK';

        $command = <<<EOD
curl -X POST -H 'Authorization: Bearer {$line_token}' -F 'message={$message}' https://notify-api.line.me/api/notify
EOD;

        exec($command, $result);

        if (!$result) {
            return redirect()->back()->withErrors('Sending the LINE notification failed!');
        }

        $pageConfigs = ['bodyCustomClass' => 'bg-full-screen-image'];
        return view('meters.solar-line-notify', [
            'pageConfigs' => $pageConfigs,
        ]);
    }
}
