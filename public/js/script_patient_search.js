$(document).ready(function() {
  $('#spanimc').fadeIn().html('');
  $('#spanpas').fadeIn().html('');
  $('#spanpad').fadeIn().html('');
  $('#spanfc').fadeIn().html('');  

  var userdataTable = $('#user_data').DataTable({
    "processing": true,
    "serverSide": true,
    "order": [],
    "ajax": {
      url: "patient_search_fetch.php",
      type: "POST"
    },
    "columnDefs": [
    {
      "target": [4, 5],
      "orderable": false
    }
    ],
    "pageLength": 25
  });




  $(document).on('click', '.afficher', function() {

    var btn_action = 'afficher'; 
    var Matricule = $(this).attr("id");

    $.ajax({
      url:"patient_search_action.php",
      method:"post",
      dataType:"JSON",
      data:{Matricule:Matricule,btn_action:btn_action},

      success:function(data){
        $('#employee_details').html(data); 
        $('#dataModalemployee').modal("show");
        $('#matriculeParent').val(Matricule);
      }

    });

  }); 


  $(document).on('click', '.certificataptitude', function() {
    var btn_action = 'afficher'; 
    var numero = $(this).attr("id");
    var categorie = $(this).data('categoriepatient');  


   window.open(this.href = "certificat.php?numero="+numero+"&categorie="+categorie+"&etat=APTE",'blank');

  });  
  $(document).on('click', '.certificatinaptitude', function() {
   var btn_action = 'afficher'; 
   var numero = $(this).attr("id");
   var categorie = $(this).data('categoriepatient');  
   window.open(this.href = "certificat.php?numero="+numero+"&categorie="+categorie+"&etat=INAPTE",'blank');


 });  



  $(document).on('click', '.effectuer', function() { 
    var Matricule = $(this).attr("id"); 
    var nom_agent = $(this).data('nom'); 
   
    var categorie_patient = $(this).data('categoriepatient'); 
   // var code_centre = document.getElementById("select_centre").value; 
   // var formation = $("#select_centre option:selected").text(); 
    var btn_action = 'transfert';

 
      $.ajax({
        url:"patient_search_action.php",
        method:"post",
        dataType:"JSON",
        data:{btn_action:btn_action},

        success:function(data){

         $('#transfertModal').modal("show"); 
   
         $('#transfert_details').html(data);   
        // $('#code_centre_tranfert').val(code_centre);
        // $('#formation').val(formation);
         $('#nom_membre_transfert').val(nom_agent);
         $('#fkmatricule_agent_transfert').val(Matricule);  
         $('#categorie_patient').val(categorie_patient);

       },

       error:function(){
        alert('Error');
      }



    });  
  
  });
            /**
            * le boutton modifier pour agent
            *
            */
            $(document).on('click', '.modifier', function() { 
              var Matricule = $(this).attr("id"); 
            //   alert('The Wise');


            var btn_action = 'patientSearch';

            $.ajax({
              url: "patient_search_action.php",
              method: "POST",
              data: {Matricule: Matricule, btn_action: btn_action},
              dataType: "json",
              success: function(data)
              {

                $('#patientUpdate').modal('show');

                $('#matriculePatient').val(Matricule); 
                $('#nomPatient').val(data.Nom);  
                $('#sexePatient').val(data.Sexe); 
                $('#siegePatient').val(data.siege); 
                $('#fonctionPatient').val(data.Fonction); 
                $('#datenaissancePatient').val(data.DateNaissance); 
                        /**
                        $('.modal-title').html("<i class='fa fa-pencil-square-o'></i> Mise &#224; jour"); 
                        $('#actionUpate').val('Modifier');
                        $('#btn_action').val('Edit'); 
                        */
                      }
                    })

          });

            $(document).on('submit', '#transfertModal', function(event) {
              event.preventDefault(); 
              
              
              var fk_matricule_agent = document.getElementById("fkmatricule_agent_transfert").value;  

             // var id_centre = document.getElementById("code_centre_tranfert").value;
              var id_centre = document.getElementById("formation").value;
              var categorie = document.getElementById("categorie_patient").value;
              var renseignement = document.getElementById("renseignement_clinique").value;
              var specialite_centre = document.getElementById("specialite_centre").value; 
              var btn_action = 'transfert_membre';


              var motif_envoi = document.getElementById("motif_envoi").value; 


              if (fk_matricule_agent != 'vide' && id_centre != '' ) {
               $.ajax({
                url:"patient_search_action.php",
                method:"post", 
                data:{categorie:categorie,
                  fk_matricule_agent:fk_matricule_agent,
                  id_centre:id_centre,
                  motif_envoi:motif_envoi,
                  btn_action:btn_action},

                  success:function(data){
           window.open(this.href = "certificat.php?Matricule="+fk_matricule_agent+"&id_centre="+id_centre+
"&specialite_centre="+specialite_centre+"&motif_envoi="+motif_envoi+"&categorie_patient="+categorie+"&renseignement="+renseignement, 'blank');
                    $("#transfertModal").modal("hide");
                 }
               });
 
             } else {
              alert('Error');
            }             

          });

            $(document).on('keyup', '#recherchemembre', function() {
             recherchemembre();
           });


            $('input[type="radio"]').click(function(){
              var gender = $(this).val();
              $('#repradioAjout').val(gender);  

            });

            $(document).on('submit', '#user_form', function(event) {
              event.preventDefault(); 


              if ($('input[type="text"]').val() !='' && $('#user_datenaissance').val() !='') {

                $('#action').attr('disabled', 'disabled');
                var form_data = $(this).serialize(); 
                $.ajax({
                  url: 'patient_search_action.php',
                  method: "POST",
                  data: form_data,
                  success: function(data)
                  { 
                    $('#user_form')[0].reset();
                    $('#userModal').modal('hide');
                    $('#alert_action').fadeIn().html('<div class="alert alert-success">' + data + '</div>'); 
                    $('#action').attr('disabled', false);
                    userdataTable.ajax.reload(); 
                  }
                });
              } else{ alert('Vérifiez vos champs');}
            });

            $(document).on('submit', '#user_formUpdate', function(event) {
              event.preventDefault(); 
              //    alert('The Wise');
              $('#actionUpdate').attr('disabled', 'disabled');


              var btn_action = 'Edit';
              var matriculePatient = $('#matriculePatient').val();
              var nomPatient = $('#nomPatient').val();
              var sexePatient = $('#sexePatient').val();
              var siegePatient = $('#siegePatient').val();
              var fonctionPatient = $('#fonctionPatient').val();
              var datenaissancePatient = $('#datenaissancePatient').val();
                   // var siegePatient = $('#siegePatient').val();
                   $.ajax({
                    url: 'patient_search_action.php',
                    method: "POST",
                    data: {btn_action:btn_action, 
                      nomPatient:nomPatient,
                      siegePatient:siegePatient,
                      matriculePatient:matriculePatient,
                      datenaissancePatient:datenaissancePatient,
                      fonctionPatient:fonctionPatient,
                      sexePatient:sexePatient
                    }, 
                    success: function(data)
                    {
                      $('#user_formUpdate')[0].reset();
                      $('#patientUpdate').modal('hide');
                        /**
                        $('#alert_action').fadeIn().html('<div class="alert alert-success">' + data + '</div>');  */
                        $('#actionUpdate').attr('disabled', false);
                        userdataTable.ajax.reload();
                      }
                    });   
                 });



            $(document).on('blur', '#user_number', function(event) {
              var btn_action = 'checkNumber';
              var user_number = $('#user_number').val();
              if (user_number !='') {

                $.ajax({
                  url: 'patient_search_action.php',
                  method: "POST",
                  dataType:"JSON",
                  data: {btn_action:btn_action,user_number:user_number},
                  success: function(data)
                  { 
                    if (data.matricule != 'existe') {

                    } else {
                     alert('Ce Matricule existe dans la base');
                     $('#user_number').val('');

                   }
                 }
               });
              }
              else{

                alert('le champ est vide');
              }

            });
          });  



function recherchemembre(){
  var btn_action = 'afficherMembre';
  var MatriculeMembre = document.getElementById("recherchemembre").value;
  var Matricule = document.getElementById("matriculeParent").value;

  afficherFamille(Matricule,MatriculeMembre,btn_action);
}
function afficherFamille(Matricule,MatriculeMembre, btn_action){ 

  $.ajax({
    url:"patient_search_action.php",
    method:"post",
    dataType:"JSON",
    data:{Matricule:Matricule,MatriculeMembre:MatriculeMembre,btn_action:btn_action},

    success:function(data){
      $('#employee_details').html(data); 
      $('#dataModalemployee').modal("show");
    }

  });

}

function isInputNumber(evt){
  var char =   evt.which;

  if(char > 31 && char != 32 && (char<48 || char > 57)){
    return false;
  }
}