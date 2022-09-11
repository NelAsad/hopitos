
$(document).ready(function () {

    let path = "http://localhost:92/hopitos/";

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

    //initialise datatable fiches en cours (etape 2)
    var dataTable_etape2 = $('#table_fiche_en_cours_etape_2').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            url: path + "consultation/consultation_etape2_datatable",
            type: "POST"
        },
        "columnDefs": [
            {
                "target": [0, 3, 4],
                "orderable": false
            }
        ]
    });

    //initialise datatable fiches cloturees pour la journee en cours (etape 3)
    var dataTable_etape3 = $('#table_fiches_cloturees').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            url: path + "consultation/consultation_etape3_datatable",
            type: "POST"
        },
        "columnDefs": [
            {
                "target": [0, 3, 4],
                "orderable": false
            }
        ]
    });

    //initialise datatable fiches cloturees (pour toutes cloturees dans la db)
    var dataTable_toutes_les_fiches = $('#table_toutes_les_fiches_cloturees').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            url: path + "consultation/consultation_toutes_les_fiches_datatable",
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
        let fiche_id = $(this).attr('id');

        $.ajax({
            url: path + "consultation/get_fiche",
            type: 'POST',
            dataType: 'JSON',
            data: {
                fiche_id: fiche_id
            },
            success: function (fiche) {

                console.log(fiche);
                console.log(fiche_id);

                $('#start_consulation_fiche_id').html(fiche.fiche_id);
                $('#start_consulation_patient_fiche_numero').html(fiche.patient_fiche_numero);
                $('#start_consulation_patient_nom').html(fiche.patient_nom);
                $('#start_consulation_patient_postnom').html(fiche.patient_postnom);
                $('#start_consulation_patient_prenom').html(fiche.patient_prenom);
                $('#start_consulation_patient_poids').html(fiche.poids);
                $('#start_consulation_patient_tension').html(fiche.tension);
                $('#start_consulation_date_ouverture').html(fiche.fiche_ouverture_date);
                $('#start_consulation_date_cloture').html(fiche.fiche_cloture_date);
                
                $('#hidden_commencer_consultation_fiche_id').val(fiche_id);
                $('#commencer_consultation_modal').modal('show');
            },
            error: function (data) {
                alert('Error!!');
            }
        });

        
    });
    //done_commencer_consultation
    $(document).on('click', '#btn_done_commencer_consultation', function (e) {
        e.preventDefault();
        var fiche_id = $('#hidden_commencer_consultation_fiche_id').val();
        var symptomes = $('#commencer_consultation_symptomes').val();
        var diagnostic = $('#commencer_consultation_diagnostic').val();

            $.ajax({
                url: path + "consultation/commencer_consultation",
                type: 'POST',
                dataType: 'JSON',
                data: {
                    fiche_id: fiche_id,
                    symptomes: symptomes,
                    diagnostic: diagnostic
                },
                success: function (data) {
                    if (data.reponse == 'bien') {
                        toastr.options.progressBar = true;
                        toastr.options.showMethod = 'slideDown';
                        toastr.options.hideMethod = 'fadeOut';
                        toastr.options.closeMethod = 'fadeOut';
                        toastr.success('les premieres informations ont ete bien enregistrees', 'Consultation demarrer avec succes');
                        
                        form_commencer_consultation.reset();
                        dataTable_etape1.ajax.reload();
                        dataTable_etape2.ajax.reload();
                    }
                    if (data.reponse == 'pas_bien') {
                        toastr.options.progressBar = true;
                        toastr.options.showMethod = 'slideDown';
                        toastr.options.hideMethod = 'fadeOut';
                        toastr.options.closeMethod = 'fadeOut';
                        toastr.warning('Echec d\'ouverture de la consultation');
                    }
                },
                error: function (data) {
                    alert('Error!!');
                }
            });
        
    });


    //COMPLETER UNE CONSULTATION
    //ouvrir_modal_completer_consultation
    $(document).on('click', '.btn_completer_consultation_patient_modal', function (e) {
        e.preventDefault();
        var patient_id = $(this).attr('id');
        $('#hidden_completer_consultation_fiche_id').val(patient_id);
        $('#completer_consultation_modal').modal('show');
    });
    //done_completer_consultation
    $(document).on('click', '#btn_done_completer_consultation', function (e) {
        e.preventDefault();
        var fiche_id = $('#hidden_completer_consultation_fiche_id').val();
        var traitement = $('#completer_consultation_traitement').val();
        var prescription = $('#completer_consultation_prescription').val();

            $.ajax({
                url: path + "consultation/completer_consultation",
                type: 'POST',
                dataType: 'JSON',
                data: {
                    fiche_id: fiche_id,
                    traitement: traitement,
                    prescription: prescription
                },
                success: function (data) {
                    if (data.reponse == 'bien') {
                        toastr.options.progressBar = true;
                        toastr.options.showMethod = 'slideDown';
                        toastr.options.hideMethod = 'fadeOut';
                        toastr.options.closeMethod = 'fadeOut';
                        toastr.success('Les informations ont ete bien enregistrees', 'Fiche completer avec succes');
                        
                        form_completer_consultation.reset();
                        dataTable_etape2.ajax.reload();
                        dataTable_etape3.ajax.reload();
                        dataTable_toutes_les_fiches.ajax.reload();
                    }
                    if (data.reponse == 'pas_bien') {
                        swal.fire({
                            title: 'Echec',
                            text: 'la consultation n\'est pas cloturee',
                            type: 'error',
                            confirmButtonText: 'Ok'
                        });
                    }
                },
                error: function (data) {
                    alert('Error!!');
                }
            });
        
    });

    //APPELER PATIENT
    $(document).on('click', '.btn_commencer_consultation_appeler_patient', function (e) {
        e.preventDefault();
        var patient_id = $(this).attr('patient_id');
        var nom = $(this).attr('nom');
        var postnom = $(this).attr('postnom');
        var prenom = $(this).attr('prenom');

        const msg = new SpeechSynthesisUtterance();
		msg.volume = 1;//0 to 1
		msg.rate = 0.6;// 0.1 to 10
		msg.pitch = 1;//0 to 2
		msg.text = "numéro ..." + patient_id + "..." + prenom +  "...Vous êtes voulu au bloc de consultation";

		msg.voiceURI = "Microsoft Julie - Fr";
		msg.lang = "fr-CA";

        let voices = speechSynthesis.getVoices();

        console.log(voices);

		speechSynthesis.speak(msg);
        
    });


    //VOIR_LES_DETAILS_D'UNE_CONSULTATION
    $(document).on('click', '.btn_show_consultation_modal', function (e) {
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
                $('#voir_consultation_modal').modal('show');
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


    //DEMANDER DES EXAMENS
    //ouvrir modal demande examens
    $(document).on('click', '.btn_consultation_demander_examens', function (e) {
        e.preventDefault();
        var fiche_id = $(this).attr('fiche_id');
        var patient_id = $(this).attr('patient_id');

        $('#fk_fiche_id').val(fiche_id);
        $('#fk_patient_id').val(patient_id);// pas indispensable car l'examen est lie a la fiche qui a son tour est lie au patient
       
        $('#demander_examens_modal').modal('show');

    });
    // valider demande examens
    $(document).on('click', '#btn_done_demande_exam', function (e) {
        e.preventDefault();

        let exam_service = $('#exam_service').val();

        if (exam_service == "") {
            swal.fire({
                title: 'Champ vide',
                text: 'Veillez remplir le champ service',
                type: 'error',
                confirmButtonText: 'Ok'
            });
        } else {
            $.ajax({
                url: path + "consultation/demander_exam",
                type: 'POST',
                dataType: 'JSON',
                data: $('#form_demande_exam').serialize(),
                success: function (data) {

                    if (data == true) {
                        toastr.options.progressBar = true;
                        toastr.options.showMethod = 'slideDown';
                        toastr.options.hideMethod = 'fadeOut';
                        toastr.options.closeMethod = 'fadeOut';
                        toastr.success('Votre demande d \'examen a ete bien envoyer au labo. Merci', 'Examen(s) demande(s) avec succes');
                        
                        form_demande_exam.reset();
                        dataTable_etape2.ajax.reload();
                    } else if (data == false) {
                        swal.fire({
                            title: 'Echec',
                            text: 'Nous n\'avons pas pu envoyer votre demande. Veillez contacter l\'admin du systeme',
                            type: 'error',
                            confirmButtonText: 'Ok'
                        });
                    } else if (data == 'aucun_choix') {
                        swal.fire({
                            title: 'Demande invalide',
                            text: 'Une demande doit comporter au moins un choix',
                            type: 'error',
                            confirmButtonText: 'Ok'
                        });
                    } else if (data == 'une_demande_existe_deja_pour_cette_fiche') {
                        swal.fire({
                            title: 'Demande en cours',
                            text: 'vous avez deja une demande pour cette fiche. veillez la supprimer avant d\'en faire une autre',
                            type: 'error',
                            confirmButtonText: 'Ok'
                        });
                    }
                    
                },
                error: function (data) {
                    console.log(data);
                    alert('Error!!');
                }
            });

        }

    });

    //SUPPRIMER UNE DEMANDE D'EXAMENS
    $(document).on('click', '.consultation_supprimer_demande', function (e) {
        e.preventDefault();
        var fiche_id = $(this).attr('id');

        swal.fire({
            title: 'Voulez vous vraiment supprimer cette demande ?',
            text: 'Cette action est irreversible. une demande supprimee ne peut etre recuperee',
            type: 'warnig',
            showCancelButton: true,
            confirmButtonText: 'Oui, Supprimer!',
            cancelButtonText: 'No, Annuler'

        }).then( (result) => {

            if (result.value) {
                $.ajax({
                    url: path + "consultation/supprimer_demande_exam",
                    type: 'POST',
                    dataType: 'JSON',
                    data: {
                        fiche_id: fiche_id
                    },
                    success: function (data) {
                        if (data == true) {
                            toastr.options.progressBar = true;
                            toastr.options.showMethod = 'slideDown';
                            toastr.options.hideMethod = 'fadeOut';
                            toastr.options.closeMethod = 'fadeOut';
                            toastr.success('Demande supprimer avec succes');

                            dataTable_etape2.ajax.reload();
                        } else if (data == false) {
                            toastr.options.progressBar = true;
                            toastr.options.showMethod = 'slideDown';
                            toastr.options.hideMethod = 'fadeOut';
                            toastr.options.closeMethod = 'fadeOut';
                            toastr.warning('Nous n\'avons pas pu supprimer la demande. Veillez contacter l\'admin du systeme');
                        }
                    },
                    error: function (data) {
                        alert('Error!!');
                    }
                });
            }

        })

    });

    //VOIR LE MOTIF DU DECLASSEMENT
    $(document).on('click', '.consultation_voir_motif_declassement', function (e) {
        e.preventDefault();
        let fiche_id = $(this).attr('id');
        let exam_etape = "3";

        $.ajax({
            url: path + "consultation/get_exam",
            type: 'POST',
            dataType: 'JSON',
            data: {
                fiche_id: fiche_id,
                exam_etape: exam_etape
            },
            success: function (exam) {
                $('#le_motif_du_declassement').html(exam.motif_declasse);
                $('#voir_motif_declassement_modal').modal('show');
            },
            error: function (data) {
                alert('Error!! ' + data);
            }
        });

    });

    // VOIR LE RESULTAT DU LABO & VALIDER
    //afficher le modal des resultats
    $(document).on('click','.consultation_voir_resultat_labo',function (e) {
        e.preventDefault();
        var fiche_id = $(this).attr('id');
        let exam_etape = "2";
        
        //j'affiche tout les champs
        afficher_tout_les_champs();

        //Appel Ajax
        $.ajax({
            url: path + "consultation/get_exam",
            type: 'POST',
            dataType: 'JSON',
            data: {
                fiche_id: fiche_id,
                exam_etape: exam_etape
            },
            success: function (exam) {
                //je cahe les champs qu'il faut caher
                cahe_champ_moins_important(exam);
                //je defini les valeurs pour les champs
                set_each_field_value(exam);

                $('#back_laboratoire_autres_examens_liste').html(exam.autres_examens);
                $('#back_autres_examens').val(exam.autres_examens_resultats);

                $('#back_exam_service').html(exam.exam_service);
                $('#hidden_back_fiche_id').val(exam.fk_fiche_id);
                $('#voir_resultat_labo_modal').modal('show');
            },
            error: function (data) {
                alert('Error!!');
            }
        });
    });
    //Ajouter les resultats a la fiche
    $(document).on('click', '#btn_inserer_resultat_a_la_fiche', function (e) {
        e.preventDefault();

        $.ajax({
            url: path + "consultation/ajouter_resultats_a_la_fiche",
            type: 'POST',
            dataType: 'JSON',
            data: $('#form_inserer_resultat_labo_a_la_fiche').serialize(),
            success: function (data) {
                if (data == true) {
                    toastr.options.progressBar = true;
                    toastr.options.showMethod = 'slideDown';
                    toastr.options.hideMethod = 'fadeOut';
                    toastr.options.closeMethod = 'fadeOut';
                    toastr.success('Resultats ajoutes a la fiche avec succes');
                } else {
                    toastr.options.progressBar = true;
                    toastr.options.showMethod = 'slideDown';
                    toastr.options.hideMethod = 'fadeOut';
                    toastr.options.closeMethod = 'fadeOut';
                    toastr.warning('Nous n\'avons pas pu ajouter les resultat a la fiche.<br>Veillez contacter l\'administratreur');
                }
                

            },
            error: function (data) {
                alert('Error!! ' + data);
            }
        });
    });

    /**
     * Auto-Actualise de datatables apres une minute
     */
    setInterval(() => {
        dataTable_etape1.ajax.reload();
        dataTable_etape2.ajax.reload();
        dataTable_etape3.ajax.reload();
        dataTable_toutes_les_fiches.ajax.reload();
    }, 600000);//dix minutes

});

