let dataTable_produits

$(document).ready(function () {

    let path = "http://localhost:92/hopitos/";

    //initialise datatable produit pharmaceutique
    dataTable_produits = $('#produits_table').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            url: path + "pharmacie/produit_datatable",
            type: "POST"
        },
        "columnDefs": [
            {
                "target": [0, 3, 4],
                "orderable": false
            }
        ]
    });
    //initialise datatable sortie produit
    dataTable_sortie_produit = $('#sortie_produits_table').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            url: path + "pharmacie/sortie_produits_datatable",
            type: "POST"
        },
        "columnDefs": [
            {
                "target": [0, 3, 4],
                "orderable": false
            }
        ]
    });

    //AJOUT D'UN NOUVEAU PRODUIT
    $(document).on('click', '#btn_add_new_produit', function (e) {
        e.preventDefault();

        let new_produit_nom = $('#new_produit_nom').val();
        let new_produit_dosage = $('#new_produit_dosage').val();
        let new_produit_dosage_unite = $('#new_produit_dosage_unite').val();
        let new_produit_pv = $('#new_produit_pv').val();

        if (new_produit_pv == '' || new_produit_nom == '') {
            swal.fire({
                title: 'Champs vide',
                text: 'Veillez remplir tout les champs obligatoires',
                type: 'error',
                confirmButtonText: 'Ok'
            });
        } else {

            $.ajax({
                url: path + "pharmacie/add_new_produit",
                type: 'POST',
                dataType: 'JSON',
                data: {
                    new_produit_nom: new_produit_nom,
                    new_produit_dosage: new_produit_dosage,
                    new_produit_dosage_unite: new_produit_dosage_unite,
                    new_produit_pv: new_produit_pv
                },
                success: function (data) {
                    if (data.reponse == 'bien') {
                        toastr.options.progressBar = true;
                        toastr.options.showMethod = 'slideDown';
                        toastr.options.hideMethod = 'fadeOut';
                        toastr.options.closeMethod = 'fadeOut';
                        toastr.success('Produit ajoutée avec succès');

                        form_add_produit.reset();
                        dataTable_produits.ajax.reload();
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

    // UPDATE PRODUIT
    //show modal
    $(document).on('click', '.btn_update_produit_modal', function (e) {
        e.preventDefault();
        var produit_id = $(this).attr('id');
        $.ajax({
            url: path + "pharmacie/get_produit",
            type: 'POST',
            dataType: 'JSON',
            data: {
                produit_id: produit_id
            },
            success: function (produit) {
                $('#hidden_update_produit_id').val(produit.produit_id);
                $('#update_produit_nom').val(produit.produit_nom);
                $('#update_produit_dosage').val(produit.produit_dosage);
                $('#update_produit_dosage_unite').val(produit.produit_dosage_unite);
                $('#update_produit_pv').val(produit.produit_pv);
                $('#update_produit_qte').val(produit.produit_qte);

                $('#update_produit_modal').modal('show');
            },
            error: function (data) {
                alert('Error');
            }
        });
    });
    //done update
    $(document).on('click','#btn_add_update_produit', function (e){
        e.preventDefault();

        let produit_id = $('#hidden_update_produit_id').val();
        let produit_nom = $('#update_produit_nom').val();
        let produit_dosage = $('#update_produit_dosage').val();
        let produit_dosage_unite = $('#update_produit_dosage_unite').val();
        let produit_pv = $('#update_produit_pv').val();
        let produit_qte = $('#update_produit_qte').val();

        if (produit_nom == '' || produit_pv == '' || produit_qte == '' || produit_dosage_unite == '') {
            swal.fire({
                title: 'Champs vide',
                text: 'Veillez remplir tout les champs obligatoires',
                type: 'error',
                confirmButtonText: 'Ok'
            });
        } else {

            $.ajax({
                url: path + "pharmacie/update_produit",
                type: 'POST',
                dataType: 'JSON',
                data: {
                    produit_id: produit_id,
                    produit_nom: produit_nom,
                    produit_dosage: produit_dosage,
                    produit_dosage_unite: produit_dosage_unite,
                    produit_pv: produit_pv,
                    produit_qte: produit_qte,
                },
                success: function (data) {
                    if (data.reponse == 'bien') {
                        toastr.options.progressBar = true;
                        toastr.options.showMethod = 'slideDown';
                        toastr.options.hideMethod = 'fadeOut';
                        toastr.options.closeMethod = 'fadeOut';
                        toastr.success('Produit mise à jour avec succès');

                        form_update_produit.reset();
                        dataTable_produits.ajax.reload();
                    }
                    if (data.reponse == 'pas_bien') {
                        toastr.options.progressBar = true;
                        toastr.options.showMethod = 'slideDown';
                        toastr.options.hideMethod = 'fadeOut';
                        toastr.options.closeMethod = 'fadeOut';
                        toastr.warning('Echec de mise à jour');
                    }
                },
                error: function (data) {
                    alert('Error');
                }
            });
        }
    });

    //Ajout d'une quantite pour un produit
    //show modal
    $(document).on('click', '.btn_add_qte_produit_modal', function (e) {
        e.preventDefault();
        var produit_id = $(this).attr('id');

        $('#hidden_add_qte_produit_id').val(produit_id);
        $('#add_qte_produit_modal').modal('show');

    });
    //done add qte pour un produit
    $(document).on('click', '#btn_add_qte_produit', function (e) {
        e.preventDefault();
        let produit_id = $('#hidden_add_qte_produit_id').val();
        let qte_added = parseFloat($('#add_qte_produit_qte').val());

        if (qte_added < 1) {
            swal.fire({
                title: 'Valeur invalide',
                text: 'Veillez saisir une quantite valide',
                type: 'error',
                confirmButtonText: 'Ok'
            });
        } else {
            $.ajax({
                url: path + "pharmacie/get_produit",
                type: 'POST',
                dataType: 'JSON',
                data: {
                    produit_id: produit_id
                },
                success: function (produit) {

                    $.ajax({
                        url: path + "pharmacie/add_produit_qte",
                        type: 'POST',
                        dataType: 'JSON',
                        data: {
                            produit_id: produit.produit_id,
                            produit_qte: parseFloat(produit.produit_qte) + qte_added
                        },
                        success: function (data) {
                            if (data.reponse == 'bien') {
                                toastr.options.progressBar = true;
                                toastr.options.showMethod = 'slideDown';
                                toastr.options.hideMethod = 'fadeOut';
                                toastr.options.closeMethod = 'fadeOut';
                                toastr.success('Quantité ajouté avec succès');

                                form_add_qte_produit.reset();
                                dataTable_produits.ajax.reload();
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
                },
                error: function (data) {
                    alert('Error');
                }
            });
        }
    });

    //Delivrer une quantite d'un produit
    //show modal
    $(document).on('click', '.btn_sortie_produit_modal', function (e) {
        e.preventDefault();
        var produit_id = $(this).attr('id');

        $('#hidden_delivrer_qte_produit_id').val(produit_id);
        $('#delivrer_qte_produit_modal').modal('show');

    });
    //done delivrer qte pour un produit
    $(document).on('click', '#btn_delivrer_qte_produit', function (e) {
        e.preventDefault();
        let produit_id = $('#hidden_delivrer_qte_produit_id').val();
        let quantite_delivree = parseFloat($('#delivrer_produit_qte').val());

        if (quantite_delivree < 1) {
            swal.fire({
                title: 'Valeur invalide',
                text: 'Veillez saisir une quantite valide',
                type: 'error',
                confirmButtonText: 'Ok'
            });
        } else {
            $.ajax({
                url: path + "pharmacie/get_produit",
                type: 'POST',
                dataType: 'JSON',
                data: {
                    produit_id: produit_id
                },
                success: function (produit) {

                    if (parseFloat(produit.produit_qte) - quantite_delivree) {
                        swal.fire({
                            title: 'Quantité trop importante',
                            text: 'La quantité demandée est supérieure à la quantité en stock',
                            type: 'error',
                            confirmButtonText: 'Ok'
                        });
                    } else {
                        $.ajax({
                            url: path + "pharmacie/delivrer_produit_qte",
                            type: 'POST',
                            dataType: 'JSON',
                            data: {
                                produit_id: produit.produit_id,
                                produit_qte: parseFloat(produit.produit_qte) - quantite_delivree,
                                quantite_delivree: quantite_delivree
                            },
                            success: function (data) {
                                if (data.reponse == 'bien') {
                                    toastr.options.progressBar = true;
                                    toastr.options.showMethod = 'slideDown';
                                    toastr.options.hideMethod = 'fadeOut';
                                    toastr.options.closeMethod = 'fadeOut';
                                    toastr.success('Produit delivré avec succès');
    
                                    form_add_qte_produit.reset();
                                    dataTable_produits.ajax.reload();
                                    dataTable_sortie_produit.ajax.reload();
                                }
                                if (data.reponse == 'pas_bien') {
                                    toastr.options.progressBar = true;
                                    toastr.options.showMethod = 'slideDown';
                                    toastr.options.hideMethod = 'fadeOut';
                                    toastr.options.closeMethod = 'fadeOut';
                                    toastr.warning('Echec de livraison');
                                }
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
    });



});