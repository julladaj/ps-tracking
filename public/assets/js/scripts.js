(function(window, undefined) {
  'use strict';

  window.solarInit = () => {
    const provinceObject = $('#province');
    const amphureObject = $('#amphure');
    const districtObject = $('#district');
    const postcodeObject = $('#postcode');

    // on change province
    provinceObject.on('change', function(){
      const provinceId = $(this).val();

      amphureObject.html('<option value="">เลือกอำเภอ</option>');
      districtObject.html('<option value="">เลือกตำบล</option>');

      $.get('/amphures?province_id=' + provinceId, function(data){
        $.each(data, function(index, item){
          amphureObject.append(
              $('<option></option>').val(item.id).html(item.name_th)
          );
        });
      });
    });

    // on change amphure
    amphureObject.on('change', function(){
      const amphureId = $(this).val();

      districtObject.html('<option value="">เลือกตำบล</option>');

      $.get('/districts?amphure_id=' + amphureId, function(data){
        $.each(data, function(index, item){
          districtObject.append(
              $('<option data-postcode="' + item.zip_code + '"></option>').val(item.id).html(item.name_th)
          );
        });
      });
    });

    // on change districts
    districtObject.on('change', function(){
      postcodeObject.val($(this).find(':selected').attr('data-postcode'));
    });

    $('.select2').select2();
  }

})(window);