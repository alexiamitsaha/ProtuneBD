<?php
// version 1.0.0
// Register and load the widget
function miraculous_load_widget() {

    register_widget( 'Miraculous_Widget_Gplay' );
    register_widget( 'Miraculous_Widget_Social_Links' );
    register_widget( 'Miraculous_Widget_Address_Block' );
    register_widget( 'Miraculous_Widget_Newsletter' );
    register_widget( 'Miraculous_Widget_Tracks' ); 

}

add_action( 'widgets_init', 'miraculous_load_widget' );


// Creating the widget 
class Miraculous_Widget_Gplay extends WP_Widget {

function  __construct() {

	parent::__construct(
		   'miraculous_widget_gplay', // Base ID of your widget
		   esc_html__('Apps Buttons', 'miraculous'),  // Widget name will appear in UI
		   array( 'description' => esc_html__( 'Store button widget', 'miraculous' ), ) // Widget description
		  );
}

public function widget( $args, $instance ) {

    $app_widget_title = apply_filters( 'app_widget_title', $instance['app_widget_title'] );
    $app_widget_desc = apply_filters( 'app_widget_desc', $instance['app_widget_desc'] );
    $gplay_url = apply_filters( 'widget_gplay_url', $instance['gplay_url'] );
    $gplay_image_url = ( ! empty( $instance['gplay_image_url'] ) ) ? $instance['gplay_image_url'] : '';

    $apple_url = apply_filters( 'widget_apple_url', $instance['apple_url'] );
    $apple_image_url = ( ! empty( $instance['apple_image_url'] ) ) ? $instance['apple_image_url'] : '';

    $window_url = apply_filters( 'widget_window_url', $instance['window_url'] );
    $window_image_url = ( ! empty( $instance['window_image_url'] ) ) ? $instance['window_image_url'] : '';

    // before and after widget arguments are defined by themes
    echo __($args['before_widget']); ?>

    <div class="footer_box footer_app">
        <h1 class="footer_title"><?php echo esc_html($app_widget_title); ?></h1>
        <p><?php echo esc_html($app_widget_desc); ?></p>
    <?php if ( ! empty( $gplay_url ) ) { ?>

    	<a href="<?php echo esc_url($gplay_url); ?>" class="foo_app_btn"><img src="<?php echo esc_url($gplay_image_url); ?>" alt="<?php esc_attr_e('Google Play', 'miraculous'); ?>" class="img-fluid"></a>

    <?php } if( ! empty( $apple_url ) ) { ?>

    	<a href="<?php echo esc_url($apple_url); ?>" class="foo_app_btn"><img src="<?php echo esc_url($apple_image_url); ?>" alt="<?php esc_attr_e('App Store', 'miraculous'); ?>" class="img-fluid"></a>

    <?php } if( ! empty( $window_url ) ) { ?>

    	<a href="<?php echo esc_url($window_url); ?>" class="foo_app_btn"><img src="<?php echo esc_url($window_image_url); ?>" alt="<?php esc_attr_e('Windows', 'miraculous'); ?>" class="img-fluid"></a>

    <?php } ?>

    </div>
    <?php
    echo __($args['after_widget']);

}

// Widget Backend 

public function form( $instance ) {
    $app_widget_title = '';
    if ( isset( $instance[ 'app_widget_title' ] ) ) {
        $app_widget_title = $instance[ 'app_widget_title' ];
    }
    $app_widget_desc = '';
    if ( isset( $instance[ 'app_widget_desc' ] ) ) {
        $app_widget_desc = $instance[ 'app_widget_desc' ];
    }
    $gplay_url = '';
    if ( isset( $instance[ 'gplay_url' ] ) ) {
        $gplay_url = $instance[ 'gplay_url' ];
    }
    $gplay_image_url = '';
    if ( isset( $instance[ 'gplay_image_url' ] ) ) {
        $gplay_image_url = $instance[ 'gplay_image_url' ];
    }
    $apple_url = '';
    if ( isset( $instance[ 'apple_url' ] ) ) {
        $apple_url = $instance[ 'apple_url' ];
    }
    $apple_image_url = '';
    if ( isset( $instance[ 'apple_image_url' ] ) ) {
        $apple_image_url = $instance[ 'apple_image_url' ];
    }
    $window_url = '';
    if ( isset( $instance[ 'window_url' ] ) ) {
        $window_url = $instance[ 'window_url' ];
    }
    $window_image_url = '';
    if ( isset( $instance[ 'window_image_url' ] ) ) {
        $window_image_url = $instance[ 'window_image_url' ];
    }

?>
<p>
<label for="<?php echo esc_attr($this->get_field_id( 'app_widget_title' )); ?>">
<?php esc_html_e( 'Title:','miraculous'); ?></label> 
<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'app_widget_title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'app_widget_title' )); ?>" type="text" value="<?php echo esc_attr( $app_widget_title ); ?>" />
</p>
<p>
<label for="<?php echo esc_attr($this->get_field_id( 'app_widget_desc' )); ?>">
<?php esc_html_e( 'Content:' ); ?></label> 
<textarea class="widefat" id="<?php echo esc_attr($this->get_field_id( 'app_widget_desc' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'app_widget_desc' )); ?>" rows="5"><?php echo esc_html( $app_widget_desc ); ?></textarea>
</p>
<p>
<label for="<?php echo $this->get_field_id('gplay_image_url'); ?>">
<?php esc_html_e('upload Image', 'miraculous') ?>:</label>
<input  id="<?php echo $this->get_field_id('gplay_image_url'); ?>" type="hidden" class="gplayimage-url" name="<?php echo $this->get_field_name('gplay_image_url'); ?>" value="<?php if (isset($gplay_image_url)) echo esc_attr($gplay_image_url); ?>"
    />
<input data-title="Image" data-btntext="Select it" class="button upload_gplay_image_button" type="button" value="<?php esc_attr_e('Upload','miraculous') ?>" />
</p>
<p class="img-prev">
	<?php if (isset($gplay_image_url)) { echo '<img src="'.$gplay_image_url.'" class="gplay_image_url"';} ?>
</p>
<p>
<label for="<?php echo esc_attr($this->get_field_id( 'gplay_url' )); ?>">
<?php esc_html_e( 'Google Play Url:','miraculous'); ?></label> 
<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'gplay_url' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'gplay_url' )); ?>" type="text" value="<?php echo esc_attr( $gplay_url ); ?>" />
</p>
<p>
<label for="<?php echo $this->get_field_id('apple_image_url'); ?>">
<?php esc_html_e('upload Image', 'miraculous') ?>:</label>
<input  id="<?php echo $this->get_field_id('apple_image_url'); ?>" type="hidden" class="appleimage-url" name="<?php echo $this->get_field_name('apple_image_url'); ?>" value="<?php if (isset($apple_image_url)) echo esc_attr($apple_image_url); ?>"
    />
