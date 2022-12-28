<?php
/***
 * Template Name: Multivendor profile page
 * 
 * Miraculous Blog Template
 * @package Miraculous
 */
get_header();

$user_id = get_current_user_id(); 
$miraculous_theme_data ='';
if(function_exists('fw_get_db_settings_option')):  
    $miraculous_theme_data = fw_get_db_settings_option();     
endif; 
$currency = '';
if(!empty($miraculous_theme_data['currency']) && function_exists('miraculous_currency_symbol')):
    $currency = miraculous_currency_symbol( $miraculous_theme_data['currency'] );
endif;
$user_roles = '';
if($user_id): 
$user_info = get_userdata($user_id);
 $user_roles = implode(', ', $user_info->roles);
endif;
$artistsdata = '?artistid='.$user_id;  
if(!empty($user_id)):
$name = get_the_author_meta('display_name', $user_id);
$email = get_the_author_meta('user_email', $user_id);
$preview = get_template_directory_uri().'/assets/images/pro_img.png';
$bg_image_url = get_user_meta($user_id, 'user_profilebg_img', true); 
$datebirthday = get_user_meta($user_id,'dateofbirthday',true);
$instagrampageurl = get_user_meta($user_id,'instagrampageurl',true);
$facebookpageurl = get_user_meta($user_id,'facebookpageurl',true);
$twitterpageurl = get_user_meta($user_id,'twitterpageurl',true);
$youtube_url = get_user_meta($user_id,'youtube_url',true);
if(!empty($bg_image_url)): 
  $bg_image = 'background-image:url(' .esc_url($bg_image_url). ');';   
else:
  $bg_image_url = get_stylesheet_directory_uri().'/assets/images/pv-banner-img.jpg';
  $bg_image = 'background-image:url('.esc_url($bg_image_url).');';
endif;
$section_style = ($bg_image) ? 'style="background-size: cover;'. esc_attr($bg_image) . '"' : '';

