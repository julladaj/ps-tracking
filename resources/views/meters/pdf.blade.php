<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>PEA Document</title>
    <link rel="apple-touch-icon" href="{{asset('images/ico/apple-icon-120.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('images/ico/favicon.ico')}}">

    <style>
        @font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: normal;
            src: url("{{ public_path('fonts/THSarabunNew.ttf') }}") format('truetype');
        }

        @font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: bold;
            src: url("{{ public_path('fonts/THSarabunNew Bold.ttf') }}") format('truetype');
        }

        @font-face {
            font-family: 'THSarabunNew';
            font-style: italic;
            font-weight: normal;
            src: url("{{ public_path('fonts/THSarabunNew Italic.ttf') }}") format('truetype');
        }

        @font-face {
            font-family: 'THSarabunNew';
            font-style: italic;
            font-weight: bold;
            src: url("{{ public_path('fonts/THSarabunNew BoldItalic.ttf') }}") format('truetype');
        }

        /** Define the margins of your page **/
        @page {
            margin: 150px 50px 50px 50px ;
        }

        header {
            position: fixed;
            top: -140px;
            left: 0px;
            right: 0px;
            height: 150px;
        }

        footer {
            position: fixed;
            bottom: -40px;
            left: 0px;
            right: 0px;
            height: 50px;
            font-size: 20px !important;

            /** Extra personal styles **/
            background-color: #008B8B;
            color: white;
            text-align: center;
            line-height: 35px;
        }

        body {
            font-family: "THSarabunNew", sans-serif;
            font-size: 14pt;
            line-height: 1em;
        }

        p {
            text-indent: 100px;
            padding: 0;
            margin-top: 0;
        }

        .page-break {
            page-break-after: always;
        }

        .red {
            color: red;
        }

        .bx-border-bottom {
            border-bottom: dotted 1px #0b0f13;
        }

        .fit-width {
            padding: 0;
            margin: 0;
            width: 1%;
            white-space: nowrap;
        }

        input {
            width: 13px;
            height: 13px;
            padding: 0;
            margin: 0;
            vertical-align: middle;
        }

        .pl-5 {
            padding-left: 5px;
        }

        .pr-5 {
            padding-right: 5px;
        }

        .pl-20 {
            padding-left: 20px;
        }

        .pr-20 {
            padding-right: 20px;
        }

        .m-0 {
            margin: 0;
        }
    </style>
</head>
<body>
<!-- Define header and footer blocks before your content -->
<header>
    <img style="width: 120px;" src="{{ public_path('images/logo/pea_logo.png') }}">
</header>

