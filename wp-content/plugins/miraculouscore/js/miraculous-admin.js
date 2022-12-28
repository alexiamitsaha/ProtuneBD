jQuery(document).ready( function($){
	"use strict";	
	$(".paid").click(function() {
		var id = $(this).attr('data-productid'); 
        var formdata ='userid='+id;
        formdata += '&action=miraculous_user_payment_request';
        $.ajax({
            type: 'post',
            url: backend.ajax_url,
            data: formdata,
            success: function(response){ 
                var result = JSON.parse(response);
                if( result.status == 'true' ) {
                    window.location.replace(window.location.href);
                }
                else{
                    alert("Something went Wrong.");
                }
            }
        });
	});
	/*Uploading files*/
    var gplay_image_uploader; 
    var apple_image_uploader;
    var window_image_uploader;
     
    $('.upload_gplay_image_button').on('click',function(e) {
    e.preventDefault();
    /*If the uploader object has already been created, reopen the dialog*/
      if (gplay_image_uploader) {
      gplay_image_uploader.open();
      return;
    }
    /* Extend the wp.media object*/
    gplay_image_uploader = wp.media.frames.file_frame = wp.media({
      title: 'Choose Image',
      button: {
      text: 'Choose Image'
    },
    library: {
        type: 'image'
      },
    multiple: false });

    /* When a file is selected, grab the URL */
    gplay_image_uploader.on('select', function() {
      var attachment = gplay_image_uploader.state().get('selection').first().toJSON();
      $('.gplayimage-url').val(attachment.url);
      $('.gplay_image_url').attr('src', attachment.url);
    });
    /* Open the uploader dialog*/
    gplay_image_uploader.open();
  });
  
  $('.upload_apple_image_button').on('click',function(e) {
    e.preventDefault();
    /* If the uploader object has already been created, reopen the dialog*/
      if (apple_image_uploader) {
      apple_image_uploader.open();
      return;
    }
    /* Extend the wp.media object*/
    apple_image_uploader = wp.media.frames.file_frame = wp.media({
      title: 'Choose Image',
      button: {
      text: 'Choose Image'
    },
    library: {
        type: 'image'
      },
    multiple: false });

    /* When a file is selected, grab the URL and set it as the text field's value*/
    apple_image_uploader.on('select', function() {
      var attachment = apple_image_uploader.state().get('selection').first().toJSON();
      $('.appleimage-url').val(attachment.url);
      $('.apple_image_url').attr('src', attachment.url);
    });
    /* Open the uploader dialog*/
    apple_image_uploader.open();
  });
  
   $('.upload_window_image_button').on('click',function(e) {
    e.preventDefault();
    /* If the uploader object has already been created, reopen the dialog*/
      if (window_image_uploader) {
      window_image_uploader.open();
      return;
    }
    /* Extend the wp.media object*/
    window_image_uploader = wp.media.frames.file_frame = wp.media({
      title: 'Choose Image',
      button: {
      text: 'Choose Image'
    },
    library: {
        type: 'image'
      },
    multiple: false });

    /* When a file is selected, grab the URL and set it as the text field's value*/
    window_image_uploader.on('select', function() {
      var attachment = window_image_uploader.state().get('selection').first().toJSON();
      $('.windowimage-url').val(attachment.url);
      $('.window_image_url').attr('src', attachment.url);
    });
    /* Open the uploader dialog*/
    window_image_uploader.open();
  });
 

});