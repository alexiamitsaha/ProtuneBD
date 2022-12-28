<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Miraculous
 */
?> 
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="profile" href="https://gmpg.org/xfn/11">
 <?php wp_head();?>
</head> 
<body <?php body_class(); ?>>
<?php 
$attachment_product_sample_url = wp_get_attachment_image( 'image');
print_r($attachment_product_sample_url);
$miraculous_setting = '';
if(class_exists('Miraculous_setting')):
    if(function_exists('miraculous_font_style')):
	  miraculous_font_style();
   endif; 
   if(function_exists('miraculous_multi_color')):
	  miraculous_multi_color();
   endif;
   $miraculous_setting = new Miraculous_setting();
   $miraculous_setting->miraculous_header_setting();
   $miraculous_setting->miraculous_breadcrumbs_setting();
endif; 
$miraculouscore = ''; 
if(class_exists('Miraculouscore')):
 $miraculouscore = new Miraculouscore();
 $miraculouscore->miraculous_theme_loader();
endif;
?>