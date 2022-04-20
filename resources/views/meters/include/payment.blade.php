<div class="form-body">
    <div class="alert bg-rgba-primary mt-1 p-1">
        <h4 class="text-primary">แจ้งค่าใช้จ่าย</h4>
        <p class="m-0">งานก่อสร้าง<code class="highlighter-rouge">ขยายเขต/ย้ายแนว</code>ระบบจำหน่ายไฟฟ้า</p>
    </div>
    <div class="row mt-1">
        <div class="col-md-2 text-right vertical-middle">
            <label>เรียกเก็บจากผู้ใช้ไฟ</label>
        </div>
        <div class="col-md-4 vertical-middle">
            <fieldset>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <div class="checkbox">
                                <input type="checkbox" class="checkbox__input" id="has_payment" name="meters[has_payment]"
                                       value="1" {{ ((isset($meter->has_payment) && $meter->has_payment) || old('meters.has_payment'))? 'checked':'' }}>
                                <label for="has_payment"></label>
                            </div>
                        </div>
                    </div>
                    <input type="number" class="form-control" name="meters[payment_request]" placeholder="เรียกเก็บจากผู้ใช้ไฟ" aria-describedby="payment_request" step="0.01"
                           value="{{ $meter->payment_request?? old('meters.payment_request') }}">
                    <div class="input-group-append">
                        <span class="input-group-text" id="payment_request">บาท</span>
                    </div>
                </div>
            </fieldset>
        </div>
        <div class="col-md-4 vertical-middle">
            <fieldset>
                <div class="input-group">
                    <input type="number" class="form-control" name="meters[paid_credit_terms]" placeholder="กำหนดยืนราคา" aria-describedby="paid_credit_terms"
                           value="{{ $meter->paid_credit_terms?? old('meters.paid_credit_terms') }}">
                    <div class="input-group-append">
                        <span class="input-group-text" id="paid_credit_terms">เดือน</span>
                    </div>
                </div>
            </fieldset>
        </div>
    </div>
    <div class="row mt-1">
        <div class="col-md-2 text-right vertical-middle">
            <label>ประเภทการชำระ</label>
        </div>
        <div class="col-md-4 vertical-middle">
            <ul class="list-unstyled mb-0">
                <li class="d-inline-block mr-2">
                    <fieldset>
                        <div class="radio">
                            <input type="radio" name="meter_extra[customer_payment_type]" id="customer_payment_type_1" value="ค่าตรวจสอบแบบและแผนผัง"
                                   @if(isset($meter_extra['customer_payment_type']) && $meter_extra['customer_payment_type'] === 'ค่าตรวจสอบแบบและแผนผัง') checked @endif>
                            <label for="customer_payment_type_1">ค่าตรวจสอบแบบและแผนผัง</label>
                        </div>
                    </fieldset>
                </li>
                <li class="d-inline-block mr-2">
                    <fieldset>
                        <div class="radio">
                            <input type="radio" name="meter_extra[customer_payment_type]" id="customer_payment_type_2" value="ค่าสำรวจออกแบบและจัดทำแผนผังประมาณการ"
                                   @if(isset($meter_extra['customer_payment_type']) && $meter_extra['customer_payment_type'] === 'ค่าสำรวจออกแบบและจัดทำแผนผังประมาณการ') checked @endif>
                            <label for="customer_payment_type_2">ค่าสำรวจออกแบบและจัดทำแผนผังประมาณการ</label>
                        </div>
                    </fieldset>
                </li>
            </ul>
        </div>
    </div>
    <div class="row mt-1">
        <div class="col-md-2 text-right vertical-middle">
            <label>ผู้ใช้ไฟได้ชำระ</label>
        </div>
        <div class="col-md-4 vertical-middle">
            <fieldset>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <div class="checkbox">
                                <input type="checkbox" class="checkbox__input" id="paid" name="meters[paid]"
                                       value="1" {{ ((isset($meter->paid) && $meter->paid) || old('meters.paid'))? 'checked':'' }}>
                                <label for="paid"></label>
                            </div>
                        </div>
                    </div>
                    <input type="number" class="form-control" name="meters[paid_amount]" placeholder="ผู้ใช้ไฟได้ชำระ" aria-describedby="paid_amount"
                           value="{{ $meter->paid_amount?? old('meters.paid_amount') }}">
                    <div class="input-group-append">
                        <span class="input-group-text" id="paid_amount">บาท</span>
                    </div>
                </div>
            </fieldset>
        </div>
    </div>
    <div class="row mt-1">
        <div class="col-md-2 text-right vertical-middle">
            <label>ใบเสร็จรับเงินเลขที่</label>
        </div>
        <div class="col-md-4 vertical-middle">
            <input type="text" class="form-control" name="meters[receive_no]" placeholder="ใบเสร็จรับเงินเลขที่" value="{{ $meter->receive_no?? old('meters.receive_no') }}">
        </div>

        <div class="col-md-2 text-right vertical-middle">
            <label>ลงวันที่</label>
        </div>
        <div class="col-md-4 vertical-middle">
            <input type="date" class="form-control" name="meters[receive_date]" placeholder="ลงวันที่" value="{{ $meter->receive_date?? old('meters.receive_date') }}" data-toggle="tooltip" data-placement="top"
                   data-original-title="{{ buddhismDate($meter->receive_date?? old('meters.receive_date')) }}">
        </div>
    </div>
    <div class="row mt-1">
        <div class="col-md-2 text-right vertical-middle">
            <label>ผู้เสนอขออนุมัติ</label>
        </div>
        <div class="col-md-4 form-group vertical-middle">
            <select class="form-control" name="meters[request_approve_user_id]">
                <option></option>
                @forelse($pea_staffs as $pea_staff)
                    <option value="{{ $pea_staff->id }}" {{ ((isset($meter->request_approve_user_id) && $meter->request_approve_user_id === $pea_staff->id) || old('meters.request_approve_user_id') === $pea_staff->id)? 'selected':'' }}>{{ $pea_staff->name }}</option>
                @empty
                @endforelse
            </select>
        </div>

        <div class="col-md-2 text-right vertical-middle">
            <label>ผู้อนุมัติ</label>
        </div>
        <div class="col-md-4 form-group vertical-middle">
            <select class="form-control" name="meters[approve_user_id]">
                <option></option>
                @forelse($pea_staffs as $pea_staff)
                    <option value="{{ $pea_staff->id }}" {{ ((isset($meter->approve_user_id) && $meter->approve_user_id === $pea_staff->id) || old('meters.approve_user_id') === $pea_staff->id)? 'selected':'' }}>{{ $pea_staff->name }}</option>
                @empty
                @endforelse
            </select>
        </div>
    </div>

    <div class="meter-transformer">
        <div class="alert bg-rgba-primary mt-1 p-1">
            <h4 class="text-primary">ค่าธรรมเนียม</h4>
            <p class="m-0">การขอใช้ไฟฟ้า</p>
        </div>
        <div class="row mt-1">
            <div class="col-md-2 text-right vertical-middle">
                <label>ติดตั้งหม้อแปลงรวม</label>
            </div>
            <div class="col-md-4 vertical-middle">
                <fieldset>
                    <div class="input-group">
                        <input type="number" class="form-control" id="payment_transformer_installation" name="meter_extra[payment_transformer_installation]" placeholder="kVA" aria-describedby="payment_transformer_installation"
                               value="{{ $meter_extra['payment_transformer_installation']?? old('meter_extra.payment_transformer_installation', 0) }}">
                        <div class="input-group-append">
                            <span class="input-group-text" id="payment_transformer_installation">kVA</span>
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>

        <div class="row mt-1">
            <div class="col-md-2 text-right vertical-middle">
                <label>ติดตั้งมิเตอร์</label>
            </div>
            <div class="col-md-10 vertical-middle">
                <ul class="list-unstyled mb-0">
                    <li class="d-inline-block mr-2">
                        <fieldset>
                            <div class="checkbox">
                                <input type="checkbox" class="checkbox-input" id="payment_meter_low_voltage" name="meter_extra[payment_meter_low_voltage]" value="1"
                                        {{ ((isset($meter_extra['payment_meter_low_voltage']) && $meter_extra['payment_meter_low_voltage']) || old('meter_extra.payment_meter_low_voltage'))? 'checked':'' }}>
                                <label for="payment_meter_low_voltage">ประกอบ CT แรงต่ำ</label>
                            </div>
                        </fieldset>
                    </li>
                    <li class="d-inline-block mr-2">
                        <fieldset>
                            <div class="checkbox">
                                <input type="checkbox" class="checkbox-input" id="payment_meter_high_voltage" name="meter_extra[payment_meter_high_voltage]" value="1"
                                        {{ ((isset($meter_extra['payment_meter_high_voltage']) && $meter_extra['payment_meter_high_voltage']) || old('meter_extra.payment_meter_high_voltage'))? 'checked':'' }}>
                                <label for="payment_meter_high_voltage">ประกอบ CT/VT แรงสูง</label>
                            </div>
                        </fieldset>
                    </li>
                </ul>
            </div>
        </div>

        <div class="row mt-1">
            <div class="col-md-2 text-right vertical-middle">
                <label>อัตราค่าไฟฟ้า</label>
            </div>
            <div class="col-md-10 vertical-middle">
                <select class="form-control" id="payment_rate_id" name="meter_extra[payment_rate_id]">
                    @foreach($payment_rates as $payment_rate)
                        <option value="{{ $payment_rate->id }}" factor="{{ $payment_rate->payment_factor }}"
                                {{ ((isset($meter_extra['payment_rate_id']) && $meter_extra['payment_rate_id'] === (string)$payment_rate->id) || old('meter_extra.payment_rate_id') === $payment_rate->id)? 'selected':'' }}>{{ $payment_rate->description }}</option>
                    @endforeach
                </select>

            </div>
        </div>

        <div class="row mt-1">
            <div class="col-md-2 text-right vertical-middle">
            </div>
            <div class="col-md-4 vertical-middle">
                <label>1. ค่าตรวจสอบการติดตั้งอุปกรณ์ไฟฟ้าภายในอาคาร</label>
            </div>
            <div class="col-md-2 vertical-middle">
                <fieldset>
                    <div class="input-group">
                        <input type="hidden" id="price_of_indoor_checking_value" name="meter_extra[payment_price_of_indoor_checking]" value="{{ $meter_extra['payment_price_of_indoor_checking']?? 0 }}">
                        <input type="text" class="form-control text-right" id="price_of_indoor_checking" value="0" readonly>
                        <div class="input-group-append">
                            <span class="input-group-text">บาท</span>
                        </div>
                    </div>
                </fieldset>
            </div>
            <div class="col-md-2 vertical-middle">
                <label>(รวมภาษีมูลค่าเพิ่ม)</label>
            </div>
        </div>

        <div class="row mt-1">
            <div class="col-md-2 text-right vertical-middle">
            </div>
            <div class="col-md-4 vertical-middle">
                <label>2. เงินประกันการใช้ไฟฟ้า</label>
            </div>
            <div class="col-md-2 vertical-middle">
                <fieldset>
                    <div class="input-group">
                        <input type="hidden" id="price_of_guarantee_value" name="meter_extra[payment_price_of_guarantee_value]" value="{{ $meter_extra['payment_price_of_guarantee_value']?? 0 }}">
                        <input type="text" class="form-control text-right" id="price_of_guarantee" value="0" readonly>
                        <div class="input-group-append">
                            <span class="input-group-text">บาท</span>
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>

        <div class="row mt-1">
            <div class="col-md-2 text-right vertical-middle">
            </div>
            <div class="col-md-4 vertical-middle">
                <label><b>รวมเงินค่าใช้จ่าย</b> เป็นเงิน</label>
            </div>
            <div class="col-md-2 vertical-middle">
                <fieldset>
                    <div class="input-group">
                        <input type="hidden" id="price_of_grand_total_value" name="meter_extra[payment_price_of_grand_total]" value="{{ $meter_extra['payment_price_of_grand_total']?? 0 }}">
                        <input type="text" class="form-control text-right" id="price_of_grand_total" value="0" readonly>
                        <div class="input-group-append">
                            <span class="input-group-text">บาท</span>
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
    </div>

    <hr>

    <div class="row mt-1">
        <div class="col-sm-12 d-flex justify-content-end">
            <a href="{{ route('meters.index') }}" class="btn btn-secondary mr-1"><i class="bx bx-arrow-back"></i> ย้อนกลับหน้าหลัก</a>
            <a href="{{ route('meter-payment-pdf', $meter->id) }}" target="_BLANK" class="btn btn-success mr-1"><i class="bx bx-printer"></i> พิมพ์แบบฟอร์มแจ้งค่าใช้จ่าย</a>
            <button type="reset" class="btn btn-light-secondary mr-1">คืนค่าเริ่มต้น</button>
            <button type="submit" class="btn btn-primary"><i class="bx bx-save"></i> บันทึกข้อมูล</button>
        </div>
    </div>
