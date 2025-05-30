<div class="form-body">
    <div class="alert bg-rgba-primary mt-1 p-1">
        <h4 class="text-primary">แผนกบริการลูกค้า</h4>
        <p class="m-0">เพิ่ม/แก้ไขข้อมูล<code class="highlighter-rouge">งานขยายเขต</code>ระบบจำหน่ายไฟฟ้า</p>
    </div>
    <div class="row mt-1">
        <div class="col-md-2 text-right vertical-middle">
            <label>เลขที่คำร้อง</label>
        </div>
        <div class="col-md-4 form-group vertical-middle">
            <input type="text" class="form-control @error('meters.document_number') error @enderror" id="document_number" name="meters[document_number]" placeholder="เลขที่คำร้อง" maxlength="12"
                   value="{{ old('meters.document_number', $meter->document_number ?? '') }}">
            @error('meters.document_number')<span class="error">{{ $message }}</span>@enderror

        </div>

        <div class="col-md-2 text-right vertical-middle">
            <label>วันที่ยื่นคำร้อง</label>
        </div>
        <div class="col-md-4 form-group vertical-middle">
            <input type="date" class="form-control @error('meters.document_date') error @enderror" name="meters[document_date]" placeholder="วันที่ยื่นคำร้อง" value="{{ $meter->document_date?? old('meters.document_date') }}"
                   data-toggle="tooltip" data-placement="top"
                   data-original-title="{{ buddhismDate(old('meters.document_date', $meter->document_date ?? '')) }}">
            @error('meters.document_date')<span class="error">{{ $message }}</span>@enderror
        </div>
    </div>
    <div class="row mt-0">
        <div class="col-md-2"></div>
        <div class="col-md-10"><small class="form-text text-muted">ตัวอย่าง เลขที่คำร้อง: ABCD00000000, 120000000000</small></div>
    </div>
    <div class="row mt-1">
        <div class="col-md-2 text-right vertical-middle">
            <label>ชื่อ-นามสกุล</label>
        </div>
        <div class="col-md-4 form-group vertical-middle">
            <input type="text" class="form-control @error('meters.customer_name') error @enderror" id="customer_name" name="meters[customer_name]" placeholder="ชื่อ-นามสกุล"
                   value="{{ old('meters.customer_name', $meter->customer_name ?? '') }}">
            @error('meters.customer_name')<span class="error">{{ $message }}</span>@enderror
        </div>

        <div class="col-md-2 text-right vertical-middle">
            <label>เบอร์โทรศัพท์</label>
        </div>
        <div class="col-md-4 form-group vertical-middle">
            <input type="text" class="form-control" name="meters[customer_phone]" placeholder="เบอร์โทรศัพท์" value="{{ old('meters.customer_phone', $meter->customer_phone ?? '') }}">
        </div>
    </div>
    <div class="row mt-1">
        <div class="col-md-2 text-right vertical-middle">
            <label>ประเภทงาน</label>
        </div>
        <div class="col-md-4 form-group vertical-middle">
            <select class="form-control" name="meters[job_type_id]" id="job_type_id">
                @forelse($job_types as $job_type)
                    <option value="{{ $job_type->id }}" {{ ((int)old('meters.job_type_id', $meter->job_type_id ?? 0) === $job_type->id) ? 'selected' : '' }}>{{ $job_type->description }}</option>
                @empty
                    <option></option>
                @endforelse
            </select>
        </div>
        <div class="col-md-2 text-right vertical-middle meter-transformer">
            <label>หม้อแปลง ขนาด</label>
        </div>
        <div class="col-md-4 form-group vertical-middle meter-transformer">
            <select class="form-control" name="meters[transformer_id]">
                @forelse($transformers as $transformer)
                    <option value="{{ $transformer->id }}" {{ ((int)old('meters.transformer_id', $meter->transformer_id ?? 0) === $transformer->id) ? 'selected' : '' }}>{{ $transformer->description }}
                        kVA
                    </option>
                @empty
                    <option></option>
                @endforelse
            </select>
        </div>
    </div>
    <div class="row mt-1">
        <div class="col-md-2 text-right vertical-middle">
            <label>สถานที่ขอใช้บริการ</label>
        </div>
        <div class="col-md-4 form-group vertical-middle">
            <select class="form-control" name="meters[requested_place_id]" id="requested_place_id">
                @forelse($requested_places as $requested_place)
                    <option value="{{ $requested_place->id }}"
                            credit_terms="{{ $requested_place->credit_terms }}" {{ ((isset($meter->requested_place_id) && $meter->requested_place_id === $requested_place->id) || old('meters.requested_place_id') === $requested_place->id)? 'selected':'' }}>{{ $requested_place->description }}</option>
                @empty
                    <option></option>
                @endforelse
            </select>
        </div>
    </div>

    <hr>

    <div class="row mt-1">
        <div class="col-md-2 text-right vertical-middle">
            <label>หมายเลขงาน</label>
        </div>
        <div class="col-md-4 form-group vertical-middle">
            <input type="text" class="form-control" id="job_number" name="meters[job_number]" placeholder="หมายเลขงาน" value="{{ $meter->job_number?? old('meters.job_number') }}">
        </div>
        <div class="col-md-2 text-right vertical-middle">
            <label>ชื่อผู้สำรวจ</label>
        </div>
        <div class="col-md-4 form-group vertical-middle">
            <select class="form-control" id="survey_user_id" name="meters[survey_user_id]">
                <option></option>
                @forelse($pea_staffs as $pea_staff)
                    <option value="{{ $pea_staff->id }}" {{ ((isset($meter->survey_user_id) && $meter->survey_user_id === $pea_staff->id) || old('meters.survey_user_id') === $pea_staff->id)? 'selected':'' }}>{{ $pea_staff->name }}</option>
                @empty
                @endforelse
            </select>
        </div>
    </div>
    <div class="row mt-1">
        <div class="col-md-2 text-right vertical-middle">
            <label>ปริมาณงาน</label>
        </div>
        <div class="col-md-4 form-group vertical-middle">
            <select class="form-control" name="meters[job_amount_id]" id="job_amount_id">
                @forelse($job_amounts as $job_amount)
                    <option value="{{ $job_amount->id }}" {{ ((isset($meter->job_amount_id) && $meter->job_amount_id === $job_amount->id) || old('meters.job_amount_id') === $job_amount->id)? 'selected':'' }}>{{ $job_amount->description }}</option>
                @empty
                    <option></option>
                @endforelse
            </select>
        </div>
        <div class="col-md-2 text-right vertical-middle">
            <label>สถานะงาน</label>
        </div>
        <div class="col-md-4 form-group vertical-middle">
            <select class="form-control" name="meters[job_status_id]" id="job_status_id">
                @forelse($job_statuses as $job_status)
                    <option value="{{ $job_status->id }}" {{ ((isset($meter->job_status_id) && $meter->job_status_id === $job_status->id) || old('meters.survey_user_id') === $job_status->id)? 'selected':'' }}>{{ $job_status->description }}</option>
                @empty
                    <option></option>
                @endforelse
            </select>
        </div>
    </div>
    <div class="row mt-1 show_on_approve">
        <div class="col-md-2 text-right vertical-middle">
            <label>อนุมัติที่</label>
        </div>
        <div class="col-md-4 form-group vertical-middle">
            <input type="text" class="form-control" name="meters[approve_location]" id="approve_location" placeholder="อนุมัติที่" value="{{ $meter->approve_location?? old('meters.approve_location') }}">
        </div>
        <div class="col-md-2 text-right vertical-middle">
            <label>ลงวันที่</label>
        </div>
        <div class="col-md-4 form-group vertical-middle">
            <input type="date" class="form-control" id="approve_date" name="meters[approve_date]" id="approve_date" placeholder="ลงวันที่" value="{{ $meter->approve_date?? old('meters.approve_date') }}"
                   data-toggle="tooltip"
                   data-placement="top" data-original-title="{{ buddhismDate($meter->approve_date?? old('meters.approve_date')) }}">
        </div>
    </div>
    <div class="row mt-1 show_on_approve hide_on_no_payment">
        <div class="col-md-2 text-right vertical-middle">
            <label>เลขที่หนังสือแจ้งค่าใช้จ่าย</label>
        </div>
        <div class="col-md-4 form-group vertical-middle">
            <input type="text" class="form-control" name="meter_extra[approve_letter_no]" id="approve_letter_no" placeholder="เลขที่หนังสือแจ้งค่าใช้จ่าย" value="{{ $meter_extra['approve_letter_no']?? '' }}">
        </div>
        <div class="col-md-2 text-right vertical-middle">
            <label>วันที่แจ้งค่าใช้จ่าย</label>
        </div>
        <div class="col-md-4 form-group vertical-middle">
            <input type="date" class="form-control" name="meter_extra[approve_letter_date]" id="approve_letter_date" placeholder="วันที่แจ้งค่าใช้จ่าย" value="{{ $meter_extra['approve_letter_date']?? null }}"
                   data-toggle="tooltip"
                   data-placement="top" data-original-title="{{ $meter_extra['approve_letter_date']?? null }}">
        </div>
    </div>
    <div class="row mt-1 show_on_approve_date hide_on_no_payment">
        <div class="col-md-2 text-right vertical-middle">
            <label>หมดกำหนดยืนราคา</label>
        </div>
        <div class="col-md-4 form-group vertical-middle">
            <input type="date" class="form-control" id="expires_quote_date" name="meters[expires_quote_date]" placeholder="หมดกำหนดยื่นราคา" value="{{ $meter->expires_quote_date?? old('meters.expires_quote_date') }}"
                   readonly data-toggle="tooltip" data-placement="top" data-original-title="{{ buddhismDate($meter->expires_quote_date?? old('meters.expires_quote_date')) }}"/>
        </div>
        <div class="col-md-2 text-right vertical-middle">
            <label>วันที่ชำระเงิน</label>
        </div>
        <div class="col-md-4 form-group vertical-middle">
            <input type="date" class="form-control" name="meters[payment_date]" id="payment_date" placeholder="วันที่ชำระเงิน" value="{{ $meter->payment_date?? old('meters.payment_date') }}" data-toggle="tooltip"
                   data-placement="top"
                   data-original-title="{{ buddhismDate($meter->payment_date?? old('meters.payment_date')) }}">
        </div>
    </div>
    <div class="row mt-1 show_on_approve">
        <div class="col-md-2 text-right vertical-middle"></div>
        <div class="col-md-4 form-group vertical-middle">
            <fieldset>
                <div class="checkbox">
                    <input type="checkbox" class="checkbox-input" id="has_no_payment" {{ (isset($meter->has_payment) && !$meter->has_payment)? 'checked' : '' }}>
                    <label for="has_no_payment">ไม่มีค่าใช้จ่ายเรียกเก็บ</label>
                </div>
            </fieldset>
        </div>
        <div class="col-md-2 text-right vertical-middle">
            <label>ผบค. ส่งงาน</label>
        </div>
        <div class="col-md-4 form-group vertical-middle">
            <input type="date" class="form-control" name="meters[service_final_date]" placeholder="ผบค. ส่งงาน" id="service_final_date"
                   value="{{ $meter->service_final_date?? old('meters.service_final_date') }}" data-toggle="tooltip"
                   data-placement="top" data-original-title="{{ buddhismDate($meter->service_final_date?? old('meters.service_final_date')) }}">
        </div>
    </div>
    <div class="row mt-1">
        <div class="col-md-2 text-right vertical-middle">
            <label>หมายเหตุ</label>
        </div>
        <div class="col-md-10 form-group vertical-middle">
            <textarea class="form-control" rows="3" name="meters[comment]" placeholder="หมายเหตุ">{{ $meter->comment?? old('meters.comment') }}</textarea>
        </div>
    </div>

    <hr>

    <div class="row mt-1">
        <div class="col-sm-12 d-flex justify-content-end">
            <a href="{{ route('meters.index') }}" class="btn btn-secondary mr-1"><i class="bx bx-arrow-back"></i> ย้อนกลับหน้าหลัก</a>
            @if(!$isCreate) <a href="{{ route('meter-pdf', $meter->id) }}" target="_BLANK" class="btn btn-success mr-1"><i class="bx bx-printer"></i> พิมพ์แบบฟอร์มขออนุมัติ</a> @endif
            <button type="reset" class="btn btn-light-secondary mr-1">คืนค่าเริ่มต้น</button>
            <button type="submit" class="btn btn-primary"><i class="bx bx-save"></i> บันทึกข้อมูล</button>
        </div>
    </div>
