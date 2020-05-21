$(document).ready(function () {
    $("#individualEmail").select2();
    $("#companyEmail").select2();
    $("#domainReseller").select2();
    $("#hostingReseller").select2();
    $("#serviceStartDaty").datepicker({
        format: "dd-mm-yyyy",
        todayHighlight: true,
    });
    $("#serviceExpireDate").datepicker({
        format: "dd-mm-yyyy",
        todayHighlight: true,
    });

    $(".serviceCheckbox").on("click", function () {
        var id = $(this).val();
        if ($(this).is(":checked")) {
            $("#hidden_st_" + id).val(id);
        } else {
            $("#hidden_st_" + id).val(0);
        }
    });
    // Company Types
    $(".individual-customer").hide();
    $(".company-customer").hide();
    $("#customerType").on("change", function () {
        var customerType = $(this).children(":selected").val();
        if (customerType === "1") {
            $(".individual-customer").show();
            $(".company-customer").hide();
        } else if (customerType === "2") {
            $(".individual-customer").hide();
            $(".company-customer").show();
        } else {
            $(".individual-customer").hide();
            $(".company-customer").hide();
        }
    });

    // Domain Hosting show hide
    $(".domain-reseller").hide();
    $(".hosting-reseller").hide();
    $(".hosting-type").hide();
    $(".hosting-package").hide();
    $(".other-details").hide();

    $("input:checkbox").change(function () {
        $(":checkbox:checked").each(function (i) {
            checked = $(this).val();
            if (checked === "1") {
                $(".domain-reseller").show();
            }

            if (checked === "2") {
                $(".hosting-reseller").show();
                $(".hosting-type").show();
            }

            if (checked === "3") {
                $(".other-details").show();
            }
        });
        $(":checkbox:not(:checked)").each(function (i) {
            unchecked = $(this).val();
            if (unchecked === "1") {
                $(".domain-reseller").hide();
            }

            if (unchecked === "2") {
                $(".hosting-reseller").hide();
                $(".hosting-type").hide();
                $(".hosting-package").hide();
                $(".custom-package").hide();
            }

            if (unchecked === "3") {
                $(".other-details").hide();
            }
        });
    });

    /*$("#serviceFor").on("change", function () {
        var serviceName = $(this).children(":selected").val();
        if (serviceName === "1") {
            $(".domain-reseller").show();
            $(".hosting-reseller").show();
            $(".hosting-type").show();
            $(".hosting-package").hide();
            $(".custom-package").hide();
        } else if (serviceName === "2") {
            $(".domain-reseller").hide();
            $(".hosting-reseller").show();
            $(".hosting-type").show();
            $(".hosting-package").hide();
            $(".custom-package").hide();
        } else if (serviceName === "3") {
            $(".domain-reseller").show();
            $(".hosting-reseller").hide();
            $(".hosting-type").hide();
            $(".hosting-package").hide();
            $(".custom-package").hide();
        } else {
            $(".domain-reseller").hide();
            $(".hosting-reseller").hide();
            $(".hosting-type").hide();
            $(".hosting-package").hide();
            $(".custom-package").hide();
        }
    });*/

    // Package show hide
    $(".custom-package").hide();
    $(".hosting-package").hide();
    $("#hostingType").on("change", function () {
        var package = $(this).children(":selected").val();
        if (package === "custom") {
            $(".custom-package").show();
            $(".hosting-package").hide();
        } else if (package === "package") {
            $(".hosting-package").show();
            $(".custom-package").hide();
        } else {
            $(".custom-package").hide();
            $(".hosting-package").hide();
        }
    });
});
