
function isInputChar(evt){
  var char =  evt.which;

  if(char > 31 && char != 32 && (char<65 || char > 90)&&(char < 97 || char > 122)){
    return false;
  }
} 


function isInputNumber(evt){
  var char =   evt.which;

  if(char > 31 && char != 32 && (char<48 || char > 57)){
    return false;
  }
}

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
      url: "consult_fetch.php",
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


            
            setInterval(function(){
              userdataTable.ajax.reload();
            },20000);


         

            $(document).on('click', '.appel', function() {
             var btn_action = 'appel'; 
             var ordre = $(this).attr("id");
             // alert(''+ordre);
             $.ajax({
              url:"consult_action.php",
              method:"post",
              dataType:"JSON",
              data:{ordre:ordre,btn_action:btn_action},
              success:function(data){
                          //alert('Succes');
                        },

                        error:function(){
                          alert('Error');
                        }
                        
                        
                      }); 
           }); 


            $(document).on('click', '.examen', function() {
             var btn_action = 'examen'; 
             var ordre = $(this).attr("id");


             $.ajax({
              url:"consult_action.php",
              method:"post",
              dataType:"JSON",
              data:{ordre:ordre,btn_action:btn_action},

              success:function(data){ 
               $('#userModal').modal("show");  
               $('#ordrearrive').val(ordre);
               $('#examen').val(data.examen);
               
               
             },

             error:function(){
              alert('Error');
            }



          }); 
             
           }); 
            

            $(document).on('click', '.update', function() {
              var ordre_arrive = $(this).attr("id");
              var btn_action = 'fetch_singleUpdate';
                
                
                $.ajax({
                  url: "consult_action.php",
                  method: "POST",
                  data: {ordre_arrive: ordre_arrive, btn_action: btn_action},
                  dataType: "json",
                  success: function(data)
                  { 
                   $('#userModalUpdate').modal('show');
                       
                        $('#user_nameUpdate').val(data.nom_patient);
                        
                        $('#numjetonUpdate').val(data.num_jeton); 
                        $('#orientationUpdate').val(data.orientation);  
                        $('#ordre_arriveUpdate').val(ordre_arrive);   
                        $('.modal-title').html("<i class='fa fa-pencil-square-o'></i> Mise &#224; jour");
                      
                       $('#btn_action').val('Edit'); 
                     }
                   });  
              });


            $(document).on('submit', '#user_formUpdate', function(event) {
              event.preventDefault(); 
              $('#actionUpdate').attr('disabled', 'disabled');
              var btn_action = 'EditOrientation';
              var form_data = $(this).serialize();

              $.ajax({
                url: 'consult_action.php',
                method: "POST",
                data: form_data,
                success: function(data)
                {
                  $('#user_formUpdate')[0].reset();
                  $('#userModalUpdate').modal('hide');
                  $('#alert_action').fadeIn().html('<div class="alert alert-success">' + data + '</div>');
                  $('#actionUpdate').attr('disabled', false);
                  userdataTable.ajax.reload();
                }
              });       
              
            });
            //
            $(document).on('click', '.cloturer', function() {
             var btn_action = 'cloturer'; 
           
           var numero = $(this).attr("id");
           
           
           if(confirm('Etes-vous sûr de cloturer cette fiche ?')){
             $.ajax({
              url:"consult_action.php",
              method:"post",
              dataType:"JSON",
              data:{numero:numero,btn_action:btn_action},

              success:function(data){ 
               userdataTable.ajax.reload();                         
             },

             error:function(){
              alert('Error');
            }
            

          });  } else{

             }
             
           }); 
            $(document).on('click', '.laboratoire', function() {
             var btn_action = 'envoiLabo'; 
             var ordre = $(this).attr("id"); 
             
             if(confirm('Les examens mentionnés seront envoyé au labo')){
               $.ajax({
                url:"consult_action.php",
                method:"post",
                dataType:"JSON",
                data:{ordre:ordre,btn_action:btn_action},

                success:function(data){ 
                  userdataTable.ajax.reload();
                },

                error:function(){
                  alert('Error');
                }



              });  } else{

               }
               
             }); 

            $(document).on('submit', '#user_form', function(event) {
              event.preventDefault(); 
         
              $('#action').attr('disabled', 'disabled');
              var form_data = $(this).serialize();


              $.ajax({
                url: 'consult_action.php',
                method: "POST",
                data: form_data,
                success: function(data)
                { 
                  $('#user_form')[0].reset();
                  $('#userModal').modal('hide');
                        // $('#alert_action').fadeIn().html('<div class="alert alert-success">' + data + '</div>');
                        $('#action').attr('disabled', false);
                        userdataTable.ajax.reload();
                      }
                    });
              
            });

            
            $(document).on('click', '.consulter', function() {
              var agent_matricule = $(this).attr("id");
              var ordre_arrive = $(this).data("ordrearrive");  
              var categorie = $(this).data("categorie"); 
              var nomspatient = $(this).data("nomspatient");  
              var btn_action = 'fetch_single';
              
              $('#spanimc').fadeIn().html('');
              $('#spanpas').fadeIn().html('');
              $('#spanpad').fadeIn().html('');
              $('#spanfc').fadeIn().html('');

              
              
              $.ajax({
                url: "consult_action.php",
                method: "POST",
                data: {agent_matricule: agent_matricule,ordre_arrive:ordre_arrive,nomspatient:nomspatient,btn_action: btn_action},
                dataType: "json",
                success: function(data)
                { 
                  

                  if (  data.etat == 'New') {
                    alert('Une nouvelle consultation a été créée');
                  } else {

                    $('#consultModal').modal('show');
                        //remplissage des champs de la boite de dialogue
                        $('#spanimc').fadeIn().html(data.agent_matricule);
                        $('#agent_matricule').val(data.agent_matricule);
                        $('#agent_sexe').val(data.agent_sexe); 
                        $('#poids').val(data.poids); 
                        $('#taille').val(data.taille);
                        $('#deficiteaudition').val(data.deficiteaudition);
                        $('#otiterecidivante').val(data.otiterecidivante);
                        $('#troubleequilibre').val(data.troubleequilibre); 
                        $('#hypertensionarterielle').val(data.hypertensionarterielle);
                        $('#tuberculose').val(data.tuberculose);
                        $('#asthme').val(data.asthme);
                        $('#touxchronique').val(data.touxchronique);
                        $('#essoufflement').val(data.essoufflement);
                        $('#epilepsie').val(data.epilepsie); 
                        $('#mauxdetete').val(data.mauxdetete); 
                        $('#diminutionacuitevisuel').val(data.diminutionacuitevisuel);
                        $('#troublevision').val(data.troublevision); 
                        $('#diabete').val(data.diabete);
                        $('#familleparalysieagain').val(data.familleparalysieagain); 
                        $('#diabetefamille').val(data.diabetefamille);
                        $('#anemiessfamille').val(data.anemiessfamille);
                        $('#hypertensionfamille').val(data.hypertensionfamille); 
                        $('#troublepsychiafamille').val(data.troublepsychiafamille);
                        $('#obesitefamille').val(data.obesitefamille);
                        $('#epilepsiefamille').val(data.epilepsiefamille);
                        $('#traite_contraceptif').val(data.traite_contraceptif);
                        $('#traite_autre').val(data.traite_autre); 
                        $('#nbrecigaretteparjour').val(data.nbrecigaretteparjour); 
                        $('#pratiquedusport').val(data.pratiquedusport);
                        $('#sportpratique').val(data.sportpratique); 
                        $('#accidenttravail').val(data.accidenttravail);
                        $('#anneeaccident').val(data.anneeaccident);
                        $('#nbreheuresport').val(data.nbreheuresport); 
                        $('#buvezvouslabiere').val(data.buvezvouslabiere); 
                        $('#nbrebouteilleparsemaine').val(data.nbrebouteilleparsemaine);
                        $('#consommationcoupable').val(data.consommationcoupable); 
                        $('#besoinbaisserconsbiere').val(data.besoinbaisserconsbiere);
                        $('#consommationmatinalebiere').val(data.consommationmatinalebiere);
                        $('#critiqueconsommation').val(data.critiqueconsommation); 
                        $('#dejaopere').val(data.dejaopere);
                        $('#alergie').val(data.alergie);
                        $('#quellealergie').val(data.quellealergie);
                        $('#imc').val(data.imc);
                        $('#pas').val(data.pas);
                        $('#pad').val(data.pad);
                        $('#fc').val(data.fc);
                        $('#anomalie_clinique').val(data.anomalie_clinique);
                        $('#consulter_pour').val(data.consulter_pour);
                        $('#audition').val(data.audition);
                        $('#audiometriedroite').val(data.audiometriedroite);
                        $('#audiometriegauche').val(data.audiometriegauche);
                        $('#audiometrieconclusion').val(data.audiometrieconclusion);
                        $('#consult_opht').val(data.consult_opht);
                        $('#opht_oeildroit').val(data.opht_oeildroit);
                        $('#opht_conclusion').val(data.opht_conclusion);
                        $('#repimc').val(data.repimc);
                        $('#reppas').val(data.reppas);
                        $('#reppad').val(data.reppad);
                        $('#repfc').val(data.repfc);
                        $('#consultationfiche').val(data.consultationfiche);
                        
                        $('#dateconsultation').val(data.dateconsultation);
                        $('#numero').val(data.numero);
                        $('#btn_action').val('save'); 
                      }
                    }
                  }); 


});  
/*
* 
*
*/
$('form #taille').on('blur',function(){
  $('#spanimc').fadeIn().html('<div class="danger"></div>');
  var taille = document.getElementById("taille").value;
  var poids = document.getElementById("poids").value;
  var numero = document.getElementById("numero").value;
  var test = 'imc';
  var testvalue = 0;
  var testrepid = 'repimc';
  var testrepval = '';
  var spantest = '#spanimc';
  var btn_action = 'insert_single_integer';

var imc = 0; 

if (poids != "" && taille != "") {
  if (poids > 0 && taille > 0) {
    imc = (poids / (taille*taille))*10000;  
    imc = Math.floor(imc);
    if (imc < 16.5) {   
     $(spantest).val('Famine');
     
   } 
   else if(imc <=18.5){ 
     $(spantest).val('Maigre'); 
   }
   else if(imc <=25){ 
    $(spantest).val('Corpulense normale'); 
  }
  else if(imc <=30){ 
   $(spantest).val('Surpois'); 
 }
 else if(imc <=40){ 
   $(spantest).val('Obesite severe'); 
 }
 else if(imc >40){  
  $(spantest).val('Obesite morbide');
}

$('#imc').val(imc);

testvalue = imc; 
testrepval =  $(spantest).val(); 

                 // l appelle de cette fonction permet d enregistrer la valeur de la taille  avant 
                 // d enregistrer le imc
                 //resultTest4(obj);
                 
                 $.ajax({
                  url: "consult_action.php",
                  method: "POST",
                  data: {numero: numero, test: test, 
                    testvalue: testvalue,testrepid:testrepid,
                    testrepval:testrepval, btn_action:btn_action}, 
                    dataType:"json", 
                    success: function(data)
                    { 
                     
                     if ($(spantest).val()=='Famine') {
                       $(spantest).fadeIn().html('<div class="alert alert-warning"> IMC: ' + imc +', ' + $(spantest).val()+   '</div>');
                     } else if  ($(spantest).val()=='Corpulense normale') {
                      $(spantest).fadeIn().html('<div class="alert alert-success"> IMC: ' + imc +', ' + $(spantest).val()+   '</div>');
                    } else if($(spantest).val()=='Maigre'){
                      $(spantest).fadeIn().html('<div class="alert alert-warning"> IMC: ' + imc +', ' + $(spantest).val()+   '</div>');
                    } else if($(spantest).val()=='Surpois'){
                      $(spantest).fadeIn().html('<div class="alert alert-warning"> IMC: ' + imc +', ' + $(spantest).val()+   '</div>');
                    }else if($(spantest).val()=='Obesite severe'){
                      $(spantest).fadeIn().html('<div class="alert alert-warning"> IMC: ' + imc +', ' + $(spantest).val()+   '</div>');
                    }else if($(spantest).val()=='Obesite morbide'){
                      $(spantest).fadeIn().html('<div class="alert alert-warning"> IMC: ' + imc +', ' + $(spantest).val()+   '</div>');
                    }

                    
                  }
                })
               } else{
                 $(spantest).fadeIn().html('<div class="error"> V&#233;rifier vos champs</div>');
               }
             } else{
              $(spantest).fadeIn().html('<div class="error"> V&#233;rifier vos champs</div>'); 
            }

          });

