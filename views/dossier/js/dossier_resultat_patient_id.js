$(document).ready(function () {

    let path = "http://localhost/hopitos/";

    //initialise_datatable_fiche_juste_ouvetes
    var dataTable_fiche_dossier_by_patient_id = $('#table_fiches_dossier_by_patient_id').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            url: path + "dossier/fiches_dossier_by_patient_id_datatable",
            type: "POST",
            data: {
                search_text: $('#hidden_search_text').val(),
                search_type: $('#hidden_search_type').val()
            }
        },
        "columnDefs": [
            {
                "target": [0, 3, 4],
                "orderable": false
            }
        ]
    });
});