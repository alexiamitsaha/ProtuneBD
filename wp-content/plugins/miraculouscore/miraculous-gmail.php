<?php
//session_start();
require_once ('libraries/Google/autoload.php');
class Miraculous_google_api_app_details{
	function __construct() {
		
		$miraculous_theme_data = '';
	    if( function_exists('fw_get_db_settings_option') ):
	    	$miraculous_theme_data = fw_get_db_settings_option();
	    endif;

	    $google_login_client_id = '';
	    if( !empty($miraculous_theme_data['google_login_client_id']) ):
	    	$google_login_client_id = $miraculous_theme_data['google_login_client_id'];
	    endif;

	    $google_login_client_secret = '';
	    if( !empty($miraculous_theme_data['google_login_client_secret']) ):
	    	$google_login_client_secret = $miraculous_theme_data['google_login_client_secret'];
	    endif;

	    $google_login_redirect_uri = '';
	    if( !empty($miraculous_theme_data['google_login_redirect_uri']) ):
	    	$google_login_redirect_uri = $miraculous_theme_data['google_login_redirect_uri'];
	    endif;

		$this->client_id = $google_login_client_id;
		$this->client_secret = $google_login_client_secret;
		$this->redirect_uri = $google_login_redirect_uri;
			
	}	
}
add_action('wp_logout','miraculous_google_login_clear_session');
function miraculous_google_login_clear_session(){
	unset($_SESSION['access_token']);
	wp_redirect( home_url() );
	
}
add_action('init', 'miraculous_goole_login');
function miraculous_goole_login($google_login_button=false){

if (isset($_GET['logout'])) {
	unset($_SESSION['access_token']);	
}
// Google Service call
$api_service_deatils = new Miraculous_google_api_app_details();
$client = new Google_Client();
$client->setClientId($api_service_deatils->client_id);
$client->setClientSecret($api_service_deatils->client_secret);
$client->setRedirectUri($api_service_deatils->redirect_uri);
$client->addScope("email");
$client->addScope("profile");

$service = new Google_Service_Oauth2($client);

		if (isset($_GET['code'])) {			
			if (strval($_SESSION['state']) !== strval($_GET['state'])) {
				
			  die("The session state ({$_SESSION['state']}) didn't match the state parameter ({$_GET['state']})");
			}
			try {
				$client->authenticate($_GET['code']);
				$_SESSION['access_token'] = $client->getAccessToken();
			} catch (Exception $e) {
				  unset($_SESSION['access_token']);			  
				  print "<p class='error'>Invalid API Credentials!<p>\n";			  
				  wp_redirect( site_url() );
				  exit();
			}
		}

		if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
			$client->setAccessToken($_SESSION['access_token']);
		} else {
			$authUrl = $client->createAuthUrl();
		}
