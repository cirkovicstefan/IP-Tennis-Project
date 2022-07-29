
$(document).ready(function () {
    $('#formRezervacija').validate({
        errorClass: "error fail-alert",
        validClass: "valid success-alert",
        rules: {
            id_igraca1: {
                required: true
            },
            id_igraca2: {
                required: true
            },
            id_igraca3: {
                required: true
            },
            id_igraca4: {
                required: true
                
            },
            id_terena:{
                required: true
            },
            id_meca:{
                required: true
            },
            datum:{
                required: true
            },
            vreme:{
                required: true
            }
        },
        messages: {
            id_igraca1: {
                required: 'Morate odabrati igrača'
            },
            id_igraca2: {
                required: 'Morate odabrati igrača'
            },
            id_igraca3: {
                required: 'Morate odabrati igrača'
            },
            id_igraca4: {
                required: 'Morate odabrati igrača'
            },
            id_terena:{
                required: 'Morate odabrati teren'
            },
            id_meca:{
                required: 'Morate odabrati tip meča'
            },
            datum:{
                required: 'Morate uneti datum'
            },
            vreme:{
                required: 'Morate uneti vreme'
            }
            
        }
    });
});

