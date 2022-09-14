
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

    //Affichage_des_champs_en_fontion_du_statut
    $(document).on('change', '#new_patient_statut', function () {

        if ($('#new_patient_statut').val() == 'simple') {
            $('#bloc_conv_toggle').hide();
            $('#bloc_titulaire_toggle').hide();
        }
        if ($('#new_patient_statut').val() == 'familleConv') {
            $('#bloc_conv_toggle').show();
            $('#bloc_titulaire_toggle').show();
        }
        if ($('#new_patient_statut').val() == 'conventionne') {
            $('#bloc_conv_toggle').show();
            $('#bloc_titulaire_toggle').hide();
        }
    });

    //AJOUT_D'UN_NOUVEAU_PATIENT
    $(document).on('click', '#btn_add_new_patient', function (e) {
        e.preventDefault();

        var new_patient_prenom = $('#new_patient_prenom').val();
        var new_patient_nom = $('#new_patient_nom').val();
        var new_patient_postnom = $('#new_patient_postnom').val();
        var new_patient_date_naissance = $('#new_patient_date_naissance').val();
        var new_patient_sexe = $('#new_patient_sexe').val();
        var new_patient_adresse = $('#new_patient_adresse').val();
        var new_patient_statut = $('#new_patient_statut').val();
        var new_patient_dossier_num = $('#new_patient_dossier_num').val();
        var new_patient_fiche_num = $('#new_patient_fiche_num').val();
        var new_patient_titulaire_id = $('#new_patient_titulaire_id').val();
        var new_patient_affiliation = $('#new_patient_affiliation').val();
        var new_patient_code_conv = $('#new_patient_code_conv').val();
        var new_patient_occupation = $('#new_patient_occupation').val();

        if (new_patient_prenom == '' || new_patient_nom == '' || new_patient_postnom == '' || new_patient_dossier_num == '' || new_patient_fiche_num == '' || new_patient_date_naissance == '' || new_patient_adresse == '') {
            swal.fire({
                title: 'Champs vide',
                text: 'Veillez remplir tout les champs obligatoires',
                type: 'error',
                confirmButtonText: 'Ok'
            });
        } else {

            $.ajax({
                url: path + "patient/add_new_patient",
                type: 'POST',
                dataType: 'JSON',
                data: {
                    new_patient_prenom: new_patient_prenom,
                    new_patient_nom: new_patient_nom,
                    new_patient_postnom: new_patient_postnom,
                    new_patient_date_naissance: new_patient_date_naissance,
                    new_patient_sexe: new_patient_sexe,
                    new_patient_adresse: new_patient_adresse,
                    new_patient_statut: new_patient_statut,
                    new_patient_dossier_num: new_patient_dossier_num,
                    new_patient_fiche_num: new_patient_fiche_num,
                    new_patient_titulaire_id: new_patient_titulaire_id,
                    new_patient_affiliation: new_patient_affiliation,
                    new_patient_code_conv: new_patient_code_conv,
                    new_patient_occupation: new_patient_occupation
                },
                success: function (data) {
                    if (data.reponse == 'bien') {
                        toastr.options.progressBar = true;
                        toastr.options.showMethod = 'slideDown';
                        toastr.options.hideMethod = 'fadeOut';
                        toastr.options.closeMethod = 'fadeOut';
                        toastr.success('Patient ajouté avec succès');

                        form_add_new_patient.reset();
                        dataTable_patient.ajax.reload();
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
                    alert('Error');
                }
            });
        }
    });

    //VOIR_LES_DETAILS_D'UN_PATIENT
    $(document).on('click', '.btn_show_patient_modal', function (e) {
        e.preventDefault();
        var patient_id = $(this).attr('id');
        var patient_statut = $(this).attr('statut');
        $('#membre_famille_content').hide();

        if (patient_statut == 'conventionne') {
            $.ajax({
                url: path + "patient/get_membres_famille_patient",
                type: 'POST',
                dataType: 'JSON',
                data: {
                    patient_id: patient_id
                },
                success: function (membres) {
    
                    membres.forEach(membre => {
                        $('#table_membres_famille_body').append('<tr><td>' + membre.patient_nom + '</td><td>' + membre.patient_postnom + '</td><td>' + membre.patient_prenom + '</td><td>' + membre.patient_sexe + '</td></tr>')
                    });
    
                    $('#membre_famille_content').show();
                },
                error: function (data) {
                    console.log(data);
                    alert('Error');
                }
            });
        }

        $.ajax({
            url: path + "patient/get_patient",
            type: 'POST',
            dataType: 'JSON',
            data: {
                patient_id: patient_id
            },
            success: function (patient) {

                console.log(patient);

                var date_naissance = new Date(patient.patient_date_naissance);

                $('#show_patient_prenom_et_nom').html(patient.patient_prenom + ' ' + patient.patient_nom);
                $('#show_patient_id').html(patient.patient_id);
                $('#show_patient_fiche_numero').html(patient.patient_fiche_numero);
                $('#show_patient_dossier_numero').html(patient.patient_dossier_numero);
                $('#show_patient_nom').html(patient.patient_nom);
                $('#show_patient_postnom').html(patient.patient_postnom);
                $('#show_patient_prenom').html(patient.patient_prenom);
                $('#show_patient_sexe').html(patient.patient_sexe);
                $('#show_patient_date_naissance').html(date_naissance.getDate() + '/' + date_naissance.getMonth() + '/' + date_naissance.getFullYear());
                $('#show_patient_adresse').html(patient.patient_adresse);
                $('#show_patient_statut').html(patient.patient_statut);
                $('#show_patient_fk_patient_conv').html(patient.fk_patient_conv);
                $('#show_patient_affiliation').html(patient.patient_affiliation);
                $('#show_patient_code_convention').html(patient.patient_code_convention);
                $('#show_patient_occupation').html(patient.patient_occupation);
                $('#show_patient_save_date').html(patient.patient_save_date);
                $('#show_patient_fk_users_id').html(patient.fk_users_id);
                $('#patient_show_modal').modal('show');
            },
            error: function (data) {
                alert('Error!!');
            }
        });
    });

    //UPDATE UN USER
    //Remplir les champs pour l'update
    $(document).on('click', '.btn_update_patient_modal', function (e) {
        e.preventDefault();
        var patient_id = $(this).attr('id');

        $.ajax({
            url: path + "patient/get_patient",
            type: 'POST',
            dataType: 'JSON',
            data: {
                patient_id: patient_id
            },
            success: function (patient) {

                if (patient.patient_statut == '') {
                    
                }

                $('#hidden_update_patient_id').val(patient.patient_id);
                $('#new_patient_prenom').val(patient.patient_prenom);
                $('#new_patient_nom').val(patient.patient_nom);
                $('#new_patient_postnom').val(patient.patient_postnom);
                $('#new_patient_date_naissance').val(patient.patient_date_naissance);
                $('#new_patient_sexe').val(patient.patient_sexe);
                $('#new_patient_adresse').val(patient.patient_adresse);
                $('#new_patient_statut').val(patient.patient_statut);
                $('#new_patient_dossier_num').val(patient.patient_dossier_numero);
                $('#new_patient_fiche_num').val(patient.patient_id);
                $('#new_patient_titulaire_id').val(patient.fk_patient_conv);// le personne liee a l'hopital
                $('#new_patient_affiliation').val(patient.patient_affiliation);
                $('#new_patient_code_conv').val(patient.patient_code_convention);
                $('#new_patient_occupation').val(patient.patient_occupation);

                // $('#patient_update_modal').modal('show');
            },
            error: function (data) {
                alert('Error!!');
            }
        });

    });
    // Valider la modification
    $(document).on('click', '#btn_update_patient', function (e) {
        e.preventDefault();

        var new_patient_id = $('#hidden_update_patient_id').val();
        var new_patient_prenom = $('#new_patient_prenom').val();
        var new_patient_nom = $('#new_patient_nom').val();
        var new_patient_postnom = $('#new_patient_postnom').val();
        var new_patient_date_naissance = $('#new_patient_date_naissance').val();
        var new_patient_sexe = $('#new_patient_sexe').val();
        var new_patient_adresse = $('#new_patient_adresse').val();
        var new_patient_statut = $('#new_patient_statut').val();
        var new_patient_dossier_num = $('#new_patient_dossier_num').val();
        var new_patient_fiche_num = $('#new_patient_fiche_num').val();
        var new_patient_titulaire_id = $('#new_patient_titulaire_id').val();
        var new_patient_affiliation = $('#new_patient_affiliation').val();
        var new_patient_code_conv = $('#new_patient_code_conv').val();
        var new_patient_occupation = $('#new_patient_occupation').val();

        if (new_patient_prenom == '' || new_patient_nom == '' || new_patient_postnom == '' || new_patient_dossier_num == '' || new_patient_fiche_num == '' || new_patient_date_naissance == '' || new_patient_adresse == '') {
            swal.fire({
                title: 'Champs vide',
                text: 'Veillez remplir tout les champs obligatoires',
                type: 'error',
                confirmButtonText: 'Ok'
            });
        } else {

            $.ajax({
                url: path + "patient/update_patient",
                type: 'POST',
                dataType: 'JSON',
                data: {
                    new_patient_id: new_patient_id,
                    new_patient_prenom: new_patient_prenom,
                    new_patient_nom: new_patient_nom,
                    new_patient_postnom: new_patient_postnom,
                    new_patient_date_naissance: new_patient_date_naissance,
                    new_patient_sexe: new_patient_sexe,
                    new_patient_adresse: new_patient_adresse,
                    new_patient_statut: new_patient_statut,
                    new_patient_dossier_num: new_patient_dossier_num,
                    new_patient_fiche_num: new_patient_fiche_num,
                    new_patient_titulaire_id: new_patient_titulaire_id,
                    new_patient_affiliation: new_patient_affiliation,
                    new_patient_code_conv: new_patient_code_conv,
                    new_patient_occupation: new_patient_occupation
                },
                success: function (data) {
                    if (data.reponse == 'bien') {
                        toastr.options.progressBar = true;
                        toastr.options.showMethod = 'slideDown';
                        toastr.options.hideMethod = 'fadeOut';
                        toastr.options.closeMethod = 'fadeOut';
                        toastr.success('Patient Modifié avec succès');

                        form_add_new_patient.reset();
                        dataTable_patient.ajax.reload();
                    }
                    if (data.reponse == 'pas_bien') {
                        toastr.options.progressBar = true;
                        toastr.options.showMethod = 'slideDown';
                        toastr.options.hideMethod = 'fadeOut';
                        toastr.options.closeMethod = 'fadeOut';
                        toastr.warning('Echec de modification');
                    }
                },
                error: function (data) {
                    console.log(data);
                    alert('Error');
                }
            });
        }
    });



    //OUVRIR UNE FICHE
    //Afficher modal ouvrir fiche
    $(document).on('click', '.btn_ouvrir_fiche_patient', function (e) {

        // alert('im here');

        e.preventDefault();
        let patient_id = $(this).attr('id');
        $('#ouvrir_fiche_fk_patient_id').val(patient_id);
        $.ajax({
            url: path + "patient/get_patient_frais_fiche_actif",
            type: 'POST',
            dataType: 'JSON',
            data: {
                patient_id: patient_id
            },
            success: function (pay_actifs) {
                if (pay_actifs.length > 0 && pay_actifs[0].utilise == 0) {
                    $('#ouvrir_fiche_modal').modal('show');
                } else {
                    toastr.options.progressBar = true;
                    toastr.options.showMethod = 'slideDown';
                    toastr.options.hideMethod = 'fadeOut';
                    toastr.options.closeMethod = 'fadeOut';
                    toastr.warning('Priere d\'aller payer a la caisse avant l\'ouverture de la fiche');
                }
            },
            error: function (data) {
                alert('Error');
            }
        });
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

    //Delete patient
    $(document).on('click', '#btn_delete_patient', function (e) {
        e.preventDefault();
        let patient_id = $('#hidden_update_patient_id').val();

        if (patient_id == '') {
            alert('Veillez choisir un patient avant');
        } else {

            if (confirm('Voulez-vous vraiment supprimer le patient ?')) {
                $.ajax({
                    url: path + "patient/delete_patient",
                    type: 'POST',
                    dataType: 'JSON',
                    data: {
                        patient_id: patient_id
                    },
                    success: function (data) {
                        if (data.reponse == 'bien') {
                            toastr.options.progressBar = true;
                            toastr.options.showMethod = 'slideDown';
                            toastr.options.hideMethod = 'fadeOut';
                            toastr.options.closeMethod = 'fadeOut';
                            toastr.success('Patient supprime');
                        }
                        if (data.reponse == 'pas_bien') {
                            toastr.options.progressBar = true;
                            toastr.options.showMethod = 'slideDown';
                            toastr.options.hideMethod = 'fadeOut';
                            toastr.options.closeMethod = 'fadeOut';
                            toastr.warning('Echec de suppression');
                        }
                    },
                    error: function (data) {
                        alert('Error');
                    }
                });
            }

        }

    });

    // Ajouter membre famille
    // voir modal
    $(document).on('click', '.btn_add_famille_patient_modal', function (e) {
        e.preventDefault();
        let patient_id = $(this).attr('id');
        $('#hidden_famille_patient_id').val(patient_id);

        $.ajax({
            url: path + "patient/get_patient",
            type: 'POST',
            dataType: 'JSON',
            data: {
                patient_id: patient_id
            },
            success: function (patient) {
                $('#famille_patient_adresse').val(patient.patient_adresse);
                $('#add_famille_membre_modal').modal('show');
            },
            error: function (data) {
                alert('Error!!');
            }
        });
    });
    // Done 
    $(document).on('click', '#btn_done_add_membre_famille', function (e) {
        e.preventDefault();

        var patient_id = $('#hidden_famille_patient_id').val();
        var new_patient_prenom = $('#famille_patient_prenom').val();
        var new_patient_nom = $('#famille_patient_nom').val();
        var new_patient_postnom = $('#famille_patient_postnom').val();
        var new_patient_date_naissance = $('#famille_patient_date_naissance').val();
        var new_patient_sexe = $('#famille_patient_sexe').val();
        var new_patient_adresse = $('#famille_patient_adresse').val();

        if (new_patient_prenom == '' || new_patient_nom == '' || new_patient_postnom == '') {
            swal.fire({
                title: 'Champs vide',
                text: 'Veillez remplir tout les champs obligatoires',
                type: 'error',
                confirmButtonText: 'Ok'
            });
        } else {

            $.ajax({
                url: path + "patient/add_famille_patient",
                type: 'POST',
                dataType: 'JSON',
                data: {
                    patient_id: patient_id,
                    new_patient_prenom: new_patient_prenom,
                    new_patient_nom: new_patient_nom,
                    new_patient_postnom: new_patient_postnom,
                    new_patient_date_naissance: new_patient_date_naissance,
                    new_patient_sexe: new_patient_sexe,
                    new_patient_adresse: new_patient_adresse
                },
                success: function (data) {
                    if (data.reponse == 'bien') {

                        $('#add_famille_membre_modal').modal('hide');

                        toastr.options.progressBar = true;
                        toastr.options.showMethod = 'slideDown';
                        toastr.options.hideMethod = 'fadeOut';
                        toastr.options.closeMethod = 'fadeOut';
                        toastr.success('Membre de la famille ajouté avec succès');

                        form_add_new_patient.reset();
                        dataTable_patient.ajax.reload();
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
                    alert('Error');
                }
            });
        }
    });


    // voir membres famille modal
    $(document).on('click', '.btn_voir_famille_patient_modal', function (e) {
        e.preventDefault();
        let patient_id = $(this).attr('id');
        $.ajax({
            url: path + "patient/get_membres_famille_patient",
            type: 'POST',
            dataType: 'JSON',
            data: {
                patient_id: patient_id
            },
            success: function (membres) {

                membres.forEach(membre => {
                    $('#table_membres_famille_body').append('<tr><td>' + membre.patient_nom + '</td><td>' + membre.patient_postnom + '</td><td>' + membre.patient_prenom + '</td><td>' + membre.patient_sexe + '</td></tr>')
                });

                $('#voir_famille_membre_modal').modal('show');
            },
            error: function (data) {
                console.log(data);
                alert('Error');
            }
        });

    });

});