//if token then grab data
	  if ($client->getAccessToken()) {
		  
		//Check if user exists and/or create
		if (isset($_GET['code'])) {
		  try {
			$user = $service->userinfo->get();
		  } catch (Exception $e) {
			  unset($_SESSION['access_token']);
			  print "<p class='error'>Invalid Google Account!<p>\n";
			  wp_redirect( site_url() );
			  exit();
		  }
		  //Get or Create User			
			$user = $service->userinfo->get();					
			$users = get_user_by( 'email', $user->email );
			$user_id = $users->ID;	
			$ms_user_name=$user->name;
			$ms_user_name_arr=explode(" ",$ms_user_name);
			$ms_user_name=$ms_user_name_arr[0];			
			$ms_user_fisrtname=sanitize_user( $ms_user_name_arr[0] );
			$ms_user_lastname=sanitize_user( $ms_user_name_arr[1] );
			$ms_user_name=sanitize_user( $ms_user_name );
			$ms_user_name=str_replace(array(" ","."),"",$ms_user_name);
			$ms_user_name_check = username_exists( $ms_user_name );
			
		  if($user_id){	
		  
					$users = get_user_by( 'id', $user_id ); 
					$users = get_user_by('login',$users->user_login);		
					update_user_meta( $user_id, 'googleplus_access_token', $user->id );
					update_user_meta( $user_id, 'user_profile_img', $user->picture );
					update_user_meta( $user_id, 'googleplus_display_name', $user->name );
					update_user_meta( $user_id, 'first_name', $ms_user_fisrtname );
					update_user_meta( $user_id, 'last_name', $ms_user_lastname );
		  }		
		 else{					
					
					
					if ( $ms_user_name_check ) { 
					$ms_user_name=$ms_user_name_arr[1];
					$ms_user_name=sanitize_user( $ms_user_name );
					$ms_user_name=str_replace(array(" ","."),"",$ms_user_name);
					$ms_user_name_check = username_exists( $ms_user_name );
					}
					if ( $ms_user_name_check ) { 
					$ms_user_name=$user->name;;
					$ms_user_name=sanitize_user( $ms_user_name );
					$ms_user_name=str_replace(array(" ","."),"",$ms_user_name);
					$ms_user_name_check = username_exists( $ms_user_name );
					}
					if ( $ms_user_name_check ) { 
					$ms_user_name=$ms_user_name_arr[0];
					$ms_user_name=sanitize_user( $ms_user_name );
					$ms_user_name=str_replace(array(" ","."),"",$ms_user_name);
					$ms_user_name=$ms_user_name.rand(100, 999);
					$ms_user_name_check = username_exists( $ms_user_name );
					}
					if ( !$ms_user_name_check and email_exists($user->email) == false ) {
						$random_password = wp_generate_password( $length=12, $include_standard_special_chars=false );
						$user_id = wp_create_user( $ms_user_name, $random_password, $user->email );
						$users = get_user_by( 'id', $user_id );							
						update_user_meta( $user_id, 'googleplus_access_token', $user->id );
						update_user_meta( $user_id, 'user_profile_img', $user->picture );
						update_user_meta( $user_id, 'googleplus_display_name', $user->name );
						update_user_meta( $user_id, 'first_name', $ms_user_fisrtname );
						update_user_meta( $user_id, 'last_name', $ms_user_lastname );
					}			
		  }
		  //login user and redirect
			 wp_set_current_user( $user_id, $users->user_login );
			 wp_set_auth_cookie( $user_id, false, is_ssl() );
			 wp_redirect( site_url() );
			  exit();
		  
		}
		if (isset($_GET['code'])) {
		  $_SESSION['access_token'] = $client->getAccessToken();
		}
	  }
	  
	   //display Google Login button
	  if ($google_login_button==true) {		 
		
		if(is_user_logged_in()){
			 $user_id = get_current_user_id();
			 $user_profile_img = get_user_meta ( $user_id,'user_profile_img', true );
			 $ms_display_name = get_user_meta ( $user_id,'googleplus_display_name', true );
		}else{
			if (!$client->getAccessToken()) 
			{			
				if(isset($_SESSION['state']) && $_SESSION['state']){
				  $state=$_SESSION['state'];
				}else{
				  $state = mt_rand();
				}
				$client->setState($state);
				$_SESSION['state'] = $state;
				$authUrl = $client->createAuthUrl();
				
				if($api_service_deatils->client_id ){			
				?>
					<div class="save_modal_btn">
						<a href="<?php echo esc_url($authUrl); ?>">
						 <i class="fa fa-google-plus" aria-hidden="true"></i> 
						 <?php echo esc_html_e('continue with google', 'miraculous'); ?>
						</a>
					</div>
				<?php
				}
			}			
		}	
		
	  }
}
add_action('login_form', 'miraculous_gplus_login_button_add');
function miraculous_gplus_login_button_add(){
	miraculous_goole_login(true);
}
//short code
add_shortcode( 'miraculos_google_button', 'miraculous_gplus_login_button_add_shortcode' );
function miraculous_gplus_login_button_add_shortcode( $atts ) {
	ob_start();
	miraculous_goole_login(true);
	$output = ob_get_contents();;
	ob_end_clean();
	return $output;
}