/*
* ces methodes permettent de rendre les champs ci-dessous invibles 
* 
*/

$('form #pratiquedusport').on('change',function(){
  var rep = document.getElementById("pratiquedusport").value;
  
  if (rep ==='oui') {
    document.getElementById("sportpratique").style.display = "initial";
    document.getElementById("nbreheuresport").style.display = "initial"; 
  } else if(rep === 'non') {
    document.getElementById("sportpratique").style.display = "none";
    document.getElementById("nbreheuresport").style.display = "none";
    document.getElementById("sportpratique").value = 'rien'; 
  }
});

/*
* les champs doivent disparaitre lorsque utilisateur selection non dans ce combobox
*/
$('form #buvezvouslabiere').on('change',function(){
  var rep = document.getElementById("buvezvouslabiere").value;
  if(rep === 'non') {
    document.getElementById("nbrebouteilleparsemaine").style.display = "none";
    document.getElementById("consommationcoupable").style.display = "none";
    document.getElementById("besoinbaisserconsbiere").style.display = "none";
    document.getElementById("consommationmatinalebiere").style.display = "none";
    document.getElementById("critiqueconsommation").style.display = "none"; 
  }else if(rep === 'oui') {
    document.getElementById("nbrebouteilleparsemaine").style.display = "initial";
    document.getElementById("consommationcoupable").style.display = "initial";
    document.getElementById("besoinbaisserconsbiere").style.display = "initial";
    document.getElementById("consommationmatinalebiere").style.display = "initial";
    document.getElementById("critiqueconsommation").style.display = "initial"; 
  }
});


