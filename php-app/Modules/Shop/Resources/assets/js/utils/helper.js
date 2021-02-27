export const renderMesssage = ($parent, text) => {
    return $parent.find(".invalid-feedback").length > 0
        ? $parent.find(".invalid-feedback").html(text)
        : $parent.append(`<div class="invalid-feedback">${text}</div>`);
}

export const renderErrors = ($form, meta) => {
    clearErrorMessage($form);

    if (meta && meta.errors) {
        if (meta.code == 422) {
            let errors = meta.errors;
            let i = 0;
            $.each(errors, function(key, msg) {
                let $el = $form.find(`[name="${key}"]:not(:disabled)`);
                if(i == 0) {
                    $el.focus();
                    i = 1;
                }
                $el.val($.trim($el.val()));
                $el.closest(".form-group").addClass("has-errors");
                renderMesssage($el.closest(".form-group"), msg);
            });
        }
    } else {
        toastr.error(meta.message, "Có lỗi xảy ra!");
    }
}

export const clearErrorMessage = ($form) => {
    $form.find('.form-group').removeClass('has-errors');
    $form.find('.invalid-feedback').remove();
}
