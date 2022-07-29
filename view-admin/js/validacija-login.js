
$(document).ready(function () {
    $('#formLogin').validate({
        errorClass: "error fail-alert",
        validClass: "valid success-alert",
        rules: {
            email: {
                required: true,
                email: true
            },
            lozinka: {
                required: true
            }

        },
        messages: {
            email: {
                required: 'Morate uneti email adresu',
                email: 'Pogrešan format email adrese'
            },
            lozinka: {
                required: 'Morate uneti lozinku'
            }
        }
    });
});

