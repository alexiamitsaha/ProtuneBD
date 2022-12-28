/**
 * Javascript number validation function
 */
function validate_num(evt) {
    var theEvent = evt || window.event;
    // Handle paste
    if (theEvent.type === 'paste') {
        key = event.clipboardData.getData('text/plain');
    } else {
        // Handle key press
        var key = theEvent.keyCode || theEvent.which;
        key = String.fromCharCode(key);
    }
    var regex = /[0-9]|\./;
    if (!regex.test(key)) {
        theEvent.returnValue = false;
        if (theEvent.preventDefault) theEvent.preventDefault();
    }
}

 /**
    * User Track Update jQuery Function
 */
 (function($) {
    "use strict";
 /**
    * User Track Update jQuery Function
 */	
 
 
     $("#update_music_form").on('submit', function(e) {
        e.preventDefault();

        var aduio_id = $("#audio_id").val();
        var mp3_file = $("#up_track_mp3").val();
        var full_track = $("#up_full_track_data").val();
        var track_name = $("#up_track_name").val();
        var artists_name = $("#up_artists_name").val();
        var language_id = '5';//$("#up_language_id").val();
        var privacy = $("#up_privacy_name").val();
        var image = $("#up_image_file").val();
        var attachimage_id = $("#up_image_file_id").val();
        var up_track_mp3_id = $("#up_track_mp3_id").val();
        var track_price = $("#track_price").val();
        var track_lyrics = $("#track_lyrics").val();
        var track_types = $('#track_types').val();
        if (track_types == 'free') {

            track_price = 0;

        } else {

            if (track_price == '') {
                toastr.error('Please Enter Track Price.');
                return;
            }

        }
        if (track_lyrics == '') {
            toastr.error('Please Enter description or lyrics.');
            return;
        }

        /*if(mp3_file == '' ){
           toastr.error('Please upload mp3 file.');
           return;
        }*/

        if (track_name == '') {
            toastr.error('Please enter track name.');
            return;
        }
  
        /*if(artists_name == '' ){
           toastr.error('Please enter artist name.');
           return;
        }*/

        if (image == '') {
            toastr.error('Please upload music image.');
            return;
        }
        $("#upload_submit").hide();
        $(".hst_loader").show();

        var formdata = 'aduio_id=' + aduio_id + '&mp3_url=' + mp3_file + '&track_mp3_id=' + up_track_mp3_id + '&full_track=' + full_track + '&track_name=' + track_name + '&artists_name=' + artists_name + '&language_id=' + language_id + '&privacy=' + privacy + '&music_image=' + image + '&attachimage_id=' + attachimage_id + '&track_price=' + track_price + '&track_lyrics=' + track_lyrics + '&track_types=' + track_types;

        formdata += '&action=miraculous_user_track_update';

        $.ajax({
            type: 'post',
            url: frontadminajax.ajax_url,
            data: formdata,
            success: function(response) {
                var result = JSON.parse(response);
                if (result.status == 'true') {
                    if (result.track_page != '') {
                        window.location.href = result.track_page;
                    }
                    toastr.success(result.msg);
                } else {
                    toastr.error(result.msg);
                }
                $(".hst_loader").hide();
                $("#upload_submit").show();
            }
        });
    });

       /**
     * upload album
     */

    $("#upload_album_forms").on('submit', function(e) {
        e.preventDefault();

        var albumtitle = $("#albumtitle").val();
        var albumdscription = $("#albumdscription").val();
        var languages = $("#language").val();
        var album_price = $("#album_price").val();
        var album_tracks = $("#album_tracks").val();
        var image = $("#up_image_file").val();
        var attachimage_id = $("#up_image_file_id").val();
        var track_types = $('#album_types').val(); 
 
        if (albumtitle == '') {
            toastr.error('Please Enter Album Title.');
            return;
        }
        if (albumdscription == '') {
            toastr.error('Please Enter Album Description.');
            return;
        }
        if (languages == '') {
            toastr.error('Please select Languages.');
            return;
        }
        if (track_types == 'free') {
            album_price = 0;
        } else {
            if (album_price == '') {
                toastr.error('Please Enter Album Price.');
                return;
            }
        }
        if (album_tracks == '') {
            toastr.error('Please select Album Track.');
            return;
        }
        if (image == '') {
            toastr.error('Please upload music image.');
            return;
        }

        $("#upload_submit").hide();
        $(".hst_loader").show();

        var formdata = 'albumtitle=' + albumtitle + '&albumdscription=' + albumdscription + '&languages=' + languages + '&album_price=' + album_price + '&album_tracks=' + album_tracks + '&music_image=' + image + '&attachimage_id=' + attachimage_id + '&track_types=' + track_types;
        formdata += '&action=miraculous_user_ablummusic_upload';
 
        $.ajax({
            type: 'post',
            url: frontadminajax.ajax_url,
            data: formdata,
            success: function(response) {
               // console.log(response);

                var result = JSON.parse(response);

                if (result.status == 'true') {

                    $("#upload_album_forms")[0].reset();



                    if (result.track_page != '') {
                        window.location.href = result.track_page;
                    }
                    toastr.success(result.msg);
                } else {
                    toastr.error(result.msg);
                }

                $(".hst_loader").hide();
                $("#upload_submit").show();
      

            }
        });

    });
    /**
     * alubm update
     */
     
    $("#update_album_forms").on('submit', function(e) {
        e.preventDefault();
        var albums_id = $("#albums_id").val();
        var albumtitle = $("#albumtitle").val();
        var albumdscription = $("#albumdscription").val();
        var languages = 5; //$("#language").val();
        var album_price = $("#album_price").val();
        var album_tracks = $("#album_tracks").val();
        var image = $("#up_image_file").val();
        var attachimage_id = $("#up_image_file_id").val();
        var track_types = $('#album_types').val();
        if (albumtitle == '') {
            toastr.error('Please Enter Album Title.');
            return;
        }
        if (albumdscription == '') {
            toastr.error('Please Enter Album Description.');
            return;
        }
        if (languages == '') {
            toastr.error('Please select Languages.');
            return;
        }
        if (track_types == 'free') {
            album_price = 0;
        } else {
            if (album_price == '') {
                toastr.error('Please Enter Album Price.');
                return;
            } 
        }
        if (album_tracks == '') {
            toastr.error('Please select Album Track.');
            return;
        }
        if (image == '') {
            toastr.error('Please upload music image.');
            return;
        }
        $("#upload_submit").hide();
        $(".hst_loader").show();

        var formdata = 'albums_id=' + albums_id + '&albumtitle=' + albumtitle + '&albumdscription=' + albumdscription + '&languages=' + languages + '&album_price=' + album_price + '&album_tracks=' + album_tracks + '&music_image=' + image + '&attachimage_id=' + attachimage_id + '&track_types=' + track_types;
        formdata += '&action=miraculous_user_ablummusic_update';

        $.ajax({
            type: 'post',
            url: frontadminajax.ajax_url,
            data: formdata,
            success: function(response) {
           // console.log(response);
              var result = JSON.parse(response);

                if (result.status == 'true') {

                    if (result.track_page != '') {
                        window.location.href = result.track_page;
                    }
                    toastr.success(result.msg);
                } else {
                    toastr.error(result.msg);
                }

                $(".hst_loader").hide();
                $("#upload_submit").show();
            }
        });

    });
    
    /**
    * monthly yearly priceplan
    */
    $("input[name$='plantype']").click(function() {
        var plantype = $(this).val();
        //console.log(plantype);
        if(plantype == 'yearly'){
            $(".monthly_price").hide();
            $(".yearly_price").show();
            $(".mira_monthly_plans").hide();
            $(".mira_yearly_plans").show();
        }
        if(plantype == 'monthly'){
            $(".monthly_price").show();
            $(".yearly_price").hide();
            $(".mira_monthly_plans").show();
            $(".mira_yearly_plans").hide();
        }
        $('.itemplan').val(plantype);
    }); 
    $( document ).ready(function() {
        $(".monthly_price").show();
        $(".yearly_price").hide();
        $(".mira_monthly_plans").show();
        $(".mira_yearly_plans").hide();
    });
  
})(jQuery);