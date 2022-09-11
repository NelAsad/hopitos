
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
            url: "labo_termine_fetch.php",
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


                 
                  $(document).on('click', '.completer', function() {
                    var numero = $(this).attr("id");
                    var btn_action = 'fetch_single'; 

                  
                    $.ajax({
                      url: "labo_action.php",
                      method: "POST",
                      data: {numero: numero, btn_action: btn_action},
                      dataType: "json",
                      success: function(data)
                      { 
                        $('#consultModal').modal('show');
                             
                              $('#numero').val(data.numero);  
                              $('#agent_sexe').val(data.agent_sexe);
                              $('#hb').val(data.hb);
                              $('#ge').val(data.ge);
                              $('#wbc').val(data.wbc);
                              $('#b').val(data.b);
                              $('#e').val(data.e);
                              $('#l').val(data.l);
                              $('#m').val(data.m);
                              $('#n').val(data.n);
                              $('#vs').val(data.vs);
                              $('#mcv').val(data.mcv);
                              $('#glycemie').val(data.glycemie);
                              $('#got').val(data.got);
                              $('#wbc').val(data.wbc);
                              $('#gpt').val(data.gpt);
                              $('#ggt').val(data.ggt);
                              $('#ac_ur').val(data.ac_ur);
                              $('#chol').val(data.chol);
                              $('#creatinine').val(data.creatinine);
                              $('#urines').val(data.urines);
                              $('#vih').val(data.vih);
                              $('#conclusion').val(data.conclusion);
                              $('#btn_action').val('edit'); 
                            }
                          })
                  });  
                  $(document).on('click', '.afficher', function() {
                   var btn_action = 'afficher'; 
                   var numero = $(this).attr("id");

                   $.ajax({
                    url:"labo_action.php",
                    method:"post",
                    dataType:"JSON",
                    data:{numero:numero,btn_action:btn_action},

                    success:function(data){
                      $('#employee_detail').html(data);
                      $('#dataModal').modal("show");
                    }

                  }); 

                 });  
                });  

        $(document).on('click', '#laboterminer', function() {
        location.reload();
        });

        $(document).on('click', '#imprimer', function() {
        var printkon = document.getElementById("employee_detail");
        var winkon = window.open("","","width=900,height=650");
        winkon.document.write(printkon.outerHTML);
        winkon.document.close();
        winkon.focus();
        winkon.print();
        winkon.close();
        }); 
        

        function resultTest(obj,valInfH,valSupH,valInfF,valSupF)
        { 

        var test = obj.id;
        var testvalue  = document.getElementById(obj.id).value; 
        var testrepid = 'rep' + obj.id;
        var inputrep = '#'+testrepid;
        var testrepval = '';
        var spantest = '#span' + obj.id;

        var sexe = document.getElementById("agent_sexe").value;
        var numero = document.getElementById("numero").value;


        var btn_action = 'insert_single';

        if (testvalue != '') { 


          testrepval = $(spantest).val();
          $(inputrep).val(testrepval);

          $.ajax({
            url: "labo_action.php",
            method: "POST",
            data: {numero: numero, test: test, 
              testvalue: testvalue,testrepid:testrepid,
              testrepval:testrepval, btn_action:btn_action}, 
              dataType:"json", 
              success: function(data)
              { 

                switch(sexe)
                {
                  case 'M':
                  if (testvalue >= valInfH && testvalue <= valSupH) 
                  {  

                    $(spantest).fadeIn().html('<div class="alert alert-success"> BON </div>');
                  } else { 
                    $(spantest).fadeIn().html('<div class="alert alert-danger"> Mauvais </div>');

                  }

                  break;

                  case 'F':
                  if (testvalue >= valInfF && testvalue <= valSupF) 
                  {  

                   $(spantest).fadeIn().html('<div class="alert alert-success"> BON </div>');

                 } else {  

                  $(spantest).fadeIn().html('<div class="alert alert-danger"> Mauvais </div>');  }
                  break;

                  default :
                  $(spantest).fadeIn().html('<div class="alert alert-warning"> Pas d&#180;appreciation</div>');
                  break;
                } 
              },

              error: function(){
                $(spantest).fadeIn().html('<div class="alert alert-warning"> Pas d&#180;info !</div>');
              } 
            });

        } else{$(spantest).fadeIn().html('<div class="alert alert-danger"> Saisir une valeur </div>');}

        }


        
        function resultTestHB(obj,valInfH,valSupH,valInfF,valSupF)
        { 

        var test = obj.id;
        var testvalue  = document.getElementById(obj.id).value; 
        var testrepid = 'rep' + obj.id;
        var inputrep = '#'+testrepid;
        var testrepval = '';
        var spantest = '#span' + obj.id;

        var sexe = document.getElementById("agent_sexe").value;
        var numero = document.getElementById("numero").value;


        var btn_action = 'insert_single';

        if (testvalue != '') { 



         $(inputrep).val(testrepval);


         switch(sexe)
         {
          case 'M':
          if (testvalue >= valInfH && testvalue <= valSupH) 
          {  

            $(spantest).val('Bon');
          } else { 

            if (testvalue > valSupH) { $(spantest).val('Hyperglobulie');  }
            else if (testvalue < valInfH){ $(spantest).val('Anemie');}

          }

          break;

          case 'F':
          if (testvalue >= valInfF && testvalue <= valSupF) 
          {  
            $(spantest).val('Bon'); 

          } else {  

           if (testvalue > valSupF) {    $(spantest).val('Hyperglobulie'); }
           else if (testvalue < valInfF){ $(spantest).val('Anemie');  }
         }
         break;

         default :
         $(spantest).val('Pas d&#180;appreciation'); 
         break;
        } 
        testrepval = $(spantest).val();
        $.ajax({
        url: "labo_action.php",
        method: "POST",
        data: {numero: numero, test: test, 
          testvalue: testvalue,testrepid:testrepid,
          testrepval:testrepval, btn_action:btn_action}, 
          dataType:"json", 
          success: function(data)
          { 
            if ($(spantest).val() == 'Bon') {
              $(spantest).fadeIn().html('<div class="alert alert-success"> Bon </div>');
            } else if ($(spantest).val() == 'Hyperglobulie'){
             $(spantest).fadeIn().html('<div class="alert alert-warning"> Hyperglobulie </div>');
           } else if ($(spantest).val() == 'Anemie'){
             $(spantest).fadeIn().html('<div class="alert alert-danger"> Anemie </div>');
           } else {
            $(spantest).fadeIn().html('<div class="alert alert-danger"> Pas d&#180;appreciation </div>');
          }
        },

        error: function(){
          $(spantest).fadeIn().html('<div class="alert alert-warning"> Pas d&#180;info !</div>');
        } 
        });

        } else{$(spantest).fadeIn().html('<div class="alert alert-danger"> Saisir une valeur </div>');}

        }


        
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

        if (testvalue != '') { 

          if (testvalue >= valInf && testvalue <= valSup) {
           $(spantest).val('Bon');  
         } else {   
          $(spantest).val('Mauvais'); 
        } 


           testrepval = $(spantest).val();
           $(inputrep).val(testrepval);

           $.ajax({
            url: "labo_action.php",
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

         } else{$(spantest).fadeIn().html('<div class="alert alert-danger"> Saisir une valeur </div>');}

        }

function resultTestTwo(obj,valInf,valSup, messageHypo, messageHyper)
        { 

        var test = obj.id;
        var testvalue  = document.getElementById(obj.id).value; 
        var testrepid = 'rep' + obj.id;
        var inputrep = '#'+testrepid;
        var testrepval = '';
        var spantest = '#span' + obj.id;

        var numero = document.getElementById("numero").value;

        var btn_action = 'insert_single';

        if (testvalue != '') { 

          if (testvalue >= valInf && testvalue <= valSup) {
           $(spantest).val('Bon');  
         } else if(testvalue  < valInf) {   
          $(spantest).val(messageHypo); 
        }else if(testvalue  > valSup) {   
          $(spantest).val(messageHyper); }


           testrepval = $(spantest).val();
           $(inputrep).val(testrepval);

           $.ajax({
            url: "labo_action.php",
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

         } else{$(spantest).fadeIn().html('<div class="alert alert-danger"> Saisir une valeur </div>');}

        }

        function resultTestGE(obj,valTest)
        { 

        var test = obj.id;
        var testvalue  = document.getElementById(obj.id).value; 
        var testrepid = 'rep' + obj.id;
        var inputrep = '#'+testrepid;
        var testrepval = '';
        var spantest = '#span' + obj.id;

        var sexe = document.getElementById("agent_sexe").value;
        var numero = document.getElementById("numero").value;


        var btn_action = 'insert_single';

        if (testvalue != '') {  
         if (testvalue == valTest) 
          {  $(spantest).val('Bon');  
        } else if(testvalue > valTest) {  
        $(spantest).val('Tropho/Malaria'); }
        else if(testvalue < valTest) {  
         $(spantest).val('Mauvais'); }


         testrepval = $(spantest).val();
         $(inputrep).val(testrepval);

         $.ajax({
          url: "labo_action.php",
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
            } }

          })


        } else{$(spantest).fadeIn().html('<div class="alert alert-danger"> Saisir une valeur </div>');}

        }

      
         function resultTestTree(obj,valTest)
        { 

        var test = obj.id;
        var testvalue  = document.getElementById(obj.id).value; 
        var testrepid = 'rep' + obj.id;
        var inputrep = '#'+testrepid;
        var testrepval = '';
        var spantest = '#span' + obj.id;

        var sexe = document.getElementById("agent_sexe").value;
        var numero = document.getElementById("numero").value;


        var btn_action = 'insert_single';

        if (testvalue != '') {  
         if (testvalue <= valTest) 
          {  $(spantest).val('Bon');  
        } else  {  
        $(spantest).val('Mauvais'); }
     

         testrepval = $(spantest).val();
         $(inputrep).val(testrepval);

         $.ajax({
          url: "labo_action.php",
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
            } }

          })


        } else{$(spantest).fadeIn().html('<div class="alert alert-danger"> Saisir une valeur </div>');}

        }

       

        function resultTestFive(obj,valTest)
        { 

        var test = obj.id;
        var testvalue  = document.getElementById(obj.id).value; 
        var testrepid = 'rep' + obj.id;
        var inputrep = '#'+testrepid;
        var testrepval = '';
        var spantest = '#span' + obj.id;

        var sexe = document.getElementById("agent_sexe").value;
        var numero = document.getElementById("numero").value;


        var btn_action = 'insert_single';

        if (testvalue != '') {  
         if (testvalue < valTest) 
          {  $(spantest).val('Bon');  
        } else{$(spantest).val('Mauvais'); }
     

         testrepval = $(spantest).val();
         $(inputrep).val(testrepval);

         $.ajax({
          url: "labo_action.php",
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
            } }

          })


        } else{$(spantest).fadeIn().html('<div class="alert alert-danger"> Saisir une valeur </div>');}

        }

       
        function resultTestFour(obj,valTest,message)
        { 

        var test = obj.id;
        var testvalue  = document.getElementById(obj.id).value; 
        var testrepid = 'rep' + obj.id;
        var inputrep = '#'+testrepid;
        var testrepval = '';
        var spantest = '#span' + obj.id;

        var numero = document.getElementById("numero").value;

        var btn_action = 'insert_single';

        if (testvalue != '') { 

          if (testvalue <= valTest) {
           $(spantest).val('Bon');  
         } else if(testvalue > valTest) {   
          $(spantest).val(message); 
        } 


           testrepval = $(spantest).val();
           $(inputrep).val(testrepval);

           $.ajax({
            url: "labo_action.php",
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

         } else{$(spantest).fadeIn().html('<div class="alert alert-danger"> Saisir une valeur </div>');}

        }
        
        function resultTest4(obj)
        { 

        var test = obj.id;
        var testvalue  = document.getElementById(obj.id).value; 
        var numero = document.getElementById("numero").value;
        var spantest = '#span' + obj.id;

        var btn_action = 'insert_single_value_only';

        if (testvalue != '') { 

         $.ajax({
          url: "labo_action.php",
          method: "POST",
          data: {numero: numero, test: test, 
            testvalue: testvalue, btn_action:btn_action}, 
            dataType:"json", 
            success: function(data)
            { 
             $(spantest).fadeIn().html('<div></div>');
           }
         })


        } else{$(spantest).fadeIn().html('<div class="alert alert-danger"> Saisir une valeur </div>');}

        }



      
        function resultTestVS(obj,valInfH,valSupH,valInfF,valSupF)
        { 

        var test = obj.id;
        var testvalue  = document.getElementById(obj.id).value; 
        var testrepid = 'rep' + obj.id;
        var inputrep = '#'+testrepid;
        var testrepval = '';
        var spantest = '#span' + obj.id;

        var sexe = document.getElementById("agent_sexe").value;
        var numero = document.getElementById("numero").value;


        var btn_action = 'insert_single';

        if (testvalue != '') { 



         $(inputrep).val(testrepval);


         switch(sexe)
         {
          case 'M':
          if (testvalue >= valInfH && testvalue <= valSupH) 
          {  

            $(spantest).val('Bon');
          } else { 
             $(spantest).val('Mauvais');
             

          }

          break;

          case 'F':
          if (testvalue >= valInfF && testvalue <= valSupF) 
          {  
            $(spantest).val('Bon'); 

          } else {  
            $(spantest).val('Mauvais'); 
         }
         break;

         default :
         $(spantest).val('Pas d&#180;appreciation'); 
         break;
        } 
        testrepval = $(spantest).val();

        
        $.ajax({
        url: "labo_action.php",
        method: "POST",
        data: {numero: numero, test: test, 
          testvalue: testvalue,testrepid:testrepid,
          testrepval:testrepval, btn_action:btn_action}, 
          dataType:"json", 
          success: function(data)
          { 
            if ($(spantest).val() == 'Bon') {
              $(spantest).fadeIn().html('<div class="alert alert-success"> Bon </div>');
            } else {
              $(spantest).fadeIn().html('<div class="alert alert-danger"> Mauvais </div>');
           }  
        },

        error: function(){
          $(spantest).fadeIn().html('<div class="alert alert-warning"> Pas d&#180;info !</div>');
        } 
        });

        } else{$(spantest).fadeIn().html('<div class="alert alert-danger"> Saisir une valeur </div>');}

        }
