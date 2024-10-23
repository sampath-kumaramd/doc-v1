$(document).ready(function () {
    $("#send-otp").click(function () {
        var phoneNumber = $("#mobile_no").val();
        $.ajax({
            url: "/otp/send",
            method: "POST",
            data: { phone_number: phoneNumber },
            success: function (response) {
                if (response.success) {
                    alert("OTP sent successfully");
                } else {
                    alert("Failed to send OTP");
                }
            },
        });
    });

    $("#verify-otp").click(function () {
        var otp = $("#otp").val();
        $.ajax({
            url: "/otp/verify",
            method: "POST",
            data: { otp: otp },
            success: function (response) {
                if (response.success) {
                    alert("OTP verified successfully");
                } else {
                    alert("Invalid OTP");
                }
            },
        });
    });

    // Add client-side validation for the registration form
    $("form").submit(function (e) {
        var isValid = true;
        // Add your validation logic here
        if (!isValid) {
            e.preventDefault();
        }
    });
});