<!-- Wrap the content of your PDF inside a main tag -->
<main>
    <table border="0" cellpadding="2" cellspacing="0">
        <tr>
            <td colspan="1">จาก</td>
            <td colspan="5">ผบค.กฟอ.หางดง</td>
            <td colspan="1">ถึง</td>
            <td colspan="5">กฟอ.หางดง</td>
        </tr>
        <tr>
            <td colspan="1">เลขที่</td>
            <td colspan="5"></td>
            <td colspan="1">วันที่</td>
            <td colspan="5"></td>
        </tr>
        <tr>
            <td colspan="1">เรื่อง</td>
            <td colspan="11">ขออนุมัติขยายเขตฯ/ย้ายแนวฯ กฟอ.หางดง P3-ขย.แรงต่ำ {{ $meter->customer_name }}</td>
        </tr>
        <tr>
            <td colspan="1">เรียน</td>
            <td colspan="11">ผจก.กฟอ.หางดง</td>
        </tr>
        <tr>
            <td colspan="12">
                <p>ตามคำร้องเลขที่ {{ $meter->document_number }} ลว. {{ buddhismDate($meter->document_date) }} ขอขยายเขต/ย้ายแนวระบบไฟฟ้า กฟอ.หางดง ผบค.กฟอ.หางดง ได้ตรวจสอบ และพิจารณาแล้ว สรุปรายละเอียด และวิธีดำเนินการ ดังนี้</p>
            </td>
        </tr>
        <tr>
            <td colspan="12">
                <b>1. รายละเอียด</b>
            </td>
        </tr>
        <tr>
            <td colspan="1"></td>
            <td colspan="11">
                <table style="width: 100%;" border="0" cellpadding="2" cellspacing="0">
                    <tr>
                        <td class="fit-width">1.1 สถานที่ใช้ไฟ</td>
                        <td class="m-0 pl-20 red bx-border-bottom">{{ $meter->electric_expand->location?? '' }}</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="1"></td>
            <td colspan="11">
                <table style="width: 100%;" border="0" cellpadding="2" cellspacing="0">
                    <tr>
                        <td class="fit-width">1.2 ลักษณะการใช้พลังงานไฟฟ้า</td>
                        <td class="m-0 pl-20 red bx-border-bottom">{{ $meter->electric_expand->consumer_type?? '' }}</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="1"></td>
            <td colspan="11">
                <table style="width: 100%;" border="0" cellpadding="2" cellspacing="0">
                    <tr>
                        <td class="fit-width">1.3 สภาพภูมิประเทศ</td>
                        <td class="m-0 pl-20">
                            <input type="checkbox" {{ $meter->electric_expand->geo_id === 1? 'checked' : '' }}><label> ที่ราบปกติ</label>
                            <input type="checkbox" class="pl-20" {{ $meter->electric_expand->geo_id === 2? 'checked' : '' }}><label> ที่ลุ่มมีน้ำขัง</label>
                            <input type="checkbox" class="pl-20" {{ $meter->electric_expand->geo_id === 3? 'checked' : '' }}><label> ลำน้ำคูคลอง</label>
                            <input type="checkbox" class="pl-20" {{ $meter->electric_expand->geo_id === 4? 'checked' : '' }}><label> ภูเขา-หิน</label>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="1"></td>
            <td colspan="11">
                <table style="width: 100%;" border="0" cellpadding="2" cellspacing="0">
                    <tr>
                        <td class="fit-width">1.4 สภาพพื้นดิน</td>
                        <td class="m-0 pl-20">
                            <input type="checkbox" {{ $meter->electric_expand->env_earth_id === 1? 'checked' : '' }}><label> ดินธรรมดา</label>
                            <input type="checkbox" class="pl-20" {{ $meter->electric_expand->env_earth_id === 2? 'checked' : '' }}><label> ดินทราย</label>
                            <input type="checkbox" class="pl-20" {{ $meter->electric_expand->env_earth_id === 3? 'checked' : '' }}><label> เขาดินลูกรัง</label>
                            <input type="checkbox" class="pl-20" {{ $meter->electric_expand->env_earth_id === 4? 'checked' : '' }}><label> ภูเขา-หิน</label>
                            <input type="checkbox" class="pl-20" {{ $meter->electric_expand->env_earth_id === 5? 'checked' : '' }}><label> ดินดาน</label>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="1"></td>
            <td colspan="11">
                <span>1.5 สภาพต้นไม้ตามแนวขยายเขต หนาทึบ</span>
                <span class="m-0 pl-20 pr-20 red bx-border-bottom"> {{ $meter->electric_expand->env_tree_id === 1? $meter->electric_expand->env_tree_distant_km : '-' }} </span>
                <span>กม. ไม่หนาทึบ</span>
                <span class="m-0 pl-20 pr-20 red bx-border-bottom"> {{ $meter->electric_expand->env_tree_id === 2? $meter->electric_expand->env_tree_distant_km : '-' }} </span>
                <span>กม. ป่าสงวน</span>
                <input type="checkbox" class="pl-20" {{ $meter->electric_expand->reserved_forest_id === 1? 'checked' : '' }}><label> มี</label>
                <input type="checkbox" class="pl-20" {{ $meter->electric_expand->reserved_forest_id === 2? 'checked' : '' }}><label> ไม่มี</label>
            </td>
        </tr>
        <tr>
            <td colspan="1"></td>
            <td colspan="11">
                <span>1.6 นำรถยนต์เข้าปฏิบัติงาน</span>
                <input type="checkbox" class="pl-20"><label> สะดวก</label>
                <input type="checkbox" class="pl-20"><label> ไม่สะดวก</label>
                <span class="pl-20">สภาพชุมชน</span>
                <span class="m-0 pl-20 pr-20 red bx-border-bottom"> {{ $meter->electric_expand->env_community->description }} </span>
            </td>
        </tr>
        <tr>
            <td colspan="1"></td>
            <td colspan="11">
                <span>1.7 รับพลังงานไฟฟ้าจากหม้อแปลง พีอีเอ.</span>
                <span class="m-0 pl-5 pr-5 red bx-border-bottom"> {{ $meter->electric_expand->transformer_pea_no?? '-' }} </span>
                <span>ขนาด</span>
                <span class="m-0 pl-5 pr-5 red bx-border-bottom"> {{ $meter->electric_expand->transformer->description }} </span>
                <span>เควีเอ ระบบ</span>
                <span class="m-0 pl-5 pr-5 red bx-border-bottom"> 3 </span>
                <span>เฟส</span>
                <span class="m-0 pl-5 pr-5 red bx-border-bottom"> 22 </span>
                <span>เควี.</span>
            </td>
        </tr>
        <tr>
            <td colspan="1"></td>
            <td colspan="11">
                <span>โวลท์ จากสถานี</span>
                <span class="m-0 pl-5 pr-5 red bx-border-bottom"> {{ $meter->electric_expand->station->description?? '-' }} </span>
                <span>ฟีดเดอร์</span>
                <span class="m-0 pl-5 pr-5 red bx-border-bottom"> {{ $meter->electric_expand->feeder?? '-' }} </span>
                <span>ระยะห่างจากสถานีตามระบบจำหน่าย</span>
                <span class="m-0 pl-5 pr-5 red bx-border-bottom"> {{ $meter->electric_expand->feeder_distant_km?? '-' }} </span>
                <span>กม.</span>
            </td>
        </tr>
        <tr>
            <td colspan="12">
                <b>2. ส่วนของ กฟภ. ดำเนินการ</b>
            </td>
        </tr>
        <tr>
            <td colspan="1"></td>
            <td colspan="11">
                <span>2.1 แผนกแรงสูง ระบบ</span>
                <span class="m-0 pl-5 pr-5 red bx-border-bottom"> {{ $meter_extra['high_voltage_phase']?? 1 }} </span>
                <span>เฟส แรงดัน</span>
                <span class="m-0 pl-5 pr-5 red bx-border-bottom"> {{ $meter_extra['high_voltage']?? '-' }} </span>
                <span>เควี. ปักเสา คอร. ขนาด</span>
                <span class="m-0 pl-5 pr-5 red bx-border-bottom"> - </span>
                <span>เมตร จำนวน</span>
                <span class="m-0 pl-5 pr-5 red bx-border-bottom"> - </span>
                <span>ต้น </span>
            </td>
        </tr>
        <tr>
            <td colspan="1"></td>
            <td colspan="11">
                <span>พาดสายแรงสูงด้วยสายเคเบิ้ลอากาศ ขนาด</span>
                <span class="m-0 pl-5 pr-5 red bx-border-bottom"> - </span>
                <span>ตร.มม. ระยะทาง</span>
                <span class="m-0 pl-5 pr-5 red bx-border-bottom"> - </span>
                <span>เมตร ติดตั้งชุดบัคอาร์ม จำนวน</span>
                <span class="m-0 pl-5 pr-5 red bx-border-bottom"> - </span>
                <span>ชุด</span>
            </td>
        </tr>
        <tr>
            <td colspan="1"></td>
            <td colspan="11">
                <span>2.2 แผนกหม้อแปลง ติดตั้งหม้อแปลง ขนาด</span>
                <span class="m-0 pl-5 pr-5 red bx-border-bottom"> - </span>
                <span>เควีเอ. ระบบ</span>
                <span class="m-0 pl-5 pr-5 red bx-border-bottom"> - </span>
                <span>เฟส จำนวน</span>
                <span class="m-0 pl-5 pr-5 red bx-border-bottom"> - </span>
                <span>เครื่อง</span>
            </td>
        </tr>
        <tr>
            <td colspan="1"></td>
            <td colspan="11">
                <span>2.3 แผนกแรงต่ำ ปักเสา คอร. ขนาด</span>
                <span class="m-0 pl-5 pr-5 red bx-border-bottom"> - </span>
                <span>เมตร จำนวน</span>
                <span class="m-0 pl-5 pr-5 red bx-border-bottom"> - </span>
                <span>ต้น พาดสายอลูมิเนียมหุ้มฉนวน ขนาด</span>
                <span class="m-0 pl-5 pr-5 red bx-border-bottom"> - </span>
                <span>ตร.มม.</span>
            </td>
        </tr>
        <tr>
            <td colspan="1"></td>
            <td colspan="11">
                <span>ระบบ</span>
                <span class="m-0 pl-5 pr-5 red bx-border-bottom"> - </span>
                <span>เฟส</span>
                <span class="m-0 pl-5 pr-5 red bx-border-bottom"> - </span>
                <span>สาย ระยะทางประมาณ</span>
                <span class="m-0 pl-5 pr-5 red bx-border-bottom"> - </span>
                <span>เมตร</span>
            </td>
        </tr>
        <tr>
            <td colspan="1"></td>
            <td colspan="11">
                <span>2.4 แผนกมิเตอร์ ติดตั้งมิเตอร์ขนาด</span>
                <span class="m-0 pl-5 pr-5 red bx-border-bottom"> - </span>
                <span>แอมป์</span>
                <span class="m-0 pl-5 pr-5 red bx-border-bottom"> - </span>
                <span>เฟส ประกอบซีที.แรงต่ำ</span>
                <span class="m-0 pl-5 pr-5 red bx-border-bottom"> - </span>
                <span>ขนาด</span>
                <span class="m-0 pl-5 pr-5 red bx-border-bottom"> - </span>
                <span>โวลท์</span>
            </td>
        </tr>
        <tr>
            <td colspan="1"></td>
            <td colspan="11">
                <span class="m-0 pl-5 pr-5 red bx-border-bottom"> - </span>
                <span>แอมป์ จำนวน</span>
                <span class="m-0 pl-5 pr-5 red bx-border-bottom"> - </span>
                <span>เครื่อง</span>
            </td>
        </tr>
        <tr>
            <td colspan="1"></td>
            <td colspan="11">
                <span>2.5 แผนกไฟสาธารณะ พาดสายอลูมิเนียมหุ้มฉนวน ขนาด</span>
                <span class="m-0 pl-5 pr-5 red bx-border-bottom"> {{ $meter_extra['public_light_cable_size']?? '-' }} </span>
                <span>ตร.มม. ระยะทางประมาณ</span>
                <span class="m-0 pl-5 pr-5 red bx-border-bottom"> {{ $meter_extra['public_light_cable_length']?? '-' }} </span>
                <span>เมตร</span>
            </td>
        </tr>
        <tr>
            <td colspan="1"></td>
            <td colspan="11">
                <span>ติดตั้ง ชุดโคมไฟ ขนาด</span>
                <span class="m-0 pl-5 pr-5 red bx-border-bottom"> {{ $meter_extra['public_light_lamp_size']?? '-' }} </span>
                <span>วัตต์</span>
                <span>จำนวน</span>
                <span class="m-0 pl-5 pr-5 red bx-border-bottom"> {{ $meter_extra['public_light_lamp_quantity']?? '-' }} </span>
                <span>ชุด สวิทช์ควบคุม จำนวน</span>
                <span class="m-0 pl-5 pr-5 red bx-border-bottom"> {{ $meter_extra['public_light_lamp_switch_quantity']?? '-' }} </span>
                <span>ชุด</span>
            </td>
        </tr>
    </table>
</main>
</body>
</html>