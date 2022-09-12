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
                    url: "reporting_fetch.php",
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
                 var numero = $(this).attr("id");
                 
                    $.ajax({
                        url:"reporting_action.php",
                        method:"post",
                        dataType:"JSON",
                        data:{numero:numero,btn_action:btn_action},

                        success:function(data){
                            $('#employee_details').html(data);
                             $('#dataModalemployee').modal("show");
                        }

                        }); 

                }); 

   
 $(document).on('click', '.certificataptitude', function() {
              var btn_action = 'afficher'; 
                 var numero = $(this).attr("id");
                var categorie = $(this).data('categoriepatient');  
                   

                    window.location.href = "certificat.php?numero="+numero+"&categorie="+categorie+"&etat=APTE";
                   
                 });  
            $(document).on('click', '.certificatinaptitude', function() {
             var btn_action = 'afficher'; 
             var numero = $(this).attr("id");
             var categorie = $(this).data('categoriepatient');  
             
             window.location.href = "certificat.php?numero="+numero+"&categorie="+categorie+"&etat=INAPTE";
             
           });  
           
            

            $(document).on('click', '.effectuer', function() { 
              var Matricule = $(this).attr("id"); 
              var nom_agent = $(this).data('nom');    
               var categorie_patient = $(this).data('categoriepatient'); 
              var code_centre = document.getElementById("select_centre").value; 
              var formation = $("#select_centre option:selected").text(); 
              var btn_action = 'transfert';
              
              

              if (code_centre != 'vide') {
                
               
                    $.ajax({
                      url:"reporting_action.php",
                      method:"post",
                      dataType:"JSON",
                      data:{code_centre:code_centre,btn_action:btn_action},

                      success:function(data){

                       $('#transfertModal').modal("show"); 
                       
                       $('#transfert_details').html(data);  
                       $('#code_centre_tranfert').val(code_centre);
                       $('#formation').val(formation);
                       $('#nom_membre_transfert').val(nom_agent);
                       $('#fkmatricule_agent_transfert').val(Matricule);  
                        $('#categorie_patient').val(categorie_patient);
                       
                     },

                     error:function(){
                      alert('Error');
                    }



                  });  
                  } else {
                    alert('Sélectionner un centre');
                  } 
                });

       
            $(document).on('submit', '#transfertModal', function(event) {
              event.preventDefault(); 
              
             
            var fk_matricule_agent = document.getElementById("fkmatricule_agent_transfert").value;  
                 
              var id_centre = document.getElementById("code_centre_tranfert").value;
              var categorie = document.getElementById("categorie_patient").value;

              var specialite_centre = document.getElementById("specialite_centre").value; 
              var btn_action = 'transfert_membre';
                

                 var motif_envoi = document.getElementById("motif_envoi").value; 

                 
                 if (fk_matricule_agent != 'vide') {
                   
                   $.ajax({
                    url:"reporting_action.php",
                    method:"post", 
                    data:{categorie:categorie,
                          fk_matricule_agent:fk_matricule_agent,
                          id_centre:id_centre,
                          motif_envoi:motif_envoi,
                          btn_action:btn_action},

                    success:function(data){
      window.location.href = "certificat.php?Matricule="+fk_matricule_agent+"&id_centre="+id_centre+"&specialite_centre="+specialite_centre+"&motif_envoi="+motif_envoi+"&categorie_patient="+categorie;

                   }
                 });
                   
                 } else {
                  alert('Error');
                }             
                
              });

            
            
 });  