$('form #accidenttravail').on('change',function(){
  var rep = document.getElementById("accidenttravail").value;
  if(rep === 'non') {
    document.getElementById("anneeaccident").style.display = "none"; 
    document.getElementById("anneeaccident").value = ''; 

    
  }else if(rep === 'oui') {
    document.getElementById("anneeaccident").style.display = "initial";  
  }
});
$('form #buvezvouslabiere').on('change',function(){
  var rep = document.getElementById("buvezvouslabiere").value;

  
  if(rep === 'non') {
    document.getElementById("nbrebouteilleparsemaine").style.display = "none";
    document.getElementById("consommationcoupable").style.display = "none";
    document.getElementById("besoinbaisserconsbiere").style.display = "none";
    document.getElementById("consommationmatinalebiere").style.display = "none";
    document.getElementById("critiqueconsommation").style.display = "none"; 
  }else if(rep === 'oui') {
    document.getElementById("nbrebouteilleparsemaine").style.display = "initial";
    document.getElementById("consommationcoupable").style.display = "initial";
    document.getElementById("besoinbaisserconsbiere").style.display = "initial";
    document.getElementById("consommationmatinalebiere").style.display = "initial";
    document.getElementById("critiqueconsommation").style.display = "initial"; 
  } 
});


$('form #alergie').on('change',function(){
  var rep = document.getElementById("alergie").value;
  if(rep === 'non') {  
   document.getElementById("quellealergie").style.display = "none";
 }else if(rep === 'oui') { 
  document.getElementById("quellealergie").style.display = "initial";
}
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
              
              //  var id_membre = document.getElementById("id_membre_transfert").value;
              var fk_matricule_agent = document.getElementById("fkmatricule_agent_transfert").value;  
              
              var id_centre = document.getElementById("code_centre_tranfert").value;
              var categorie = document.getElementById("categorie_patient").value;
              var renseignement = document.getElementById("renseignement_clinique").value;
              var specialite_centre = document.getElementById("specialite_centre").value; 
              var btn_action = 'transfert_membre';
                 // envoi les coordonnees d un membre

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
                        window.open(this.href = "certificat.php?Matricule="+fk_matricule_agent+"&id_centre="+id_centre+"&specialite_centre="+specialite_centre+"&motif_envoi="+motif_envoi+"&categorie_patient="+categorie+"&renseignement="+renseignement,'blank');

                      }
                    });
                   
                 } else {
                  alert('Error');
                }             
                
              });

            $(document).on('click', '.certificataptitude', function() {
              var btn_action = 'afficher'; 
              var numero = $(this).attr("id");
              var categorie = $(this).data('categoriepatient');  
                   // window.location.href = "certificat.php?numero="+numero;

                    window.open(this.href =  "certificat.php?numero="+numero+"&categorie="+categorie+"&etat=APTE",'blank');
                   
                 });  
            $(document).on('click', '.certificatinaptitude', function() {
             var btn_action = 'afficher'; 
             var numero = $(this).attr("id");
             var categorie = $(this).data('categoriepatient');  
             
            window.open(this.href =  "certificat.php?numero="+numero+"&categorie="+categorie+"&etat=INAPTE",'blank');
             
           });  





          }); 