<input data-title="Image" data-btntext="Select it" class="button upload_apple_image_button" type="button" value="<?php esc_attr_e('Upload','miraculous') ?>" />
</p>
<p class="img-prev">
<?php if (isset($apple_image_url)) { echo '<img src="'.$apple_image_url.'" class="apple_image_url"';} ?>
</p>
<p>
<label for="<?php echo esc_attr($this->get_field_id( 'apple_url' )); ?>">
<?php esc_html_e( 'Apple Store Url:','miraculous'); ?></label> 
<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'apple_url' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'apple_url' )); ?>" type="text" value="<?php echo esc_attr( $apple_url ); ?>" />
</p>
<p>
<label for="<?php echo $this->get_field_id('window_image_url'); ?>"><?php esc_html_e('upload Image', 'miraculous') ?>:</label>
<input  id="<?php echo $this->get_field_id('window_image_url'); ?>" type="hidden" class="windowimage-url" 
name="<?php echo $this->get_field_name('window_image_url'); ?>" value="<?php if (isset($window_image_url)) echo esc_attr($window_image_url); ?>"
/>
<input data-title="Image" data-btntext="Select it" class="button upload_window_image_button" type="button" value="<?php esc_attr_e('Upload','miraculous') ?>" />
</p>
<p class="img-prev">
	<?php if (isset($window_image_url)) { echo '<img src="'.$window_image_url.'" class="window_image_url"';} ?>
