<?php if (!defined('FW')) die('Forbidden');

$upload_heading_one = '';
if(!empty($atts['upload_heading'])):
  $upload_heading_one = $atts['upload_heading'];
endif; 

$miraculous_theme_data = '';
if (function_exists('fw_get_db_settings_option')):  
    $miraculous_theme_data = fw_get_db_settings_option();     
endif;

$currency = '';
if(!empty($miraculous_theme_data['currency'])):
    $currency = $miraculous_theme_data['currency'];
endif;

$user_id = get_current_user_id();
if($user_id):  

$albums_id = '';   
if(!empty($_GET['albums_id'])):
  $albums_id = $_GET['albums_id'];  
endif;
$albums_data = get_post($albums_id);

$ms_album_post_meta_option = '';
if( function_exists('fw_get_db_post_option') ):
   $ms_album_post_meta_option = fw_get_db_post_option($albums_id);
endif;

$album_metadata = '';
if(!empty($ms_album_post_meta_option['album_release_date'])):
  $album_metadata = $ms_album_post_meta_option['album_release_date'];
else:
  $album_metadata = get_post_meta($albums_id,'fw_options:album_release_date',true);
endif;

$prices = '';
if(!empty($ms_album_post_meta_option['album_full_prices'])):
  $prices = $ms_album_post_meta_option['album_full_prices'];
else:
  $prices = get_post_meta($albums_id,'fw_options:album_full_prices',true);
endif;

$image_url = wp_get_attachment_image_url(get_post_thumbnail_id($albums_id), 'full');
?>   
<div class="ms_upload_wrapper mv_video_wrap music-dashboard-wrapper">
    <form id="update_album_forms" method="post" enctype="multipart/form-data">
        <div class="form-group">
          <label for="albumtitle"><?php echo esc_html__('Album Title','miraculous'); ?></label>
          <input type="text" id="albumtitle" name="albumtitle" placeholder="Enter Album Title" value="<?php echo get_the_title($albums_id); ?>">
        </div>
        <div class="form-group">
            <label for="albumdscription">
            <?php echo esc_html__('Album Description','miraculous'); ?></label>
            <textarea id="albumdscription" name="albumdscription" placeholder="Enter Album Description" ><?php echo $albums_data->post_content; ?></textarea>
        </div> 
		<!--
        <div class="form-group">   
            <label for="language"><?php echo esc_html__('Album Language','miraculous'); ?></label>
            <select id="language" name="language">
                <?php 
                $language_terms = get_terms('language',array( 'hide_empty' => false,));
                if(!empty($language_terms)):
                    foreach($language_terms as $data_terms):
                ?>
                <option value="<?php echo esc_attr($data_terms->slug); ?>">
                <?php echo esc_html($data_terms->name); ?></option>
                <?php endforeach;
                 endif;
                ?>
            </select>
        </div> --> 
        <div class="form-group relative">
            <label><?php esc_html_e('Album Cover Image Upload','miraculous'); ?></label>
            <input type="text" name="up_image_file" id="up_image_file" class="form-control" value="<?php echo esc_url($image_url); ?>" readonly="true">
            <input type="hidden" name="up_image_file_id" id="up_image_file_id" value="">
            <a href="javascript:;" class="ms_btn up_image_upload">
            <?php esc_html_e('Upload Image','miraculous'); ?></a>
        </div> 
		<div class="row">
			<div class="form-group col-lg-6">
				<label><?php echo esc_html('Album Type', 'miraculous'); ?></label>
				<select name="album_types" id="album_types" class="form-control">
					<option value="premium"><?php echo esc_html__('Premium', 'miraculous'); ?></option>
					<option value="free"><?php echo esc_html__('Free', 'miraculous'); ?></option>
				</select>
			</div>   
			<div class="form-group col-lg-6" id="mira_album_price_showhide">
				<label><?php echo esc_html('Album Price', 'miraculous'); ?></label>
				<input type="text" name="album_price" id="album_price" value="<?php echo esc_attr($prices); ?>" class="form-control" onkeypress="validate_num(event)" >
			</div>   
		</div>
        <div class="form-group">
          <label for="my_image_upload">
          <?php echo esc_html__('Select Audio','miraculous'); ?></label>
          <select id="album_tracks" class="bw_album_tracks_upload" name="fw_options[album_songs][]" multiple="">
            <?php 
              $user_id = $user_id = get_current_user_id(); 
              $sg_args = array(
                'post_type' => 'ms-music',
                'posts_per_page' => -1,
                'author' =>  $user_id,
                ); 
              $music_posts = new WP_Query( $sg_args );
              if( $music_posts->have_posts() && $user_id ):
                while ( $music_posts->have_posts() ) : $music_posts->the_post();
              ?>
              <option value="<?php echo get_the_ID(); ?>"><?php echo get_the_title(); ?></option>
			        <?php 
              endwhile;
              wp_reset_query();
              endif;  
              ?>
          </select> 
        </div>
        <div class="mv_upload_btn">   
          <input type="hidden" name="albums_id" id="albums_id" value="<?php echo esc_attr($albums_id);  ?>" />  
          <input type="submit" name="submit_form" id="upload_submit" class="ms_btn" value="Update Album"> 
          <button class="hst_loader"><i class="fa fa-circle-o-notch fa-spin"></i><?php echo esc_html__('Loading', 'miraculous'); ?></button>
          <input type="reset" name="reset_form" class="ms_btn" value="<?php esc_attr_e('reset','miraculous'); ?>">
        </div> 
    </form>
</div>
<?php
endif;