$followers = get_user_meta($user_id, 'mira_author_followers', true);
?> 
<div class="ms_content_multivendor">
<div id="primary" class="mv_main_wrap">
    <div class="ms_main_wrapper ms_main_wrapper_single" id="mv_primary" <?php printf($section_style); ?>>
        <div class="container-fluid">	
            <div class="mv_profile_head">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="mv_profile_img">
                            <?php 
                            $img_src = get_user_meta($user_id, 'user_profile_img', true); 
                             if($img_src) { ?>
                                <img src="<?php echo esc_url($img_src); ?>" alt="<?php esc_attr_e('preview','miraculous'); ?>" id="img-preview" class="img-fluid">
                            <?php }else{ ?>
                                <img src="<?php echo esc_url($preview); ?>" alt="<?php esc_attr_e('preview','miraculous'); ?>" id="img-preview" class="img-fluid">
                            <?php }
                            ?>	
                        </div>  
                        <div class="mv_profile_text">
                            <?php if(!empty($name)): ?>	
                              <h2><?php echo esc_html($name); ?></h2>
                              <p><?php echo esc_html($user_roles); ?></p>
                              <p><?php echo esc_html($email); ?></p>
                            <?php endif; 
                            $address = get_user_meta($user_id, 'user_address', true); 
                            if(!empty($address)):
                            ?><p><?php echo esc_html($address); ?></p>
                            <?php endif; ?> 
                          </div> 
                          <div class="foo_sharing">
                          <ul class="pl-0">
                            <?php if(!empty($facebookpageurl)): ?>
                            <li><a href="<?php echo esc_url($facebookpageurl); ?>" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                            <?php endif;
                            if(!empty($instagrampageurl)):
                            ?>
                            <li><a href="<?php echo esc_url($instagrampageurl); ?>" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                            <?php 
                            endif; 
                            if(!empty($twitterpageurl)):
                            ?>
                            <li><a href="<?php echo esc_url($twitterpageurl); ?>" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                            <?php  
                            endif; 
                            if(!empty($youtube_url)):
                            ?>
                            <li><a href="<?php echo esc_url($youtube_url); ?>" target="_blank"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
                            <?php 
                            endif;
                            ?>
                          </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 align-self-center">
                        <div class="mv_profile_view">	
                           <?php 
                            if($user_roles=='artist' || $user_roles=='administrator'):
                           ?>
                            <ul>
                            <?php 
                            $follow_cont = get_user_meta($user_id, 'follower', true);
                            if($follow_cont):
                            ?>
                            <li>
                            <p><span id="ms_author_followers">
                            <?php 
                            echo count(array_filter($follow_cont, 'strlen'));
                            ?>
                            </span></p>
                            <p>
                            <?php  
                            $followers_url = '';
                            if(!empty($miraculous_theme_data['user_followers_page'])){
                               $followers_url =  get_page_link( $miraculous_theme_data['user_followers_page'] );
                            }else{
                                $followers_url = '#';
                            }
                            ?>
                            <a href="<?php echo esc_url($followers_url); ?>">
                            <?php esc_html_e('Followers','miraculous'); ?>
                            </a> 
                            </p>
                            </li>
                            <?php 
                            else:
                            ?>
                            <li>
                              <p><span id="ms_author_followers">
                               <?php esc_html_e('0', 'miraculous'); ?>
                               </span></p>
                               <p><?php esc_html_e('Followers','miraculous'); ?></p>
                            </li> 
                            <?php     
                            endif;
                            global $wp_query;
                            $post_details = $wpdb->get_results("SELECT ID FROM $wpdb->posts WHERE post_author = '" .$user_id. "' AND post_type = 'ms-music' AND post_status = 'publish'");
                            
                                   $sum = $dowmsum = 0;
                                foreach($post_details as $post_details_child){
                                   $id = $post_details_child->ID;
                                   $view = get_post_meta( $id, 'song_views_count' , true );
                                   if(!empty($view)){
                                   $sum+= $view;
                                   }
                                   $download = get_post_meta($id,'song_dowenload_counter',true);
                                   if(!empty($download)){
                                        $dowmsum+= $download;
                                   }
                                }
                                
                            $curauth = $wp_query->get_queried_object();
                            $post_tracks_count = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->posts WHERE post_author = '" .$user_id. "' AND post_type = 'ms-music' AND post_status = 'publish'");
                            ?>
                            <li>
                             <p><span><?php
                             if(!empty($post_tracks_count)){
                             echo esc_html($post_tracks_count); 
                             }
                             else{
                                esc_html_e('0', 'miraculous'); 
                             }
                             ?></span></p>
                             <p><?php esc_html_e('Tracks','miraculous'); ?></p>
                            </li>
                            <li>
                                <p><span><?php
                                if(!empty($sum)){
                                esc_html_e($sum); 
                                }
                                else{
                                    esc_html_e('0', 'miraculous'); 
                                }
                                ?></span></p>
                                <p><?php esc_html_e('Views','miraculous'); ?></p>
                            </li>
                            <li>
                            <p><span><?php 
                                if(!empty($dowmsum)){
                                esc_html_e($dowmsum); 
                                }
                                else{
                                    esc_html_e('0', 'miraculous'); 
                                }
                                ?></span></p>
                                <p><?php esc_html_e('Downloads','miraculous'); ?></p>
                            </li> 
                            </ul>
                            <?php endif; ?>
                            <?php 
                            if($user_roles=='artist' || $user_roles=='administrator'):
                           ?>
                            <ul>
                            <?php 
                            global $wpdb; 
                            $today = date('Y-m-d H:i:s');
                            $pmt_tbl = $wpdb->prefix . 'ms_orders'; 
                            $track_query = $wpdb->get_results( "SELECT* FROM $pmt_tbl WHERE author_id={$user_id}");
                                $total_musics = 0;
                                foreach($track_query as $items_music){
                                    $items_id = $items_music->itemid;
                                    $post_type = get_post_type( $items_id );
                                    if($post_type == 'ms-music'){
                                     $total_musics++;
                                    } 
                                }
                            ?> 
                              <li>
                              <?php if(isset($total_musics)): ?>
                              <p><span><?php echo esc_html($total_musics); ?></span></p>
                              <?php else: ?>
                                <p><span><?php echo esc_html__('0','miraculous'); ?></span></p>
                              <?php endif; ?>
                              <p><?php esc_html_e('Track Purchase','miraculous'); ?></p>
                              </li>
                              <?php 
                              $album_querys = $wpdb->get_results( "SELECT* FROM $pmt_tbl WHERE author_id={$user_id}");
                              $total_albums = 0;
                                foreach($album_querys as $items_album){
                                    $items_idt = $items_album->itemid;
                                    $post_typeo = get_post_type( $items_idt );
                                    if($post_typeo == 'ms-albums'){
                                        $total_albums++;
                                    }
                                }
                              ?>
                              <li>
                              <?php if(isset($total_albums)): ?>
                               <p><span><?php echo esc_html($total_albums); ?></span></p>
                              <?php else: ?>
                                <p><span><?php echo esc_html__('0','miraculous'); ?></span></p>
                              <?php endif; ?>
                              <p><?php esc_html_e('Album Purchase','miraculous'); ?></p>
                              </li>
                              
                              <?php
                                $commision = '';
                                if(!empty($miraculous_theme_data['commission_value'])):
                                    $commision = $miraculous_theme_data['commission_value'];
                                endif;
                                $orders = wc_get_orders( array(
                                    'numberposts' => -1,
                                ) );
                                $quantitys = $order_totals = 0;
                                if(!empty($orders)){
                                    foreach($orders as $order){
                                        $status = $order->get_status();
                                        if( $status == 'completed'){
                                            foreach ( $order->get_items() as $item_id => $item ) {
                                                $product_id = $item->get_product_id();
                                                $post_obj    = get_post( $product_id );
                                                $vendor_id = $post_obj->post_author;
                                                if($user_id == $vendor_id ){
                                                    $order_total = $order->get_total();
                                                    $order_totals += $order_total;
                                                    $quantity = $item->get_quantity();
                                                    $quantitys += $quantity;
                                                }
                                                
                                            }
                                        }
                                    }
                                }
                              ?>
                              
                              <li>
                              <?php if(isset($quantitys)): ?>
                               <p><span><?php echo esc_html($quantitys); ?></span></p>
                              <?php else: ?>
                                <p><span><?php echo esc_html__('0','miraculous'); ?></span></p>
                              <?php endif; ?>
                              <p><?php esc_html_e('Product Purchase','miraculous'); ?></p>
                              </li>
                              
                              
                              
                              <?php 
                              $revenue_query = $wpdb->get_results( "SELECT SUM(payment_amount) AS revenue FROM $pmt_tbl WHERE author_id={$user_id} ");
                              ?>
                              <li>
                                <?php 
                                    if(!empty($revenue_query[0]->revenue) && !empty($order_totals)){
                                        $order_product = 0;
                                        if(!empty($order_product)){
                                            $order_product = ($order_totals * $commision)/100;
                                        }
                                        $order_product_total = $order_totals-$order_product;
                                
                                        $revenve = $revenue_query[0]->revenue;
                                        $revenves = 0;
                                        if(!empty($revenves)){
                                            $revenves = ($revenve * $commision)/100;
                                        }
                                        $revenves_total = $revenve-$revenves;
                                        
                                        $g_total =  $order_product_total + $revenves_total;
                                        echo '<p><span>'. esc_attr($currency.' '.$g_total) .'</span></p>';
                                    } else if(empty($revenue_query[0]->revenue) && !empty($order_totals)) {
                                        $order_product = ($order_totals * $commision)/100;
                                        $order_product_total = $order_totals-$order_product;
                                        echo '<p><span>'. esc_attr($currency.' '.$order_product_total) .'</span></p>';
                                    } else if(!empty($revenue_query[0]->revenue) && empty($order_totals)) {
                                        $revenve = $revenue_query[0]->revenue;
                                        if(!empty($commision)){
                                        $revenves = ($revenve * $commision)/100;
                                        }
                                        else{
                                           $revenves = 0; 
                                        }
                                        $revenves_total = $revenve-$revenves;
                                        echo '<p><span>'. esc_attr($currency.' '.$revenves_total) .'</span></p>';
                                    } else {
                                        echo '<p>'. esc_html__('0','miraculous').'</p>'; 
                                    }
                                ?>
                              <p><?php esc_html_e('Revenue','miraculous'); ?></p>
                              </li>
                            </ul> 
                            <?php endif; ?>
                           </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="ms_main_wrapper ms_main_wrapper_single">
    <div class="container-fuild">	
        <div class="mv_profile_content downloads_row1">
            <div class="row">
                <div class="col-lg-2">
                    <div class="mv_user_dash mv_separate">
                        <?php
                        $userlogin_id = get_current_user_id();
                        if($userlogin_id):
                        $user_info = get_userdata($userlogin_id);
                        $user_roles = implode(', ', $user_info->roles);
                        if($user_roles=='artist' || $user_roles=='administrator'):

                               if($user_roles=='administrator'):
                                  echo '<h1>'.esc_html__('Artist','miraculous').'</h1>';
                               endif;

                            if(has_nav_menu('artist')):
                                wp_nav_menu( array(
                                    'theme_location' => 'artist',
                                    'menu_id'        => 'primary-menu',
                                    'fallback_cb'=> 'miraculous_menu_editor'
                                ) );
                            endif;

                        $stripe_secretkey = get_user_meta($user_id, 'stripe_secretkey', true); 

                        $stripe_accountid = get_user_meta($user_id, 'stripe_accountid', true);

                        if(empty($stripe_secretkey) && empty($stripe_accountid)):
                        ?>
                        <style>
                       .ms-overview a,.ms-album-upload a,.ms-track-upload a {
                         cursor: not-allowed;
                        }
                        </style>
                        <script>
                        jQuery('.ms-overview a,.ms-album-upload a,.ms-track-upload a').click(function(e){
                            return false;
                            e.stopPropagation();
                            
                        });
                        jQuery('.ms-overview a,.ms-album-upload a,.ms-track-upload a').attr('href','#');
                        </script>
                        <?php
                        endif;

                        endif;
                        if($user_roles=='listener' || $user_roles=='administrator'):

                            if($user_roles=='administrator'):
                                echo '<h1>'.esc_html__('Listener','miraculous').'</h1>';
                            endif;

                            if(has_nav_menu('listener')):
                                wp_nav_menu( array(
                                    'theme_location' => 'listener',
                                    'menu_id'        => 'primary-menu',
                                    'fallback_cb'=> 'miraculous_menu_editor'
                                    ) );
                            endif;

                        endif;
                    endif;
                    ?>
                    </div>
                </div>
                <div class="col-lg-10">
                    <?php
                    $pagetitle = get_the_title();
                    $miraculous_theme_data = '';
                    if(function_exists('fw_get_db_settings_option')):	
                    	$miraculous_theme_data = fw_get_db_settings_option();     
                    endif;
                   ?>
                    <div class="beatswipe_profilepage" >
                    <?php
                	while ( have_posts() ) : the_post();
                
                		get_template_part( 'template-parts/content', 'full' );
                
                	endwhile; // End of the loop.
                	?>
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?php
else:
$need_heading = '';
if(!empty($atts['need_heading'])):
    $need_heading = $atts['need_heading'];
