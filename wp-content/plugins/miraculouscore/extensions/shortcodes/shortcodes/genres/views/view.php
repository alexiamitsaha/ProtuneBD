<?php if (!defined('FW')) die('Forbidden');
$genre_heading = '';
if(!empty($atts['genre_heading'])):
    $genre_heading = $atts['genre_heading'];
endif;
$number_limits = '';
if(!empty($atts['number_limits'])):
    $number_limits = $atts['number_limits'];
endif;
$play_icone ='';
$play_icone = get_template_directory_uri().'/assets/images/svg/play.svg';
$genres = '';
$genres = get_terms( array(
            'taxonomy' => 'genre',
            'number' => $number_limits,
            'hide_empty' => true
        ) );

function miraculous_odd_genre_row($i, $image_id, $genre, $term_id, $play_icone){
    if($i == 1){
        ?>
        <div class="col-lg-4">
            <div class="ms_genres_box">
                <?php 
                $image_url = wp_get_attachment_url($image_id, 'full');
                $new_img = miraculous_aq_resize($image_url, '534', '534' , true);  ?>
                <img src="<?php echo esc_url($new_img); ?>" alt="<?php esc_attr_e('Image','miraculous'); ?>" class="img-fluid" />
                <div class="ms_main_overlay">
                    <div class="ms_box_overlay"></div>
                    <div class="ms_play_icon">
                        <a href="<?php echo esc_url(get_category_link($term_id)); ?>"><img src="<?php echo esc_url($play_icone);?>" alt="<?php esc_attr_e('play icone','miraculous'); ?>"></a>
                    </div>
                    <div class="ovrly_text_div">
                        <span class="ovrly_text1"><a href="javascript:;"><?php echo esc_html($genre); ?></a></span>
                        <span class="ovrly_text2"><a href="<?php echo esc_url(get_category_link($term_id)); ?>"><?php echo esc_html_e('view songs', 'miraculous'); ?></a></span>
                    </div>
                </div>
                <div class="ms_box_overlay_on">
                    <div class="ovrly_text_div">
                        <span class="ovrly_text1"><a href="javascript:;">
						<?php echo esc_html($genre); ?></a></span>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }elseif($i < 6){
            if($i == 2){ ?>
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="ms_genres_box">
                            <?php 
                            $image_url = wp_get_attachment_url($image_id, 'full');
                            $new_img = miraculous_aq_resize($image_url, '252', '252' , true); ?>
                            <img src="<?php echo esc_url($new_img); ?>" alt="<?php esc_attr_e('Image','miraculous'); ?>" class="img-fluid" />
                            <div class="ms_main_overlay">
                                <div class="ms_box_overlay"></div>
                                <div class="ms_play_icon">
                                    <a href="<?php echo esc_url(get_category_link($term_id)); ?>"><img src="<?php echo esc_url($play_icone);?>" alt="<?php esc_attr_e('play icone','miraculous'); ?>"></a>
                                </div>
                                <div class="ovrly_text_div">
                                    <span class="ovrly_text1"><a href="javascript:;"><?php echo esc_html($genre); ?></a></span>
                                    <span class="ovrly_text2"><a href="<?php echo esc_url(get_category_link($term_id)); ?>"><?php esc_html_e('view songs', 'miraculous'); ?></a></span>
                                </div>
                            </div>
                            <div class="ms_box_overlay_on">
                                <div class="ovrly_text_div">
                                    <span class="ovrly_text1"><a href="javascript:;">
									<?php echo esc_html($genre); ?></a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php }
                if($i == 3 || $i == 4){ ?>
                    <div class="col-lg-8">
                        <div class="ms_genres_box">
                            <?php 
                            $image_url = wp_get_attachment_url($image_id, 'full');
                            $new_img = miraculous_aq_resize($image_url, '534', '251' , true); ?>
                            <img src="<?php echo esc_url($new_img); ?>" alt="<?php esc_attr_e('Image','miraculous'); ?>" class="img-fluid" />
                            <div class="ms_main_overlay">
                                <div class="ms_box_overlay"></div>
                                <div class="ms_play_icon">
                                    <a href="<?php echo esc_url(get_category_link($term_id)); ?>"><img src="<?php echo esc_url($play_icone);?>" alt="<?php esc_attr_e('play icone','miraculous'); ?>"></a>
                                </div>
                                <div class="ovrly_text_div">
                                    <span class="ovrly_text1">
									<a href="javascript:;">
									<?php echo esc_html($genre); ?></a></span>
                                    <span class="ovrly_text2"><a href="<?php echo esc_url(get_category_link($term_id)); ?>">
									<?php esc_html_e('view songs', 'miraculous'); ?></a></span>
                                </div>
                            </div>
                            <div class="ms_box_overlay_on">
                                <div class="ovrly_text_div">
                                    <span class="ovrly_text1">
									<a href="javascript:;">
									<?php echo esc_html($genre); ?></a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php }
                if($i == 5){ ?>
                    <div class="col-lg-4">
                        <div class="ms_genres_box">
                            <?php 
                            $image_url = wp_get_attachment_url($image_id, 'full');
                            $new_img = miraculous_aq_resize($image_url, '252', '252' , true); ?>
                            <img src="<?php echo esc_url($new_img); ?>" alt="<?php esc_attr_e('Image','miraculous'); ?>" class="img-fluid" />
                            <div class="ms_main_overlay">
                                <div class="ms_box_overlay"></div>
                                <div class="ms_play_icon">
                                    <a href="<?php echo esc_url(get_category_link($term_id)); ?>"><img src="<?php echo esc_url($play_icone);?>" alt="<?php esc_attr_e('play icone','miraculous'); ?>"></a>
                                </div>
                                <div class="ovrly_text_div">
                                    <span class="ovrly_text1"><a href="javascript:;"><?php echo esc_html($genre); ?></a></span>
                                    <span class="ovrly_text2"><a href="<?php echo esc_url(get_category_link($term_id)); ?>"><?php esc_html_e('view songs', 'miraculous'); ?></a></span>
                                </div>
                            </div>
                            <div class="ms_box_overlay_on">
                                <div class="ovrly_text_div">
                                    <span class="ovrly_text1"><a href="javascript:;"><?php echo esc_html($genre); ?></a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php }
    }else{
        ?>
        <div class="col-lg-2">
            <div class="ms_genres_box">
                <?php 
                $image_url = wp_get_attachment_url($image_id, 'full');
                $new_img = miraculous_aq_resize($image_url, '252', '536' , true); ?>
                <img src="<?php echo esc_url($new_img); ?>" alt="<?php esc_attr_e('Image','miraculous'); ?>" class="img-fluid" />
                <div class="ms_main_overlay">
                    <div class="ms_box_overlay"></div>
                    <div class="ms_play_icon">
                        <a href="<?php echo esc_url(get_category_link($term_id)); ?>"><img src="<?php echo esc_url($play_icone);?>" alt="<?php esc_attr_e('play icone','miraculous'); ?>"></a>
                    </div>
                    <div class="ovrly_text_div">
                        <span class="ovrly_text1"><a href="javascript:;"><?php echo esc_html($genre); ?></a></span>
                        <span class="ovrly_text2"><a href="<?php echo esc_url(get_category_link($term_id)); ?>"><?php esc_html_e('view songs', 'miraculous'); ?></a></span>
                    </div>
                </div>
                <div class="ms_box_overlay_on">
                    <div class="ovrly_text_div">
                        <span class="ovrly_text1"><a href="javascript:;">
						<?php echo esc_html($genre); ?></a></span>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}

function miraculous_even_genre_row($i, $image_id, $genre, $term_id, $play_icone){
    if($i < 5){
            if($i == 1){ ?>
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="ms_genres_box">
                            <?php 
                            $image_url = wp_get_attachment_url($image_id, 'full');
                            $new_img = miraculous_aq_resize($image_url, '252', '252' , true); ?>
                            <img src="<?php echo esc_url($new_img); ?>" alt="<?php esc_attr_e('Image','miraculous'); ?>" class="img-fluid" />
                            <div class="ms_main_overlay">
                                <div class="ms_box_overlay"></div>
                                <div class="ms_play_icon">
                                    <a href="<?php echo esc_url(get_category_link($term_id)); ?>"><img src="<?php echo esc_url($play_icone);?>" alt="<?php esc_attr_e('play icone','miraculous'); ?>"></a>
                                </div>
                                <div class="ovrly_text_div">
                                    <span class="ovrly_text1"><a href="javascript:;"><?php echo esc_html($genre); ?></a></span>
                                    <span class="ovrly_text2"><a href="<?php echo esc_url(get_category_link($term_id)); ?>"><?php esc_html_e('view songs', 'miraculous'); ?></a></span>
                                </div>
                            </div>
                            <div class="ms_box_overlay_on">
                                <div class="ovrly_text_div">
                                    <span class="ovrly_text1"><a href="javascript:;"><?php echo esc_html($genre); ?></a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php }
                if($i == 2 || $i == 3){ ?>
                    <div class="col-lg-8">
                        <div class="ms_genres_box">
                            <?php 
                            $image_url = wp_get_attachment_url($image_id, 'full');
                            $new_img = miraculous_aq_resize($image_url, '534', '251' , true); ?>
                            <img src="<?php echo esc_url($new_img); ?>" alt="<?php esc_attr_e('Image','miraculous'); ?>" class="img-fluid" />
                            <div class="ms_main_overlay">
                                <div class="ms_box_overlay"></div>
                                <div class="ms_play_icon">
                                    <a href="<?php echo esc_url(get_category_link($term_id)); ?>"><img src="<?php echo esc_url($play_icone);?>" alt="<?php esc_attr_e('play icone','miraculous'); ?>"></a>
                                </div>
                                <div class="ovrly_text_div">
                                    <span class="ovrly_text1"><a href="javascript:;"><?php echo esc_html($genre); ?></a></span>
                                    <span class="ovrly_text2"><a href="<?php echo esc_url(get_category_link($term_id)); ?>"><?php esc_html_e('view songs', 'miraculous'); ?></a></span>
                                </div>
                            </div>
                            <div class="ms_box_overlay_on">
                                <div class="ovrly_text_div">
                                    <span class="ovrly_text1">
									<a href="javascript:;">
									<?php echo esc_html($genre); ?></a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php }
                if($i == 4){ ?>
                    <div class="col-lg-4">
                        <div class="ms_genres_box">
                            <?php 
                            $image_url = wp_get_attachment_url($image_id, 'full');
                            $new_img = miraculous_aq_resize($image_url, '252', '252' , true); ?>
                            <img src="<?php echo esc_url($new_img); ?>" alt="<?php esc_attr_e('Image','miraculous'); ?>" class="img-fluid" />
                            <div class="ms_main_overlay">
                                <div class="ms_box_overlay"></div>
                                <div class="ms_play_icon">
                                    <a href="<?php echo esc_url(get_category_link($term_id)); ?>"><img src="<?php echo esc_url($play_icone);?>" alt="<?php esc_attr_e('play icone','miraculous'); ?>"></a>
                                </div>
                                <div class="ovrly_text_div">
                                    <span class="ovrly_text1"><a href="javascript:;"><?php echo esc_html($genre); ?></a></span>
                                    <span class="ovrly_text2"><a href="<?php echo esc_url(get_category_link($term_id)); ?>"><?php esc_html_e('view songs', 'miraculous'); ?></a></span>
                                </div>
                            </div>
                            <div class="ms_box_overlay_on">
                                <div class="ovrly_text_div">
                                    <span class="ovrly_text1"><a href="javascript:;"><?php echo esc_html($genre); ?></a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php }
    }elseif($i == 5){
        ?>
        <div class="col-lg-2">
            <div class="ms_genres_box">
                <?php 
                $image_url = wp_get_attachment_url($image_id, 'full');
                $new_img = miraculous_aq_resize($image_url, '252', '536' , true);  ?>
                <img src="<?php echo esc_url($new_img); ?>" alt="<?php esc_attr_e('Image','miraculous'); ?>" class="img-fluid" />
                <div class="ms_main_overlay">
                    <div class="ms_box_overlay"></div>
                    <div class="ms_play_icon">
                        <a href="<?php echo esc_url(get_category_link($term_id)); ?>"><img src="<?php echo esc_url($play_icone);?>" alt="<?php esc_attr_e('play icone','miraculous'); ?>"></a>
                    </div>
                    <div class="ovrly_text_div">
                        <span class="ovrly_text1">
						<a href="javascript:;"><?php echo esc_html($genre); ?></a></span>
                        <span class="ovrly_text2">
						<a href="<?php echo esc_url(get_category_link($term_id)); ?>"><?php esc_html_e('view songs', 'miraculous'); ?></a></span>
                    </div>
                </div>
                <div class="ms_box_overlay_on">
                    <div class="ovrly_text_div">
                        <span class="ovrly_text1">
						<a href="javascript:;"><?php echo esc_html($genre); ?></a></span>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }else{
        ?>
        <div class="col-lg-4">
            <div class="ms_genres_box">
                <?php 
                $image_url = wp_get_attachment_url($image_id, 'full');
                $new_img = miraculous_aq_resize($image_url, '534', '534' , true); ?>
                <img src="<?php echo esc_url($new_img); ?>" alt="<?php esc_attr_e('Image','miraculous'); ?>" class="img-fluid" />
                <div class="ms_main_overlay">
                    <div class="ms_box_overlay"></div>
                    <div class="ms_play_icon">
                        <a href="<?php echo esc_url(get_category_link($term_id)); ?>"><img src="<?php echo esc_url($play_icone);?>" alt="<?php esc_attr_e('play icone','miraculous'); ?>"></a>
                    </div>
                    <div class="ovrly_text_div">
                        <span class="ovrly_text1">
						<a href="javascript:;"><?php echo esc_html($genre); ?></a></span>
                        <span class="ovrly_text2">
						<a href="<?php echo esc_url(get_category_link($term_id)); ?>">
						<?php esc_html_e('view songs', 'miraculous'); ?></a>
						</span>
                    </div>
                </div>
                <div class="ms_box_overlay_on">
                    <div class="ovrly_text_div">
                        <span class="ovrly_text1">
						<a href="javascript:;"><?php echo esc_html($genre); ?></a></span>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}
?>
<div class="ms_genres_wrapper ms_genres_single">
    <div class="row">
        <div class="col-lg-12">
            <div class="ms_heading">
                <h1><?php esc_html_e($genre_heading); ?></h1>
            </div>
        </div>
      <?php 
	    if($genres):  
            $i = 1;
            $n = 7;
            $j = 1;
            foreach($genres as $genre): 
                $image_id = get_term_meta( $genre->term_id, 'miraculous-taxonomy-image-id', true );
                if($i < $n){
                    if($j == 1){
                        miraculous_odd_genre_row($i, $image_id, $genre->name, $genre->term_id, $play_icone);
                    }else{
                        miraculous_even_genre_row($i, $image_id, $genre->name, $genre->term_id, $play_icone);
                    }
                }
                if($i >= 6){
                    $i = 1;
                    $j = ($j == 1) ? 2 : 1;
                }else{
                    $i++; 
                }
            endforeach; ?>
        
        <?php endif; ?>  
    </div>
  </div>