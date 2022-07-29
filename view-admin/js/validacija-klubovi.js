
$(document).ready(function () {
    $('#formIgrac').validate({
        errorClass: "error fail-alert",
        validClass: "valid success-alert",
        rules: {
            naziv: {
                required: true
            },
            adresa: {
                required: true
            }
        },
        messages: {
            naziv: {
                required: 'Morate uneti naziv sportskog kluba'
            },
            adresa: {
                required: 'Morate uneti adresu sportskog kluba'
            }
        }
    });
});

