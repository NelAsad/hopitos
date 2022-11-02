
$(document).ready(function () {

    let path = "http://localhost/hopitos/";

    // function pour la notification
    function notification(titre, text, type, seconde) {
        new PNotify({
            title: titre,
            text: text,
            type: type,
            delay: seconde*1000,
            styling: 'bootstrap3'
        });
    }

    //initialise_datatable_patients
    var dataTable_patient = $('#table_patients').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            url: path + "patient/patient_datatable",
            type: "POST"
        },
        "columnDefs": [
            {
                "target": [0, 3, 4],
                "orderable": false
            }
        ]
    });

    
    //OUVRIR UNE FICHE
    //Afficher modal ouvrir fiche
    $(document).on('click', '.btn_ouvrir_fiche_patient', function (e) {
        e.preventDefault();
        $('#ouvrir_fiche_fk_patient_id').val($(this).attr('id'));
        $('#ouvrir_fiche_modal').modal('show');
    });
    //Donne ouverture fiche
    $(document).on('click', '#btn_done_ouverture_fiche', function (e) {
        e.preventDefault();

        let patient_id = $('#ouvrir_fiche_fk_patient_id').val();
        let poids = $('#ouvrir_fiche_poids').val();
        let tension = $('#ouvrir_fiche_tension').val();
        let temperature = $('#ouvrir_fiche_temperature').val();
        let medecin_consultant_id = $('#ouvrir_fiche_medecin_id').val();

        $.ajax({
            url: path + "patient/ouvrir_une_fiche",
            type: 'POST',
            dataType: 'JSON',
            data: {
                patient_id: patient_id,
                poids: poids,
                tension: tension,
                temperature: temperature,
                medecin_consultant_id: medecin_consultant_id
            },
            success: function (data) {
                if (data.reponse == 'bien') {
                    notification('Succès', 'Fiche ouverte avec succes', 'success', 2);
                    $('#ouvrir_fiche_modal').modal('hide');
                    form_ouvrir_fiche.reset();
                }
                if (data.reponse == 'pas_bien') {
                    notification('Echec', 'Echec d\'ouverture de la fiche', 'error', 2);
                }
            },
            error: function (data) {
                console.log(data);
                alert('Error!!');
            }
        });
    });


});