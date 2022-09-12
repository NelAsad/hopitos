
$(document).ready(function () {

    let path = "http://localhost/hopitos/";

    //initialise datatable utilisateurs
    dataTable_personnel = $('#users_table').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            url: path + "utilis/users_datatable",
            type: "POST"
        },
        "columnDefs": [
            {
                "target": [0, 3, 4],
                "orderable": false
            }
        ]
    });

    //AJOUT_D'UN_USER
    $(document).on('click', '#save_user_btn', function (e) {
        e.preventDefault();
        var login = $('#login').val();
        var password = $('#password').val();
        var privilege = $('#privilege').val();
        var etat_user = $('#etat_user').val();
        var agent_user = $('#agent_user').val();

        if (login == '' || password == '') {
            swal.fire({
                title: 'Veillez remplir tout les champs',
                text: '',
                type: 'error',
                confirmButtonText: 'Ok'
            });
        } else {

            $.ajax({
                url: path + "utilis/new_user",
                type: 'POST',
                data: {
                    login,
                    password,
                    privilege,
                    etat_user,
                    agent_user
                },
                success: function (data) {
                    if (data == 'inserted') {
                        swal.fire({
                            title: 'Utilisateur ajouté avec succès',
                            text: '',
                            type: 'success',
                            confirmButtonText: 'Ok'
                        });
                        formulaire_ajout_personnel.reset();
                        dataTable_personnel.ajax.reload();
                    } else {
                        console.log(data);
                        // swal.fire({
                        //     title: 'Erreur!',
                        //     text: 'Echec d\'enregistrement',
                        //     type: 'error',
                        //     confirmButtonText: 'Ok'
                        // });
                    }
                },
                error: function (data) {
                    console.log(data);
                }
            });
        }
    });

     // Update user click btn
    // load data
    $(document).on('click', '.btn_update_user_modal', function (e) {
        e.preventDefault();
        var user_id = $(this).attr('id');

        $.ajax({
            url: path + "utilis/get_user",
            type: 'POST',
            dataType: 'JSON',
            data: {
                user_id: user_id
            },
            success: function (user) {
                $('#hidden_update_userid').val(user.user_id);
                $('#login').val(user.login);
                $('#password').val(user.password);
                $('#privilge').val(user.privilege);
                $('#etat_user').val(user.etat);
                $('#agent_user').val(user.agent_id);

                // $('#patient_update_modal').modal('show');
            },
            error: function (data) {
                console.log(data);
                alert('Error!!');
            }
        });
    });

});