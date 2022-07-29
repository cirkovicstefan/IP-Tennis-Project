$(document).ready(function () {
    $('#formaLog').validate({
        
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
                required: 'Polje za email adresu ne sme biti prazno',
                email: 'Pogrešan format email adrese'
            },
            lozinka: {
                required: 'Polje za lozinku ne sme biti prazno'
            }
        }
    });
});