</p>
<p>
  <label for="<?php echo esc_attr($this->get_field_id( 'window_url' )); ?>">
  <?php esc_html_e( 'Window store Url:','miraculous'); ?></label> 
  <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'window_url' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'window_url' )); ?>" type="text" value="<?php echo esc_attr( $window_url ); ?>" />
</p>
<?php 

}

// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {

    $instance = array();

    $instance['app_widget_title'] = ( ! empty( $new_instance['app_widget_title'] ) ) ? strip_tags( $new_instance['app_widget_title'] ) : '';
    $instance['app_widget_desc'] = ( ! empty( $new_instance['app_widget_desc'] ) ) ? strip_tags( $new_instance['app_widget_desc'] ) : '';

    $instance['gplay_url'] = ( ! empty( $new_instance['gplay_url'] ) ) ? strip_tags( $new_instance['gplay_url'] ) : '';
    $instance['gplay_image_url'] = ( ! empty( $new_instance['gplay_image_url'] ) ) ? strip_tags( $new_instance['gplay_image_url'] ) : '';

    $instance['apple_url'] = ( ! empty( $new_instance['apple_url'] ) ) ? strip_tags( $new_instance['apple_url'] ) : '';
    $instance['apple_image_url'] = ( ! empty( $new_instance['apple_image_url'] ) ) ? strip_tags( $new_instance['apple_image_url'] ) : '';

    $instance['window_url'] = ( ! empty( $new_instance['window_url'] ) ) ? strip_tags( $new_instance['window_url'] ) : '';
    $instance['window_image_url'] = ( ! empty( $new_instance['window_image_url'] ) ) ? strip_tags( $new_instance['window_image_url'] ) : '';

    return $instance;

    }

} // Class Miraculous_Widget_Gplay ends here


// Creating the widget 
class Miraculous_Widget_Social_Links extends WP_Widget {

function __construct() {

    parent::__construct(
           'miraculous_widget_social_links', // Base ID of your widget
           esc_html__('Social Buttons', 'miraculous'), // Widget name will appear in UI
           array( 'description' => __( 'Social button widget', 'miraculous' ), ) // Widget description
        );

}
 
public function widget( $args, $instance ) {

    $facebook_url = apply_filters( 'widget_facebook_url', $instance['facebook_url'] );

    $linkedin_url = apply_filters( 'widget_linkedin_url', $instance['linkedin_url'] );

    $twitter_url = apply_filters( 'widget_twitter_url', $instance['twitter_url'] );

    $google_plus_url = apply_filters( 'widget_google_plus_url', $instance['google_plus_url'] );

    // before and after widget arguments are defined by themes

    echo __($args['before_widget']); ?>

    <div class="foo_sharing">
         <div class="share_title">
		  <?php esc_html_e( 'follow us :','miraculous'); ?>
		</div>
         <ul>
          <?php if ( ! empty( $facebook_url ) ) { ?>
               <li><a href="<?php echo esc_url($facebook_url); ?>"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
          <?php } if( ! empty( $linkedin_url ) ) { ?>
              <li><a href="<?php echo esc_url($linkedin_url); ?>"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
          <?php } if( ! empty( $twitter_url ) ) { ?>
               <li><a href="<?php echo esc_url($twitter_url); ?>"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
          <?php } if( ! empty( $google_plus_url ) ) { ?>
               <li><a href="<?php echo esc_url($google_plus_url); ?>"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
          <?php } ?>
         </ul>
  </div>
<?php 
echo __($args['after_widget']);

}

// Widget Backend 

public function form( $instance ) {
    $facebook_url = '';
    if ( isset( $instance[ 'facebook_url' ] ) ) {
        $facebook_url = $instance[ 'facebook_url' ];
    }
    $linkedin_url = '';
    if ( isset( $instance[ 'linkedin_url' ] ) ) {
        $linkedin_url = $instance[ 'linkedin_url' ];
    }
    $twitter_url = '';
    if ( isset( $instance[ 'twitter_url' ] ) ) {
        $twitter_url = $instance[ 'twitter_url' ];
    }
    $google_plus_url = '';
    if ( isset( $instance[ 'google_plus_url' ] ) ) {
        $google_plus_url = $instance[ 'google_plus_url' ];
    }

?>

<p>
    <label for="<?php echo esc_attr($this->get_field_id( 'facebook_url' )); ?>"><?php _e( 'Facebook Url:' ); ?></label> 
    <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'facebook_url' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'facebook_url' )); ?>" type="text" value="<?php echo esc_attr( $facebook_url ); ?>" />
