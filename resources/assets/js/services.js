$(document).ready(function () {
    $("#customerEmail").select2();
    $("#domainReseller").select2();
    $("#hostingReseller").select2();
    $("#serviceStartDaty").datepicker({
        format: "yyyy-mm-dd",
        todayHighlight: true,
    });
    $("#serviceExpireDate").datepicker({
        format: "yyyy-mm-dd",
        todayHighlight: true,
    });
    // Domain Hosting show hide
    $(".domain-reseller").hide();
    $(".hosting-reseller").hide();
    $(".hosting-type").hide();
    $(".hosting-package").hide();
    $("#serviceFor").on("change", function () {
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
    });

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
