$( document ).ready(function() {
    
    $('form').submit(function(e) {

      $('.appriseInner button').click();
      apprise("<i><b><font color='grey'>Saving information please wait ... </font></b></i><br><br><center> <img src= '"+public_url+"admin-assets/plugins/ckeditor/skins/kama/images/spinner.gif' width='20' height='20' /></center>");
      $('.aButtons').hide();

        var form = $(this);
           $.ajax({
                    headers: (
                      'Content-type: text/html; charset=utf-8'
                     ),
                    url: form.attr("action"),
                    type: form.attr("method"),
                    data: form.serialize(), 
                    success: function(data)
                       {
                        $('.appriseInner button').click();
                        
                          if(data.success == true){
                            window.location = data.url;
                          }else{
                            $.each( data.message, function( key, value ) {
                               $('#'+key+'-error').text(value[0]);
                               $('#'+key+'-error').prev().addClass('error focused');
                            });
                          }
                       }

                });
 
         return false;
        });

    $('.noSpace').keyup(function() {
       this.value = this.value.replace(/\s/g,'');
    });


    $('input').on('focus',function(){
        $(this).parent().removeClass('error');
        $(this).parent().next().text('');
    });

        
    $('textarea').on('focus',function(){
        $(this).parent().removeClass('error');
        $(this).parent().next().text('');
    });



    $('.show-tick').on('click',function(){
      $(this).parent().removeClass('error');
      $(this).parent().removeClass('focused');
      $(this).parent().next().text('');
    });

///change status

    $('body').on('click','.status-change-function.action-tag',function(){


        var selector = $(this);
        var status =  selector.attr('data-status');
          

            var icon = "";
            if(status == 1){
                blk = 'Block';
                status = 0;
                icon = "account_circle";
            }

            if(status == 0){
                blk = 'Unblocked';
                status = 1;
                icon = "block";
            }

            if(status == 2){
                blk = 'Approve';
            }

             var msg = '<strong><font size="3" color="red"> Are you sure you want to '+blk+' '+selector.data('name')+' account? </font></strong>'
             $('.appriseInner button').click();
             apprise(msg, {'verify':true}, function(r)
             {
             if(r)
                 { 


                 loadingMsg();
                   
                var dataString = 'id='+ selector.data('id');

                $.ajax({
                    headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     },
                    url: selector.data('action'),
                    type: 'POST',
                    data: dataString, 
                    success: function(data)
                       {
                        
                        $('.appriseInner button').click();

                          if(data.success == true){

                              if(status == 1){
                                blk = 'Block User';
                              }else{
                                blk = 'Unblock User';
                              }

                                selector.attr('data-status',status);
                                selector.find("i").attr('data-original-title',blk)
                                selector.find("i").text(icon);
                                
                          }
                        
                          apprise(data.message);
                       }
                  });

                 }
              return false;
            });

        });
  
  /// destroy record


     


        $('body').on('click','.destory-function.action-tag',function(){
            var selector = $(this);

            var msg = '<strong><font size="3" color="red"> Are you sure you want to delete '+selector.data('name')+'? </font></strong>'
            // $('.appriseInner.aButtons.cancel').click();
            $('.appriseInner button').click();
            apprise(msg, {'verify':true}, function(r)
            {
            if(r)
                {

                loadingMsg();

                var dataString = 'id='+ selector.data('id');

                $.ajax({
                    headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     },
                    url: selector.data('action'),
                    type: 'POST',
                    data: dataString, 
                    success: function(data)
                       {
                        $('.appriseInner button').click();
                          if(data.success == true){

                            renderTable(data.page);

                          }
                           $('.appriseInner.aButtons.cancel').click();
                           apprise(data.message);
                       }
                });

                }
             return false;
            });
        });


      
        $.fn.security_delete = function(selector){
            var msg = '<strong><font size="3" color="red"> Are you sure you want to delete '+selector.data('name')+'? </font></strong>'
            // $('.appriseInner.aButtons.cancel').click();
            $('.appriseInner button').click();
            apprise(msg, {'verify':true}, function(r)
            {
            if(r)
                {

                loadingMsg();

                var dataString = 'id='+ selector.data('id');

                $.ajax({
                    headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     },
                    url: selector.data('action'),
                    type: 'POST',
                    data: dataString, 
                    success: function(data)
                       {
                        $('.appriseInner button').click();
                          if(data.success == true){

                            renderTable(data.page);

                          }
                           $('.appriseInner.aButtons.cancel').click();
                           apprise(data.message);
                       }
                });

                }
             return false;
            });

        };

        function renderTable(page) {
          
         // $('.table-container').html('');

          var $request = $.get(page); 

          var $container = $('.table-container');

          $container.addClass('loading'); // add loading class (optional)

          $request.done(function(data) { // success
              $container.html(data.html);
             
          });
          $request.always(function() {
              $container.removeClass('loading');
          });

          setTimeout(function() {
            reLoadTable();
          }, 1500);
      }
      
      function loadingMsg(){
            $('.appriseInner button').click();
            apprise("<i><b><font color='grey'>Saving information please wait ... </font></b></i><br><br><center> <img src= '"+public_url+"admin-assets/plugins/ckeditor/skins/kama/images/spinner.gif' width='20' height='20' /></center>");
                  $('.aButtons').hide();

      }

        function reLoadTable(){

        //reinitialize javascipt
        var docHeadObj = document.getElementsByTagName("head")[0];
        var newScript= document.createElement("script");
        newScript.type = "text/javascript";
        newScript.src = public_url+"admin-assets/js/custom-admin.js";///
        docHeadObj.appendChild(newScript);

        var docHeadObj = document.getElementsByTagName("head")[0];
        var newScript= document.createElement("script");
        newScript.type = "text/javascript";
        newScript.src = public_url+"admin-assets/plugins/jquery/jquery.min.js";///
        docHeadObj.appendChild(newScript);

        var docHeadObj = document.getElementsByTagName("head")[0];
        var newScript= document.createElement("script");
        newScript.type = "text/javascript";
        newScript.src = public_url+"admin-assets/plugins/bootstrap/js/bootstrap.js";///
        docHeadObj.appendChild(newScript);

        var docHeadObj = document.getElementsByTagName("head")[0];
        var newScript= document.createElement("script");
        newScript.type = "text/javascript";
        newScript.src = public_url+"admin-assets/plugins/jquery-datatable/jquery.dataTables.js";///
        docHeadObj.appendChild(newScript);

        var docHeadObj = document.getElementsByTagName("head")[0];
        var newScript= document.createElement("script");
        newScript.type = "text/javascript";
        newScript.src = public_url+"admin-assets/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js";///
        docHeadObj.appendChild(newScript);

        var docHeadObj = document.getElementsByTagName("head")[0];
        var newScript= document.createElement("script");
        newScript.type = "text/javascript";
        newScript.src = public_url+"admin-assets/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js";///
        docHeadObj.appendChild(newScript);

        var docHeadObj = document.getElementsByTagName("head")[0];
        var newScript= document.createElement("script");
        newScript.type = "text/javascript";
        newScript.src = public_url+"admin-assets/plugins/jquery-datatable/extensions/export/buttons.flash.min.js";///
        docHeadObj.appendChild(newScript);

        var docHeadObj = document.getElementsByTagName("head")[0];
        var newScript= document.createElement("script");
        newScript.type = "text/javascript";
        newScript.src = public_url+"admin-assets/plugins/jquery-datatable/extensions/export/jszip.min.js";///
        docHeadObj.appendChild(newScript);

        var docHeadObj = document.getElementsByTagName("head")[0];
        var newScript= document.createElement("script");
        newScript.type = "text/javascript";
        newScript.src = public_url+"admin-assets/plugins/jquery-datatable/extensions/export/pdfmake.min.js";///
        docHeadObj.appendChild(newScript);

        var docHeadObj = document.getElementsByTagName("head")[0];
        var newScript= document.createElement("script");
        newScript.type = "text/javascript";
        newScript.src = public_url+"admin-assets/plugins/jquery-datatable/extensions/export/vfs_fonts.js";///
        docHeadObj.appendChild(newScript);

        var docHeadObj = document.getElementsByTagName("head")[0];
        var newScript= document.createElement("script");
        newScript.type = "text/javascript";
        newScript.src = public_url+"admin-assets/plugins/jquery-datatable/extensions/export/buttons.html5.min.js";///
        docHeadObj.appendChild(newScript);

        var docHeadObj = document.getElementsByTagName("head")[0];
        var newScript= document.createElement("script");
        newScript.type = "text/javascript";
        newScript.src = public_url+"admin-assets/plugins/jquery-datatable/extensions/export/buttons.print.min.js";///
        docHeadObj.appendChild(newScript);

        var docHeadObj = document.getElementsByTagName("head")[0];
        var newScript= document.createElement("script");
        newScript.type = "text/javascript";
        newScript.src = public_url+"admin-assets/js/pages/tables/jquery-datatable.js";///
        docHeadObj.appendChild(newScript);

        }

});