</p>
<p>
    <label for="<?php echo esc_attr($this->get_field_id( 'linkedin_url' )); ?>"><?php _e( 'LinkedIn Url:' ); ?></label> 
    <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'linkedin_url' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'linkedin_url' )); ?>" type="text" value="<?php echo esc_attr( $linkedin_url ); ?>" />
</p>
<p>
    <label for="<?php echo esc_attr($this->get_field_id( 'twitter_url' )); ?>"><?php _e( 'Twitter Url:' ); ?></label> 
    <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'twitter_url' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'twitter_url' )); ?>" type="text" value="<?php echo esc_attr( $twitter_url ); ?>" />
</p>
<p>
    <label for="<?php echo esc_attr($this->get_field_id( 'google_plus_url' )); ?>"><?php _e( 'Instagram Url:' ); ?></label> 
    <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'google_plus_url' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'google_plus_url' )); ?>" type="text" value="<?php echo esc_attr( $google_plus_url ); ?>" />
</p>

<?php 

}

// Updating widget replacing old instances with new

public function update( $new_instance, $old_instance ) {

    $instance = array();

    $instance['facebook_url'] = ( ! empty( $new_instance['facebook_url'] ) ) ? strip_tags( $new_instance['facebook_url'] ) : '';

    $instance['linkedin_url'] = ( ! empty( $new_instance['linkedin_url'] ) ) ? strip_tags( $new_instance['linkedin_url'] ) : '';

    $instance['twitter_url'] = ( ! empty( $new_instance['twitter_url'] ) ) ? strip_tags( $new_instance['twitter_url'] ) : '';

    $instance['google_plus_url'] = ( ! empty( $new_instance['google_plus_url'] ) ) ? strip_tags( $new_instance['google_plus_url'] ) : '';

    return $instance;

    }

} 

// Creating the widget 
class Miraculous_Widget_Address_Block extends WP_Widget {

    function __construct() {
    
        parent::__construct(
              'miraculous_widget_address_block', // Base ID of your widget
               esc_html__('Address Block', 'miraculous'), // Widget name will appear in UI
               array( 'description' => __( 'Shows Addess, Emails and phone number', 'miraculous' ), ) // Widget description
             );
    
    }

