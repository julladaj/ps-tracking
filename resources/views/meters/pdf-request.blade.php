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
            margin: 50px 50px 50px 50px ;
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

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        input {
            width: 13px;
            height: 13px;
            padding: 0;
            margin: 0;
            vertical-align: middle;
        }

        table {
            width: 100%;
        }

        .table_price {
            line-height: 1;
            border-collapse: collapse;
            border-spacing: 0;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .table_price td, .table_price th {
            padding: 0 5px;
            /*padding: 0;*/
            margin: 0;
            font-size: 12pt;
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
<!-- Wrap the content of your PDF inside a main tag -->
<main>
    <img style="width: 120px;" src="{{ public_path('images/logo/pea_logo.png') }}">
    <script type="text/php">
    if ( isset($pdf) ) {
        $w = $pdf->get_width();
        $h = $pdf->get_height();

        $size = 14;
        $color = array(0,0,0);
        $font = $fontMetrics->getFont("THSarabunNew");
        $font_bold = $fontMetrics->getFont("THSarabunNew", "bold");
        $text_height = $fontMetrics->getFontHeight($font, $size);
        $y = $h - 2 * $text_height - 24;

        $pdf->text(480, $y, "/3. ส่วนของผู้ใช้ไฟ...", $font, $size, $color);
    }

    </script>

    <table border="0" cellpadding="2" cellspacing="0" style="table-layout: fixed;">
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
    </table>

    <table border="0" cellpadding="2" cellspacing="0" style="table-layout: fixed; page-break-inside: avoid;">
        <tr>
            <td colspan="12">
                <b>2. ส่วนของ กฟภ. ดำเนินการ</b>
            </td>
        </tr>
        @php($high_voltage_pole = $meter->meter_extra_groups('high_voltage_pole'))
        @php($high_voltage_cable = $meter->meter_extra_groups('high_voltage_cable'))
        @php($topic_index = 0)
        @if($high_voltage_pole->count() || $high_voltage_cable->count())
            <tr>
                <td colspan="1"></td>
                <td colspan="11">
                    <span>2.{{ ++$topic_index }} แผนกแรงสูง ระบบ</span>
                    <span class="m-0 pl-5 pr-5 red bx-border-bottom"> {{ $meter_extra['high_voltage_phase']?? '-' }} </span>
                    <span>เฟส แรงดัน</span>
                    <span class="m-0 pl-5 pr-5 red bx-border-bottom"> {{ $meter_extra['high_voltage']?? '-' }} </span>
                    <span>เควี.</span>
                    @if(!empty($high_voltage_pole))
                        @foreach($high_voltage_pole as $data)
                            <span>{{ $data['job_type']?? '' }} คอร. ขนาด</span>
                            <span class="m-0 pl-5 pr-5 red bx-border-bottom"> {{ $data['core_size']?? '-' }} </span>
                            <span>เมตร จำนวน</span>
                            <span class="m-0 pl-5 pr-5 red bx-border-bottom"> {{ $data['quantity']?? '-' }} </span>
                            <span>ต้น</span>
                        @endforeach
                    @endif
                    @if(!empty($high_voltage_cable))
                        @foreach($high_voltage_cable as $data)
                            <span> {{ $data['job_type']?? '' }}สายแรงสูงด้วยสาย</span>
                            <span class="m-0 pl-5 pr-5 red bx-border-bottom"> {{ $data['cable_type']?? '-' }} </span>
                            <span>ขนาด</span>
                            <span class="m-0 pl-5 pr-5 red bx-border-bottom"> {{ $data['cable_size']?? '-' }} </span>
                            <span>ตร.มม. ระยะทาง</span>
                            <span class="m-0 pl-5 pr-5 red bx-border-bottom"> {{ $data['length']?? '-' }} </span>
                            <span>เมตร</span>
                        @endforeach
                    @endif
                    <span> ติดตั้งชุดบัคอาร์ม จำนวน</span>
                    <span class="m-0 pl-5 pr-5 red bx-border-bottom"> {{ $meter_extra['buc_arm']?? '-' }} </span>
                    <span>ชุด</span>
                </td>
            </tr>
        @endif

        @php($transformer = $meter->meter_extra_groups('transformer'))
        @if($transformer->count())
            <tr>
                <td colspan="1"></td>
                <td colspan="11">
                    <span>2.{{ ++$topic_index }} แผนกหม้อแปลง</span>
                    @foreach($transformer as $data)
                        <span>{{ $data['job_type']?? '' }}หม้อแปลง ขนาด</span>
                        <span class="m-0 pl-5 pr-5 red bx-border-bottom"> {{ $data['transformer_size']?? '-' }} </span>
                        <span>เควีเอ. ระบบ</span>
                        <span class="m-0 pl-5 pr-5 red bx-border-bottom"> {{ $data['phase']?? '-' }} </span>
                        <span>เฟส จำนวน</span>
                        <span class="m-0 pl-5 pr-5 red bx-border-bottom"> {{ $data['quantity']?? '-' }} </span>
                        <span>เครื่อง</span>
                    @endforeach
                </td>
            </tr>
        @endif

        @php($low_voltage_pole = $meter->meter_extra_groups('low_voltage_pole'))
        @php($low_voltage_cable = $meter->meter_extra_groups('low_voltage_cable'))
        @if($low_voltage_pole->count() || $low_voltage_cable->count())
            <tr>
                <td colspan="1"></td>
                <td colspan="11">
                    <span>2.{{ ++$topic_index }} แผนกแรงต่ำ</span>
                    @if(!empty($low_voltage_pole))
                        @foreach($low_voltage_pole as $data)
                            <span>{{ $data['job_type']?? '' }} คอร. ขนาด</span>
                            <span class="m-0 pl-5 pr-5 red bx-border-bottom"> {{ $data['cord_size']?? '-' }} </span>
                            <span>เมตร จำนวน</span>
                            <span class="m-0 pl-5 pr-5 red bx-border-bottom"> {{ $data['quantity']?? '-' }} </span>
                            <span>ต้น</span>
                        @endforeach
                    @endif
                    @if(!empty($low_voltage_cable))
                        @foreach($low_voltage_cable as $data)
                            <span>{{ $data['job_type']?? '' }}สายอลูมิเนียม{{ $data['cable_type']?? '' }}</span>
                            <span class="m-0 pl-5 pr-5 red bx-border-bottom"> {{ $data['cable_type']?? '-' }} </span>
                            <span>ขนาด</span>
                            <span class="m-0 pl-5 pr-5 red bx-border-bottom"> {{ $data['cord_size']?? '-' }} </span>
                            <span>ตร.มม. ระบบ</span>
                            <span class="m-0 pl-5 pr-5 red bx-border-bottom"> {{ $data['phase']?? '-' }} </span>
                            <span>เฟส สาย ระยะทางประมาณ</span>
                            <span class="m-0 pl-5 pr-5 red bx-border-bottom"> {{ $data['cable_length']?? '-' }} </span>
                            <span>เมตร</span>
                        @endforeach
                    @endif

                </td>
            </tr>
        @endif

        @php($meter_extra_groups = $meter->meter_extra_groups('meter'))
        @if($meter_extra_groups->count())
            <tr>
                <td colspan="1"></td>
                <td colspan="11">
                    <span>2.{{ ++$topic_index }} แผนกมิเตอร์</span>
                    @foreach($meter_extra_groups as $data)
                        <span>ติดตั้งมิเตอร์ขนาด</span>
                        <span class="m-0 pl-5 pr-5 red bx-border-bottom"> {{ $data['meter_size']?? '-' }} </span>
                        <span>แอมป์</span>
                        <span class="m-0 pl-5 pr-5 red bx-border-bottom"> {{ $data['phase']?? '-' }} </span>
                        <span>เฟส ประกอบ</span>
                        <span class="m-0 pl-5 pr-5 red bx-border-bottom"> {{ $data['job_type']?? '-' }} </span>
                        <span>ขนาด</span>
                        <span class="m-0 pl-5 pr-5 red bx-border-bottom"> {{ $data['meter_volt']?? '-' }} </span>
                        <span>โวลท์</span>
                        <span class="m-0 pl-5 pr-5 red bx-border-bottom"> {{ $data['meter_amp']?? '-' }} </span>
                        <span>แอมป์ จำนวน</span>
                        <span class="m-0 pl-5 pr-5 red bx-border-bottom"> {{ $data['quantity']?? '-' }} </span>
                        <span>เครื่อง</span>
                    @endforeach
                </td>
            </tr>
        @endif

        @isset($meter_extra['public_light_cable_type'])
            <tr>
                <td colspan="1"></td>
                <td colspan="11">
                    <span>2.{{ ++$topic_index }} แผนกไฟสาธารณะ</span>
                    <span>{{ $meter_extra['public_light_cable_type'] }}อลูมิเนียมหุ้มฉนวน ขนาด</span>
                    <span class="m-0 pl-5 pr-5 red bx-border-bottom"> {{ $meter_extra['public_light_cable_size']?? '-' }} </span>
                    <span>ตร.มม. ระยะทางประมาณ</span>
                    <span class="m-0 pl-5 pr-5 red bx-border-bottom"> {{ $meter_extra['public_light_cable_length']?? '-' }} </span>
                    <span>เมตร </span>
                    @if($meter_extra['public_light_lamp_type'])
                        <span>{{ $meter_extra['public_light_lamp_type'] }} ชุดโคมไฟ ขนาด</span>
                        <span class="m-0 pl-5 pr-5 red bx-border-bottom"> {{ $meter_extra['public_light_lamp_size']?? '-' }} </span>
                        <span>วัตต์ จำนวน</span>
                        <span class="m-0 pl-5 pr-5 red bx-border-bottom"> {{ $meter_extra['public_light_lamp_quantity']?? '-' }} </span>
                        <span>ชุด สวิทช์ควบคุม จำนวน</span>
                        <span class="m-0 pl-5 pr-5 red bx-border-bottom"> {{ $meter_extra['public_light_lamp_switch_quantity']?? '-' }} </span>
                        <span>ชุด</span>
                    @endif
                </td>
            </tr>
        @endisset

    </table>

    <table border="0" cellpadding="2" cellspacing="0" style="table-layout: fixed; page-break-inside: avoid;">
        <tr>
            <td colspan="12">
                <b>3. ส่วนของผู้ใช้ไฟดำเนินการเอง</b>
            </td>
        </tr>
        <tr>
            <td colspan="1"></td>
            <td colspan="11">
                <span>3.1 แผนกแรงสูง ระบบ</span>
                <span class="m-0 pl-5 pr-5 red bx-border-bottom"> - </span>
                <span>เฟส แรงดัน</span>
                <span class="m-0 pl-5 pr-5 red bx-border-bottom"> - </span>
                <span>เควี. ปักเสา คอร. ขนาด</span>
                <span class="m-0 pl-5 pr-5 red bx-border-bottom"> - </span>
                <span>เมตร จำนวน</span>
                <span class="m-0 pl-5 pr-5 red bx-border-bottom"> - </span>
                <span>ต้น</span>
            </td>
        </tr>
        <tr>
            <td colspan="1"></td>
            <td colspan="11">
                <span>พาดสายแรงสูง ด้วยสาย</span>
                <span class="m-0 pl-5 pr-5 red bx-border-bottom"> - </span>
                <span>ขนาด</span>
                <span class="m-0 pl-5 pr-5 red bx-border-bottom"> - </span>
                <span>ตร. มม. ระยะทาง</span>
                <span class="m-0 pl-5 pr-5 red bx-border-bottom"> - </span>
                <span>เมตร</span>
            </td>
        </tr>
        <tr>
            <td colspan="1"></td>
            <td colspan="11">
                <span>3.2 แผนกหม้อแปลงติดตั้งใหม่</span>
                <span class="m-0 pl-5 pr-5 red bx-border-bottom"> - </span>
                <span>เควีเอ. ระบบ</span>
                <span class="m-0 pl-5 pr-5 red bx-border-bottom"> - </span>
                <span>เฟส จำนวน</span>
                <span class="m-0 pl-5 pr-5 red bx-border-bottom"> - </span>
                <span>เครื่อง</span>
            </td>
        </tr>
    </table>

    {{--    <script type="text/php">--}}
    {{--    if ( isset($pdf) ) {--}}
    {{--        $w = $pdf->get_width();--}}
    {{--        $h = $pdf->get_height();--}}

    {{--        $size = 14;--}}
    {{--        $color = array(0,0,0);--}}
    {{--        $font = $fontMetrics->getFont("THSarabunNew");--}}
    {{--        $font_bold = $fontMetrics->getFont("THSarabunNew", "bold");--}}
    {{--        $text_height = $fontMetrics->getFontHeight($font, $size);--}}
    {{--        $y = $h - 2 * $text_height - 24;--}}

    {{--        $pdf->text(500, $y, "/5. ทรัพย์สิน...", $font, $size, $color);--}}
    {{--    }--}}
    {{--    </script>--}}

    <table border="1" cellpadding="0" cellspacing="0" class="table_price" style="page-break-inside: avoid;">
        <thead>
        <tr>
            <th>ชื่อประเภทงาน</th>
            <th class="text-right">กฟภ. ลงทุน (บาท)</th>
            <th class="text-right">ทำการ (บาท)</th>
            <th class="text-right">ผู้ใช้ไฟ (บาท)</th>
            <th class="text-right">รวมทั้งสิ้น (บาท)</th>
        </tr>
        </thead>
        <tbody>
        @php($i = 1)
        @php($vat_rate = 7)
        @php($sum_net_pea_invest = 0)
        @php($sum_net_action = 0)
        @php($sum_net_customer = 0)
        @php($sum_net_summary = 0)
        @php($payment_manual_net_pea_invest = ($meter_extra['payment_manual_pea_invest_'.$i]?? 0))
        @php($payment_manual_net_action = ($meter_extra['payment_manual_action_'.$i]?? 0))
        @php($payment_manual_net_customer = ($meter_extra['payment_manual_customer_'.$i]?? 0))
        @if($payment_manual_net_summary = ($payment_manual_net_pea_invest + $payment_manual_net_action + $payment_manual_net_customer))
            <tr>
                <td><span>ค่าสมทบก่อสร้างและปรับปรุงระบบจำหน่าย</span><br>(<span
                            class="m-0 pl-5 pr-5 red bx-border-bottom">@if ($payment_manual_pea_invest_kva = ($meter_extra['payment_manual_pea_invest_kva_'.$i]?? 0)) {{ number_format($payment_manual_pea_invest_kva, 2) }} @endif</span>kVA. X <span
                            class="m-0 pl-5 pr-5 red bx-border-bottom">@if ($payment_manual_pea_invest_baht = ($meter_extra['payment_manual_pea_invest_baht_'.$i]?? 0)) {{ number_format($payment_manual_pea_invest_baht, 2) }} @endif</span>บาท/kVA.)
                </td>
                <td class="text-right">@if ($payment_manual_net_pea_invest) {{ number_format($payment_manual_net_pea_invest, 2) }} @endif</td>
                <td class="text-right">@if ($payment_manual_net_action) {{ number_format($payment_manual_net_action, 2) }} @endif</td>
                <td class="text-right">@if ($payment_manual_net_customer) {{ number_format($payment_manual_net_customer, 2) }} @endif</td>
                <td class="text-right">@if ($payment_manual_net_summary) {{ number_format($payment_manual_net_summary, 2) }} @endif</td>
            </tr>
        @endif
        @php($sum_net_pea_invest += $payment_manual_net_pea_invest)
        @php($sum_net_action += $payment_manual_net_action)
        @php($sum_net_customer += $payment_manual_net_customer)
        @php($sum_net_summary += $payment_manual_net_summary)
        @php($i++)

        @foreach(__('payment_type') as $row)
            @php($payment_manual_net_pea_invest = ($meter_extra['payment_manual_pea_invest_'.$i]?? 0))
            @php($payment_manual_net_action = ($meter_extra['payment_manual_action_'.$i]?? 0))
            @php($payment_manual_net_customer = ($meter_extra['payment_manual_customer_'.$i]?? 0))
            @if($payment_manual_net_summary = ($payment_manual_net_pea_invest + $payment_manual_net_action + $payment_manual_net_customer))
                <tr>
                    <td>{!! $row !!}</td>
                    <td class="text-right">@if ($payment_manual_net_pea_invest) {{ number_format($payment_manual_net_pea_invest, 2) }} @endif</td>
                    <td class="text-right">@if ($payment_manual_net_action) {{ number_format($payment_manual_net_action, 2) }} @endif</td>
                    <td class="text-right">@if ($payment_manual_net_customer) {{ number_format($payment_manual_net_customer, 2) }} @endif</td>
                    <td class="text-right">@if ($payment_manual_net_summary) {{ number_format($payment_manual_net_summary, 2) }} @endif</td>
                </tr>
            @endif

            @php($sum_net_pea_invest += $payment_manual_net_pea_invest)
            @php($sum_net_action += $payment_manual_net_action)
            @php($sum_net_customer += $payment_manual_net_customer)
            @php($sum_net_summary += $payment_manual_net_summary)
            @php($i++)
        @endforeach
        <tr style="font-weight: bold;">
            <td>รวมเงินลงทุนทั้งหมด</td>
            <td class="text-right">{{ number_format($sum_net_pea_invest, 2) }}</td>
            <td class="text-right">{{ number_format($sum_net_action, 2) }}</td>
            <td class="text-right">{{ number_format($sum_net_customer, 2) }}</td>
            <td class="text-right">{{ number_format($sum_net_summary, 2) }}</td>
        </tr>
        <tr style="font-weight: bold;">
            <td>ภาษีมูลค่าเพิ่ม {{ $vat_rate }}%</td>
            <td class="text-right">{{ number_format($tax_net_pea_invest = $sum_net_pea_invest * $vat_rate / 100, 2) }}</td>
            <td class="text-right">{{ number_format($tax_net_action = $sum_net_action * $vat_rate / 100, 2) }}</td>
            <td class="text-right">{{ number_format($tax_net_customer = $sum_net_customer * $vat_rate / 100, 2) }}</td>
            <td class="text-right">{{ number_format($tax_net_summary = $sum_net_summary * $vat_rate / 100, 2) }}</td>
        </tr>
        <tr style="font-weight: bold;">
            <td>รวมเป็นเงินทั้งสิ้น (รวมภาษีมูลค่าเพิ่มแล้ว)</td>
            <td class="text-right">{{ number_format($sum_net_pea_invest + $tax_net_pea_invest, 2) }}</td>
            <td class="text-right">{{ number_format($sum_net_action + $tax_net_action, 2) }}</td>
            <td class="text-right">{{ number_format($sum_net_customer + $tax_net_customer, 2) }}</td>
            <td class="text-right">{{ number_format($sum_net_summary + $tax_net_summary, 2) }}</td>
        </tr>
        </tbody>
    </table>

    <table border="0" cellpadding="2" cellspacing="0" style="table-layout: fixed;">
        <tr>
            <td colspan="12">
                <p>
                    <span>ในการดำเนินการดังกล่าว ให้เรียกเก็บเงินจาก</span>
                    <span class="m-0 pl-5 pr-5 red bx-border-bottom"> ผชฟ. </span>
                    <span>เป็นจำนวนเงิน</span>
                    <span class="m-0 pl-5 pr-5 red bx-border-bottom">{{ number_format($sum_net_summary + $tax_net_summary, 2) }}</span>
                    <span>บาท กำหนดยืนราคาภายใน</span>
                    <span class="m-0 pl-5 pr-5 red bx-border-bottom"> 3 </span>
                    <span>เดือน ส่วนค่าธรรมเนียมต่างๆ ให้เรียกเก็บตามระเบียบ กฟภ.</span>
                </p>
                <p>
                    <span>ผู้ใช้ไฟได้</span>
                    <span class="m-0 pl-5 pr-5 red bx-border-bottom">ชำระ{{ $meter_extra['customer_payment_type']?? 'ค่าตรวจสอบแบบและแผนผัง' }}</span>
                    <span>ตามคำสั่งที่ {{ $meter->document_number }} ลว. {{ buddhismDate($meter->document_date) }} เป็นเงิน</span>
                    <span class="m-0 pl-5 pr-5 red bx-border-bottom"> - </span>
                    <span>บาท <b>(ใบเสร็จรับเงินเลขที่</b></span>
                    <span class="m-0 pl-5 pr-5 red bx-border-bottom"> - </span>
                    <span><b>)</b></span>
                </p>
                <p>
                    <span>ดังนั้น ขอให้ผู้ใช้ไฟจะต้องชำระค่าใช้จ่ายในการดำเนินการตามข้อ <b>4</b> คงเหลือเป็นเงิน</span>
                    <span class="m-0 pl-5 pr-5 red bx-border-bottom"> 5,718.76 </span>
                    <span>บาท <b>(</b></span>
                    <span class="m-0 pl-5 pr-5 red bx-border-bottom"> - </span>
                    <span><b>)</b> (รวมภาษีมูลค่าเพิ่มแล้ว)</span>
                </p>
            </td>
        </tr>
    </table>

    <table border="0" cellpadding="2" cellspacing="0" style="table-layout: fixed; page-break-inside: avoid;">
        <tr>
            <td colspan="12">
                <b>5. ทรัพย์สิน</b>
            </td>
        </tr>
        <tr>
            <td colspan="12">
                <p>
                    <span>เมื่อดำเนินการแล้วเสร็จ ระบบไฟฟ้าในที่สาธารณะและเครื่องวัดพร้อมอุปกรณ์ประกอบเป็นทรัพย์สินของ กฟภ. ยกเว้น สายดับ กิ่งโคมไฟ และ/หรือระบบไฟฟ้าในเขตที่ดินของผู้ใช้ไฟ เป็นทรัพย์สินของผู้ใช้ไฟ</span>
                </p>
                <p style="padding-bottom: 80px;">
                    <span>จึงเรียนมาเพื่อโปรดพิจารณาอนุมัติ พร้อมนี้ได้แนบแผนผังเลขที่</span>
                    <span class="m-0 pl-5 pr-5 red bx-border-bottom"> PB30 017/650038 </span>
                    <span>จำนวน</span>
                    <span class="m-0 pl-5 pr-5 red bx-border-bottom"> 1 </span>
                    <span>แผ่น ประมาณการค่าใช้จ่ายหน้างาน และเรื่องเดิมมาเพื่อประกอบการพิจารณาด้วยแล้ว</span>
                </p>
            </td>
        </tr>
        <tr>
            <td colspan="2">@if($request_approval_user = $meter->request_approval_user) <b>ผู้เสนอขออนุมัติ</b> @endif</td>
            <td colspan="3" class="text-center">@if($request_approval_user) ({{ $request_approval_user->name }}) @endif</td>
            <td></td>
            <td colspan="2">@if($approval_user = $meter->approval_user) <b>ผู้อนุมัติ</b> @endif</td>
            <td colspan="3" class="text-center">@if($approval_user) ({{ $approval_user->name }}) @endif</td>
            <td></td>
        </tr>
        <tr>
            <td colspan="2"></td>
            <td colspan="3" class="text-center">@if($request_approval_user) {{ $request_approval_user->job_title }} @endif</td>
            <td></td>
            <td colspan="2"></td>
            <td colspan="3" class="text-center">@if($approval_user) {{ $approval_user->job_title }} @endif</td>
            <td></td>
        </tr>
        <tr>
            <td colspan="2"></td>
            <td colspan="3" class="text-center">@if($request_approval_user) {{ $request_approval_user->position }} @endif</td>
            <td></td>
            <td colspan="2"></td>
            <td colspan="3" class="text-center">@if($approval_user) {{ $approval_user->position }} @endif</td>
            <td></td>
        </tr>
    </table>

</main>
</body>
</html>