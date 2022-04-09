<div class="form-body">
    <table class="table">
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
        @php($i = 0)
        @php($vat_rate = 7)
        @foreach(__('payment_type') as $row)
            <tr>
                <td>{!! $row !!}</td>
                <td><input type="number" class="form-control text-right" name="meter_extra[payment_manual_pea_invest_{{ ++$i }}]" placeholder="บาท" step="0.01"
                           payment_manual="{{ $i }}" value="{{ $meter_extra['payment_manual_pea_invest_'.$i]?? old('meter_extra.payment_manual_pea_invest_'.$i, 0) }}"></td>
                <td><input type="number" class="form-control text-right" name="meter_extra[payment_manual_action_{{ $i }}]" placeholder="บาท" step="0.01"
                           payment_manual="{{ $i }}" value="{{ $meter_extra['payment_manual_action_'.$i]?? old('meter_extra.payment_manual_action_'.$i, 0) }}"></td>
                <td><input type="number" class="form-control text-right" name="meter_extra[payment_manual_customer_{{ $i }}]" placeholder="บาท" step="0.01"
                           payment_manual="{{ $i }}" value="{{ $meter_extra['payment_manual_customer_'.$i]?? old('meter_extra.payment_manual_customer_'.$i, 0) }}"></td>
                <td><input type="number" class="form-control text-right" name="meter_extra[payment_manual_summary_{{ $i }}]" placeholder="บาท" readonly
                           payment_manual_id="{{ $i }}" value="{{ $meter_extra['payment_manual_summary_'.$i]?? old('meter_extra.payment_manual_summary_'.$i, 0) }}"></td>
            </tr>
        @endforeach
        <tr style="font-weight: bold;">
            <td>รวมเงินลงทุนทั้งหมด</td>
            <td class="text-right"><input type="number" id="payment_manual_net_pea_invest" class="form-control text-right" value="0" readonly></td>
            <td class="text-right"><input type="number" id="payment_manual_net_action" class="form-control text-right" value="0" readonly></td>
            <td class="text-right"><input type="number" id="payment_manual_net_customer" class="form-control text-right" value="0" readonly></td>
            <td class="text-right"><input type="number" id="payment_manual_net_summary" class="form-control text-right" value="0" readonly></td>
        </tr>
        <tr style="font-weight: bold;">
            <td>ภาษีมูลค่าเพิ่ม {{ $vat_rate }}%</td>
            <td class="text-right"><input type="number" id="payment_manual_tax_pea_invest" class="form-control text-right" value="0" readonly></td>
            <td class="text-right"><input type="number" id="payment_manual_tax_action" class="form-control text-right" value="0" readonly></td>
            <td class="text-right"><input type="number" id="payment_manual_tax_customer" class="form-control text-right" value="0" readonly></td>
            <td class="text-right"><input type="number" id="payment_manual_tax_summary" class="form-control text-right" value="0" readonly></td>
        </tr>
        <tr style="font-weight: bold;">
            <td>รวมเป็นเงินทั้งสิ้น (รวมภาษีมูลค่าเพิ่มแล้ว)</td>
            <td class="text-right"><input type="number" id="payment_manual_gross_pea_invest" class="form-control text-right" value="0" readonly></td>
            <td class="text-right"><input type="number" id="payment_manual_gross_action" class="form-control text-right" value="0" readonly></td>
            <td class="text-right"><input type="number" id="payment_manual_gross_customer" class="form-control text-right" value="0" readonly></td>
            <td class="text-right"><input type="number" id="payment_manual_gross_summary" class="form-control text-right" value="0" readonly></td>
        </tr>
        </tbody>
    </table>

    <hr>

    <div class="row mt-1">
        <div class="col-sm-12 d-flex justify-content-end">
            <a href="{{ route('meters.index') }}" class="btn btn-secondary mr-1"><i class="bx bx-arrow-back"></i> ย้อนกลับหน้าหลัก</a>
            <a href="{{ route('meter-pdf', $meter->id) }}" target="_BLANK" class="btn btn-success mr-1"><i class="bx bx-printer"></i> พิมพ์แบบฟอร์ม</a>
            <button type="reset" class="btn btn-light-secondary mr-1">คืนค่าเริ่มต้น</button>
            <button type="submit" class="btn btn-primary"><i class="bx bx-save"></i> บันทึกข้อมูล</button>
        </div>
    </div>
</div>

{{-- page scripts --}}
@push('scripts')
    <script>
        $(document).ready(function () {
            const payment_manual_pea_invest = $('input[name^="meter_extra[payment_manual_pea_invest_"]');
            const payment_manual_action = $('input[name^="meter_extra[payment_manual_action_"]');
            const payment_manual_customer = $('input[name^="meter_extra[payment_manual_customer_"]');
            const payment_manual_summary = $('input[name^="meter_extra[payment_manual_summary_"]');

            payment_manual_pea_invest.blur(function () {
                payment_manual_calculate_summary();
            });

            payment_manual_action.blur(function () {
                payment_manual_calculate_summary();
            });

            payment_manual_customer.blur(function () {
                payment_manual_calculate_summary();
            });

            function payment_manual_calculate_summary() {
                let net_pea_invest = 0;
                let tax_pea_invest = 0;
                let net_action = 0;
                let tax_action = 0;
                let net_customer = 0;
                let tax_customer = 0;
                let net_summary = 0;
                let tax_summary = 0;

                let vat_rate = {{ $vat_rate }};

                payment_manual_pea_invest.each(function () {
                    net_pea_invest += Number($(this).val());
                });

                payment_manual_action.each(function () {
                    net_action += Number($(this).val());
                });

                payment_manual_customer.each(function () {
                    net_customer += Number($(this).val());
                });

                payment_manual_summary.each(function () {
                    const payment_manual_id = $(this).attr('payment_manual_id');
                    let this_summary = 0;
                    $('input[payment_manual="' + payment_manual_id + '"]').each(function () {
                        this_summary += Number($(this).val());
                    });
                    $(this).val(this_summary.toFixed(2));
                    net_summary += this_summary;
                });

                tax_pea_invest = net_pea_invest * vat_rate / 100;
                tax_action = net_action * vat_rate / 100;
                tax_customer = net_customer * vat_rate / 100;
                tax_summary = net_summary * vat_rate / 100;

                $('#payment_manual_net_pea_invest').val(net_pea_invest.toFixed(2));
                $('#payment_manual_tax_pea_invest').val(tax_pea_invest.toFixed(2));
                $('#payment_manual_gross_pea_invest').val((net_pea_invest + tax_pea_invest).toFixed(2));

                $('#payment_manual_net_action').val(net_action.toFixed(2));
                $('#payment_manual_tax_action').val(tax_action.toFixed(2));
                $('#payment_manual_gross_action').val((net_action + tax_action).toFixed(2));

                $('#payment_manual_net_customer').val(net_customer.toFixed(2));
                $('#payment_manual_tax_customer').val(tax_customer.toFixed(2));
                $('#payment_manual_gross_customer').val((net_customer + tax_customer).toFixed(2));
                $('input[name="meters[payment_request]"]').val((net_customer + tax_customer).toFixed(2));

                $('#payment_manual_net_summary').val(net_summary.toFixed(2));
                $('#payment_manual_tax_summary').val(tax_summary.toFixed(2));
                $('#payment_manual_gross_summary').val((net_summary + tax_summary).toFixed(2));
            }

            payment_manual_calculate_summary();
        });
    </script>
@endpush
