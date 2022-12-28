<?php if ( ! defined( 'FW' ) ):
	  die( 'Forbidden' );
  endif;
if(isset($atts['rev_alias'])):
      $rev_alias = $atts['rev_alias'];
endif;
if(!empty($rev_alias)):
echo '<div class="ms_rev_slider">';
  echo do_shortcode('[rev_slider alias="'.$rev_alias.'"]'); 
echo '</div>'; 
endif;
?>  