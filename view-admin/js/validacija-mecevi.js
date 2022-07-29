
$(document).ready(function () {
    $('#formIgrac').validate({
        errorClass: "error fail-alert",
        validClass: "valid success-alert",
        rules: {
            tip_meca: {
                required: true
            }
        },
        messages: {
            tip_meca: {
                required: 'Morate uneti tip meča'
            }
        }
    });
});