function resultTest2(obj,valInf,valSup)
{ 
 
  var test = obj.id;
  var testvalue  = document.getElementById(obj.id).value; 
  var testrepid = 'rep' + obj.id;
  var inputrep = '#'+testrepid;
  var testrepval = '';
  var spantest = '#span' + obj.id;
  
  var numero = document.getElementById("numero").value;
  
  var btn_action = 'insert_single';

  if (testvalue != "") {

    if (testvalue >= 0) {
      if (testvalue >= valInf && testvalue <= valSup) {
       $(spantest).val('Bon');  

     } else if(testvalue > valSup)  {   
      switch(test)
      {
        case 'fc':
        $(spantest).val('Tachicardie');  
        break;

        default:
        $(spantest).val('Hypertension');  
        break;
      }
      

    } else if(testvalue < valInf){  
      switch(test)
      {
       case 'fc':
       $(spantest).val('Brodycardie');  
       break;

       default :
       $(spantest).val('Hypotension');  
       break;

     }
     
   }

   
   
   testrepval = $(spantest).val();
   $(inputrep).val(testrepval);

   $.ajax({
    url: "consult_action.php",
    method: "POST",
    data: {numero: numero, test: test, 
      testvalue: testvalue,testrepid:testrepid,
      testrepval:testrepval, btn_action:btn_action}, 
      dataType:"json", 
      success: function(data)
      { 
        if ($(spantest).val() == 'Bon') {
          $(spantest).fadeIn().html('<div class="alert alert-success">' + $(spantest).val() + '</div>');
        } else {
          $(spantest).fadeIn().html('<div class="alert alert-danger">' + $(spantest).val() + '</div>');
        }
        
      }
    })


 } else{$(spantest).fadeIn().html('<div class="error"> Saisissez un nombre </div>');}
} else{$(spantest).fadeIn().html('<div class="error"> Saisir une valeur </div>');}

}


