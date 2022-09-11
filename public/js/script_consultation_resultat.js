 $(document).ready(function() {
 	 var userdataTable = $('#user_data').DataTable({
                "processing": true,
                "serverSide": true,
                "order": [],
                "ajax": {
                    url: "consult_resultat_fetch.php",
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
                   // alert(numero);
                   $.ajax({
                    url:"consult_resultat_action.php",
                    method:"post",
                    dataType:"JSON",
                    data:{numero:numero,btn_action:btn_action},

                    success:function(data){
                      $('#patient_detail').html(data);
                      $('#dataModal').modal("show");
                    }

                  });  

                 });

                  $(document).on('click', '.vider', function() {
                   var btn_action = 'vider'; 
                   var ordre_arrive = $(this).attr("id");
                   if(confirm('Etes-vous sûr de vider cet enregistrement ?')){
                     $.ajax({
                    url:"consult_resultat_action.php",
                    method:"post",
                    dataType:"JSON",
                    data:{ordre_arrive:ordre_arrive,btn_action:btn_action},

                    success:function(data){ 
                    
                       userdataTable.ajax.reload();
                      }

                  });  
                      }
                 });
   
    $(document).on('click', '.appel', function() {
             var btn_action = 'appel'; 
             var ordre_arrive = $(this).attr("id");
             
              $.ajax({
                      url:"consult_resultat_action.php",
                      method:"post",
                      dataType:"JSON",
                      data:{ordre_arrive:ordre_arrive,btn_action:btn_action},

                      success:function(data){
                         
                      },

                      error:function(){
                        alert('Error');
                      }
 
                    });  
                  });

                  $(document).on('click', '#imprimer', function() {
                  var printkon = document.getElementById("patient_detail");
                  var winkon = window.open("","","width=900,height=650");
                  winkon.document.write(printkon.outerHTML);
                  winkon.document.close();
                  winkon.focus();
                  winkon.print();
                  winkon.close();
}); 

          
            setInterval(function(){
                userdataTable.ajax.reload();
            },60000);

  });