////////////////////////////////////////////////////////////////
////////////////// MES FONCTIONS ///////////////////////////////
////////////////////////////////////////////////////////////////

/**
 * Rend tout les champs affichables
 * @return void
 */
function afficher_tout_les_champs() {
    //hemato
    $('#back_hemato_Hbg').show();
    $('#back_hemato_GB').show();
    $('#back_hemato_VS').show();
    $('#back_hemato_FL_E').show();
    $('#back_hemato_FL_B').show();
    $('#back_hemato_FL_L').show();
    $('#back_hemato_FL_M').show();
    $('#back_hemato_TS').show();
    $('#back_hemato_TC').show();
    $('#back_hemato_GS').show();
    $('#back_hemato_HTC').show();
    //parasito
    $('#back_parasito_GE').show();
    $('#back_parasito_GF').show();
    $('#back_parasito_CATT').show();
    $('#back_parasito_frais_mince').show();
    $('#back_parasito_selles_exam_direct').show();
    $('#back_parasito_urines_sediment').show();
    $('#back_parasito_PVUF').show();
    $('#back_parasito_ecr_element').show();
    $('#back_parasito_bacterio_nature_produit').show();
    $('#back_parasito_bacterio_gramme').show();
    $('#back_parasito_bacterio_ziehl').show();
    //bio-chimie
    $('#back_bio_nature_produit').show();
    $('#back_bio_glucose').show();
    $('#back_bio_bilirubine').show();
    $('#back_bio_albumine').show();
    $('#back_bio_acetone').show();
    $('#back_bio_PH').show();
    $('#back_bio_nitrite').show();
    //IMMINO SEROLOGIE
    $('#back_is_test_grossesse').show();
    $('#back_is_widal_TO').show();
    $('#back_is_TH').show();
    $('#back_is_CATT').show();
    $('#back_is_HBS').show();
    $('#back_is_HC').show();
    $('#back_is_P120').show();
}

