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
                    <input type="number" class="form-control" name="meters[payment_request]" placeholder="เรียกเก็บจากผู้ใช้ไฟ" aria-describedby="payment_request"
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

    <hr>

    <div class="row mt-1">
        <div class="col-sm-12 d-flex justify-content-end">
            <a href="{{ route('meters.index') }}" class="btn btn-secondary mr-1"><i class="bx bx-arrow-back"></i> ย้อนกลับหน้าหลัก</a>
            <button type="reset" class="btn btn-light-secondary mr-1">คืนค่าเริ่มต้น</button>
            <button type="submit" class="btn btn-primary"><i class="bx bx-save"></i> บันทึกข้อมูล</button>
        </div>
    </div>
</div>
