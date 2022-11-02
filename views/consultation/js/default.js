
$(document).ready(function () {

    let path = "http://localhost/hopitos/";

    $('textarea.tiny').tinymce({
        height: 200,
        menubar: false,
        plugins: [
           'a11ychecker','advlist','advcode','advtable','autolink','checklist','export',
           'lists','link','image','charmap','preview','anchor','searchreplace','visualblocks',
           'powerpaste','fullscreen','formatpainter','insertdatetime','media','table','help','wordcount'
        ],
        toolbar: 'undo redo | a11ycheck casechange blocks | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist checklist outdent indent | removeformat | code table help'
      });

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

    $('#show_diagnostic_section').hide();
    let tab_prescription = [];


    // INITIALISATION DES DATATABLES

    //initialise datatable fiches juste ouvertes (etape 1)
    var dataTable_etape1 = $('#table_fiche_juste_ouvertes').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            url: path + "consultation/consultation_etape1_datatable",
            type: "POST"
        },
        "columnDefs": [
            {
                "target": [0, 3, 4],
                "orderable": false
            }
        ]
    });

    //COMMENCER UNE CONSULTATION
    //ouvrir_modal_commencer_consultation
    $(document).on('click', '.btn_commencer_consultation_patient_modal', function (e) {
        e.preventDefault();
        let transfert_id = $(this).attr('id');
        $('#hidden_commencer_consultation_transfert_id').val(transfert_id);
        $('#commencer_consultation_modal').modal('show');
    });
    //done_commencer_consultation
    $(document).on('click', '#btn_done_commencer_consultation', function (e) {
        e.preventDefault();
        var transfert_id = $('#hidden_commencer_consultation_transfert_id').val();
        var symptomes = $('#commencer_consultation_symptomes').val();
        var diagnostic = $('#commencer_consultation_diagnostic').val();

        $.ajax({
            url: path + "consultation/commencer_consultation",
            type: 'POST',
            dataType: 'JSON',
            data: {
                transfert_id,
                symptomes,
                diagnostic
            },
            success: function (data) {
                if (data.reponse == 'bien') {
                    $('#commencer_consultation_modal').modal('hide');
                    notification('Succès', 'les premieres informations ont ete bien enregistrees', 'success', 2);
                    form_commencer_consultation.reset();
                    dataTable_etape1.ajax.reload();
                }
                if (data.reponse == 'pas_bien') {
                    notification('Echec', 'Echec d\'ouverture de la consultation', 'error', 2);
                }
            },
            error: function (data) {
                console.log(data);
                alert('Error!!');
            }
        });

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

                $('.diagnostic_btn_demande_examen').attr("id", data.pk_diagnostic);
                $('.diagnostic_btn_prescrire').attr("id", data.pk_diagnostic);
                $('.diagnostic_voir_demande_examen').attr("id", data.pk_diagnostic);
                $('.diagnostic_voir_resultats_demande_examen').attr("id", data.pk_diagnostic);
                $('.diagnostic_voir_prescrire').attr("id", data.pk_diagnostic);

                $('#show_diagnostic_section').show();
            },
            error: function (data) {
                console.log(data);
                alert('Error!!');
            }
        });
    });


    //DEMANDER DES EXAMENS
    //ouvrir modal demande examens
    $(document).on('click', '.diagnostic_btn_demande_examen', function (e) { 
        e.preventDefault();
        let transfert_id = $(this).attr('id');
        $.ajax({
            url: path + "consultation/get_actes",
            type: 'POST',
            dataType: 'JSON',
            data: {},
            success: function (data) {
                console.log(data);
                $('#hidden_demande_diagnostic_id').val(transfert_id);
                let list_examen = ``;

                data.forEach(acte => {
                    list_examen += `
                        <li>
                            <p>
                                <input type="checkbox" class="flat" id="${acte.pk_acte}" name="${acte.pk_acte}"> ${acte.nom_acte}
                            </p>
                        </li>
                    `;
                });

                $('#list_demande_examen').html(list_examen);
                $('#demander_examens_modal').modal('show');
            },
            error: function (data) {
                console.log(data);
                alert('Error!!');
            }
        });

    });
    // valider demande examens
    $(document).on('click', '#btn_done_demande_exam', function (e) {
        e.preventDefault();
        let diagnostic_id = $('#hidden_demande_diagnostic_id').val();
        let actes = [];
        $(':checkbox:checked').each(function (i) {
            actes[i] = $(this).attr("id");
        });
        
        $.ajax({
            url: path + "consultation/demande_examen",
            type: 'POST',
            dataType: 'JSON',
            data: { actes, diagnostic_id },
            success: function (data) {
                notification('Succès', 'Operation effectuée ave succès', 'success', 2);
            },
            error: function (data) {
                console.log(data);
                alert('Error!!');
            }
        });
    });


    // PRESCRIPTION
    // Open modal prescription
    $(document).on('click', '.diagnostic_btn_prescrire', function (e) {
        e.preventDefault();
        let diagnostic_id = $(this).attr('id');
        $('#hidden_prescription_diagnostic_id').val(diagnostic_id);
        $('#do_prescription_modal').modal('show');
    });
    $(document).on('click', '#ajouter_prescription', function (e) {
        let prescription_medicament = $('#prescription_medicament').val();
        let prescription_posologie = $('#prescription_posologie').val();
        let prescription_dosage = $('#prescription_dosage').val();
        let tab_prescription_body = ``;

        tab_prescription.push([prescription_medicament, prescription_posologie, prescription_dosage]);
        // tab_keys_prescription.push(element.produit_id);

        tab_prescription.forEach((prod, index) => {
            tab_prescription_body += `
                <tr>
                    <td>${prod[0]}</td>
                    <td>${prod[1]}</td>
                    <td>${prod[2]}</td>
                    <td>
                        <button type="button" class="btn btn-danger btn-xs btn_remove_medicament" id="${index}"><i class="fa fa-times"></i></button>
                    </td>
                </tr>
            `;
        });
        $('#body_table_prescription').html(tab_prescription_body);
    });
    // Supprimer element de la liste des produits à sortir
    $(document).on('click', '.btn_remove_medicament', function (e) {
        e.preventDefault();
        let row_index = $(this).attr('id');
        let tab_prescription_body = ``;
        tab_prescription.splice(row_index, 1);
        tab_prescription.forEach((prod, index) => {
            tab_prescription_body += `
                <tr>
                    <td>${prod[0]}</td>
                    <td>${prod[1]}</td>
                    <td>${prod[2]}</td>
                    <td>
                        <button type="button" class="btn btn-danger btn-xs btn_remove_medicament" id="${index}"><i class="fa fa-times"></i></button>
                    </td>
                </tr>
            `;
        });
        $('#body_table_prescription').html(tab_prescription_body);
    });
    // valider prescription
    $(document).on('click', '#btn_valider_prescription', function (e) {
        e.preventDefault();
        let prescription_diagnostic_id = $('#hidden_prescription_diagnostic_id').val();
        
        $.ajax({
            url: path + "consultation/diagnostic_prescrire",
            type: 'POST',
            dataType: 'JSON',
            data: {
                prescription_diagnostic_id,
                tab_prescription
            },
            success: function (data) {
                $('#do_prescription_modal').modal('hide');
                notification('Succès', 'Operation effectuée ave succès', 'success', 2);
            },
            error: function (data) {
                console.log(data);
                alert('Error!!');
            }
        });
    });


    // Voir examens demandés
    $(document).on('click', '.diagnostic_voir_demande_examen', function (e) {
        e.preventDefault();
        let diagnostic_id = $(this).attr('id');
        
        $.ajax({
            url: path + "consultation/diagnostic_examen_demandes",
            type: 'POST',
            dataType: 'JSON',
            data: {
                diagnostic_id
            },
            success: function (data) {
                console.log(data);
                let body_modal_voir_examens_demandes = ``;

                data.forEach(exam => {
                    body_modal_voir_examens_demandes += `
                        <li>
                            <p>
                                <input type="checkbox" class="flat" disabled> ${exam.nom_acte}
                            </p>
                        </li>
                    `;
                });

                $('#body_modal_voir_diagnostic_examens_demandes').html(body_modal_voir_examens_demandes);
                $('#voir_demande_examens_modal').modal('show');
            },
            error: function (data) {
                console.log(data);
                alert('Error!!');
            }
        });
    });

    // Voir prescription
    $(document).on('click', '.diagnostic_voir_prescrire', function (e) {
        e.preventDefault();
        let diagnostic_id = $(this).attr('id');
        
        $.ajax({
            url: path + "consultation/diagnostic_prescription",
            type: 'POST',
            dataType: 'JSON',
            data: {
                diagnostic_id
            },
            success: function (data) {
                console.log(data);
                let body_modal_voir_prescriptions = ``;

                data.forEach(prescription => {
                    body_modal_voir_prescriptions += `
                        <tr>
                            <td>${prescription.medicament}</td>
                            <td>${prescription.posologie}</td>
                            <td>${prescription.dosage}</td>
                        </tr>
                    `;
                });

                $('#body_modal_voir_prescriptions').html(body_modal_voir_prescriptions);
                $('#voir_prescription_modal').modal('show');
            },
            error: function (data) {
                console.log(data);
                alert('Error!!');
            }
        });
    });



    
});



