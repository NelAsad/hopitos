$(document).ready(function () {

    let path = "http://localhost/hopitos/";

    //initialise_datatable_payement
    var dataTable_payements = $('#table_payements').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            url: path + "payement/payement_datatable",
            type: "POST"
        },
        "columnDefs": [
            {
                "target": [0, 3, 4],
                "orderable": false
            }
        ]
    });

    $('#bloc_ident_patient').show();
    $('#bloc_ident_demande').hide();
    $('.bloc_autre_payement').hide();

    //Affichage_des_champs_en_fontion_du_statut
    $(document).on('change', '#new_payement_motif', function () {
        if ($('#new_payement_motif').val() == 1) {
            $('#bloc_ident_patient').show();
            $('#bloc_ident_demande').hide();
            $('.bloc_autre_payement').hide();
        }
        if ($('#new_payement_motif').val() == 2) {
            $('#bloc_ident_demande').show();
            $('#bloc_ident_patient').hide();
            $('.bloc_autre_payement').hide();
        }
        if ($('#new_payement_motif').val() == 3) {
            $('.bloc_autre_payement').show();
            $('#bloc_ident_patient').show();
            $('#bloc_ident_demande').hide();
        }
    });

    //AJOUT_D'UN_NOUVEAU_PAYEMENT
    //show le modal
    $(document).on('click', '#btn_add_new_payement', function (e) {
        e.preventDefault();

        let new_payement_motif = $('#new_payement_motif').val();
        let new_payement_patient_id = $('#new_payement_patient_id').val();
        let new_payement_demande_id = $('#new_payement_demande_id').val();
        let new_payement_motif_autre_payement = $('#new_payement_motif_autre_payement').val();
        let new_payement_montant_autre_payement = $('#new_payement_montant_autre_payement').val();

        let montant_frais_labo = 0;
        let exam_demandes = [];

        if (new_payement_motif == 1) {
            if (new_payement_patient_id == '') {
                swal.fire({
                    title: 'Champs vide',
                    text: 'Veillez remplir tout les champs obligatoires',
                    type: 'error',
                    confirmButtonText: 'Ok'
                });
            } else {
                
                $.ajax({
                    url: path + "payement/get_patient",
                    type: 'POST',
                    dataType: 'JSON',
                    data: {
                        patient_id: new_payement_patient_id
                    },
                    success: function (patient) {
                        if (patient == false) {
                            swal.fire({
                                title: 'Code invalide',
                                text: 'Le numéro ne correspond à aucun patient',
                                type: 'error',
                                confirmButtonText: 'Ok'
                            });
                        } else {
                            $('#patient_preview_payement_fiche').html(patient.patient_prenom + ' ' + patient.patient_nom + ' ' + patient.patient_postnom);

                            $.ajax({
                                url: path + "payement/get_config_frais_fiche",
                                type: 'POST',
                                dataType: 'JSON',
                                success: function (config) {
                                    montant_frais_fiche = config.config_val;
                                    $('#montant_preview_payement_fiche').html(montant_frais_fiche);
                                    $('#valider_payement_fiche_modal').modal('show');
                                },
                                error: function (data) {
                                    alert('Error');
                                }
                            });
                        }
                    },
                    error: function (data) {
                        alert('Error');
                    }
                });
            }

        } else if (new_payement_motif == 2) {
            $.ajax({
                url: path + "payement/get_exam_by_id",
                type: 'POST',
                dataType: 'JSON',
                data: {
                    new_payement_demande_id: new_payement_demande_id
                },
                success: function (exams) {
                    if (exams == false) {
                        swal.fire({
                            title: 'Code invalide',
                            text: 'Le numéro ne correspond à aucune demande d\'examen',
                            type: 'error',
                            confirmButtonText: 'Ok'
                        });
                    } else {
                        $('#patient_preview_payement_labo').html(exams.patient_prenom + ' ' + exams.patient_nom + ' ' + exams.patient_postnom);

                        for (const key in exams) {
                            if (exams.hasOwnProperty(key)) {
                                const value = exams[key];
                                if (value == 'x_dem') {
                                    exam_demandes.push(key);
                                }
                            }
                        }

                        $.ajax({
                            url: path + "payement/get_montant_frais_by_name",
                            type: 'POST',
                            dataType: 'JSON',
                            data: {
                                exam_demandes: exam_demandes
                            },
                            success: function (exams_avec_prix) {
                                $('#payement_labo_table_body').html('');
                                for (const key in exams_avec_prix) {
                                    if (exams_avec_prix.hasOwnProperty(key)) {
                                        const value = exams_avec_prix[key];
                                        $('#payement_labo_table_body').append('<tr><td>' + key + ' : </td><td>' + value + ' FC</td></tr>');
                                        montant_frais_labo += parseFloat(value);
                                    }
                                }
                                $('#payement_autres_examens_liste').html(exams.autres_examens);
                                if (exams.autres_examens == '') {
                                    $('#payement_input_set_prix_autres_examens').hide();
                                }
                                $('#frais_labo_preview_total_a_payer').html(montant_frais_labo);
                                $('#total_avec_autres_payement').html(montant_frais_labo);
                                $('#valider_payement_labo_modal').modal('show');
                            },
                            error: function (data) {
                                alert('Error');
                            }
                        });   
                    }
                },
                error: function (data) {
                    console.log(data);
                    alert('Error kanda fort');
                }
            });
        } else if (new_payement_motif == 3){
            if (new_payement_patient_id == '' || new_payement_montant_autre_payement == '' || new_payement_motif_autre_payement == '') {
                swal.fire({
                    title: 'Champs vide',
                    text: 'Veillez remplir tout les champs obligatoires',
                    type: 'error',
                    confirmButtonText: 'Ok'
                });
            } else {
                $.ajax({
                    url: path + "payement/get_patient",
                    type: 'POST',
                    dataType: 'JSON',
                    data: {
                        patient_id: new_payement_patient_id
                    },
                    success: function (patient) {
                        if (patient == false) {
                            swal.fire({
                                title: 'Code invalide',
                                text: 'Le numéro ne correspond à aucun patient',
                                type: 'error',
                                confirmButtonText: 'Ok'
                            });
                        } else {
                            $('#patient_preview_autre_payement').html(patient.patient_prenom + ' ' + patient.patient_nom + ' ' + patient.patient_postnom);
                            $('#span_description_autre_payement').html(new_payement_motif_autre_payement);
                            $('#span_montant_preview_autre_payement').html(new_payement_montant_autre_payement);
                            $('#valider_autre_payement_modal').modal('show');

                        }
                    },
                    error: function (data) {
                        alert('Error');
                    }
                });
            }
        }

    });
    //done payement pour fiche
    $(document).on('click', '#btn_done_payement_fiche', function (e) {
        e.preventDefault();

        let new_payement_motif = $('#new_payement_motif').val();
        let new_payement_patient_id = $('#new_payement_patient_id').val();
        let new_payement_demande_id = 0;
        let montant_frais_fiche = parseFloat($('#montant_preview_payement_fiche').html());

        $.ajax({
            url: path + "payement/done_payement",
            type: 'POST',
            dataType: 'JSON',
            data: {
                new_payement_motif: new_payement_motif,
                new_payement_patient_id: new_payement_patient_id,
                new_payement_demande_id: new_payement_demande_id,
                montant_frais: montant_frais_fiche
            },
            success: function (data) {
                if (data.reponse == 'bien') {

                    $('#montant_recu_payement_fiche').html(montant_frais_fiche);
                    $("#recu_payement_fiche").printThis();

                    toastr.options.progressBar = true;
                    toastr.options.showMethod = 'slideDown';
                    toastr.options.hideMethod = 'fadeOut';
                    toastr.options.closeMethod = 'fadeOut';
                    toastr.success('Paiement effectué avec succès');

                    form_add_payement.reset();
                    dataTable_payements.ajax.reload();
                }
                if (data.reponse == 'pas_bien') {
                    toastr.options.progressBar = true;
                    toastr.options.showMethod = 'slideDown';
                    toastr.options.hideMethod = 'fadeOut';
                    toastr.options.closeMethod = 'fadeOut';
                    toastr.warning('Echec d\'enregistrement');
                }
            },
            error: function (data) {
                console.log(data);
                alert(data);
            }
        });

    });
    //Saisie prix autres examens
    $(document).on('keyup', '#payement_input_set_prix_autres_examens', function (e) {
        let montant_autres_examens = parseFloat($('#payement_input_set_prix_autres_examens').val());
        montant_autres_examens = isNaN(montant_autres_examens) ? 0 : montant_autres_examens;
        let montant_frais_labo_sans_autres_examens = parseFloat($('#frais_labo_preview_total_a_payer').html());
        let montant_frais_labo_avec_autres_examens = montant_autres_examens + montant_frais_labo_sans_autres_examens;

        console.log((montant_autres_examens))

        $('#total_avec_autres_payement').html(montant_frais_labo_avec_autres_examens);
    });
    //Done payement pour frais de laboratoire
    $(document).on('click', '#btn_done_payement_labo', function (e) {
        e.preventDefault();

        let new_payement_motif = $('#new_payement_motif').val();
        let new_payement_patient_id = 0;
        let new_payement_demande_id = $('#new_payement_demande_id').val();
        let montant_frais_labo = parseFloat($('#total_avec_autres_payement').html());

        $.ajax({
            url: path + "payement/done_payement",
            type: 'POST',
            dataType: 'JSON',
            data: {
                new_payement_motif: new_payement_motif,
                new_payement_patient_id: new_payement_patient_id,
                new_payement_demande_id: new_payement_demande_id,
                montant_frais: montant_frais_labo
            },
            success: function (data) {
                if (data.reponse == 'bien') {
                    toastr.options.progressBar = true;
                    toastr.options.showMethod = 'slideDown';
                    toastr.options.hideMethod = 'fadeOut';
                    toastr.options.closeMethod = 'fadeOut';
                    toastr.success('Paiement effectué avec succès');

                    form_add_payement.reset();
                    dataTable_payements.ajax.reload();
                }
                if (data.reponse == 'pas_bien') {
                    toastr.options.progressBar = true;
                    toastr.options.showMethod = 'slideDown';
                    toastr.options.hideMethod = 'fadeOut';
                    toastr.options.closeMethod = 'fadeOut';
                    toastr.warning('Echec d\'enregistrement');
                }
            },
            error: function (data) {
                alert('Error');
            }
        });
    });
    //Done autre payement
    $(document).on('click', '#btn_done_autre_payement', function (e) {
        e.preventDefault();

        let new_payement_motif = $('#new_payement_motif').val();
        let new_payement_patient_id = $('#new_payement_patient_id').val();
        let new_payement_demande_id = 0;
        let new_payement_motif_autre_payement = $('#span_description_autre_payement').html();
        let new_payement_montant_autre_payement = parseFloat($('#span_montant_preview_autre_payement').html());

        $.ajax({
            url: path + "payement/done_payement",
            type: 'POST',
            dataType: 'JSON',
            data: {
                new_payement_motif: new_payement_motif,
                new_payement_patient_id: new_payement_patient_id,
                new_payement_demande_id: new_payement_demande_id,
                new_payement_motif_autre_payement: new_payement_motif_autre_payement,
                new_payement_montant_autre_payement: new_payement_montant_autre_payement
            },
            success: function (data) {
                if (data.reponse == 'bien') {
                    toastr.options.progressBar = true;
                    toastr.options.showMethod = 'slideDown';
                    toastr.options.hideMethod = 'fadeOut';
                    toastr.options.closeMethod = 'fadeOut';
                    toastr.success('Paiement effectué avec succès');

                    form_add_payement.reset();
                    dataTable_payements.ajax.reload();
                }
                if (data.reponse == 'pas_bien') {
                    toastr.options.progressBar = true;
                    toastr.options.showMethod = 'slideDown';
                    toastr.options.hideMethod = 'fadeOut';
                    toastr.options.closeMethod = 'fadeOut';
                    toastr.warning('Echec d\'enregistrement');
                }
            },
            error: function (data) {
                alert('Error');
            }
        });
    });

});