    public function widget( $args, $instance ) {
    $address_widget_title = '';
	if(isset($instance['address_widget_title'])):
	   $address_widget_title = $instance['address_widget_title'];
	endif;
	$call_title = '';
	if(isset($instance['call_title'])):
	   $call_title = $instance['call_title'];
	endif;
	$call_desc = '';
	if(isset($instance['call_desc'])):
	   $call_desc = $instance['call_desc'];
	endif;
	$email_title = '';
	if(isset($instance['email_title'])):
	   $email_title = $instance['email_title'];
	endif;
	$email_desc = '';
	if(isset($instance['email_desc'])):
	   $email_desc = $instance['email_desc'];
	endif;
	$walkin_title = '';
	if(isset($instance['walkin_title'])):
	   $walkin_title = $instance['walkin_title'];
	endif;
	$walkin_desc = '';
	if(isset($instance['walkin_desc'])):
	   $walkin_desc = $instance['walkin_desc'];
	endif;
    
    $phone_icone = '';
    $phone_icone = get_template_directory_uri().'/assets/images/svg/phone.svg';
    $message_icone = '';
    $message_icone = get_template_directory_uri().'/assets/images/svg/message.svg';
    
    echo __($args['before_widget']);
    ?>
    <div class="footer_box footer_contacts">
    <h1 class="footer_title"><?php echo esc_html($address_widget_title); ?></h1>
        <ul class="foo_con_info">
            <li>
                <div class="foo_con_icon">
                   <img src="<?php echo esc_url($phone_icone); ?>" alt="<?php esc_attr_e('phone','miraculous'); ?>">
                </div>
                <?php if ( ! empty( $call_title ) ) { ?>
                    <div class="foo_con_data">
                        <span class="con-title">
    					<?php printf( __('%s :', 'miraculous'), $call_title ); ?></span>
                        <span><?php echo esc_html($call_desc); ?></span>
                    </div>
                <?php } ?>
            </li>
            <li>
                <div class="foo_con_icon">
                    <img src="<?php echo esc_url($message_icone); ?>" alt="<?php esc_attr_e('message','miraculous'); ?>">
                </div>
                <?php if ( ! empty( $email_title ) ) { ?>
                    <div class="foo_con_data">
                        <span class="con-title">
    					<?php printf( __('%s :', 'miraculous'), $email_title ); ?></span>
                        <span>
                            <?php $emails = explode(',', $email_desc); 
                            if($emails){
                                foreach ($emails as $email) { ?>
                                    <a href="javascript:;"><?php echo esc_html($email); ?></a>,
                                <?php }
                            } ?>
                        </span>
                    </div>
                <?php } ?>
            </li>
            <li>
                <div class="foo_con_icon">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/svg/add.svg" alt="">
                </div>
                <div class="foo_con_data">
                    <span class="con-title"><?php printf( __('%s :', 'miraculous'), $walkin_title ); ?></span>
                    <span><?php echo esc_html($walkin_desc); ?></span>
                </div>
            </li>
        </ul>
    </div>
    <?php
    echo __($args['after_widget']);
    
    }

    public function form( $instance ) {
    $address_widget_title = '';
    if( isset( $instance['address_widget_title'] ) ) {
        $address_widget_title = $instance[ 'address_widget_title' ];
    }
    $call_title = '';
    $call_desc = '';
    if ( isset( $instance[ 'call_title' ] ) ) {
        $call_title = $instance[ 'call_title' ];
        $call_desc = $instance[ 'call_desc' ];
    }
    $email_title = '';
    $email_desc = '';
    if ( isset( $instance[ 'email_title' ] ) ) {
        $email_title = $instance[ 'email_title' ];
        $email_desc = $instance[ 'email_desc' ];
    }
    $walkin_title = '';
    $walkin_desc = '';
    if ( isset( $instance[ 'walkin_title' ] ) ) {
        $walkin_title = $instance[ 'walkin_title' ];
        $walkin_desc = $instance[ 'walkin_desc' ];
    }
    
    ?>
    
    <p>
        <label for="<?php echo esc_attr($this->get_field_id( 'address_widget_title' )); ?>">
    	<?php esc_html_e( 'Title:','miraculous'); ?></label> 
    
        <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'address_widget_title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'address_widget_title' )); ?>" type="text" value="<?php echo esc_attr( $address_widget_title ); ?>" />
    </p>
    
    <p>
        <label for="<?php echo esc_attr($this->get_field_id( 'call_title' )); ?>">
    	<?php esc_html_e( 'Call Us:','miraculous'); ?></label> 
    
        <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'call_title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'call_title' )); ?>" type="text" value="<?php echo esc_attr( $call_title ); ?>" placeholder="Title" />
    
        <label for="<?php echo esc_attr($this->get_field_id( 'call_title' )); ?>">
    	<?php esc_html_e( 'Info:','miraculous'); ?></label> 
    
        <textarea class="widefat" id="<?php echo esc_attr($this->get_field_id( 'call_desc' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'call_desc' )); ?>">
    	<?php echo esc_html( $call_desc ); ?></textarea>
    </p>
    
    <p>
        <label for="<?php echo esc_attr($this->get_field_id( 'email_title' )); ?>">
    	<?php esc_html_e( 'Email Us:','miraculous'); ?></label> 
    
        <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'email_title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'email_title' )); ?>" type="text" value="<?php echo esc_attr( $email_title ); ?>" placeholder="Title" />
    
        <label for="<?php echo esc_attr($this->get_field_id( 'email_desc' )); ?>">
    	<?php esc_html_e( 'Info: (For multiple emails enter with (,) saparated)','miraculous'); ?></label> 
    
        <textarea class="widefat" id="<?php echo esc_attr($this->get_field_id( 'email_desc' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'email_desc' )); ?>"><?php echo esc_html( $email_desc ); ?></textarea>
    </p>
    
    <p>
        <label for="<?php echo esc_attr($this->get_field_id( 'walkin_title' )); ?>">
    	<?php esc_html_e( 'Walk In:','miraculous'); ?></label> 
    
        <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'walkin_title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'walkin_title' )); ?>" type="text" value="<?php echo esc_attr( $walkin_title ); ?>" placeholder="Title" />
    
        <label for="<?php echo esc_attr($this->get_field_id( 'walkin_desc' )); ?>"><?php esc_html_e( 'Info:','miraculous'); ?></label> 
    
        <textarea class="widefat" id="<?php echo esc_attr($this->get_field_id( 'walkin_desc' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'walkin_desc' )); ?>"><?php echo esc_html( $walkin_desc ); ?></textarea>
    </p>
    
    <?php 
    
    }

