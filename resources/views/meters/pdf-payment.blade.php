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
            size: A4;
            margin: 1.5cm 2cm 1.5cm 3cm;
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
            font-size: 16pt;
            line-height: 1em;
        }

        p {
            text-indent: 2.5cm;
            padding: 0;
            margin-top: 0;
            word-break: break-all;
            word-wrap: anywhere;
        }

        .page-break {
            page-break-after: always;
        }

        .red {
            /*color: red;*/
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
            table-layout: fixed;
        }

        .table_price {
            line-height: 1;
            border-collapse: collapse;
            border-spacing: 0;
            margin-top: 20px;
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

        .p-0 {
            margin: 0;
        }
    </style>
</head>
<body>
<!-- Define header and footer blocks before your content -->
<!-- Wrap the content of your PDF inside a main tag -->
<main>
    <img style="width: 140px;" src="{{ public_path('images/logo/pea_logo.svg') }}">

{{--    <script type="text/php">--}}
{{--    if ( isset($pdf) ) {--}}
{{--        $w = $pdf->get_width();--}}
{{--        $h = $pdf->get_height();--}}

{{--        $size = 14;--}}
{{--        $color = array(0,0,0);--}}
{{--        $font = $fontMetrics->getFont("THSarabunNew");--}}
{{--        $font_bold = $fontMetrics->getFont("THSarabunNew", "bold");--}}
{{--        $text_height = $fontMetrics->getFontHeight($font, $size);--}}
{{--        $y = 24;--}}

{{--        $pdf->text(400, $y, "การไฟฟ้าส่วนภูมิภาคอำเภอหางดง", $font, $size, $color);--}}
{{--        $pdf->text(400, $y + $text_height, "197 หมู่ 8 ตำบลหนองแก๋ว อำเภอหางดง", $font, $size, $color);--}}
{{--        $pdf->text(400, $y + (2 * $text_height), "จังหวัดเชียงใหม่ 50230", $font, $size, $color);--}}
{{--    }--}}
{{--    </script>--}}

    <table border="0" cellpadding="2" cellspacing="0" style="table-layout: fixed;">
        <tr style="vertical-align: top;">
            <td colspan="1">ที่</td>
            <td colspan="5">มท</td>
            <td colspan="1">
            <td colspan="5">การไฟฟ้าส่วนภูมิภาคอำเภอหางดง<br>197 หมู่ 8 ตำบลหนองแก๋ว อำเภอหางดง<br>จังหวัดเชียงใหม่ 50230</td>
        </tr>
        <tr>
            <td colspan="1" style="padding-top: 1cm;">เรื่อง</td>
            <td colspan="11" style="padding-top: 1cm;">แจ้งค่าใช้จ่ายงานก่อสร้าง@if($meter->job_type_id === 1)ปักเสาบริการ@elseif($meter->job_type_id === 10)ย้ายแนวระบบจำหน่าย@elseขยายเขตฯ@endifระบบจำหน่ายไฟฟ้า</td>
        </tr>
        <tr>
            <td colspan="1">เรียน</td>
            <td colspan="11">คุณ{{ $meter->customer_name }}</td>
        </tr>
        <tr>
            <td colspan="12">
                <p>ตามคำร้องเลขที่ {{ $meter->document_number }} ลงวันที่ {{ buddhismDate($meter->document_date) }} แจ้งความประสงค์ขอให้ การไฟฟ้าส่วนภูมิภาคอำเภอหางดง
                    ดำเนินการก่อสร้างขยายเขต/ย้ายแนวระบบไฟฟ้า{{ $meter->electric_expand->consumer_type }}</p>
                <p>การไฟฟ้าส่วนภูมิภาคอำเภอหางดง ได้ดำเนินการ สำรวจรายละเอียด ออกแบบ จัดทำแผนผัง ประมาณการ ราคาค่าใช้จ่าย เสร็จเรียบร้อยแล้ว โดยมีรายละเอียด ดังนี้</p>
            </td>
        </tr>
        <tr>
            <td colspan="12">
                <b>1. ปริมาณงาน</b>
            </td>
        </tr>
        @php($high_voltage_pole = $meter->meter_extra_groups('high_voltage_pole'))
        @php($high_voltage_cable = $meter->meter_extra_groups('high_voltage_cable'))
        @php($topic_index = 0)
        @if($high_voltage_pole->count() || $high_voltage_cable->count())
            <tr>
                <td colspan="1"></td>
                <td colspan="11">
                    <span>1.{{ ++$topic_index }} แผนกแรงสูง ระบบ</span>
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
                    <span>1.{{ ++$topic_index }} แผนกหม้อแปลง</span>
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
                    <span>1.{{ ++$topic_index }} แผนกแรงต่ำ</span>
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
                    <span>1.{{ ++$topic_index }} แผนกมิเตอร์</span>
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
                    <span>1.{{ ++$topic_index }} แผนกไฟสาธารณะ</span>
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
        @php($max_topic1_index = $topic_index)
        @php($topic_index = 0)
        <tr>
            <td colspan="12">
                <b>2. ส่วนของผู้ใช้ไฟดำเนินการเอง</b>
            </td>
        </tr>

        @php($customer_high_voltage_pole = $meter->meter_extra_groups('customer_high_voltage_pole'))
        @php($customer_high_voltage_cable = $meter->meter_extra_groups('customer_high_voltage_cable'))
        @if($customer_high_voltage_pole->count() || $customer_high_voltage_cable->count())
            <tr>
                <td colspan="1"></td>
                <td colspan="11">
                    <span>2.{{ ++$topic_index }} แผนกแรงสูง</span>
                    <span>ระบบ</span>
                    <span class="m-0 pl-5 pr-5 red bx-border-bottom"> {{ $meter_extra['customer_high_voltage_phase']?? '-' }} </span>
                    <span>เฟส แรงดัน</span>
                    <span class="m-0 pl-5 pr-5 red bx-border-bottom"> {{ $meter_extra['customer_high_voltage']?? '-' }} </span>
                    <span>เควี</span>
                    @if(!empty($customer_high_voltage_pole))
                        @foreach($customer_high_voltage_pole as $data)
                            <span>{{ $data['job_type']?? '' }}คอนกรีตอัดแรง ขนาด</span>
                            <span class="m-0 pl-5 pr-5 red bx-border-bottom"> {{ $data['core_size']?? '-' }} </span>
                            <span>เมตร จำนวน</span>
                            <span class="m-0 pl-5 pr-5 red bx-border-bottom"> {{ $data['quantity']?? '-' }} </span>
                            <span>ต้น</span>
                        @endforeach
                    @endif
                    @if(!empty($customer_high_voltage_cable))
                        @foreach($customer_high_voltage_cable as $data)
                            <span>{{ $data['job_type']?? '' }}</span>
                            <span class="m-0 pl-5 pr-5 red bx-border-bottom"> {{ $data['cable_type']?? '-' }} </span>
                            <span>ขนาด</span>
                            <span class="m-0 pl-5 pr-5 red bx-border-bottom"> {{ $data['cable_size']?? '-' }} </span>
                            <span>ตารางมิลลิเมตร ระยะทาง</span>
                            <span class="m-0 pl-5 pr-5 red bx-border-bottom"> {{ $data['length']?? '-' }} </span>
                            <span>เมตร</span>
                        @endforeach
                    @endif
                </td>
            </tr>
        @endif

        @php($customer_transformer = $meter->meter_extra_groups('customer_transformer'))
        @if($customer_transformer->count())
            <tr>
                <td colspan="1"></td>
                <td colspan="11">
                    <span>2.{{ ++$topic_index }} แผนกหม้อแปลง</span>
                    @foreach($customer_transformer as $data)
                        <span>{{ $data['job_type']?? '' }}หม้อแปลง ระบบ</span>
                        <span class="m-0 pl-5 pr-5 red bx-border-bottom"> {{ $data['phase']?? '-' }} </span>
                        <span>เฟส ขนาด</span>
                        <span class="m-0 pl-5 pr-5 red bx-border-bottom"> {{ $data['transformer_size']?? '-' }} </span>
                        <span>เควีเอ จำนวน</span>
                        <span class="m-0 pl-5 pr-5 red bx-border-bottom"> {{ $data['quantity']?? '-' }} </span>
                        <span>เครื่อง</span>
                    @endforeach
                </td>
            </tr>
        @endif

    </table>

    @php($max_topic2_index = $topic_index)
    @php($topic_index = 0)
    <table border="0" cellpadding="2" cellspacing="0" style="table-layout: fixed; page-break-inside: avoid;">
        <tr>
            <td colspan="12">
                <b>3. ค่าใช้จ่าย</b>
            </td>
        </tr>
        <tr>
            <td colspan="1"></td>
            <td colspan="11">
                <span>3.{{ ++$topic_index }} ค่าใช้จ่ายในการดำเนินงานตามข้อ 1.1 ถึงข้อ 1.{{ $max_topic1_index }} เป็นเงิน</span>
                <span class="m-0 pl-5 pr-5 red bx-border-bottom"> {{ isset($meter['payment_request'])? number_format($meter['payment_request'], 2) : '-' }} </span>
                <span>บาท (รวมภาษีมูลค่าเพิ่ม)</span>
            </td>
        </tr>
        @if(isset($meter['has_payment']) && $meter['has_payment'] && $meter['paid_amount'])
            <tr>
                <td colspan="1"></td>
                <td colspan="11">
                    <span>ผู้ขอใช้ไฟฟ้าได้ชำระ{{ $meter_extra['customer_payment_type']?? 'ค่าตรวจสอบแบบและแผนผัง' }} (รวมภาษีมูลค่าเพิ่ม) ไว้แล้ว จำนวน</span>
                    <span class="m-0 pl-5 pr-5 red bx-border-bottom"> {{ isset($meter['paid_amount'])? number_format($meter['paid_amount'], 2) : '-' }} </span>
                    <span>บาท เมื่อวันที่</span>
                    <span class="m-0 pl-5 pr-5 red bx-border-bottom"> {{ isset($meter['receive_date'])? buddhismDate($meter['receive_date']) : '-' }} </span>
                    <span>ตามใบเสร็จรับเงินเลขที่</span>
                    <span class="m-0 pl-5 pr-5 red bx-border-bottom"> {{ $meter['receive_no']?? '-' }} </span>
                </td>
            </tr>
            <tr>
                <td colspan="1"></td>
                <td colspan="11">
                    <span>ดังนั้น ผู้ขอใช้ไฟจะต้องชำระค่าใช้จ่ายในการดำเนินการตามข้อ 3.1 คงเหลือ เป็นเงิน</span>
                    <span class="m-0 pl-5 pr-5 red bx-border-bottom"> {{ number_format($meter['payment_request'] - $meter['paid_amount'], 2) }} </span>
                    <span>บาท (รวมภาษีมูลค่าเพิ่ม)</span>
                </td>
            </tr>
        @endif

        @if(isset($meter['job_type_id']) && ($meter['job_type_id'] === 4 || $meter['job_type_id'] === 5))
            <tr>
                <td colspan="1"></td>
                <td colspan="11">
                    <span>3.{{ ++$topic_index }} ค่าธรรมเนียมการขอใช้ไฟฟ้า แยกรายละเอียด ดังนี้</span>
                </td>
            </tr>
            <tr>
                <td colspan="12">
                    <p class="p-0 m-0">
                        <span>1. ค่าตรวจสอบการติดตั้งอุปกรณ์ไฟฟ้าภายในอาคาร</span>
                        <span class="m-0 pl-5 pr-5 red bx-border-bottom"> {{ isset($meter_extra['payment_price_of_indoor_checking'])? number_format($meter_extra['payment_price_of_indoor_checking'], 2) : '-' }} </span>
                        <span>บาท (รวมภาษีมูลค่าเพิ่ม)</span>
                    </p>
                    <p class="p-0 m-0">
                        <span>2. เงินประกันการใช้ไฟฟ้า</span>
                        <span class="m-0 pl-5 pr-5 red bx-border-bottom"> {{ isset($meter_extra['payment_price_of_guarantee_value'])? number_format($meter_extra['payment_price_of_guarantee_value'], 2) : '-' }} </span>
                        <span>บาท</span>
                    </p>
                    <p>
                        <span>รวมเงินค่าใช้จ่ายตามข้อ 3.2 เป็นเงิน</span>
                        <span class="m-0 pl-5 pr-5 red bx-border-bottom"> {{ isset($meter_extra['payment_price_of_grand_total'])? number_format($meter_extra['payment_price_of_grand_total'], 2) : '-' }} </span>
                        <span>บาท</span>
                    </p>
                    <p>
                        <span>ทั้งนี้ ผู้ใช้ไฟฟ้าจะต้องชำระค่าธรรมเนียมการใช้ไฟฟ้าตามข้อ 3.2 ภายหลังจากที่
                            <br>การไฟฟ้าส่วนภูมิภาค ได้ก่อสร้างระบบจำหน่ายไฟฟ้าเสร็จเรียบร้อยแล้ว และได้ยื่นคำร้องขอใช้ไฟฟ้า โดยต้องผ่านการตรวจสอบ การติดตั้งอุปกรณ์ไฟฟ้า ภายในอาคารจากการไฟฟ้าส่วนภูมิภาคก่อน สำหรับเงินประกันการใช้ไฟฟ้าตั้งแต่ 10,000.- บาทขึ้นไป สามารถใช้หนังสือสัญญา ค้ำประกันจากธนาคารได้ หรือหากใช้พันธบัตรรัฐบาล หรือพันธบัตรรัฐวิสาหกิจที่กระทรวงการคลังค้ำประกัน ก็สามารถทำได้ โดยให้ติดต่อการไฟฟ้าส่วนภูมิภาคเป็นรายๆไป</span>
                    </p>
                </td>
            </tr>
        @endif

        <tr>
            <td colspan="12">
                <b>4. กำหนดยืนราคา และกรรมสิทธิ์ในทรัพย์สิน</b>
            </td>
        </tr>
        <tr>
            <td colspan="12">
                <p style="word-break: break-all;">กำหนดยืนราคาค่าใช้จ่าย ภายในระยะเวลา<span class="m-0 pl-5 pr-5 red bx-border-bottom"> {{ $meter['paid_credit_terms']?? '-' }} </span>เดือน นับจากวันที่แจ้งค่าใช้จ่าย และหากการก่อสร้างระบบไฟฟ้า
                    ดังกล่าวข้างต้น มีความจำเป็นต้องแก้ไข เปลี่ยนแปลงการก่อสร้างฯหรืออื่นๆ ซึ่งอาจทำให้ค่าใช้จ่ายเพิ่มขึ้น ผู้ขอใช้ไฟจะต้องออกค่าใช้จ่ายในส่วนที่เพิ่มขึ้นภายหลังอีกต่างหากด้วย กรรมสิทธิ์ในทรัพย์สิน เมื่อดำเนินการก่อสร้างแล้วเสร็จ
                    ระบบจำหน่ายไฟฟ้าในที่สาธารณะ และเครื่องวัดพร้อมอุปกรณ์ประกอบ เป็นทรัพย์สินของการไฟฟ้าส่วนภูมิภาค ยกเว้น สายดับ กิ่งโคมไฟ และสวิทช์ควบคุมไฟสาธารณะ และ/หรือ ระบบจำหน่ายในเขตที่ดินของผู้ใช้ไฟเป็นทรัพย์สินของผู้ใช้ไฟ</p>
            </td>
        </tr>
    </table>

    <table border="0" cellpadding="2" cellspacing="0" style="table-layout: fixed; page-break-inside: avoid;">
        <tr>
            <td colspan="12">
                <p>จึงเรียนมาเพื่อโปรดทราบ และติดต่อชำระเงินได้ที่สำนักงานการไฟฟ้าส่วนภูมิภาค อำเภอหางดง</p>
            </td>
        </tr>
        <tr>
            <td colspan="5"></td>
            <td colspan="7" style="text-align: center;">ขอแสดงความนับถือ</td>
        </tr>
        <tr>
            <td colspan="5"></td>
            <td colspan="7" class="text-center" style="padding-top: 2cm;">@if($approval_user = $meter->approval_user) ({{ $approval_user->name }}) @endif</td>
        </tr>
        <tr>
            <td colspan="5"></td>
            <td colspan="7" class="text-center">@if($approval_user) {{ $approval_user->job_title }} @endif</td>
        </tr>
        <tr>
            <td colspan="5"></td>
            <td colspan="7" class="text-center">@if($approval_user) {{ $approval_user->position }} @endif</td>
        </tr>
    </table>

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

        $pdf->text(40, $y - $text_height - $text_height, "แผนกบริการลูกค้า", $font, $size, $color);
        $pdf->text(40, $y - $text_height, "โทร. 0 5344 1776", $font, $size, $color);
        $pdf->text(40, $y, "โทรสาร 0 5344 1176", $font, $size, $color);
    }
    </script>

</main>
</body>
</html>