function resultTest4(obj)
{ 
 
  var test = obj.id;
  var testvalue  = document.getElementById(obj.id).value; 
  var numero = document.getElementById("numero").value;
  var spantest = '#span' + obj.id;
    //alert(test + ' :' + testvalue);
    var btn_action = 'insert_single_value_only';

    if (test != "") { 

     $.ajax({

      url: "consult_action.php",
      method: "POST",
      data: {numero: numero, test: test, 
        testvalue: testvalue, btn_action:btn_action}, 
        dataType:"json", 
        success: function(data)
        { 
          $(spantest).fadeIn().html('<div></div>');
        }
      })

     
   } else{$(spantest).fadeIn().html('<div class="error"> Saisir une valeur </div>');}
   
 }



function resultTestAudiiometrie(obj, valInf, valSup)
{ 
 
  var test = obj.id;
  var testvalue  = document.getElementById(obj.id).value; 
  var numero = document.getElementById("numero").value;
  var testrepid = 'rep' + obj.id;
  var inputrep = '#'+testrepid;
  var testrepval = '';
  var spantest = '#span' + obj.id;
    //alert(test + ' :' + testvalue);
    var btn_action = 'insert_single_integer';

    if (test != "") { 

      if (testvalue >= valInf && testvalue <= valSup) {

        $(spantest).val('Bon');  
      } else if(testvalue < valInf){
        $(spantest).val('Hypoacousie');
      } else if(testvalue > valSup){
       $(spantest).val('Hyperacousie');
     }

     testrepval = $(spantest).val();
     $.ajax({

      url: "consult_action.php",
      method: "POST",
      data: {numero: numero, test: test,testvalue: testvalue, btn_action:btn_action, testrepid:testrepid, testrepval:testrepval}, 
      dataType:"json", 
      success: function(data)
      { 
       if ($(spantest).val() == 'Bon') {
        $(spantest).fadeIn().html('<div class="alert alert-success">' + $(spantest).val() + '</div>');
      } else {
        $(spantest).fadeIn().html('<div class="alert alert-danger">' + $(spantest).val() + '</div>');
      }
    }
  });

     
   } else{$(spantest).fadeIn().html('<div class="error"> Saisir une valeur </div>');}
   
 }


