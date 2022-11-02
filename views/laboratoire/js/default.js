$(document).ready(function () {

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

    let path = "http://localhost/hopitos/";
    $('#show_diagnostic_section').hide();

    //initialise datatable nouvelles demandes
    let dataTable_fiche_juste_ouvertes = $('#table_fiche_juste_ouvertes').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            url: path + "laboratoire/xhr_transfert_DataTable",
            type: "POST"
        },
        "columnDefs": [
            {
                "target": [0, 3, 4],
                "orderable": false
            }
        ]
    });

    //APPELER PATIENT
    $(document).on('click', '.btn_commencer_exam_appeler_patient', function (e) {
        e.preventDefault();
        var patient_id = $(this).attr('patient_id');
        var nom = $(this).attr('nom');
        var postnom = $(this).attr('postnom');
        var prenom = $(this).attr('prenom');

        const msg = new SpeechSynthesisUtterance();
        msg.volume = 1;//0 to 1
        msg.rate = 0.7;// 0.1 to 10
        msg.pitch = 1;//0 to 2
        msg.text = "numero " + patient_id + " " + nom + " " + postnom + " " + prenom + " Vous etes voulu au laboratoire";

        msg.voiceURI = "Amelie";
        msg.lang = "fr-FR";

        speechSynthesis.speak(msg);

    });

    // Voir diagnostics du transfert
    $(document).on('click', '.close_link_by_asad', function (e) {
        $('#show_diagnostic_section').hide();
    });
    $(document).on('click', '.show_diagnostic_section', function (e) {
        e.preventDefault();
        let diagnostic_id = $(this).attr('id');

        $.ajax({
            url: path + "consultation/get_diagnostic",
            type: 'POST',
            dataType: 'JSON',
            data: { diagnostic_id },
            success: function (data) {
                // console.log(data);
                $('#hidden_diagnostic_transfert_id').val(data.pk_diagnostic);
                $('#show_diagnostic_anamnese').html(data.note_plainte);
                $('#show_diagnostic_note_diagnostic').html(data.note_diagnostic);

                $('.labo_btn_insert_examen_resultat').attr("id", data.pk_diagnostic);
                $('.labo_btn_voir_resultat').attr("id", data.pk_diagnostic);

                $('#show_diagnostic_section').show();
            },
            error: function (data) {
                console.log(data);
                alert('Error!!');
            }
        });
    }); 

    //Ouvrir modal insert examens
    $(document).on('click', '.labo_btn_insert_examen_resultat', function (e) {
        e.preventDefault();
        var diagnostic_id = $(this).attr('id');

        $.ajax({
            url: path + "laboratoire/get_examens_demandes",
            type: 'POST',
            dataType: 'JSON',
            data: {
                diagnostic_id
            },
            success: function (exams) {
                console.log(exams);
                let body_modal_inserer_resultat_labo = ``;
                exams.forEach(exam => {
                    body_modal_inserer_resultat_labo = `
                        <li>
                            <div class="row">
                                <div class="col-6">
                                    <span>${exam.nom_acte}</span>
                                </div>
                                <div class="col-6">
                                    <input width="100%" type="text" class="flat input_insert_resultat_labo" id="${exam.pk_demande_labo}" name="${exam.pk_demande_labo}">
                                </div>
                            </div>
                        </li>
                    `;
                });
                $('#body_modal_voir_insert_modal').html(body_modal_inserer_resultat_labo);
                $('#insert_resultat_modal').modal('show');
            },
            error: function (data) {
                alert('Error!!');
            }
        });
    });

    //Done insert examens
    $(document).on('click', '#btn_valider_insertion_resultat', function (e) {
        e.preventDefault();
        let tab_resultat = [];

        $('input[type="text"]').each(function () {
            tab_resultat.push([$(this).attr("id"), $(this).val()]);
        });

        $.ajax({
            url: path + "laboratoire/insert_resultat_examen",
            type: 'POST',
            dataType: 'JSON',
            data: {
                tab_resultat
            },
            success: function (exams) {
                console.log(exams);
                if (exams) {
                    notification('Succès', 'Operation effectuée ave succès', 'success', 2);
                    $('#insert_resultat_modal').modal('hide');
                } else {
                    notification('Echec', 'Contactez l administrateur', 'error', 2);
                }
            },
            error: function (data) {
                console.log(data);
                alert('Error!!');
            }
        });
        
    });


    // Done insert resultat imagerie
    $(document).on('submit', '#form_inserer_image_exam', function (e) {
        e.preventDefault();

        $.ajax({
            url: path + "laboratoire/done_add_resultat_labo",
            type: 'POST',
            dataType: 'JSON',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (result) {
                console.log(result);
                if (exams) {
                    notification('Succès', 'Operation effectuée ave succès', 'success', 2);
                    $('#insert_resultat_modal').modal('hide');
                } else {
                    notification('Echec', 'Contactez l administrateur', 'error', 2);
                }
            },
            error: function (data) {
                console.log(data);
                alert('Error!!');
            }
        });

    });


    // Show result examen
    $(document).on('click', '.btn_show_resultat_exam_image_modal', function (e) {
        e.preventDefault();
        var exam_id = $(this).attr('id');
        $.ajax({
            url: path + "laboratoire/get_exam",
            type: 'POST',
            dataType: 'JSON',
            data: {
                exam_id: exam_id
            },
            success: function (exam) {

                let radio = $('#img_radiographie').attr('src');
                $('#img_radiographie').attr('src', radio + exam.radiographie);

                let echo = $('#img_echographie').attr('src');
                $('#img_echographie').attr('src', echo + exam.echographie);

                let irm = $('#img_irm').attr('src');
                $('#img_irm').attr('src', irm + exam.irm);

                let endo = $('#img_endoscopie').attr('src');
                $('#img_endoscopie').attr('src', endo + exam.endoscopie);

                let scan = $('#img_scanner').attr('src');
                $('#img_scanner').attr('src', scan + exam.scanner);

                $('#voir_resultat_examen_image_modal').modal('show');
            },
            error: function (data) {
                alert('Error!!');
            }
        });
    });

    //VOIR_LES_DETAILS_D'UNE_CONSULTATION
    $(document).on('click', '.btn_show_consultation_modal', function (e) {
        e.preventDefault();
        var fiche_id = $(this).attr('fiche_id');

        $.ajax({
            url: path + "laboratoire/get_fiche",
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
                $('#voir_consultation_modal').modal('show');
            },
            error: function (data) {
                alert('Error!!');
            }
        });
    });


});

