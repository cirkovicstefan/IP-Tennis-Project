
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
            pobeda: {
                required: true,
                number: true
            },
            porazi: {
                required: true,
                number: true
            },
            visina: {
                required: true,
                number: true
            },
            godine: {
                required: true,
                number: true

            }
        },
        messages: {
            ime: {
                required: 'Morate uneti ime igrača'
            },
            prezime: {
                required: 'Morate uneti prezime igrača'
            },
            lozinka: {
                required: 'Morate uneti lozinku',
                minlength: 'Lozinka mora da bude više od 8 karaktera'
            },
            email: {
                required: "Morate uneti email adresu",
                email: 'Pogrešan format email adrese'
            }
            , pobeda: {
                required: "Morate uneti broj pobeda",
                number: 'Pobede moraju da budu numerički podataka'
            },
            porazi: {
                required: 'Morate uneti broj poraza',
                number: "Porazi moraju da budu numerički podataka"
            }, godine: {
                required: 'Morate uneti broj godina igrača',
                number: "Godine moraju da budu numerički podataka"
            },
            visina:{
                required: 'Morate uneti visinu igrača',
                number: "Visina mora da bude numerički podataka"
            }
        }
    });
});

