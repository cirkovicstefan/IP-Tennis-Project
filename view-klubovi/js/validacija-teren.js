
$(document).ready(function () {
    $('#formTeren').validate({
        errorClass: "error fail-alert",
        validClass: "valid success-alert",
        rules: {
            naziv: {
                required: true
            },
            lokacija: {
                required: true
            },
            vrsta_podloge: {
                required: true
            },
            kapacitet: {
                required: true,
                number: true
            },
            id_kluba:{
                required: true
            }
        },
        messages: {
            naziv: {
                required: 'Morate uneti naziv terena'
            },
            lokacija: {
                required: 'Morate uneti lokaciju'
            },
            vrsta_podloge: {
                required: 'Morate uneti vrstu podloge'
            },
            kapacitet: {
                required: "Morate uneti kapacitet terena",
                number: 'Kapacitet terena mora biti numerički podatak'
            },
            id_kluba:{
                required:'Morate odabrati klub'
            }
        }
    });
});

