$(document).ready(function () {

    let path = "http://localhost/hopitos/";

    // INITIALISATION DES DATATABLES

    //initialise datatable nouvelles demandes (etape 1)
    var dataTable_nouvelles_demandes = $('#table_nouvelles_demandes').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            url: path + "laboratoire/labo_nouvelles_demandes",
            type: "POST"
        },
        "columnDefs": [
            {
                "target": [0, 3, 4],
                "orderable": false
            }
        ]
    });

    //initialise datatable demandes satisfaites du jour
    var dataTable_demandes_satisf_du_jour = $('#table_demandes_satisf_du_jour').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            url: path + "laboratoire/labo_demandes_sat_today",
            type: "POST"
        },
        "columnDefs": [
            {
                "target": [0, 3, 4],
                "orderable": false
            }
        ]
    });

    //initialise datatable toutes les demandes satisfaites
    var dataTable_demandes_satisf_all = $('#table_demandes_satisf_all').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            url: path + "laboratoire/labo_demandes_sat_all",
            type: "POST"
        },
        "columnDefs": [
            {
                "target": [0, 3, 4],
                "orderable": false
            }
        ]
    });

    //initialise datatable les demandes declassees du jour
    var dataTable_demandes_declassees_today = $('#table_demandes_declassees_today').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            url: path + "laboratoire/labo_demandes_declasees_today",
            type: "POST"
        },
        "columnDefs": [
            {
                "target": [0, 3, 4],
                "orderable": false
            }
        ]
    });

    //initialise datatable toutes les demandes declassees
    var dataTable_demandes_declassees_all = $('#table_demandes_declassees_all').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            url: path + "laboratoire/labo_demandes_declasees_all",
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

    // INSERER LES RESULTATS DES EXAMENS
    //affiche le formulaire d'insertion examens
    $(document).on('click', '.btn_show_inserer_exam_modal', function(e){
        e.preventDefault();
        var exam_id = $(this).attr('id');

        $.ajax({
            url: path + "laboratoire/get_patient_frais_labo_actif",
            type: 'POST',
            dataType: 'JSON',
            data: {
                exam_id: exam_id
            },
            success: function (pay_actifs) {

                if (pay_actifs.length > 0 && pay_actifs[0].utilise == 0) {

                    //j'affiche tout les champs
                    afficher_tout_les_champs();

                    //Appel Ajax
                    $.ajax({
                        url: path + "laboratoire/get_exam",
                        type: 'POST',
                        dataType: 'JSON',
                        data: {
                            exam_id: exam_id
                        },
                        success: function (exam) {
                            //je cahe les champs qu'il faut caher
                            cahe_champ_moins_important(exam);

                            $('#laboratoire_autres_examens_liste').html(exam.autres_examens);
                            $('#exam_show_service').html(exam.exam_service);
                            $('#hidden_exam_id').val(exam.exam_id);
                            $('#inserer_examens_modal').modal('show');
                        },
                        error: function (data) {
                            alert('Error!!');
                        }
                    });

                } else {
                    toastr.options.progressBar = true;
                    toastr.options.showMethod = 'slideDown';
                    toastr.options.hideMethod = 'fadeOut';
                    toastr.options.closeMethod = 'fadeOut';
                    toastr.warning('Priere d\'aller payer a la caisse avant d\'etre examine');
                }

            },
            error: function (data) {
                alert('Error');
            }
        });

    })
    // valider l'insersion de resultats examens
    $(document).on('click', '#btn_done_inserer_exam', function (e) {
        e.preventDefault();
 
        $.ajax({
            url: path + "laboratoire/done_resultat_exam",
            type: 'POST',
            dataType: 'JSON',
            data: $('#form_inserer_exam').serialize(),
            success: function (data) {

                if (data == true) {
                    toastr.options.progressBar = true;
                    toastr.options.showMethod = 'slideDown';
                    toastr.options.hideMethod = 'fadeOut';
                    toastr.options.closeMethod = 'fadeOut';
                    toastr.success('Les resultats des examens ont bien ete envoyer au medecin consultant. Merci', 'Resultats inseres avec succes');
                    
                    form_inserer_exam.reset();
                    dataTable_nouvelles_demandes.ajax.reload();
                    dataTable_demandes_satisf_du_jour.ajax.reload();
                    dataTable_demandes_satisf_all.ajax.reload();
                } else if (data == false) {
                    swal.fire({
                        title: 'Echec',
                        text: 'Nous n\'avons pas pu inserer les resultats. Veillez contacter l\'admin du systeme',
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

    // DECLASSER UNE DEMANDE D'EXAMEN
    //affiche le modal pour renseigner le motif du declassement
    $(document).on('click', '.btn_declasser_demande', function (e) {
        e.preventDefault();
        let exam_id = $(this).attr('id');
        $('#hidden_declasser_exam_id').val(exam_id);
        $('#declasser_demande_examen_modal').modal('show');

    });
    // valider le declassement de la demande
    $(document).on('click', '#btn_done_declasser_exam', function(e){
        e.preventDefault();
        let exam_id = $('#hidden_declasser_exam_id').val();
        let motif_declasse = $('#declasser_exam_motif').val();

        $.ajax({
            url: path + "laboratoire/declasser_exam",
            type: 'POST',
            dataType: 'JSON',
            data: {
                exam_id: exam_id,
                motif_declasse: motif_declasse
            },
            success: function (data) {
                if (data == true) {
                    toastr.options.progressBar = true;
                    toastr.options.showMethod = 'slideDown';
                    toastr.options.hideMethod = 'fadeOut';
                    toastr.options.closeMethod = 'fadeOut';
                    toastr.success('Demande d\'examen declassee avec succes');
                    
                    dataTable_nouvelles_demandes.ajax.reload();
                    dataTable_demandes_declassees_today.ajax.reload();
                    dataTable_demandes_declassees_all.ajax.reload();
                } else if (data == false) {
                    swal.fire({
                        title: 'Echec',
                        text: 'Nous n\'avons pas pu declasser la demande. Veillez contacter l\'admin du systeme',
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

    // VOIR LES RESULTATS APRES INSERTION
    $(document).on('click', '.btn_show_exam_modal', function (e) {
        e.preventDefault();
        let exam_id = $(this).attr('id');
        
        //Appel Ajax
        $.ajax({
            url: path + "laboratoire/get_exam",
            type: 'POST',
            dataType: 'JSON',
            data: {
                exam_id: exam_id
            },
            success: function (exam) {
                
                let i = 0;
                let resultat_str = '';
                
                for (const key in exam) {
                    if (exam.hasOwnProperty(key)) {
                        const element = exam[key];

                        if (i>=8 && i < 44 && element != '') {
                            resultat_str += key + ' : ' + element + '<br>';
                        }

                    }
                    i++;
                }

                $('#les_resultats_apres_insertion').html(resultat_str);
                $('#voir_exam_apres_insertion_modal').modal('show');

            },
            error: function (data) {
                alert('Error!!');
            }
        });

    });

    // VOIR LE MOTIF DU DECLASSEMENT
    $(document).on('click', '.btn_show_exam_motif_declassement_modal', function (e) {
        e.preventDefault();
        let exam_id = $(this).attr('id');

        //Appel Ajax
        $.ajax({
            url: path + "laboratoire/get_exam",
            type: 'POST',
            dataType: 'JSON',
            data: {
                exam_id: exam_id
            },
            success: function (exam) {

                $('#le_motif_apres_insertion').html(exam.motif_declasse);
                $('#voir_motif_declassement_apres_insertion_modal').modal('show');

            },
            error: function (data) {
                alert('Error!!');
            }
        });

    });


    /**
     * Auto-Actualise de datatables apres dix minute
     */
    setInterval(() => {
        dataTable_nouvelles_demandes.ajax.reload();
        dataTable_demandes_satisf_du_jour.ajax.reload();
        dataTable_demandes_satisf_all.ajax.reload();
        dataTable_demandes_declassees_today.ajax.reload();
        dataTable_demandes_declassees_all.ajax.reload();
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
    $('#hemato_Hbg').show();
    $('#hemato_GB').show();
    $('#hemato_VS').show();
    $('#hemato_FL_E').show();
    $('#hemato_FL_B').show();
    $('#hemato_FL_L').show();
    $('#hemato_FL_M').show();
    $('#hemato_TS').show();
    $('#hemato_TC').show();
    $('#hemato_GS').show();
    $('#hemato_HTC').show();
    //parasito
    $('#parasito_GE').show();
    $('#parasito_GF').show();
    $('#parasito_CATT').show();
    $('#parasito_frais_mince').show();
    $('#parasito_selles_exam_direct').show();
    $('#parasito_urines_sediment').show();
    $('#parasito_PVUF').show();
    $('#parasito_ecr_element').show();
    $('#parasito_bacterio_nature_produit').show();
    $('#parasito_bacterio_gramme').show();
    $('#parasito_bacterio_ziehl').show();
    //bio-chimie
    $('#bio_nature_produit').show();
    $('#bio_glucose').show();
    $('#bio_bilirubine').show();
    $('#bio_albumine').show();
    $('#bio_acetone').show();
    $('#bio_PH').show();
    $('#bio_nitrite').show();
    //IMMINO SEROLOGIE
    $('#is_test_grossesse').show();
    $('#is_widal_TO').show();
    $('#is_TH').show();
    $('#is_CATT').show();
    $('#is_HBS').show();
    $('#is_HC').show();
    $('#is_P120').show();
}

/**
 * Cahe les champs pas important
 * @param array exam
 * @return void
 */
function cahe_champ_moins_important(exam) {
    //hemato
    if (exam.hemato_Hbg != 'x_dem') {
        $('#hemato_Hbg').hide();
    }
    if (exam.hemato_GB != 'x_dem') {
        $('#hemato_GB').hide();
    }
    if (exam.hemato_VS != 'x_dem') {
        $('#hemato_VS').hide();
    }
    if (exam.hemato_FL_E != 'x_dem') {
        $('#hemato_FL_E').hide();
    }
    if (exam.hemato_FL_B != 'x_dem') {
        $('#hemato_FL_B').hide();
    }
    if (exam.hemato_FL_L != 'x_dem') {
        $('#hemato_FL_L').hide();
    }
    if (exam.hemato_FL_M != 'x_dem') {
        $('#hemato_FL_M').hide();
    }
    if (exam.hemato_TS != 'x_dem') {
        $('#hemato_TS').hide();
    }
    if (exam.hemato_TC != 'x_dem') {
        $('#hemato_TC').hide();
    }
    if (exam.hemato_GS != 'x_dem') {
        $('#hemato_GS').hide();
    }
    if (exam.hemato_HTC != 'x_dem') {
        $('#hemato_HTC').hide();
    }
    //parasito
    if (exam.parasito_GE != 'x_dem') {
        $('#parasito_GE').hide();
    }
    if (exam.parasito_GF != 'x_dem') {
        $('#parasito_GF').hide();
    }
    if (exam.parasito_CATT != 'x_dem') {
        $('#parasito_CATT').hide();
    }
    if (exam.parasito_frais_mince != 'x_dem') {
        $('#parasito_frais_mince').hide();
    }
    if (exam.parasito_selles_exam_direct != 'x_dem') {
        $('#parasito_selles_exam_direct').hide();
    }
    if (exam.parasito_urines_sediment != 'x_dem') {
        $('#parasito_urines_sediment').hide();
    }
    if (exam.parasito_PVUF != 'x_dem') {
        $('#parasito_PVUF').hide();
    }
    if (exam.parasito_ecr_element != 'x_dem') {
        $('#parasito_ecr_element').hide();
    }
    if (exam.parasito_bacterio_nature_produit != 'x_dem') {
        $('#parasito_bacterio_nature_produit').hide();
    }
    if (exam.parasito_bacterio_gramme != 'x_dem') {
        $('#parasito_bacterio_gramme').hide();
    }
    if (exam.parasito_bacterio_ziehl != 'x_dem') {
        $('#parasito_bacterio_ziehl').hide();
    }
    //bio-chimie
    if (exam.bio_nature_produit != 'x_dem') {
        $('#bio_nature_produit').hide();
    }
    if (exam.bio_glucose != 'x_dem') {
        $('#bio_glucose').hide();
    }
    if (exam.bio_bilirubine != 'x_dem') {
        $('#bio_bilirubine').hide();
    }
    if (exam.bio_albumine != 'x_dem') {
        $('#bio_albumine').hide();
    }
    if (exam.bio_acetone != 'x_dem') {
        $('#bio_acetone').hide();
    }
    if (exam.bio_PH != 'x_dem') {
        $('#bio_PH').hide();
    }
    if (exam.bio_nitrite != 'x_dem') {
        $('#bio_nitrite').hide();
    }
    //IMMINO SEROLOGIE
    if (exam.is_test_grossesse != 'x_dem') {
        $('#is_test_grossesse').hide();
    }
    if (exam.is_widal_TO != 'x_dem') {
        $('#is_widal_TO').hide();
    }
    if (exam.is_TH != 'x_dem') {
        $('#is_TH').hide();
    }
    if (exam.is_CATT != 'x_dem') {
        $('#is_CATT').hide();
    }
    if (exam.is_HBS != 'x_dem') {
        $('#is_HBS').hide();
    }
    if (exam.is_HC != 'x_dem') {
        $('#is_HC').hide();
    }
    if (exam.is_P120 != 'x_dem') {
        $('#is_P120').hide();
    }
}