/**
 * Cahe les champs pas important
 * @param array exam
 * @return void
 */
function cahe_champ_moins_important(exam) {
    //hemato
    if (exam.hemato_Hbg == '') {
        $('#back_hemato_Hbg').hide();
    }
    if (exam.hemato_GB == '') {
        $('#back_hemato_GB').hide();
    }
    if (exam.hemato_VS == '') {
        $('#back_hemato_VS').hide();
    }
    if (exam.hemato_FL_E == '') {
        $('#back_hemato_FL_E').hide();
    }
    if (exam.hemato_FL_B == '') {
        $('#back_hemato_FL_B').hide();
    }
    if (exam.hemato_FL_L == '') {
        $('#back_hemato_FL_L').hide();
    }
    if (exam.hemato_FL_M == '') {
        $('#back_hemato_FL_M').hide();
    }
    if (exam.hemato_TS == '') {
        $('#back_hemato_TS').hide();
    }
    if (exam.hemato_TC == '') {
        $('#back_hemato_TC').hide();
    }
    if (exam.hemato_GS == '') {
        $('#back_hemato_GS').hide();
    }
    if (exam.hemato_HTC == '') {
        $('#back_hemato_HTC').hide();
    }
    //parasito
    if (exam.parasito_GE == '') {
        $('#back_parasito_GE').hide();
    }
    if (exam.parasito_GF == '') {
        $('#back_parasito_GF').hide();
    }
    if (exam.parasito_CATT == '') {
        $('#back_parasito_CATT').hide();
    }
    if (exam.parasito_frais_mince == '') {
        $('#back_parasito_frais_mince').hide();
    }
    if (exam.parasito_selles_exam_direct == '') {
        $('#back_parasito_selles_exam_direct').hide();
    }
    if (exam.parasito_urines_sediment == '') {
        $('#back_parasito_urines_sediment').hide();
    }
    if (exam.parasito_PVUF == '') {
        $('#back_parasito_PVUF').hide();
    }
    if (exam.parasito_ecr_element == '') {
        $('#back_parasito_ecr_element').hide();
    }
    if (exam.parasito_bacterio_nature_produit == '') {
        $('#back_parasito_bacterio_nature_produit').hide();
    }
    if (exam.parasito_bacterio_gramme == '') {
        $('#back_parasito_bacterio_gramme').hide();
    }
    if (exam.parasito_bacterio_ziehl == '') {
        $('#back_parasito_bacterio_ziehl').hide();
    }
    //bio-chimie
    if (exam.bio_nature_produit == '') {
        $('#back_bio_nature_produit').hide();
    }
    if (exam.bio_glucose == '') {
        $('#back_bio_glucose').hide();
    }
    if (exam.bio_bilirubine == '') {
        $('#back_bio_bilirubine').hide();
    }
    if (exam.bio_albumine == '') {
        $('#back_bio_albumine').hide();
    }
    if (exam.bio_acetone == '') {
        $('#back_bio_acetone').hide();
    }
    if (exam.bio_PH == '') {
        $('#back_bio_PH').hide();
    }
    if (exam.bio_nitrite == '') {
        $('#back_bio_nitrite').hide();
    }
    //IMMINO SEROLOGIE
    if (exam.is_test_grossesse == '') {
        $('#back_is_test_grossesse').hide();
    }
    if (exam.is_widal_TO == '') {
        $('#back_is_widal_TO').hide();
    }
    if (exam.is_TH == '') {
        $('#back_is_TH').hide();
    }
    if (exam.is_CATT == '') {
        $('#back_is_CATT').hide();
    }
    if (exam.is_HBS == '') {
        $('#back_is_HBS').hide();
    }
    if (exam.is_HC == '') {
        $('#back_is_HC').hide();
    }
    if (exam.is_P120 == '') {
        $('#back_is_P120').hide();
    }
}

