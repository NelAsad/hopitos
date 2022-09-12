$(document).ready(function () {

    let path = "http://localhost:92/hopitos/";

    $('#search_pour_date_block').hide();
    $('.search_pour_periode_block').hide();

    $('#search_pour_date_block_consultation').hide();
    $('.search_pour_periode_block_consultation').hide();

    //Affichage_des_champs_en_fontion_du_statut (Finances)
    $(document).on('change', '#search_type', function () {
        if ($('#search_type').val() == 1) {
            $('#search_pour_date_block').show();
            $('.search_pour_periode_block').hide();
        }
        if ($('#search_type').val() == 2) {
            $('#search_pour_date_block').hide();
            $('.search_pour_periode_block').show();
        }
        if ($('#search_type').val() == "") {
            $('#search_pour_date_block').hide();
            $('.search_pour_periode_block').hide();
        }
    });
    //Affichage_des_champs_en_fontion_du_statut (consultation)
    $(document).on('change', '#search_type_consultation', function () {
        if ($('#search_type_consultation').val() == 1) {
            $('#search_pour_date_block_consultation').show();
            $('.search_pour_periode_block_consultation').hide();
        }
        if ($('#search_type_consultation').val() == 2) {
            $('#search_pour_date_block_consultation').hide();
            $('.search_pour_periode_block_consultation').show();
        }
        if ($('#search_type_consultation').val() == "") {
            $('#search_pour_date_block_consultation').hide();
            $('.search_pour_periode_block_consultation').hide();
        }
    });

    //charge les stats finances initales
    load_default_stat_finaces();
    //charge les stats consultations initiales
    load_default_stats_consultation();

    //search finances stats by date or periode
    $(document).on('click', '#btn_search_stat', function (e) {
        e.preventDefault();
        let search_type = $('#search_type').val();
        let date_pour_search_d_un_jour = $('#date_pour_search_d_un_jour').val();
        let date_debut_pour_search_d_un_jour = $('#date_debut_pour_search_d_un_jour').val();
        let date_fin_pour_search_d_un_jour = $('#date_fin_pour_search_d_un_jour').val();

        if (search_type == "") {
            load_default_stat_finaces();
        } else if (search_type == 1) {
            
            load_default_stat_finaces(date_pour_search_d_un_jour);
            
        } else if (search_type == 2) {

            if (date_debut_pour_search_d_un_jour == '' && date_fin_pour_search_d_un_jour == '') {
                swal.fire({
                        title: 'Période invalide',
                        text: 'Veillez choisir une période valide',
                        type: 'error',
                        confirmButtonText: 'Ok'
                });
            } else {

                let nbre_fiche = 0;
                let total_fiche = 0;
                let total_labo = 0;
                let total_fiche_labo = 0;
                let total_autres_payements = 0;
                let total_all = 0;
                let total_depenses = 0;
                let solde = 0;

                $.ajax({
                    url: path + "stats/get_payement_periode",
                    type: 'POST',
                    dataType: 'JSON',
                    data: {
                        date_debut: date_debut_pour_search_d_un_jour,
                        date_fin: date_fin_pour_search_d_un_jour
                    },
                    success: function (payements) {

                        if (payements.length == 0) {
                            $('#span_total_fiche').html(0);
                            $('#span_total_labo').html(0);
                            $('#span_total_fiche_and_labo').html(0);
                            $('#span_nbrel_fiche').html(0);
                        } else {
                            $.ajax({
                                url: path + "stats/get_depenses_periode",
                                type: 'POST',
                                dataType: 'JSON',
                                data: {
                                    date_debut: date_debut_pour_search_d_un_jour,
                                    date_fin: date_fin_pour_search_d_un_jour
                                },
                                success: function (depenses) {

                                    depenses.forEach(depense => {
                                        total_depenses += parseFloat(depense.depense_montant);
                                    });

                                    payements.forEach(payement => {
                                        if (payement.pay_motif == 1) {
                                            nbre_fiche++;
                                            total_fiche += parseFloat(payement.pay_montant);
                                        } else if (payement.pay_motif == 2) {
                                            total_labo += parseFloat(payement.pay_montant);
                                        } else if (payement.pay_motif == 3) {
                                            total_autres_payements += parseFloat(payement.pay_montant);
                                        }
                                    });

                                    total_fiche_labo = total_fiche + total_labo;
                                    total_all = total_fiche_labo + total_autres_payements;
                                    solde = total_all - total_depenses;

                                    $('#span_nbre_fiche').html(nbre_fiche);
                                    $('#span_total_fiche').html(total_fiche);
                                    $('#span_total_labo').html(total_labo);
                                    $('#span_total_fiche_and_labo').html(total_fiche_labo);
                                    $('#span_total_autres_peyements').html(total_autres_payements);
                                    $('#span_total_all').html(total_all);
                                    $('#span_total_depenses').html(total_depenses);
                                    $('#span_total_solde').html(solde);

                                }, error: function (data) {
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

        } 
    });

    //search fiche stats by date or periode avec filtre medecin
    $(document).on('click', '#btn_search_stat_consultation', function (e) {
        e.preventDefault();

        let search_type_consultation = $('#search_type_consultation').val();
        let search_medecin_consultation = $('#search_medecin_consultation').val();
        let date_pour_search_d_un_jour_consultation = $('#date_pour_search_d_un_jour_consultation').val();
        let date_debut_pour_search_d_un_jour_consultation = $('#date_debut_pour_search_d_un_jour_consultation').val();
        let date_fin_pour_search_d_un_jour_consultation = $('#date_fin_pour_search_d_un_jour_consultation').val();

        if (search_type_consultation == "" && search_medecin_consultation == "") {
            load_default_stat_finaces();
        } else if (search_type_consultation == 1){
            if (search_medecin_consultation == "") {
                search_medecin_consultation = null;
            }
            load_default_stats_consultation(date_pour_search_d_un_jour_consultation, search_medecin_consultation);
        } else if (search_type_consultation == 2){

            if (date_debut_pour_search_d_un_jour_consultation == '' && date_fin_pour_search_d_un_jour_consultation == '') {
                swal.fire({
                    title: 'Période invalide',
                    text: 'Veillez choisir une période valide',
                    type: 'error',
                    confirmButtonText: 'Ok'
                });
            } else {

                if (search_medecin_consultation == "") {
                    search_medecin_consultation = null;
                }

                $.ajax({
                    url: path + "stats/get_consultation_stats_periode",
                    type: 'POST',
                    dataType: 'JSON',
                    data: {
                        medecin_consultation_id: search_medecin_consultation,
                        date_debut: date_debut_pour_search_d_un_jour_consultation,
                        date_fin: date_fin_pour_search_d_un_jour_consultation
                    },
                    success: function (consultation_stats) {

                        $('#span_nbre_consultations').html(consultation_stats['consultations'].length);
                        $('#span_motant_total_consultation').html((consultation_stats['consultations'].length) * consultation_stats['info_config_fiche'][0].config_val);

                    },
                    error: function (data) {
                        alert('Error');
                    }
                });
            }

        }


    });

    /**
     * Mes Fonctions
     */
    //charge les details pour les finances
    function load_default_stat_finaces(date = null) {
        let nbre_fiche = 0;
        let total_fiche = 0;
        let total_labo = 0;
        let total_fiche_labo = 0;
        let total_autres_payements = 0;
        let total_all = 0;
        let total_depenses = 0;
        let solde = 0;

        $.ajax({
            url: path + "stats/get_payement_date",
            type: 'POST',
            dataType: 'JSON',
            data: {
                now_date: date
            },
            success: function (payements) {
                if (payements.length == 0) {
                    $('#span_total_fiche').html(0);
                    $('#span_total_labo').html(0);
                    $('#span_total_fiche_and_labo').html(0);
                    $('#span_nbrel_fiche').html(0);
                } else {

                    $.ajax({
                        url: path + "stats/get_depenses_date",
                        type: 'POST',
                        dataType: 'JSON',
                        data: {
                            now_date: date
                        },
                        success: function (depenses) {

                            depenses.forEach(depense => {
                                total_depenses += parseFloat(depense.depense_montant);
                            });
                            
                            payements.forEach(payement => {
                                if (payement.pay_motif == 1) {
                                    nbre_fiche++;
                                    total_fiche += parseFloat(payement.pay_montant);
                                } else if (payement.pay_motif == 2) {
                                    total_labo += parseFloat(payement.pay_montant);
                                } else if (payement.pay_motif == 3) {
                                    total_autres_payements += parseFloat(payement.pay_montant);
                                }
                            });

                            total_fiche_labo = total_fiche + total_labo;
                            total_all = total_fiche_labo + total_autres_payements;
                            solde = total_all - total_depenses;

                            $('#span_nbre_fiche').html(nbre_fiche);
                            $('#span_total_fiche').html(total_fiche);
                            $('#span_total_labo').html(total_labo);
                            $('#span_total_fiche_and_labo').html(total_fiche_labo);
                            $('#span_total_autres_peyements').html(total_autres_payements);
                            $('#span_total_all').html(total_all);
                            $('#span_total_depenses').html(total_depenses);
                            $('#span_total_solde').html(solde);

                        }, error: function (data) {
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
    //charge les details pour la consultations
    function load_default_stats_consultation(date = null, medecin_id = null) {
        $.ajax({
            url: path + "stats/get_consultation_stats_date",
            type: 'POST',
            dataType: 'JSON',
            data: {
                now_date: date,
                medecin_id: medecin_id
            },
            success: function (consultation_stats) {

                $('#span_nbre_consultations').html(consultation_stats['consultations'].length);
                $('#span_motant_total_consultation').html((consultation_stats['consultations'].length) * consultation_stats['info_config_fiche'][0].config_val); 
            
            },
            error: function (data) {
                alert('Error');
            }
        });
    }


});