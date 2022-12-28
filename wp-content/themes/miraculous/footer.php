<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Miraculous
 */

?>
<?php 
$miraculous_setting = '';
if(class_exists('Miraculous_setting')):
   $miraculous_setting = new Miraculous_setting();
   $miraculous_setting->miraculous_footer_setting();
endif;
?>
</div><!-- #content -->
</div><!-- #div-wrapper-style -->
<?php wp_footer(); ?>
</body>  
</html>