</div>

{{-- page scripts --}}
@push('scripts')
    <script>
        $(document).ready(function () {

            const payment_transformer_installation = $('#payment_transformer_installation');
            const payment_rate_id = $('#payment_rate_id');
            const price_of_indoor_checking = $('#price_of_indoor_checking');
            const price_of_indoor_checking_value = $('#price_of_indoor_checking_value');
            const price_of_guarantee = $('#price_of_guarantee');
            const price_of_guarantee_value = $('#price_of_guarantee_value');
            const price_of_grand_total = $('#price_of_grand_total');
            const price_of_grand_total_value = $('#price_of_grand_total_value');

            $(document).on('change', '#job_type_id', function () {
                pre_select_transformer_size($(this).val());
            });

            $(document).on('input', '#payment_transformer_installation', function () {
                calculate_payment_price();
            });

            $(document).on('change', '#payment_rate_id', function () {
                calculate_payment_price();
            });

            function pre_select_transformer_size(job_type_id) {
                if (job_type_id === "4") {
                    payment_transformer_installation.val('30');
                    payment_transformer_installation.attr('readonly', true);
                }

                if (job_type_id === "5") {
                    payment_transformer_installation.val('50');
                    payment_transformer_installation.attr('readonly', false);
                }

                calculate_payment_price();
            }

            function calculate_payment_price() {
                let indoor_checking = get_installation_survey_price(parseInt(payment_transformer_installation.val()));
                let factor = parseInt($('option:selected', payment_rate_id).attr('factor'));
                let guarantee = get_installation_guarantee_price(parseInt(payment_transformer_installation.val())) * factor;

                price_of_indoor_checking.val(moneyFormat(indoor_checking));
                price_of_indoor_checking_value.val(indoor_checking);
                price_of_guarantee.val(moneyFormat(guarantee));
                price_of_guarantee_value.val(guarantee);
                price_of_grand_total.val(moneyFormat(indoor_checking + guarantee));
                price_of_grand_total_value.val(indoor_checking + guarantee);
            }

            function get_installation_guarantee_price(transformer) {
                if (transformer <= 30) {
                    return 6000;
                }
                if (transformer <= 50) {
                    return 12000;
                }
                if (transformer <= 250) {
                    return transformer * 100;
                }
                if (transformer <= 1200) {
                    return transformer * 300;
                }
                return transformer * 400;
            }

            function get_installation_survey_price(transformer) {
                if (transformer <= 30) {
                    return 749;
                }
                if (transformer <= 50) {
                    return 1605;
                }
                if (transformer <= 250) {
                    return 4494;
                }
                if (transformer <= 1200) {
                    return 16050;
                }
                return 21400;
            }

            function moneyFormat(value){
                return value.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
            }

            pre_select_transformer_size($('#job_type_id').val());

        });
    </script>
@endpush