</div>

@push('scripts')
    <script src="{{asset('vendors/js/extensions/toastr.min.js')}}"></script>
@endpush

{{-- page scripts --}}
@section('page-scripts')
    <script>
        $(document).ready(function () {

            $(document).on('change', '#job_type_id', function () {
                check_job_type_id($(this).val());
            });

            const job_status_id = document.getElementById("job_status_id");
            let previous_job_status_id_value = job_status_id.value;

            job_status_id.addEventListener('change', (e) => {
                const value = parseInt(e.target.value);
                if (!check_job_status_id()) {
                    e.target.value = previous_job_status_id_value;
                } else {
                    previous_job_status_id_value = value;
                }

                clearAllAppendedRequired();
                if (value > 1) {
                    document.getElementById("survey_user_id").setAttribute("required", "required");
                }
                if (value > 2) {
                    document.getElementById("job_number").setAttribute("required", "required");
                }
                if (value > 3) {
                    document.getElementById("approve_location").setAttribute("required", "required");
                    document.getElementById("approve_date").setAttribute("required", "required");
                }
                if (value > 4) {
                    document.getElementById("service_final_date").setAttribute("required", "required");
                }
                if (value > 90) {
                    document.getElementById("job_number").removeAttribute("required");
                }

                toggle_show_on_approve(e.target.value);
            });

            $(document).on('change', '#job_amount_id', function () {
                coloringProgressBar();
            });

            $(document).on('change', '#approve_location', function () {
                toggle_overdue_date();
            });

            $(document).on('change', '#approve_location', function () {
                toggle_overdue_date();
            });

            $(document).on('change', '#approve_date', function () {
                toggle_overdue_date();
            });

            $(document).on('change', '#has_no_payment', function () {
                $('#has_payment').prop('checked', !$(this).is(':checked'));
                toggle_service_final_date();
            });

            $(document).on('change', '#has_payment', function () {
                $('#has_no_payment').prop('checked', !$(this).is(':checked'));
                toggle_service_final_date();
            });

            $(document).on('change', '#payment_date', function () {
                toggle_service_final_date();
                toggle_service_final_date();
            });

            $(document).on('change', '#requested_place_id', function () {
                update_credit_term($('option:selected', this).attr('credit_terms'));
            });

            $(document).on('change', '#approve_date', function () {
                update_credit_term($('option:selected', '#requested_place_id').attr('credit_terms'));
            });

            $(document).on('change', '#survey_user_id', function () {
                check_selected_survey_user();
            });

            function clearAllAppendedRequired() {
                document.getElementById("survey_user_id").removeAttribute("required");
                document.getElementById("job_number").removeAttribute("required");
                document.getElementById("approve_location").removeAttribute("required");
                document.getElementById("approve_date").removeAttribute("required");
                document.getElementById("service_final_date").removeAttribute("required");
            }

            function check_job_status_id() {
                switch (job_status_id.value) {
                    case '2':
                        return check_selected_survey_user();
                    case '3':
                        if (!$('#job_number').val()) {
                            toastr['warning']('{{ __('meter.please_input_job_number') }}', {
                                closeButton: true,
                                tapToDismiss: false
                            });
                            return false;
                        }
                        break;
                }
                return true;
            }

            function check_selected_survey_user() {
                const survey_user_id = $('#survey_user_id').val();
                if (!survey_user_id) {
                    toastr['warning']('{{ __('meter.please_select_survey_user_id') }}', {
                        closeButton: true,
                        tapToDismiss: false
                    });
                    job_status_id.value = 1;
                    return false;
                }
                if (job_status_id.value === '1') {
                    job_status_id.value = 2;
                    // job_status_id.fireEvent("onchange");
                    previous_job_status_id_value = 2;
                }
                return true;
            }

            function check_job_type_id(job_type_id) {
                if (job_type_id === "4" || job_type_id === "5") {
                    $('.meter-transformer').show();
                } else {
                    $('.meter-transformer').hide();
                }
            }

            function update_credit_term(credit_terms) {
                const date = new Date($("#approve_date").val()), days = parseInt(credit_terms, 10);

                if (!isNaN(date.getTime())) {
                    date.setDate(date.getDate() + days);
                    $("#expires_quote_date").val(date.toInputFormat());
                    $("#expires_quote_date").trigger('change');
                }
            }

            function toggle_show_on_approve(job_status_id) {
                switch (job_status_id) {
                    case "4":
                    case "5":
                        $('.show_on_approve').show();
                        document.getElementById("approve_location").setAttribute("required", "required");
                        document.getElementById("approve_date").setAttribute("required", "required");
                        document.getElementById("service_final_date").setAttribute("required", "required");
                        break;
                    case "98":
                    case "99":
                        document.getElementById("approve_location").removeAttribute("required");
                    default:
                        $('.show_on_approve').hide();
                        document.getElementById("approve_location").removeAttribute("required");
                        document.getElementById("approve_date").removeAttribute("required");
                        document.getElementById("service_final_date").removeAttribute("required");
                }
                toggle_overdue_date();
            }

            function toggle_overdue_date() {
                if ($('#approve_location').val() && $('#approve_date').val()) {
                    $('.show_on_approve_date').show();
                } else {
                    $('.show_on_approve_date').hide();
                }
            }

            function toggle_service_final_date() {
                if ($('#has_no_payment').is(':checked') || $('#payment_date').val()) {
                    $('.show_on_no_pending_payment').show();
                } else {
                    $('.show_on_no_pending_payment').hide();
                }

                if ($('#has_no_payment').is(':checked')) {
                    $('.hide_on_no_payment').hide();
                } else {
                    $('.hide_on_no_payment').show();
                }
            }

            function coloringProgressBar() {
                const job_amount_id = document.getElementById("job_amount_id");
                const job_standard_duration = {!! json_encode($standardDurations ?? []) !!};
                const calculated_job_duration = {!! json_encode($job_status_report ?? []) !!};
                const job_status_standard_duration = job_standard_duration[job_amount_id.value];

                $('.steps ul li').removeClass("overdue");

                let total_standard_duration = 0;
                $.each(job_status_standard_duration, function(job_status_id, job_status_standard_duration) {
                    $("#pgb_standard_" + job_status_id).text(job_status_standard_duration);
                    if (job_status_id !== "5") {
                        total_standard_duration += job_status_standard_duration;
                    }
                });
                $('#pgb_standard_total').text(total_standard_duration);

                let total_duration = 0;
                $.each(calculated_job_duration, function(job_status_name, summary_value) {
                    if (summary_value["avg"] > job_status_standard_duration[job_status_name]) {
                        $(".pgb_status_" + job_status_name).addClass("overdue");
                    }
                    if (job_status_name !== "payment") {
                        total_duration += summary_value["avg"];
                    }
                });
                if (total_duration > total_standard_duration) {
                    $(".pgb_status_total").addClass("overdue");
                }
            }

            Date.prototype.toInputFormat = function () {
                const yyyy = this.getFullYear().toString();
                const mm = (this.getMonth() + 1).toString(); // getMonth() is zero-based
                const dd = this.getDate().toString();
                return yyyy + "-" + (mm[1] ? mm : "0" + mm[0]) + "-" + (dd[1] ? dd : "0" + dd[0]); // padding
            };

            check_job_type_id($('#job_type_id').val());
            toggle_show_on_approve($('#job_status_id').val());
            update_credit_term($('option:selected', '#requested_place_id').attr('credit_terms'));
            check_selected_survey_user();
            coloringProgressBar();
            toggle_service_final_date();
        });
    </script>
@endsection