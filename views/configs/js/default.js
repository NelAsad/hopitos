
$(document).ready(function () {

    let path = "http://localhost:92/hopitos/";


    //initialise_datatable_configs
    var dataTable_configs = $('#table_configs').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            url: path + "configs/configs_datatable",
            type: "POST"
        },
        "columnDefs": [
            {
                "target": [0, 3, 4],
                "orderable": false
            }
        ]
    });
    //initialise_datatable_depenses
    var dataTable_depenses = $('#table_depenses').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            url: path + "configs/depenses_datatable",
            type: "POST"
        },
        "columnDefs": [
            {
                "target": [0, 3, 4],
                "orderable": false
            }
        ]
    });


    //AJOUT_D'UNE_NOUVELLE_CONFIG
    $(document).on('click', '#btn_add_new_config', function (e) {
        e.preventDefault();

        var config_type = $('#config_type').val();
        var config_id = $('#config_id').val();
        var config_nom = $('#config_nom').val();
        var config_val = $('#config_val').val();

        if (config_nom == '' || config_val == '' ) {
            swal.fire({
                title: 'Champs vide',
                text: 'Veillez remplir tout les champs obligatoires',
                type: 'error',
                confirmButtonText: 'Ok'
            });
        } else {

            $.ajax({
                url: path + "configs/add_new_config",
                type: 'POST',
                dataType: 'JSON',
                data: {
                    config_type: config_type,
                    config_id: config_id,
                    config_nom: config_nom,
                    config_val: config_val
                },
                success: function (data) {
                    if (data.reponse == 'bien') {
                        toastr.options.progressBar = true;
                        toastr.options.showMethod = 'slideDown';
                        toastr.options.hideMethod = 'fadeOut';
                        toastr.options.closeMethod = 'fadeOut';
                        toastr.success('Configuration ajoutée avec succès');

                        form_add_new_config.reset();
                        dataTable_configs.ajax.reload();
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
            
        }
    });

    //UPDATE CONFIG VALUE
    //affiche le modal
    $(document).on('click', '.btn_update_config_modal', function (e) {
        e.preventDefault();
        var config_id = $(this).attr('id');

        $('#hidden_update_config_val_id').val(config_id);
        $('#update_config_val_modal').modal('show');

    });
    // Valider la modification
    $(document).on('click', '#btn_done_update_config_val', function (e) {
        e.preventDefault();
        var config_id = $('#hidden_update_config_val_id').val();
        var config_new_val = $('#update_config_new_value').val();

        if (config_id == '' ) {
            swal.fire({
                title: 'Champs vide',
                text: 'Veillez saisir une nouvelle valeur',
                type: 'error',
                confirmButtonText: 'Ok'
            });
        } else {

            $.ajax({
                url: path + "configs/update_config_val",
                type: 'POST',
                dataType: 'JSON',
                data: {
                    config_id: config_id,
                    config_new_val: config_new_val
                },
                success: function (data) {
                    if (data.reponse == 'bien') {
                        toastr.options.progressBar = true;
                        toastr.options.showMethod = 'slideDown';
                        toastr.options.hideMethod = 'fadeOut';
                        toastr.options.closeMethod = 'fadeOut';
                        toastr.success('Configuration modifiée avec succès');

                        form_update_config_val.reset();
                        dataTable_configs.ajax.reload();
                    }
                    if (data.reponse == 'pas_bien') {
                        toastr.options.progressBar = true;
                        toastr.options.showMethod = 'slideDown';
                        toastr.options.hideMethod = 'fadeOut';
                        toastr.options.closeMethod = 'fadeOut';
                        toastr.warning('Echec de mise a jour');
                    }
                },
                error: function (data) {
                    alert('Error');
                }
            });
        }
    });

    ///////// DEPENSES //////////
    // Valider la modification
    $(document).on('click', '#btn_done_new_depense', function (e) {
        e.preventDefault();
        var new_depense_motif = $('#new_depense_motif').val();
        var new_depense_montant = $('#new_depense_montant').val();

        if (new_depense_motif == '' || new_depense_montant == '') {
            swal.fire({
                title: 'Champs vide',
                text: 'Veillez remplir tous les champs avec des donnees valides',
                type: 'error',
                confirmButtonText: 'Ok'
            });
        } else {

            $.ajax({
                url: path + "configs/add_depense",
                type: 'POST',
                dataType: 'JSON',
                data: {
                    new_depense_motif: new_depense_motif,
                    new_depense_montant: new_depense_montant
                },
                success: function (data) {
                    if (data.reponse == 'bien') {
                        toastr.options.progressBar = true;
                        toastr.options.showMethod = 'slideDown';
                        toastr.options.hideMethod = 'fadeOut';
                        toastr.options.closeMethod = 'fadeOut';
                        toastr.success('Depense effectuée avec succès');

                        form_add_new_depense.reset();
                        dataTable_depenses.ajax.reload();
                    }
                    if (data.reponse == 'pas_bien') {
                        toastr.options.progressBar = true;
                        toastr.options.showMethod = 'slideDown';
                        toastr.options.hideMethod = 'fadeOut';
                        toastr.options.closeMethod = 'fadeOut';
                        toastr.warning('Echec d ajout');
                    }
                },
                error: function (data) {
                    alert('Error');
                }
            });
        }

    });


});
