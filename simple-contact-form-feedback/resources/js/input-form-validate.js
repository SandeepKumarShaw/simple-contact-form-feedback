jQuery.noConflict();
jQuery(document).ready(function() {
  jQuery(".alert-danger").hide();
  jQuery(".alert-success").hide();
  jQuery("#contact-form-submit").click(function(){
          var name    = jQuery("#inputName").val();
          var email   = jQuery("#inputEmail").val();
          var phone   = jQuery("#inputPhone").val();
          var city    = jQuery("#inputcity").val();
          var message = jQuery("#textmessage").val();

  jQuery('#contact_form').validate({
        rules: {
            cformfullname: {
                required: true                
            },
            cformemail: {
                required: true,
                email: true
            },
            cformphone: {
                required: true,
                minlength:10,
                maxlength:10,
                number: true
            },
            cformcity: {
                required: true
            },
            cformmessage: {
                required: true
            }
        },
        messages: {
            cformfullname: {
                required: "Please enter your full name."
            },
            cformemail: {
                required: "Please enter your email id.",
                email   : "Please enter a valid email id." 
            },
            cformphone: {
                required: "Please enter your Phone No.",
                minlength: "Please enter a Valid Phone No.",
                maxlength: "Please enter a Valid Phone No.",
                number: "Please enter a Valid Phone No."
                
            },
            cformcity: {
                required: "Please enter your City name."
            },
            cformmessage: {
                required: "Please enter messages."
            }
        },
        errorElement: "em",
        errorPlacement: function ( error, element ) {
          // Add the `help-block` class to the error element
          error.addClass( "help-block" );

          if ( element.prop( "type" ) === "text" ) {
            error.insertAfter( element );
          }
          else{
            error.insertAfter( element.parent( "label" ) );
            
          } 
        },
        submitHandler: function(data) {
        jQuery.ajax({
        type: "POST",
         url: "<?php echo plugins_url(); ?>/simple-contact-form-feedback/short-code/insert_mail.php",
        data: {cformfullname:name,cformemail:email,cformphone:phone,
               cformcity:city,cformmessage:message},
        cache:false,
        dataType: "html",
                success: function(data) {
                 // alert(data);
                    jQuery(".alert-success").show();
                    jQuery('#success').append(data);                 setTimeout(function(){
                    location.reload(); 
                    }, 5000); 
                },
                error: function(data){
                  jQuery(".alert-danger").show();
                  jQuery('#error').append(data);
                  setTimeout(function(){
                    location.reload(); 
                    }, 5000);  
                }
            });         
            
        },
        highlight: function ( element, errorClass, validClass ) {
          jQuery( element ).parents( ".col-lg-10" ).addClass( "has-error" ).removeClass( "has-success" );
        },
        unhighlight: function (element, errorClass, validClass) {
          jQuery( element ).parents( ".col-lg-10" ).addClass( "has-success" ).removeClass( "has-error" );
        
        }
   });
 });
});
