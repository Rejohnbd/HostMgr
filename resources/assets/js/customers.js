$(document).ready(function () {
    $("#custJoinDate").datepicker({
        format: "yyyy-mm-dd",
        todayHighlight: true,
    });
    $("#joinYear").datepicker({
        format: "yyyy",
        viewMode: "years",
        minViewMode: "years",
    });
});

(function ($) {
    $(function () {
        var addForm = function () {
            $(".contact-person-form")
                .clone()
                .appendTo(".add-contact-form")
                .removeClass("contact-person-form")
                .find("button")
                .removeAttr("id")
                .removeClass("btn-add btn-success")
                .addClass("btn-remove btn-danger")
                .html("-");
        };

        var deleteForm = function () {
            // $('.contact-person-form').clone().appendTo('.add-contact-form').removeClass('contact-person-form').find('button').removeAttr('id').removeClass('btn-add btn-success').addClass('btn-remove btn-danger').html('-')
            $(this).closest(".multiple-form-group").remove();
        };

        $(document).on("click", ".btn-add", addForm);
        $(document).on("click", ".btn-remove", deleteForm);
    });
})(jQuery);
