
$(document).ready(function () {
    $('#formProfil').validate({
        errorClass: "error fail-alert",
        validClass: "valid success-alert",
        rules: {
            ime: {
                required: true
            },
            prezime: {
                required: true
            },
            email: {
                required: true,
                email: true
            }

        },
        messages: {
            ime: {
                required: 'Morate uneti ime radnika'
            },
            prezime: {
                required: 'Morate uneti prezime radnika'
            },

            email: {
                required: "Morate uneti email adresu",
                email: 'Pogrešan format email adrese'
            }

        }
    });
});