    public function update( $new_instance, $old_instance ) {
    
        $instance = array();
    
        $instance['address_widget_title'] = ( ! empty( $new_instance['address_widget_title'] ) ) ? strip_tags( $new_instance['address_widget_title'] ) : '';
    
        $instance['call_title'] = ( ! empty( $new_instance['call_title'] ) ) ? strip_tags( $new_instance['call_title'] ) : '';
        $instance['call_desc'] = ( ! empty( $new_instance['call_desc'] ) ) ? strip_tags( $new_instance['call_desc'] ) : '';
    
        $instance['email_title'] = ( ! empty( $new_instance['email_title'] ) ) ? strip_tags( $new_instance['email_title'] ) : '';
        $instance['email_desc'] = ( ! empty( $new_instance['email_desc'] ) ) ? strip_tags( $new_instance['email_desc'] ) : '';
    
        $instance['walkin_title'] = ( ! empty( $new_instance['walkin_title'] ) ) ? strip_tags( $new_instance['walkin_title'] ) : '';
        $instance['walkin_desc'] = ( ! empty( $new_instance['walkin_desc'] ) ) ? strip_tags( $new_instance['walkin_desc'] ) : '';
    
        return $instance;
    
        }

} 

// Creating the widget 
class Miraculous_Widget_Newsletter extends WP_Widget {

    function __construct() {
    
        parent::__construct(
              'miraculous_widget_newsletter',  // Base ID of your widget
              esc_html__('Subscriber Newsletter', 'miraculous'), // Widget name will appear in UI
              array( 'description' => __( 'Subscriber Newsletter widget', 'miraculous' ), ) // Widget description
            );
    
    }

    public function widget( $args, $instance ) {
        $nstitle = '';
        if(isset($instance['nstitle'])):
        	   $nstitle = $instance['nstitle'];
        endif;
        $nsdescription = '';
        if(isset($instance['nsdescription'])):
        	   $nsdescription = $instance['nsdescription'];
        endif;
    
        echo $args['before_widget'];
    
        if ( ! empty( $nstitle ) ) { ?>
            <div class="footer_box footer_subscribe">
                <h1 class="footer_title"><?php echo esc_html($nstitle); ?></h1>
                <p><?php echo esc_html( $nsdescription ); ?></p>
                <p class="ns_form_msg"></p>
                <form id="newsletter_form" method="post">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="<?php esc_attr_e('Enter Your Name','miraculous');?>" name="user_name" id="ns_user">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="<?php esc_attr_e('Enter Your Email','miraculous');?>" name="user_email" id="ns_email">
                    </div>
                    <div class="form-group">
                        <input type="submit" name="newsletter_sign" id="newsletter_sign" class="ms_btn" value="<?php esc_attr_e('sign me up','miraculous'); ?>">
                        <button class="hst_loader"><i class="fa fa-circle-o-notch fa-spin"></i> <?php esc_html_e('Loading', 'miraculous'); ?></button>
                    </div>
                </form>
            </div>
    
        <?php }
    
        echo $args['after_widget'];
    
    }

