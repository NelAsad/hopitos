
$(document).ready(function () {

    let path = "http://localhost/hopitos/";

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
                    toastr.options.progressBar = true;
                    toastr.options.showMethod = 'slideDown';
                    toastr.options.hideMethod = 'fadeOut';
                    toastr.options.closeMethod = 'fadeOut';
                    toastr.success('Fiche ouverte avec succes');
                    $('#ouvrir_fiche_modal').modal('hide');
                    form_ouvrir_fiche.reset();
                }
                if (data.reponse == 'pas_bien') {
                    toastr.options.progressBar = true;
                    toastr.options.showMethod = 'slideDown';
                    toastr.options.hideMethod = 'fadeOut';
                    toastr.options.closeMethod = 'fadeOut';
                    toastr.warning('Echec d\'ouverture de la fiche');
                }
            },
            error: function (data) {
                console.log(data);
                alert('Error!!');
            }
        });
    });


});