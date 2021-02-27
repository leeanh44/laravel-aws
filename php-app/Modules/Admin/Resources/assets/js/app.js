$(function () {
    $.fn.inputFilter = function(inputFilter) {
        return this.on("input keydown keyup mousedown mouseup select contextmenu drop", function() {
            if (inputFilter(this.value)) {
                this.oldValue = this.value;
                this.oldSelectionStart = this.selectionStart;
                this.oldSelectionEnd = this.selectionEnd;
            } else if (this.hasOwnProperty("oldValue")) {
                this.value = this.oldValue;
                this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
            } else {
                this.value = "";
            }
        });
    };

    $('input.text').on('input', function() {
        $(this).val($(this).val()
               .replace(/[^0-9a-zA-Z_ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s]/gi, ''));
    });

    $('input.text').on('change', function() {
        $(this).val($(this).val()
               .replace(/[^0-9a-zA-Z_ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s]/gi, ''));
    });

    $('input.positive-integer').inputFilter(function (value) {
        
        return /^\d*$/.test(value) && (value === '' || parseInt(value) > 0);
    });

    $('input.positive-number').inputFilter(function (value) {
        if ((String(value).length > 1) && (String(value).charAt(0) == 0)) {
            return false;
        }

        let valueNew = value.replace(/,/g, "");
        return /^\d*$/.test(valueNew) && (valueNew === '' || parseInt(valueNew) >= 0);
    });

    if($('.form-bs4__file__preview img').length == 0){
        $('.form-bs4__file__overlay').hide();
    }

    $('.reset-image').on('click', function(e){
        e.preventDefault();
        e.stopImmediatePropagation();
        let $parent = $(this).closest('#preview_image');
        let $input = $($parent.attr('input-target'));
        $input.val('').trigger('change'); 
    });

    $('.form-bs4__file__preview').on('click', function(e) {
        e.preventDefault();
        let input = $(this).attr('input-target');
        $(input).trigger('click');
    });


    $('.form-bs4__file__preview').each(function(){
        let $this = $(this);
        if($this.find('img').length > 0){
            $this.find('.form-bs4__file__empty').hide();
            $this.find('.form-bs4__file__overlay').show();
        }else{
            $this.find('.form-bs4__file__empty').show();
            $this.find('.form-bs4__file__overlay').hide();
        }
    })

    $('.form-bs4__file__input').on('change', function(e) {
        const preview = $(this).attr('preview-target');
        const file = e.target.files && e.target.files[0];
        if (file) {
            if (!file['type'].startsWith('image')) {
                alert('Chỉ được chọn hình ảnh!');
                return false;
            }

            var reader = new FileReader();
            reader.onload = function() {
                $(preview).find('.form-bs4__file__empty').hide();
                $(preview).find('.form-bs4__file__overlay').show();

                const imgHtml = `<img src="${reader.result}" alt="temp preview" class="tmp-image"/>`;
                $(preview).find('img.tmp-image').remove();
                $(preview).append(imgHtml);
            }
            reader.readAsDataURL(file);
        }else{
            $(preview).find('img').remove();
            $(preview).find('input[type="hidden"]').remove();
            $(preview).find('.form-bs4__file__empty').show();
            $(preview).find('.form-bs4__file__overlay').hide();
        }
    });

    // Datepicker
    var userTarget = "";
    var exit = false;
    $('.input-daterange').datepicker({
        todayHighlight: true, 
        format: "dd/mm/yyyy",
        weekStart: 0,
        calendarWeeks: true,
        autoclose: true,
        orientation: "auto",
        showOnFocus: true,
        maxViewMode: 'days',
        keepEmptyValues: true
    });
    $('.input-daterange').focusin(function(e) {
        userTarget = e.target.name;
    });
    $('.input-daterange').on('changeDate', function(e) {
        if (exit) return;
        if (e.target.name != userTarget) {
            exit = true;
            $(e.target).datepicker('clearDates');
        }
        exit = false;
    });
});
