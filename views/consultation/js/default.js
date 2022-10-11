
$(document).ready(function () {

    let path = "http://localhost/hopitos/";

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })

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

    // Voir diagnostics du transfert
    $(document).on('click', '.btn_voir_diagnostic_transfert', function (e) {
        e.preventDefault();
        let transfert_id = $(this).attr('id');

        $.ajax({
            url: path + "consultation/get_transfert_diagnostics",
            type: 'POST',
            dataType: 'JSON',
            data: { transfert_id },
            success: function (data) {
                console.log(data);
                let list_diagnostics = ``;

                data.forEach(acte => {
                    list_diagnostics += `

                        <div class="card">
                            <div class="card-header" id="heading${acte.pk_diagnostic}">
                                <h5 class="mb-0">
                                    <ul class="todo-list ui-sortable">
                                        <li>
                                            <span class="text">
                                                <button style="text-decoration: none;" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse${acte.pk_diagnostic}" aria-expanded="false" aria-controls="collapse${acte.pk_diagnostic}">
                                                    ${acte.note_diagnostic}
                                                </button>
                                            </span>
                                        </li>
                                    </ul>
                                    
                                </h5>
                            </div>
                            <div id="collapse${acte.pk_diagnostic}" class="collapse" aria-labelledby="heading${acte.pk_diagnostic}" data-parent="#accordion">
                                <div class="card-body">
                                    <a style='cursor: pointer;' data-bs-toggle="modal" data-bs-target="#demander_examens_modal" data-bs-dismiss="modal" class='btn btn-primary btn-xs btn_demander_examen_modal col-md-3' id='${acte.pk_diagnostic}' title='Demander examens'><i class='fa fa-send'></i> Demander examens</a>
                                    <a style='cursor: pointer;' class='btn btn-warning btn-xs btn_voir_diagnostic_examens col-md-3' id='${acte.pk_diagnostic}' title='Demander examens'><i class='fa fa-eye'></i> Voir examens</a>
                                    <a style='cursor: pointer;' data-bs-toggle="modal" data-bs-target="#demander_examens_modal" data-bs-dismiss="modal" class='btn btn-primary btn-xs btn_prescrire_modal col-md-3' id='${acte.pk_diagnostic}' title='Demander examens'><i class='fa fa-medkit'></i> Prescrire</a>
                                    <a style='cursor: pointer;' class='btn btn-warning btn-xs btn_voir_prescription_modal col-md-3' id='${acte.pk_diagnostic}' title='Demander examens'><i class='fa fa-eye'></i> Voir Prescriptions</a>
                                </div>
                            </div>
                        </div>
                    `;
                });

                $('#hidden_diagnostic_transfert_id').val(transfert_id);
                $('#body_modal_diagnostic').html(list_diagnostics);
                $('#voir_diagnostic_modal').modal('show');
            },
            error: function (data) {
                console.log(data);
                alert('Error!!');
            }
        });
    });


    //DEMANDER DES EXAMENS
    //ouvrir modal demande examens
    $(document).on('click', '.btn_demander_examen_modal', function (e) {
        e.preventDefault();
        var transfert_id = $(this).attr('id');
        $('#voir_diagnostic_modal').modal('hide');

        $.ajax({
            url: path + "consultation/get_actes",
            type: 'POST',
            dataType: 'JSON',
            data: {},
            success: function (data) {
                console.log(data);
                $('#hidden_demande_transfert_id').val(transfert_id);
                let list_examen = ``;

                data.forEach(acte => {
                    list_examen += `
                        <div class="col-xs-12">
                            <label for="${acte.pk_acte}">${acte.nom_acte}</label>
                            <input type="checkbox" id="${acte.pk_acte}" name="${acte.pk_acte}">
                        </div>
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
        let diagnostic_id = $('#hidden_demande_transfert_id').val();
        let actes = [];
        $(':checkbox:checked').each(function (i) {
            actes[i] = $(this).attr("id");
        });
        console.log(actes);
        $.ajax({
            url: path + "consultation/demande_examen",
            type: 'POST',
            dataType: 'JSON',
            data: { actes, diagnostic_id },
            success: function (data) {
                console.log(data);
            },
            error: function (data) {
                console.log(data);
                alert('Error!!');
            }
        });
    });




});



