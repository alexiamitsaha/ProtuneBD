<?php if(!defined('FW')) die( 'Forbidden' );

$message = '';
if(!empty($atts['messages'])):
  $message = $atts['messages'];
endif;
if(isset($_GET['order'])):
  if(!empty($message)):
  ?>
  <div class="ms_heading th_messages">
      <h1><?php echo __($message,'miraculous'); ?></h1>
  </div>
  <?php 
  endif;   
endif; 