<?php

use App\Http\Controllers\LanguageController;
use App\Http\Controllers\SolarController;
use App\Http\Controllers\ThaiAddressController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;

// Authentication  Route
Route::group(['prefix' => 'auth'], function () {
    Route::get('login', [AuthenticationController::class, 'loginPage'])->name('auth-login');
    Route::post('login', [AuthenticationController::class, 'login'])->name('post-login');
    Route::get('register', [AuthenticationController::class, 'registerPage'])->name('auth-register');
    Route::post('register', [AuthenticationController::class, 'register'])->name('post-register');
    Route::get('forgot-password', [AuthenticationController::class, 'forgetPasswordPage'])->name(
        'auth-forgot-password'
    );
    Route::get('reset-password', [AuthenticationController::class, 'resetPasswordPage'])->name('auth-reset-password');
    Route::post('reset-password', [AuthenticationController::class, 'resetPassword'])->name('post-reset-password');
    Route::get('lock-screen', [AuthenticationController::class, 'authLockPage'])->name('auth-lock-screen');
});

// locale Route
Route::get('lang/{locale}', [LanguageController::class, 'swap'])->name('lang-locale');

Route::get('solar', [SolarController::class, 'index'])->name('solar.index');
Route::post('solar/line-notify', [SolarController::class, 'lineNotify'])->name('solar.line-notify');
Route::post('line', [SolarController::class, 'lineCallback'])->name('line-callback');

Route::get('provinces', [ThaiAddressController::class, 'provinces'])->name('thai-address.provinces');
Route::get('amphures', [ThaiAddressController::class, 'amphures'])->name('thai-address.amphures');
Route::get('districts', [ThaiAddressController::class, 'districts'])->name('thai-address.districts');
Route::get('geographies', [ThaiAddressController::class, 'geographies'])->name('thai-address.geographies');

Route::get('test-line-77468547', function () {
    $token = <<<TOKEN
LXD5D9D9JlMM0qf/yfciJ6nukQbn4L6F1JoGFscKXHLYuh4X/wusqil7qNl7aKH7+jPV3YRSExrb50J5YqG2vVLaJkaAakpCqLeELcjwmkqZ9S6CrpPLTkT+LXqiD1wLMK1ycRDkWEIbEvoGSuCgTgdB04t89/1O/w1cDnyilFU=
TOKEN;

    $groupId = 'C0571d8e5425bf052811bda3e2065cf7e';

    $message = <<<TXT
PEA Solar support:
วันที่ลงทะเบียน:
April 1, 2025, 8:17

👤 ชื่อลูกค้า:
ศุภชัย พันติ

🏠 สถานที่ติดตั้ง:
130/1 หมู่ 9, ต.สันทรายหลวง, อ.สันทราย, เชียงใหม่, 50210

📱 เบอร์ติดต่อ:
0812345678

⏰ เวลาที่สะดวกให้ติดต่อกลับ:
ช่วงเช้า (9:00 - 12:00 น.)

📝 รายละเอียด:
ทดสอบระบบแจ้งเตือน

👇 ดูรายละเอียดเพิ่มเติม: 
https://peasolar.pea.co.th/nocodb/
TXT;

    // Build data structure as array
    $data = [
        "to" => $groupId,
        "messages" => [
            [
                "type" => "text",
                "text" => $message,
            ]
        ]
    ];

    // Convert to JSON safely
    $json = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

    $command = <<<EOD
curl -v -X POST https://api.line.me/v2/bot/message/push \
-H 'Content-Type: application/json' \
-H 'Authorization: Bearer {$token}' \
-d '{$json}'
EOD;

    exec($command, $result);
    dd($result);
});
