
$(document).ready(function () {
    $('#formIgrac').validate({
        errorClass: "error fail-alert",
        validClass: "valid success-alert",
        rules: {
            ime: {
                required: true
            },
            prezime: {
                required: true
            },
            lozinka: {
                required: true,
                minlength: 8
            },
            email: {
                required: true,
                email: true
            },
            naziv_kluba: {
                required: true,
            }
        },
        messages: {
            ime: {
                required: 'Morate uneti ime korisnika kluba'
            },
            prezime: {
                required: 'Morate uneti prezime korisnika kluba'
            },
            lozinka: {
                required: 'Morate uneti lozinku',
                minlength: 'Lozinka mora da bude više od 8 karaktera'
            },
            email: {
                required: "Morate uneti email adresu",
                email: 'Pogrešan format email adrese'
            }, 
            naziv_kluba: {
                required: "Morate uneti naziv kluba"
            }
        }
    });
});

