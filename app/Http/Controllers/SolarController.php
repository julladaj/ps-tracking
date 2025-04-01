<?php

namespace App\Http\Controllers;

use App\Models\Amphure;
use App\Models\District;
use App\Models\Province;
use DateTime;
use DateTimeZone;
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
        $datetime = new DateTime('now', new DateTimeZone('Asia/Bangkok'));

        $now = $datetime->format("F j, Y, G:i");
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

        // https://developers.line.biz/console/channel/2006578353/messaging-api
        $token = <<<TOKEN
LXD5D9D9JlMM0qf/yfciJ6nukQbn4L6F1JoGFscKXHLYuh4X/wusqil7qNl7aKH7+jPV3YRSExrb50J5YqG2vVLaJkaAakpCqLeELcjwmkqZ9S6CrpPLTkT+LXqiD1wLMK1ycRDkWEIbEvoGSuCgTgdB04t89/1O/w1cDnyilFU=
TOKEN;

        // Checking from "line-log.txt"
        $groupId = 'C0571d8e5425bf052811bda3e2065cf7e';

        // Build data structure as array
        $dataStructure = [
            "to" => $groupId,
            "messages" => [
                [
                    "type" => "text",
                    "text" => $message,
                ]
            ]
        ];

        // Convert to JSON safely
        $json = json_encode($dataStructure, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

        $command = <<<EOD
curl -v -X POST https://api.line.me/v2/bot/message/push \
-H 'Content-Type: application/json' \
-H 'Authorization: Bearer {$token}' \
-d '{$json}'
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

    public function lineCallback(Request $request)
    {
        file_put_contents('line-log.txt', sprintf(
            "\n\n%s:%s\n%s:%s",
            __FILE__,
            __LINE__,
            '$request->all()',
            var_export($request->all(), true)
        ));

        return response()->json([
            'status' => 'success',
        ]);
    }
}
