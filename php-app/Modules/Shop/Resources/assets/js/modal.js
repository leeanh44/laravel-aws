import requester from "./utils/requester";
import {
    renderErrors,
    clearErrorMessage,
} from "./utils/helper";

$(function () {
    $('#create_submit_form, #update_submit_form').on('submit', function (e) {
        e.preventDefault();
        let $form = $(this);
        let $modal = $(this).closest('.modal');
        let action = $form.attr('action');
        let formData = $form.serialize();
        
        $form.formModal('loading');
        requester.send(action, "POST", formData, function (response) {
            $form.formModal('success');
            console.log(response);
            if ((typeof response.meta !== 'undefined') && response.meta.code === 200) {
                toastr.success(response.meta.message, "Thành công!", {
                    timeOut: 2000
                });

                setTimeout(() => location.reload(), 500);
            } else {
                $modal.find("button.close").show();
                $form.find("button").attr("disabled", false);
                $form.find("button.btn-submit").removeClass("isLoading");
                renderErrors($form, response.responseJSON.meta);
            }
        });
    });

    $('#create_form_modal, #update_form_modal').on('show.coreui.modal', function (e) {
        let $currentTarget = $(e.currentTarget);
        let data = e.relatedTarget.dataset;
        let $form = $currentTarget.find('form');
        $form[0].reset();
        clearErrorMessage($form);

        if (data.init == 'true') {
            $.each(data, function (key, value) {
                $currentTarget.find(`[name="${key}"]`).val(value);
            });
        }
    });

    $('.link-open-modal').on('click', function (e) {
        e.preventDefault();
    });
});