function resultTestOphtamologie(obj, valInf, valSup)
{ 
 
  var test = obj.id;
  var testvalue  = document.getElementById(obj.id).value; 
  var numero = document.getElementById("numero").value;
  var testrepid = 'rep' + obj.id;
  var inputrep = '#'+testrepid;
  var testrepval = '';
  var spantest = '#span' + obj.id;
    //alert(test + ' :' + testvalue);
    var btn_action = 'insert_single_integer';

    if (test != "") { 

      if (testvalue >= valInf && testvalue <= valSup) {

        $(spantest).val('Vision normale');  
      } else if(testvalue < valInf){
        $(spantest).val('Hypovision');
      } else if(testvalue > valSup){
       $(spantest).val('Hypervision');
     }

     testrepval = $(spantest).val();
     $.ajax({

      url: "consult_action.php",
      method: "POST",
      data: {numero: numero, test: test,testvalue: testvalue, btn_action:btn_action, testrepid:testrepid, testrepval:testrepval}, 
      dataType:"json", 
      success: function(data)
      { 
        if ($(spantest).val() === 'Vision normale') {
          $(spantest).fadeIn().html('<div class="alert alert-success">' + $(spantest).val() + '</div>');
        } else if ($(spantest).val() === 'Hypovision') {
         $(spantest).fadeIn().html('<div class="alert alert-warning">' + $(spantest).val() + '</div>');
         
       } else if($(spantest).val() === 'Hypervision'){
        $(spantest).fadeIn().html('<div class="alert alert-danger">' + $(spantest).val() + '</div>');
        
        
      }
    }
  });

     
   } else{$(spantest).fadeIn().html('<div class="error"> Saisir une valeur </div>');}
   
 }
 
 

function resultTest5(obj)
{ 
 
  var test = obj.id;
  var testvalue  = document.getElementById(obj.id).value; 
  var numero = document.getElementById("numero").value;
  var spantest = '#span' + obj.id;
    //alert(test + ' :' + testvalue);
    var btn_action = 'insert_single_value_only';
    $.ajax({

      url: "consult_action.php",
      method: "POST",
      data: {numero: numero, test: test, 
        testvalue: testvalue, btn_action:btn_action}, 
        dataType:"json", 
        success: function(data)
        { 
          
         if (testvalue ==='oui') {
          $(spantest).fadeIn().html('<div class="alert alert-danger">Suspicition</div>');
        }
        if (testvalue ==='non') {
          $(spantest).fadeIn().html('<div class="alert alert-success">Normal</div>');
          
        } 
        if (testvalue ==='') {
          $(spantest).fadeIn().html('');
          
        }  
      }

    }); 
  }

$(document).on('click', '#consulterminer', function() {
 location.reload();
});