/*------------------------------------------------------------------
Project:    Retrica
Author:     Frank John
Version:    1.0
-------------------------------------------------------------------*/


/**
 * Contact form
 */

$(document).ready(function(e) {
  $('#form_sendemail').submit(function(e) {
    $.ajax({
      url: 'basistadesign.pl/mail/sendmail.php',
      type: 'POST',
      data: $(this).serialize(),
      dataType: 'json',
      beforeSend: function (XMLHttpRequest) {
        //
        $('.contact__form').fadeTo("slow", 0.33);
        $('#form_sendemail .has-error').removeClass('has-error');
        $('#form_sendemail .help-block').html('');
        $('#form_message').removeClass('alert-success').html('');
      },
      success: function( json, textStatus ) {
        if( json.error ) {
          // Error messages
          if( json.error.name ) {
            $('#form_sendemail input[name="name"]').parent().addClass('has-error');
            $('#form_sendemail input[name="name"]').next('.help-block').html( json.error.name );
          }
          if( json.error.email ) {
            $('#form_sendemail input[name="email"]').parent().addClass('has-error');
            $('#form_sendemail input[name="email"]').next('.help-block').html( json.error.email );
          }
          if( json.error.message ) {
            $('#form_sendemail textarea[name="message"]').parent().addClass('has-error');
            $('#form_sendemail textarea[name="message"]').next('.help-block').html( json.error.message );
          }
        }
        // Refresh Captcha
        //
        if( json.success ) {
          $('#form_message').addClass('alert-success').html( json.success );
          setTimeout(function(){
             $('#form_message').removeClass('alert-success').html('');
          },4000);
        }
        
      },
      complete: function( XMLHttpRequest, textStatus ) {
        //
        $('.contact__form').fadeTo("fast", 1);
      }
    });
    
    return false;
  });
});