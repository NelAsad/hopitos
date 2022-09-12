
$(document).ready(function () {

    let path = "http://localhost/hopitos/";

    //initialise datatable personnel
    dataTable_personnel = $('#personnel_table').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            url: path + "users/personnel_datatable",
            type: "POST"
        },
        "columnDefs": [
            {
                "target": [0, 3, 4],
                "orderable": false
            }
        ]
    });

    //AJOUT_D'UN_NOUVEAU_PERSONNEL
    $(document).on('click', '#save_personnel_btn', function (e) {
        e.preventDefault();
        var prenom = $('#pers_prenom').val();
        var nom = $('#pers_nom').val();
        var postnom = $('#pers_postnom').val();
        var sexe = $('#pers_sexe').val();
        var tel = $('#pers_tel').val();
        var email = $('#pers_email').val();
        var pers_fonction = $('#pers_fonction').val();
        var pers_site = $('#pers_site').val();
        var pers_matricule = $('#pers_matricule').val();
        var etat_civil = $('#pers_etat_civil').val();
        var nbre_enfant = $('#pers_nbre_enfant').val();
        var epoux = $('#pers_epoux').val();

        var nais = $('#pers_nais').val();
        var date_nais = $('#pers_date_nais').val();
        var adresse = $('#pers_adresse').val();

        if (prenom == '' || nom == '' || postnom == '') {
            swal.fire({
                title: 'Veillez remplir tout les champs',
                text: '',
                type: 'error',
                confirmButtonText: 'Ok'
            });
        } else {

            $.ajax({
                url: path + "users/new_personnel",
                type: 'POST',
                data: {
                    prenom: prenom,
                    nom: nom,
                    postnom: postnom,
                    sexe: sexe,
                    tel: tel,
                    email: email,
                    pers_fonction: pers_fonction,
                    pers_site: pers_site,
                    pers_matricule: pers_matricule,
                    etat_civil: etat_civil,
                    nbre_enfant: nbre_enfant,
                    epoux: epoux,
                    nais: nais,
                    date_nais: date_nais,
                    adresse: adresse,
                },
                success: function (data) {
                    if (data == 'inserted') {
                        swal.fire({
                            title: 'Personnel ajouté avec succès',
                            text: '',
                            type: 'success',
                            confirmButtonText: 'Ok'
                        });
                        formulaire_ajout_personnel.reset();
                        dataTable_personnel.ajax.reload();
                    } else {
                        swal.fire({
                            title: 'Erreur!',
                            text: 'Echec d\'enregistrement',
                            type: 'error',
                            confirmButtonText: 'Ok'
                        });
                    }
                },
                error: function (data) {
                    console.log(data);
                }
            });
        }
    });

    // Update personnel click btn
    // load data
    $(document).on('click', '.btn_update_personnel_modal', function (e) {
        e.preventDefault();
        var id_agent = $(this).attr('id');

        $.ajax({
            url: path + "users/get_personnel",
            type: 'POST',
            dataType: 'JSON',
            data: {
                id_agent: id_agent
            },
            success: function (agent) {
                $('#hidden_update_personnel_id').val(agent.id_agent);
                $('#pers_prenom').val(agent.prenom_agent);
                $('#pers_nom').val(agent.nom_agent);
                $('#pers_postnom').val(agent.postnom_agent);
                $('#pers_sexe').val(agent.sexe_agent);
                $('#pers_tel').val(agent.tel_agent);
                $('#pers_email').val(agent.email_agent);
                $('#pers_fonction').val(agent.fonction_agent);
                $('#pers_site').val(agent.site_agent);
                $('#pers_matricule').val(agent.matricule_agent);
                $('#pers_etat_civil').val(agent.etat_civil);
                $('#pers_nbre_enfant').val(agent.nbre_enfant);
                $('#pers_epoux').val(agent.epoux);
                $('#pers_nais').val(agent.nais_agent);
                $('#pers_date_nais').val(agent.date_nais_agent);
                $('#pers_adresse').val(agent.adresse_agent);

                // $('#patient_update_modal').modal('show');
            },
            error: function (data) {
                alert('Error!!');
            }
        });
    });
    // Valider update personnel
    $(document).on('click', '#update_personnel_btn', function (e) {
        e.preventDefault();
        var id_agent = $('#hidden_update_personnel_id').val();
        var prenom = $('#pers_prenom').val();
        var nom = $('#pers_nom').val();
        var postnom = $('#pers_postnom').val();
        var sexe = $('#pers_sexe').val();
        var tel = $('#pers_tel').val();
        var email = $('#pers_email').val();
        var profession = $('#pers_fonction').val();
        var pers_site = $('#pers_site').val();
        var pers_matricule = $('#pers_matricule').val();
        var etat_civil = $('#pers_etat_civil').val();
        var nbre_enfant = $('#pers_nbre_enfant').val();
        var epoux = $('#pers_epoux').val();

        var nais = $('#pers_nais').val();
        var date_nais = $('#pers_date_nais').val();
        var adresse = $('#pers_adresse').val();

        if (prenom == '' || nom == '' || postnom == '') {
            swal.fire({
                title: 'Veillez remplir tout les champs',
                text: '',
                type: 'error',
                confirmButtonText: 'Ok'
            });
        } else {

            $.ajax({
                url: path + "users/update_personnel",
                type: 'POST',
                data: {
                    id_agent: id_agent,
                    prenom: prenom,
                    nom: nom,
                    postnom: postnom,
                    sexe: sexe,
                    tel: tel,
                    email: email,
                    profession: profession,
                    pers_site: pers_site,
                    pers_matricule: pers_matricule,
                    etat_civil: etat_civil,
                    nbre_enfant: nbre_enfant,
                    epoux: epoux,
                    nais: nais,
                    date_nais: date_nais,
                    adresse: adresse,
                },
                success: function (data) {
                    if (data == 'inserted') {
                        swal.fire({
                            title: 'Personnel Modifié avec succès',
                            text: '',
                            type: 'success',
                            confirmButtonText: 'Ok'
                        });
                        formulaire_ajout_personnel.reset();
                        dataTable_personnel.ajax.reload();
                    } else {
                        console.log(data);
                        swal.fire({
                            title: 'Erreur!',
                            text: 'Echec de modification',
                            type: 'error',
                            confirmButtonText: 'Ok'
                        });
                    }
                },
                error: function (data) {
                    console.log(data);
                }
            });
        }
    });


    //Delete agent
    $(document).on('click', '.btn_delete_personnel', function (e) {
        e.preventDefault();
        let id_agent = $(this).attr('id');

        if (id_agent == '') {
            alert('Veillez choisir un agent avant');
        } else {

            if (confirm('Voulez-vous vraiment supprimer cet agent ?')) {
                $.ajax({
                    url: path + "users/delete_agent",
                    type: 'POST',
                    dataType: 'JSON',
                    data: {
                        id_agent: id_agent
                    },
                    success: function (data) {
                        if (data.reponse == 'bien') {
                            toastr.options.progressBar = true;
                            toastr.options.showMethod = 'slideDown';
                            toastr.options.hideMethod = 'fadeOut';
                            toastr.options.closeMethod = 'fadeOut';
                            toastr.success('Agent supprimé');
                            dataTable_personnel.ajax.reload();
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


});