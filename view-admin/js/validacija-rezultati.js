$(document).ready(function () {

    $('#formRezultat').validate ({
        errorClass: "error fail-alert",
        validClass: "valid success-alert",
        
        rules: {
            rezultat: {
                required: true
            },
            potvrda_rezultata: {
                required: true
            },
            id_rezervacije: {
                required: true
            },
            status_meca: {
                required: true
            }
        },

        messages: {
            rezultat: {
                required: 'Morate uneti rezultat'
            },
            potvrda_rezultata: {
                required: '     Morate potvrditi rezultat'
            },
            id_rezervacije: {
                required: 'Morate uneti rezervaciju'
            }, 
            status_meca: {
                required: 'Morate uneti status meca'
            }

        }

    });

});