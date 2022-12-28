(function ($) {
	"use strict";

	var extcf7_animaion_enable = extcf7_animation_info.animitation_status;
	
	extcf7_animation_status(extcf7_animaion_enable);

	$('#extcf7-animation-enable').on('change',function(){
		extcf7_animation_enable($(this).prop("checked"));
	});

	function extcf7_animation_status(animation_status){
        if('on' == animation_status){
            extcf7_animation_enable(true);   
        }else{
            extcf7_animation_enable(false);
        }
    }

    function extcf7_animation_enable(animation_enable){
        if(true == animation_enable){
            $('.extcf7-animation-time').show();
        }else{
            $('.extcf7-animation-time').hide();
        }
    }

})(jQuery);