/**
 * Definit la valeur de chaque champs
 * @return void
 */
function set_each_field_value(exam) {
    //hemato
    $('#back_hemato_Hbg').val(exam.hemato_Hbg);
    $('#back_hemato_GB').val(exam.hemato_GB);
    $('#back_hemato_VS').val(exam.hemato_VS);
    $('#back_hemato_FL_E').val(exam.hemato_FL_E);
    $('#back_hemato_FL_B').val(exam.hemato_FL_B);
    $('#back_hemato_FL_L').val(exam.hemato_FL_L);
    $('#back_hemato_FL_M').val(exam.hemato_FL_M);
    $('#back_hemato_TS').val(exam.hemato_TS);
    $('#back_hemato_TC').val(exam.hemato_TC);
    $('#back_hemato_GS').val(exam.hemato_GS);
    $('#back_hemato_HTC').val(exam.hemato_HTC);
    //parasito
    $('#back_parasito_GE').val(exam.parasito_GE);
    $('#back_parasito_GF').val(exam.parasito_GF);
    $('#back_parasito_CATT').val(exam.parasito_CATT);
    $('#back_parasito_frais_mince').val(exam.parasito_frais_mince);
    $('#back_parasito_selles_exam_direct').val(exam.parasito_selles_exam_direct);
    $('#back_parasito_urines_sediment').val(exam.parasito_urines_sediment);
    $('#back_parasito_PVUF').val(exam.parasito_PVUF);
    $('#back_parasito_ecr_element').val(exam.parasito_ecr_element);
    $('#back_parasito_bacterio_nature_produit').val(exam.parasito_bacterio_nature_produit);
    $('#back_parasito_bacterio_gramme').val(exam.parasito_bacterio_gramme);
    $('#back_parasito_bacterio_ziehl').val(exam.parasito_bacterio_ziehl);
    //bio-chimie
    $('#back_bio_nature_produit').val(exam.bio_nature_produit);
    $('#back_bio_glucose').val(exam.bio_glucose);
    $('#back_bio_bilirubine').val(exam.bio_bilirubine);
    $('#back_bio_albumine').val(exam.bio_albumine);
    $('#back_bio_acetone').val(exam.bio_acetone);
    $('#back_bio_PH').val(exam.bio_PH);
    $('#back_bio_nitrite').val(exam.bio_nitrite);
    //IMMINO SEROLOGIE
    $('#back_is_test_grossesse').val(exam.is_test_grossesse);
    $('#back_is_widal_TO').val(exam.is_widal_TO);
    $('#back_is_TH').val(exam.is_TH);
    $('#back_is_CATT').val(exam.is_CATT);
    $('#back_is_HBS').val(exam.is_HBS);
    $('#back_is_HC').val(exam.is_HC);
    $('#back_is_P120').val(exam.is_P120);
}