    public function form( $instance ) {
        $nstitle = '';
        if ( isset( $instance[ 'nstitle' ] ) ) {
            $nstitle = $instance[ 'nstitle' ];
        }
        $nsdescription = '';
        if ( isset( $instance[ 'nsdescription' ] ) ) {
            $nsdescription = $instance[ 'nsdescription' ];
        }
    
        // Widget admin form
    
        ?>
    
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'nstitle' )); ?>">
    		<?php esc_html_e( 'Title:','miraculous'); ?></label> 
    
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'nstitle' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'nstitle' )); ?>" type="text" value="<?php echo esc_attr( $nstitle ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'nsdescription' )); ?>">
    		<?php esc_html_e( 'Content:','miraculous'); ?></label> 
    
            <textarea class="widefat" id="<?php echo esc_attr($this->get_field_id( 'nsdescription' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'nsdescription' )); ?>" rows="5"><?php echo esc_html( $nsdescription ); ?></textarea>
        </p>
        <?php 
    
    }

    public function update( $new_instance, $old_instance ) {
    
        $instance = array();
        $instance['nstitle'] = ( ! empty( $new_instance['nstitle'] ) ) ? strip_tags( $new_instance['nstitle'] ) : '';
        $instance['nsdescription'] = ( ! empty( $new_instance['nsdescription'] ) ) ? strip_tags( $new_instance['nsdescription'] ) : '';
    
        return $instance;
    }

} 

class Miraculous_Widget_Tracks extends WP_Widget {

    function __construct() {
    
        parent::__construct(
               'miraculous_widget_tracks', // Base ID of your widget
               esc_html__('Tracks', 'miraculous'), // Widget name will appear in UI
               array( 'description' => __( 'Tracks widget', 'miraculous' ), ) // Widget description
             );
    
    }

    function widget($args, $instance) {
    
        extract($args);
        $title = apply_filters('widget_title', empty($instance['title']) ? esc_html__('Tracks','miraculous') : $instance['title'], $instance, $this->id_base);
        if( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) )
            $number = 10;
        $r = new WP_Query(
                        array( 'post_type' => 'ms-music',
                               'posts_per_page' => $number, 
                               'no_found_rows' => true,
                               'post_status' => 'publish',
                               'orderby' => 'rand',
                               'order' => 'DESC',
                               'ignore_sticky_posts' => true ) );
        if($r->have_posts() ) :
            echo $args['before_widget']; ?>
            
            <h2 class="widget-title"><?php echo esc_html($title); ?></h2>
            <ul>
                <?php while( $r->have_posts() ) : $r->the_post(); ?>  
                <li>
                    <div class="recent_cmnt_img">
                        <?php the_post_thumbnail(array(50,50)); ?>
                    </div>
                    <div class="recent_cmnt_data">
                        <h4><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute( 'echo=0' ); ?>"><?php the_title(); ?></a></h4>
                        <span><?php echo get_the_date( 'd F Y'); ?></span>
                    </div>
                </li>
                <?php endwhile; ?>
            </ul>
             
            <?php
            echo $args['after_widget'];
            wp_reset_postdata();
        
        endif;
    }

    public function form( $instance ) {
        $title = '';
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        }
        $number = '';
        if ( isset( $instance[ 'number' ] ) ) {
            $number = $instance[ 'number' ];
        }
    
        // Widget admin form
    
        ?>
    
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>">
            <?php esc_html_e( 'Title:','miraculous'); ?></label> 
    
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'number' )); ?>"><?php esc_html_e('Number of posts to show:', 'miraculous'); ?></label>
            <input class="tiny-text" id="<?php echo esc_attr($this->get_field_id( 'number' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'number' )); ?>" type="number" step="1" min="1" value="5" size="3">
        </p>
        <?php 
    
    }

    public function update( $new_instance, $old_instance ) {
    
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['number'] = ( ! empty( $new_instance['number'] ) ) ? strip_tags( $new_instance['number'] ) : '';
    
        return $instance;
    }

} 
?>