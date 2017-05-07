<?php 
function contact_form_creation(){
?>
<style type="text/css">
.contact-form-container{
width: 80% !important;
margin: auto;
}

</style>
<link rel="stylesheet" href="<?php echo plugins_url(); ?>/simple-contact-form-feedback/resources/css/bootstrap.min.css">
<script src="<?php echo plugins_url(); ?>/simple-contact-form-feedback/resources/js/jquery.min.js">
</script>
<script src="<?php echo plugins_url(); ?>/simple-contact-form-feedback/resources/js/bootstrap.min.js">
</script>
<script src="<?php echo plugins_url(); ?>/simple-contact-form-feedback/resources/js/jquery.validate.js">
</script>
<script src="<?php //echo plugins_url(); ?>/simple-contact-form-feedback/resources/js/input-form-validate.js">
</script>  
<script>
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

</script>
<div class="alert alert-dismissible alert-success" id="success">  
  
</div>
<div class="alert alert-dismissible alert-danger" id="error">
</div>

<div class="contact-form-container">
  <form class="form-horizontal" id="contact_form" action="#" method="post">
    <div class="form-group">
      <label for="inputEmail" class="col-lg-2 control-label">Full Name</label>
      <div class="col-lg-10">
        <input type="text" class="form-control" id="inputName" placeholder="Full Name" name="cformfullname">
      </div>
    </div>    
    <div class="form-group">
      <label for="inputEmail" class="col-lg-2 control-label">Email</label>
      <div class="col-lg-10">
        <input type="text" class="form-control" id="inputEmail" placeholder="Email" name="cformemail">
      </div>
    </div>
    <div class="form-group">
      <label for="inputEmail" class="col-lg-2 control-label">Phone</label>
      <div class="col-lg-10">
        <input type="text" class="form-control" id="inputPhone" placeholder="Phone" name="cformphone">
      </div>
    </div>
    <div class="form-group">
      <label for="inputEmail" class="col-lg-2 control-label">City</label>
      <div class="col-lg-10">
        <input type="text" class="form-control" id="inputcity" placeholder="City" name="cformcity">
      </div>
    </div>
    <div class="form-group">
      <label for="textArea" class="col-lg-2 control-label">Message</label>
      <div class="col-lg-10">
        <textarea class="form-control" rows="3" id="textmessage" name="cformmessage"></textarea>
        
      </div>
    </div>
    <div class="form-group">
      <div class="col-lg-10 col-lg-offset-2">
        <button type="reset" class="btn btn-default">Cancel</button>
        <button type="submit" class="btn btn-primary" id="contact-form-submit">Send</button>
      </div>
    </div>  
  </form>
</div>


<?php } ?>