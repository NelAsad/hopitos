
$(document).ready(function() {

    let path = "http://localhost:92/hopitos/";


    //VOIR_LES_DETAILS_D'UNE_CONSULTATION
    $(document).on('click', '.btn_show_consultation_modal_dossier', function (e) {
        e.preventDefault();
        var fiche_id = $(this).attr('id');

        $.ajax({
            url: path + "consultation/get_fiche",
            type: 'POST',
            dataType: 'JSON',
            data: {
                fiche_id: fiche_id
            },
            success: function (fiche) {

                $('#show_consulation_fiche_id').html(fiche.fiche_id);
                $('#show_consulation_patient_fiche_numero').html(fiche.patient_fiche_numero);
                $('#show_consulation_patient_nom').html(fiche.patient_nom);
                $('#show_consulation_patient_postnom').html(fiche.patient_postnom);
                $('#show_consulation_patient_prenom').html(fiche.patient_prenom);
                $('#show_consulation_patient_poids').html(fiche.poids);
                $('#show_consulation_patient_tension').html(fiche.tension);
                $('#show_consulation_date_ouverture').html(fiche.fiche_ouverture_date);
                $('#show_consulation_date_cloture').html(fiche.fiche_cloture_date);
                $('#voir_consultation_syptomes').html(fiche.symptomes);
                $('#voir_consultation_diagnostic').html(fiche.diagnostic);
                $('#voir_consultation_resultat_labo').html(fiche.resultat_labo);
                $('#voir_consultation_traitement').html(fiche.traitement);
                $('#voir_consultation_precription').html(fiche.pres_medicale);
                $('#voir_consultation_modal_dossier').modal('show');
            },
            error: function (data) {
                alert('Error!!');
            }
        });
    });

    //IMPRIMER LA FICHE
    $(document).on('click', '.btn_imprimer_fiche', function (e) {
        e.preventDefault();
        var fiche_id = $(this).attr('id');
        window.open(path + "consultation/print_fiche/?ident_asadienne=" + fiche_id, 'blank');
    });

});