endif;
$need_logoimage = '';
if(!empty($atts['need_logoimage']['url'])):
    $need_logoimage = $atts['need_logoimage']['url'];
else:
    $miraculous_layout = '';
    if(!empty($miraculous_theme_data['miraculous_layout'])){
        $miraculous_layout = $miraculous_theme_data['miraculous_layout'];
    }
    if($miraculous_layout == 2){
        $need_logoimage = get_template_directory_uri().'/assets/images/headphones-dark.svg';
    }
    else{
        $need_logoimage = get_template_directory_uri().'/assets/images/headphones.svg';
    }
    if(empty($need_heading)){
        $need_heading ='you need to login to access this page';
    }
endif;    
?>
<div class="ms_needlogin">
	<div class="needlogin_img">
	  <img src="<?php echo esc_url($need_logoimage); ?>" alt="<?php esc_attr_e('Need Logo Image','miraculous'); ?>">
	</div>
	<?php if(!empty($need_heading)): ?>
	   <h2><?php echo esc_html($need_heading); ?></h2>
	<?php endif; ?>
	<a href="javascript:;" class="ms_btn reg_btn" data-toggle="modal" data-target="#myModal"><span><?php esc_html_e('register/login','miraculous'); ?>
    </span></a>
</div>
<?php
endif;  
get_footer();