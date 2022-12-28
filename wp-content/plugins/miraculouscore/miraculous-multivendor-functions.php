<?php
/**
* Miraculous Role Add
* Function Create: 27-01-2021
* @create:  @update: @an
**/

/**
 * custom role set
 */
add_action('init', 'mirac_custom_userrole');
function mirac_custom_userrole()
{ 
 global $wp_roles;
 if (!isset($wp_roles))
 $wp_roles = new WP_Roles();
 $subs = $wp_roles->get_role('subscriber');
 // Adding a new role with all admin caps.
 $wp_roles->add_role('artist', 'Artist', $subs->capabilities);
 $wp_roles->add_role('listener', 'Listener', $subs->capabilities);
} 

/**
 * mira custom functions 
 */ 
require_once 'miraculous-multivendor-customs-functions.php';
 
//require get_stylesheet_directory().'/miracustom/mira-customs-functions.php';


function add_graph_data( $songsId='', $activity_types='', $count='')
	{ 
		$user_id =get_current_user_id();
		global $wpdb;
		$data = array();
		
		if(!empty($songsId)){
			$data['post_id']= $songsId;
			$added_id = get_post_field( 'post_author', $songsId );
		}
		if(!empty($added_id)){
			$data['added_id']= $added_id;
		}
		if(!empty($user_id)){
			$data['user_id']= $user_id;
		}
		if(!empty($activity_types)){
			$data['activity_types']= $activity_types;
		}
		if(!empty($count)){
			$data['count_type']= $count;
		}
		
		if($activity_types=="tracks_song_purchase_count" || $activity_types=="albums_song_purchase_count"){
			$user_gender =get_user_meta($user_id,'user_gender');
			if(!empty($user_gender)){
				if($user_gender=="male"){
					$user_data['male']=1;
				}else{
					$user_data['female']=1;
				}
			}
			
			$user_ageGroup =get_user_meta($user_id,'user_ageGroup');
			if(!empty($user_ageGroup)){
				if($user_ageGroup===25){
					$user_data['age_25']=1;
				}else if($user_ageGroup===30){
					$user_data['age_30']=1;
				}else if($user_ageGroup===35){
					$user_data['age_35']=1;
				}else if($user_ageGroup===40){
					$user_data['age_40']=1;
				}else if($user_ageGroup===45){
					$user_data['age_45']=1;
				}else if($user_ageGroup===50){
					$user_data['age_50']=1;
				}else if($user_ageGroup===55){
					$user_data['age_55']=1;
				}else if($user_ageGroup===60){
					$user_data['age_60']=1;
				}else if($user_ageGroup===65){
					$user_data['age_65']=1;
				}else if($user_ageGroup===70){
					$user_data['age_70']=1;
				}else if($user_ageGroup===75){
					$user_data['age_75']=1;
				}else if($user_ageGroup===80){
					$user_data['age_80']=1;
				}
			}
			
			
			$update_date = date('Y-m-d');
			$checkData = $wpdb->get_results("SELECT id, post_id,count_type FROM wp_graph_managed_user_data WHERE update_date= '$update_date' AND added_id='$added_id'");
			
			if(!empty($checkData)){
				$countUp =$checkData[0]->count_type+1;
				$id =$checkData[0]->id;
				
				if(!empty($user_gender)){
					if($user_gender=="male"){
						$Updata['male'] =$checkData[0]->male+1;
					}else{
						
						$Updata['female'] =$checkData[0]->female+1;
					}
				}
				
				if(!empty($user_ageGroup)){
					if($user_ageGroup===25){
						$Updata['age_25'] =$checkData[0]->age_25+1;
					}else if($user_ageGroup===30){
						$Updata['age_30'] =$checkData[0]->age_30+1;
					}else if($user_ageGroup===35){
						$Updata['age_35'] =$checkData[0]->age_35+1;
					}else if($user_ageGroup===40){
						$Updata['age_40'] =$checkData[0]->age_40+1;
					}else if($user_ageGroup===45){
						$Updata['age_45'] =$checkData[0]->age_45+1;
					}else if($user_ageGroup===50){
						$Updata['age_50'] =$checkData[0]->age_50+1;
					}else if($user_ageGroup===55){
						$Updata['age_55'] =$checkData[0]->age_55+1;
					}else if($user_ageGroup===60){
						$Updata['age_60'] =$checkData[0]->age_60+1;
					}else if($user_ageGroup===65){
						$Updata['age_65'] =$checkData[0]->age_65+1;
					}else if($user_ageGroup===70){
						$Updata['age_70'] =$checkData[0]->age_70+1;
					}else if($user_ageGroup===75){
						$Updata['age_75'] =$checkData[0]->age_75+1;
					}else if($user_ageGroup===80){
						$Updata['age_80'] =$checkData[0]->age_80+1;
					}
				}
				$Updata['userIds']=$checkData[0]->userIds.','.$user_id;
				$wpdb->update( $wpdb->graph_managed_user_data, $Updata, array("id" => $id), array("%s"), array("%d"));
			}else{
				
				$user_data['userIds']=$user_id;
				$user_data['added_id']=$added_id;
				$table = $wpdb->prefix.'graph_managed_user_data';
				$format = array('%s','%d');
				$wpdb->insert($table,$user_data,$format);
				$my_id = $wpdb->insert_id;
			}
		}
		
		$postTypN = get_post_type($songsId);
		if($postTypN=="ms-albums"){
			if($activity_types=="tracks_song_views_count"){
				$activity_types=="albums_song_views_count";
			}else if($activity_types=="tracks_song_download_count"){
				$activity_types=="albums_song_download_count";
			}else if($activity_types=="tracks_song_purchase_count"){
				$activity_types=="albums_song_purchase_count";
			}
		}
		
		
		$update_date = date('Y-m-d');
		$checkData = $wpdb->get_results("SELECT id, user_id, post_id,count_type FROM wp_graph_managed WHERE added_id='$added_id' AND activity_types = '$activity_types' AND update_date= '$update_date'");
		
		if(!empty($checkData)){
			$countUp =$checkData[0]->count_type+1;
			$id =$checkData[0]->id;
			$uid =$checkData[0]->user_id.','.$user_id;
			$Updatass['count_type']=$countUp;
			$Updatass['user_id']=$uid;
			$wpdb->update( $wpdb->graph_managed, $Updatass, array("id" => $id), array("%s"), array("%d"));
		}else{
			$data['update_date']= $update_date;
			$table = $wpdb->prefix.'graph_managed';
			$format = array('%s','%d');
			$wpdb->insert($table,$data,$format);
			$my_id = $wpdb->insert_id;
		}


		if($activity_types=='albums_song_purchase_count' || $activity_types=='tracks_song_purchase_count'){
			$update_date = date('Y-m-d');
			$checkData = $wpdb->get_results("SELECT id, user_id , post_id,count_type FROM wp_graph_managed WHERE added_id='$added_id' AND activity_types = 'all_subscribers_users' AND update_date= '$update_date'");
			
			if(!empty($checkData)){
				$countUp =$checkData[0]->count_type+1;
				$id =$checkData[0]->id;
				$uid =$checkData[0]->user_id.','.$user_id;
				$Updatass['count_type']=$countUp;
				$Updatass['user_id']=$uid;
				$wpdb->update( $wpdb->graph_managed, $Updatass, array("id" => $id), array("%s"), array("%d"));
			}else{
				$data['activity_types']= 'all_subscribers_users';
				$data['update_date']= $update_date;
				$table = $wpdb->prefix.'graph_managed';
				$format = array('%s','%d');
				$wpdb->insert($table,$data,$format);
				$my_id = $wpdb->insert_id;
			}
		}
	}
	add_action( 'wp_ajax_get_all_data', 'get_all_data');
	add_action( 'wp_ajax_nopriv_get_all_data', 'get_all_data');
	function get_all_data(){
		$user_id =get_current_user_id();
		global $wpdb;
		$allData=array();
		$tracks_song_download_count = $wpdb->get_results("select count_type,update_date from wp_graph_managed where added_id=$user_id AND activity_types='tracks_song_download_count'");
		$tracksDowCount=0;
		foreach($tracks_song_download_count as $value){
          $tracksDowCount+=$value->count_type;
		}
		$allData['tracks_song_download_count']=$tracksDowCount;

		$tracks_song_views_count = $wpdb->get_results("select count_type,update_date from wp_graph_managed where added_id=$user_id AND activity_types='tracks_song_views_count'");
        $tracksViewsCount=0;
		foreach($tracks_song_views_count as $value){
          $tracksViewsCount+=$value->count_type;
		}
		$allData['tracks_song_views_count']=$tracksViewsCount;

		$tracks_song_purchase_count = $wpdb->get_results("select count_type,update_date from wp_graph_managed where added_id=$user_id AND activity_types='tracks_song_purchase_count'");
		$tracksPurchaseCount=0;
		foreach($tracks_song_purchase_count as $value){
          $tracksPurchaseCount+=$value->count_type;
		}
		$allData['tracks_song_purchase_count']=$tracksPurchaseCount;

		$tracks_song_listen_count = $wpdb->get_results("select count_type,update_date from wp_graph_managed where added_id=$user_id AND activity_types='tracks_song_listen_count'");
		$tracksListenCount=0;
		foreach($tracks_song_listen_count as $value){
          $tracksListenCount+=$value->count_type;
		}
		$allData['tracks_song_listen_count']=$tracksListenCount;
		
		$albums_song_views_count = $wpdb->get_results("select count_type,update_date from wp_graph_managed where added_id=$user_id AND activity_types='albums_song_views_count'");
		$albumsViewsCount=0;
		foreach($albums_song_views_count as $value){
          $albumsViewsCount+=$value->count_type;
		}
		$allData['albums_song_views_count']=$albumsViewsCount;
		
		$albums_song_purchase_count = $wpdb->get_results("select count_type,update_date from wp_graph_managed where added_id=$user_id AND activity_types='albums_song_purchase_count'");
        $albumsPurchaseCount=0;
		foreach($albums_song_purchase_count as $value){
          $albumsPurchaseCount+=$value->count_type;
		}
		$allData['albums_song_purchase_count']=$albumsPurchaseCount;

		$albums_song_download_count = $wpdb->get_results("select count_type,update_date from wp_graph_managed where added_id=$user_id AND activity_types='albums_song_download_count'");
		$albumsDoweCount=0;
		foreach($albums_song_download_count as $value){
          $albumsDoweCount+=$value->count_type;
		}
		$allData['albums_song_download_count']=$albumsDoweCount;

		$allSubscribers = $wpdb->get_results("select count_type,update_date from wp_graph_managed where added_id=$user_id AND activity_types='all_subscribers_users'");

		$allSubscribersCount=0;
		foreach($allSubscribers as $value){
          $allSubscribersCount+=$value->count_type;
		}
		$allData['allSubscribers']=$allSubscribersCount;
		
		$allMale = $wpdb->get_results("select * from wp_graph_managed_user_data where added_id=$user_id AND male>0");
        $allMaleCount=0;
		foreach($allMale as $value){
          $allMaleCount+=$value->male;
		}
		$allData['allSubMale']=$allMaleCount;

		$allfeMale = $wpdb->get_results("select * from wp_graph_managed_user_data where added_id=$user_id AND female>0");
		$allfeMaleCount=0;
		foreach($allMale as $value){
          $allfeMaleCount+=$value->female;
		}
		$allData['allSubfeMale']=$allfeMaleCount;

		$data = array('status' => 'true', 'deta' => $allData);
		echo json_encode($data);
		die();
	}

	add_action( 'wp_ajax_get_data_graph', 'get_data_graph');
	add_action( 'wp_ajax_nopriv_get_data_graph', 'get_data_graph');
	function get_data_graph(){
		$user_id =get_current_user_id();
		global $wpdb;
		if(!empty($_POST['graph_type']) && !empty($_POST['data_view_type'])){
			 $view_t =$_POST['graph_type'];	
		
			if($_POST['data_view_type']=='day'){	
			   
				$dataDay = $wpdb->get_results("select count_type,update_date from wp_graph_managed where added_id=$user_id AND activity_types='$view_t' AND created >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)");
			   
				$countday =count($dataDay);
				$viewc =array();
				$viewdate =array();
				$lastDate =array();
				
				
				if(!empty($dataDay)){
					
					foreach($dataDay as $value){
						array_push($viewc,$value->count_type);
						$dd =date('d M', strtotime($value->update_date));
						array_push($viewdate,$dd);
						array_push($lastDate,$value->update_date);
					}
					if($countday){
						$aa=6-$countday;
						$lastDate = end($lastDate);
						for ($x = 0; $x <= $aa; $x++) {
							$a = $x+1;
							$dd = date ("d M", strtotime("+$a days", strtotime($lastDate)));
							array_push($viewc,"0");
							array_push($viewdate,$dd);
						  }
					}
					$data = array('status' => 'true', 'msg' => 'data views.','viewc'=>$viewc,'viewdate'=>$viewdate);
				}else{
					$viewc =array();
					$viewdate =array();
                    $lastDate =date('y-m-d');
					for ($x = 0; $x < 7; $x++) {
						$a = 6-$x;
						$dd = date ("d M", strtotime("-$a days", strtotime($lastDate)));
						array_push($viewc,"0");
						array_push($viewdate,$dd);
					  }
					$data = array('status' => 'true', 'msg' => 'data views.','viewc'=>$viewc,'viewdate'=>$viewdate);
				}
			}else if($_POST['data_view_type']=='week'){
				
				$dataDay = $wpdb->get_results("select count_type,update_date from wp_graph_managed where added_id=$user_id AND activity_types='$view_t' AND created >= DATE_SUB(CURDATE(), INTERVAL 1 WEEK)");

				$countday =count($dataDay);
				$viewc =array();
				$viewdate =array();
				$lastDate =array();
				if(!empty($dataDay)){
					
					foreach($dataDay as $value){
						array_push($viewc,$value->count_type);
						$dd =date('d M', strtotime($value->update_date));
						array_push($viewdate,$dd);
						array_push($lastDate,$value->update_date);
					}
					if($countday){
						$aa=6-$countday;
						$lastDate = end($lastDate);
						for ($x = 0; $x <= $aa; $x++) {
							$a = $x+1;
							$dd = date ("d M", strtotime("+$a days", strtotime($lastDate)));
							array_push($viewc,"0");
							array_push($viewdate,$dd);
						  }
					}
					$data = array('status' => 'true', 'msg' => 'data views.','viewc'=>$viewc,'viewdate'=>$viewdate);
				}else{
					$viewc =array();
					$viewdate =array();
                    $lastDate =date('y-m-d');
					for ($x = 0; $x < 7; $x++) {
						$a = 6-$x;
						$dd = date ("d M", strtotime("-$a days", strtotime($lastDate)));
						array_push($viewc,"0");
						array_push($viewdate,$dd);
					  }
					$data = array('status' => 'true', 'msg' => 'data views.','viewc'=>$viewc,'viewdate'=>$viewdate);
				}
			}else if($_POST['data_view_type']=='month'){
				
				$dataDay = $wpdb->get_results("select count_type,update_date from wp_graph_managed where added_id=$user_id AND activity_types='$view_t' AND created >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)");
				$countday =count($dataDay);
				$viewc =array();
				$viewdate =array();
				$lastDate =array();
				if(!empty($dataDay)){
					
					foreach($dataDay as $value){
						array_push($viewc,$value->count_type);
						$dd =date('d M', strtotime($value->update_date));
						array_push($viewdate,$dd);
						array_push($lastDate,$value->update_date);
					}
					if($countday){
						$aa=6-$countday;
						$lastDate = end($lastDate);
						for ($x = 0; $x <= $aa; $x++) {
							$a = $x+1;
							$dd = date ("d M", strtotime("+$a days", strtotime($lastDate)));
							array_push($viewc,"0");
							array_push($viewdate,$dd);
						  }
					}
					$data = array('status' => 'true', 'msg' => 'data views.','viewc'=>$viewc,'viewdate'=>$viewdate);
				}else{
					$viewc =array();
					$viewdate =array();
                    $lastDate =date('y-m-d');
					for ($x = 0; $x < 7; $x++) {
						$a = 6-$x;
						$dd = date ("d M", strtotime("-$a days", strtotime($lastDate)));
						array_push($viewc,"0");
						array_push($viewdate,$dd);
					  }
					$data = array('status' => 'true', 'msg' => 'data views.','viewc'=>$viewc,'viewdate'=>$viewdate);
				}
			}else if($_POST['data_view_type']=='year'){
				
				$dataDay = $wpdb->get_results("select count_type,update_date from wp_graph_managed where added_id=$user_id AND activity_types='$view_t' AND created >= DATE_SUB(CURDATE(), INTERVAL 1 YEAR)");
				$countday =count($dataDay);
				$viewc =array();
				$viewdate =array();
				$lastDate =array();
				if(!empty($dataDay)){
				
					foreach($dataDay as $value){
						array_push($viewc,$value->count_type);
						$dd =date('d M', strtotime($value->update_date));
						array_push($viewdate,$dd);
						array_push($lastDate,$value->update_date);
					}
					if($countday){
						$aa=6-$countday;
						$lastDate = end($lastDate);
						for ($x = 0; $x <= $aa; $x++) {
							$a = $x+1;
							$dd = date ("d M", strtotime("+$a days", strtotime($lastDate)));
							array_push($viewc,"0");
							array_push($viewdate,$dd);
						  }
					}
					$data = array('status' => 'true', 'msg' => 'data views.','viewc'=>$viewc,'viewdate'=>$viewdate);
				}else{
					$viewc =array();
					$viewdate =array();
                    $lastDate =date('y-m-d');
					for ($x = 0; $x < 7; $x++) {
						$a = 6-$x;
						$dd = date ("d M", strtotime("-$a days", strtotime($lastDate)));
						array_push($viewc,"0");
						array_push($viewdate,$dd);
					  }
					$data = array('status' => 'true', 'msg' => 'data views.','viewc'=>$viewc,'viewdate'=>$viewdate);
				}
			}else if($_POST['data_view_type']=='costumDate'){
				
				$countday =0;
				$viewc =array();
				$viewdate =array();
				
				$viewc =array();
				$viewdate =array();
				$lastDate =date('y-m-d');
				for ($x = 0; $x < 7; $x++) {
					$a = 6-$x;
					$dd = date ("d M", strtotime("-$a days", strtotime($lastDate)));
					array_push($viewc,"0");
					array_push($viewdate,$dd);
					}
				$data = array('status' => 'true', 'msg' => 'data views.','viewc'=>$viewc,'viewdate'=>$viewdate);
				
			}
		
		}else{
			$data = array('status' => 'false', 'msg' => 'Something went Wrong4.');
		}
		echo json_encode($data);
		die();
	}
	
    add_action('wp_ajax_get_data_graph_date', 'get_data_graph_date');
	add_action('wp_ajax_nopriv_get_data_graph_date', 'get_data_graph_date');
	function get_data_graph_date(){
		$user_id =get_current_user_id();
		global $wpdb;
		if(!empty($_POST['graph_type']) && !empty($_POST['to_date'])){

			$view_t =$_POST['graph_type'];
			$from_date =$_POST['from_date'];
			$to_date =$_POST['to_date'];	
				
			$dataDay = $wpdb->get_results("select count_type,update_date from wp_graph_managed where added_id=$user_id AND activity_types='$view_t' AND created BETWEEN '$from_date' AND '$to_date'");
			$countday =count($dataDay);
			$viewc =array();
			$viewdate =array();
			$lastDate =array();
			
			
			if(!empty($dataDay)){
				
				foreach($dataDay as $value){
					array_push($viewc,$value->count_type);
					$dd =date('d M', strtotime($value->update_date));
					array_push($viewdate,$dd);
					array_push($lastDate,$value->update_date);
				}
				if($countday){
					$aa=6-$countday;
					$lastDate = end($lastDate);
					for ($x = 0; $x <= $aa; $x++) {
						$a = $x+1;
						$dd = date ("d M", strtotime("+$a days", strtotime($lastDate)));
						array_push($viewc,"0");
						array_push($viewdate,$dd);
						}
				}
				$data = array('status' => 'true', 'msg' => 'data views.','viewc'=>$viewc,'viewdate'=>$viewdate);
			}else{
				$viewc =array();
				$viewdate =array();
				$lastDate =date('y-m-d');
				for ($x = 0; $x < 7; $x++) {
					$a = 6-$x;
					$dd = date ("d M", strtotime("-$a days", strtotime($lastDate)));
					array_push($viewc,"0");
					array_push($viewdate,$dd);
					}
				$data = array('status' => 'true', 'msg' => 'data views.','viewc'=>$viewc,'viewdate'=>$viewdate);
			}
		
		}else{
			$data = array('status' => 'false', 'msg' => 'Something went Wrong4.');
		}
		echo json_encode($data);
		die();
	}

	add_action( 'wp_ajax_get_user_data_graph', 'get_user_data_graph');
	add_action( 'wp_ajax_nopriv_get_user_data_graph', 'get_user_data_graph');
	function get_user_data_graph(){
		$user_id =get_current_user_id();
		global $wpdb;
		if(!empty($_POST['graph_type']) && !empty($_POST['data_view_type'])){
			 $view_t =$_POST['graph_type'];	
		
			if($_POST['data_view_type']=='day'){	
			   
				$dataDay = $wpdb->get_results("select * from wp_graph_managed_user_data where added_id = $user_id AND created >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)");

				$countday =count($dataDay);
				$viewc =array();
				$viewdate =array();
				$lastDate =array();
				if(!empty($dataDay)){
					$malearr =array();
					$femalearr =array();
					$datearr =array();
					$agrArry_25=array();
					$agrArry_30=array();
					$agrArry_35=array();
					$agrArry_40=array();
					$agrArry_45=array();
					$agrArry_50=array();
					$agrArry_55=array();
					$agrArry_60=array();
					$agrArry_65=array();
					$agrArry_70=array();
					$agrArry_75=array();
					$agrArry_80=array();
					foreach($dataDay as $value){
						if($view_t=="gender"){
							array_push($malearr,$value->male);
							array_push($femalearr,$value->female);
							$ddw =date('d M', strtotime($value->created));
							array_push($datearr,$ddw);
							
							array_push($lastDate,$value->created);
						}else{
							
								array_push($agrArry_25,$value->age_25);
							
								array_push($agrArry_30,$value->age_30);
							
								array_push($agrArry_35,$value->age_35);
							
								array_push($agrArry_40,$value->age_40);
							
								array_push($agrArry_45,$value->age_45);
							
								array_push($agrArry_50,$value->age_50);
							
								array_push($agrArry_55,$value->age_55);
							
								array_push($agrArry_60,$value->age_60);
							
								array_push($agrArry_65,$value->age_65);
							
								array_push($agrArry_70,$value->age_70);
							
								array_push($agrArry_75,$value->age_75);
							
								array_push($agrArry_80,$value->age_80);
							
							$dd =date('d M', strtotime($value->created));
							array_push($datearr,$dd);
							array_push($lastDate,$value->created);
						}
					}
					
					$manArr=array();
					$colors =array();
					if($view_t=="gender"){
						if($countday<7){
							$aa=6-$countday;
							$lastDate = end($lastDate);
							for ($x = 0; $x <= $aa; $x++) {
								$a = $x+1;
								array_push($malearr,"0");
								array_push($femalearr,"0");
								$dd = date ("d M", strtotime("+$a days", strtotime($lastDate)));
								array_push($datearr,$dd);
							  }
						}
						$manArr =array(array('name'=>'Male','data'=>$malearr),array('name'=>'Female','data'=>$femalearr));
						$colors =array('#ad9052', '#f9f9f9');
					}else{
						if($countday<7){
							$aa=6-$countday;
							$lastDate = end($lastDate);
							for ($x = 0; $x <= $aa; $x++) {
								$a = $x+1;
								$dd = date ("d M", strtotime("+$a days", strtotime($lastDate)));
								array_push($datearr,$dd);
								array_push($agrArry_25,"0");
								array_push($agrArry_30,"0");
								array_push($agrArry_35,"0");
								array_push($agrArry_40,"0");
								array_push($agrArry_45,"0");
								array_push($agrArry_50,"0");
								array_push($agrArry_55,"0");
								array_push($agrArry_60,"0");
								array_push($agrArry_65,"0");
								array_push($agrArry_70,"0");
								array_push($agrArry_75,"0");
								array_push($agrArry_80,"0");
								
							  }
						}
						$manArr=array(
									array('name'=>'Age 18-25','data'=>$agrArry_25),
									array('name'=>'Age 25-30','data'=>$agrArry_30),
									array('name'=>'Age 30-35','data'=>$agrArry_35),
									array('name'=>'Age 35-40','data'=>$agrArry_40),
									array('name'=>'Age 40-45','data'=>$agrArry_45),
									array('name'=>'Age 45-50','data'=>$agrArry_50),
									array('name'=>'Age 50-55','data'=>$agrArry_55),
									array('name'=>'Age 55-60','data'=>$agrArry_60),
									array('name'=>'Age 60-65','data'=>$agrArry_65),
									array('name'=>'Age 65-70','data'=>$agrArry_70),
									array('name'=>'Age 70-75','data'=>$agrArry_75),
									array('name'=>'Age 75-80','data'=>$agrArry_80)
									);
						
						$colors =array('#ad9052', '#f9f9f9','#ad9052','#f9f9f9','#ad9052','#f9f9f9','#ad9052','#f9f9f9','#ad9052','#f9f9f9','#f9f9f9','#f9f9f9');
						
					}
					
					$data = array('status' => 'true', 'msg' => 'data views.','viewc'=>$manArr,'viewdate'=>$datearr, 'colorss'=>$colors);
				}else{
					$$viewc =array();
					$viewdate =array();
                    $lastDate =date('y-m-d');
					for ($x = 0; $x < 7; $x++) {
						$a = 6-$x;
						$dd = date ("d M", strtotime("-$a days", strtotime($lastDate)));
						array_push($viewc,"0");
						array_push($viewdate,$dd);
					  }
					$data = array('status' => 'true', 'msg' => 'data views.','viewc'=>$viewc,'viewdate'=>$viewdate, 'colorss'=>'');
				}
			}else if($_POST['data_view_type']=='week'){
				
				$dataDay = $wpdb->get_results("select * from wp_graph_managed_user_data where added_id = $user_id AND created >= DATE_SUB(CURDATE(), INTERVAL 1 WEEK)");
				
				$countday =count($dataDay);
				$viewc =array();
				$viewdate =array();
				$lastDate =array();
				if(!empty($dataDay)){
					$malearr =array();
					$femalearr =array();
					$datearr =array();
					$agrArry_25=array();
					$agrArry_30=array();
					$agrArry_35=array();
					$agrArry_40=array();
					$agrArry_45=array();
					$agrArry_50=array();
					$agrArry_55=array();
					$agrArry_60=array();
					$agrArry_65=array();
					$agrArry_70=array();
					$agrArry_75=array();
					$agrArry_80=array();
					foreach($dataDay as $value){
						if($view_t=="gender"){
							array_push($malearr,$value->male);
							array_push($femalearr,$value->female);
							$ddw =date('d M', strtotime($value->created));
							array_push($datearr,$ddw);
							array_push($lastDate,$value->created);
						}else{
							
								array_push($agrArry_25,$value->age_25);
							
								array_push($agrArry_30,$value->age_30);
							
								array_push($agrArry_35,$value->age_35);
							
								array_push($agrArry_40,$value->age_40);
							
								array_push($agrArry_45,$value->age_45);
							
								array_push($agrArry_50,$value->age_50);
							
								array_push($agrArry_55,$value->age_55);
							
								array_push($agrArry_60,$value->age_60);
							
								array_push($agrArry_65,$value->age_65);
							
								array_push($agrArry_70,$value->age_70);
							
								array_push($agrArry_75,$value->age_75);
							
								array_push($agrArry_80,$value->age_80);
							
							$dd =date('d M', strtotime($value->created));
							array_push($datearr,$dd);
							array_push($lastDate,$value->created);
						}
					}
					
					$manArr=array();
					$colors =array();
					if($view_t=="gender"){
						if($countday<7){
							$aa=6-$countday;
							$lastDate = end($lastDate);
							for ($x = 0; $x <= $aa; $x++) {
								$a = $x+1;
								array_push($malearr,"0");
								array_push($femalearr,"0");
								$dd = date ("d M", strtotime("+$a days", strtotime($lastDate)));
								array_push($datearr,$dd);
							  }
						}

						$manArr =array(array('name'=>'Male','data'=>$malearr),array('name'=>'Female','data'=>$femalearr));
						$colors =array('#ad9052', '#f9f9f9');
					}else{
						
						if($countday<7){
							$aa=6-$countday;
							$lastDate = end($lastDate);
							for ($x = 0; $x <= $aa; $x++) {
								$a = $x+1;
								$dd = date ("d M", strtotime("+$a days", strtotime($lastDate)));
								array_push($datearr,$dd);
								array_push($agrArry_25,"0");
								array_push($agrArry_30,"0");
								array_push($agrArry_35,"0");
								array_push($agrArry_40,"0");
								array_push($agrArry_45,"0");
								array_push($agrArry_50,"0");
								array_push($agrArry_55,"0");
								array_push($agrArry_60,"0");
								array_push($agrArry_65,"0");
								array_push($agrArry_70,"0");
								array_push($agrArry_75,"0");
								array_push($agrArry_80,"0");
								
							  }
						}
						$manArr=array(
									array('name'=>'Age 18-25','data'=>$agrArry_25),
									array('name'=>'Age 25-30','data'=>$agrArry_30),
									array('name'=>'Age 30-35','data'=>$agrArry_35),
									array('name'=>'Age 35-40','data'=>$agrArry_40),
									array('name'=>'Age 40-45','data'=>$agrArry_45),
									array('name'=>'Age 45-50','data'=>$agrArry_50),
									array('name'=>'Age 50-55','data'=>$agrArry_55),
									array('name'=>'Age 55-60','data'=>$agrArry_60),
									array('name'=>'Age 60-65','data'=>$agrArry_65),
									array('name'=>'Age 65-70','data'=>$agrArry_70),
									array('name'=>'Age 70-75','data'=>$agrArry_75),
									array('name'=>'Age 75-80','data'=>$agrArry_80)
									);
						
						$colors =array('#ad9052', '#f9f9f9','#ad9052','#f9f9f9','#ad9052','#f9f9f9','#ad9052','#f9f9f9','#ad9052','#f9f9f9','#f9f9f9','#f9f9f9');
						
					}
					$data = array('status' => 'true', 'msg' => 'data views.','viewc'=>$manArr,'viewdate'=>$datearr, 'colorss'=>$colors);
				}else{
					$$viewc =array();
					$viewdate =array();
                    $lastDate =date('y-m-d');
					for ($x = 0; $x < 7; $x++) {
						$a = 6-$x;
						$dd = date ("d M", strtotime("-$a days", strtotime($lastDate)));
						array_push($viewc,"0");
						array_push($viewdate,$dd);
					  }
					$data = array('status' => 'true', 'msg' => 'data views.','viewc'=>$viewc,'viewdate'=>$viewdate, 'colorss'=>'');
				}
			}else if($_POST['data_view_type']=='month'){
				
				$dataDay = $wpdb->get_results("select * from wp_graph_managed_user_data where added_id = $user_id AND created >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)");

				$countday =count($dataDay);
				$viewc =array();
				$viewdate =array();
				$lastDate =array();
				if(!empty($dataDay)){
					$malearr =array();
					$femalearr =array();
					$datearr =array();
					$agrArry_25=array();
					$agrArry_30=array();
					$agrArry_35=array();
					$agrArry_40=array();
					$agrArry_45=array();
					$agrArry_50=array();
					$agrArry_55=array();
					$agrArry_60=array();
					$agrArry_65=array();
					$agrArry_70=array();
					$agrArry_75=array();
					$agrArry_80=array();
					foreach($dataDay as $value){
						if($view_t=="gender"){
							array_push($malearr,$value->male);
							array_push($femalearr,$value->female);
							$ddw =date('d M', strtotime($value->created));
							array_push($datearr,$ddw);
							array_push($lastDate,$value->created);
						}else{
							
								array_push($agrArry_25,$value->age_25);
							
								array_push($agrArry_30,$value->age_30);
							
								array_push($agrArry_35,$value->age_35);
							
								array_push($agrArry_40,$value->age_40);
							
								array_push($agrArry_45,$value->age_45);
							
								array_push($agrArry_50,$value->age_50);
							
								array_push($agrArry_55,$value->age_55);
							
								array_push($agrArry_60,$value->age_60);
							
								array_push($agrArry_65,$value->age_65);
							
								array_push($agrArry_70,$value->age_70);
							
								array_push($agrArry_75,$value->age_75);
							
								array_push($agrArry_80,$value->age_80);
							
							$dd =date('d M', strtotime($value->created));
							array_push($datearr,$dd);
							array_push($lastDate,$value->created);
						}
					}
					
					$manArr=array();
					$colors =array();
					if($view_t=="gender"){

						if($countday<7){
							$aa=6-$countday;
							$lastDate = end($lastDate);
							for ($x = 0; $x <= $aa; $x++) {
								$a = $x+1;
								array_push($malearr,"0");
								array_push($femalearr,"0");
								$dd = date ("d M", strtotime("+$a days", strtotime($lastDate)));
								array_push($datearr,$dd);
							  }
						}
						$manArr =array(array('name'=>'Male','data'=>$malearr),array('name'=>'Female','data'=>$femalearr));
						$colors =array('#ad9052', '#f9f9f9');
					}else{
						if($countday<7){
							$aa=6-$countday;
							$lastDate = end($lastDate);
							for ($x = 0; $x <= $aa; $x++) {
								$a = $x+1;
								$dd = date ("d M", strtotime("+$a days", strtotime($lastDate)));
								array_push($datearr,$dd);
								array_push($agrArry_25,"0");
								array_push($agrArry_30,"0");
								array_push($agrArry_35,"0");
								array_push($agrArry_40,"0");
								array_push($agrArry_45,"0");
								array_push($agrArry_50,"0");
								array_push($agrArry_55,"0");
								array_push($agrArry_60,"0");
								array_push($agrArry_65,"0");
								array_push($agrArry_70,"0");
								array_push($agrArry_75,"0");
								array_push($agrArry_80,"0");
								
							  }
						}

						$manArr=array(
									array('name'=>'Age 18-25','data'=>$agrArry_25),
									array('name'=>'Age 25-30','data'=>$agrArry_30),
									array('name'=>'Age 30-35','data'=>$agrArry_35),
									array('name'=>'Age 35-40','data'=>$agrArry_40),
									array('name'=>'Age 40-45','data'=>$agrArry_45),
									array('name'=>'Age 45-50','data'=>$agrArry_50),
									array('name'=>'Age 50-55','data'=>$agrArry_55),
									array('name'=>'Age 55-60','data'=>$agrArry_60),
									array('name'=>'Age 60-65','data'=>$agrArry_65),
									array('name'=>'Age 65-70','data'=>$agrArry_70),
									array('name'=>'Age 70-75','data'=>$agrArry_75),
									array('name'=>'Age 75-80','data'=>$agrArry_80)
									);
						
						$colors =array('#ad9052', '#f9f9f9','#ad9052','#f9f9f9','#ad9052','#f9f9f9','#ad9052','#f9f9f9','#ad9052','#f9f9f9','#f9f9f9','#f9f9f9');
						
					}
					$data = array('status' => 'true', 'msg' => 'data views.','viewc'=>$manArr,'viewdate'=>$datearr, 'colorss'=>$colors);
				}else{
					$$viewc =array();
					$viewdate =array();
                    $lastDate =date('y-m-d');
					for ($x = 0; $x < 7; $x++) {
						$a = 6-$x;
						$dd = date ("d M", strtotime("-$a days", strtotime($lastDate)));
						array_push($viewc,"0");
						array_push($viewdate,$dd);
					  }
					$data = array('status' => 'true', 'msg' => 'data views.','viewc'=>$viewc,'viewdate'=>$viewdate, 'colorss'=>'');
				}
			}else if($_POST['data_view_type']=='year'){
				
				$dataDay = $wpdb->get_results("select * from wp_graph_managed_user_data where added_id = $user_id AND created >= DATE_SUB(CURDATE(), INTERVAL 1 YEAR)");

				$countday =count($dataDay);
				$viewc =array();
				$viewdate =array();
				$lastDate =array();
				if(!empty($dataDay)){
					$malearr =array();
					$femalearr =array();
					$datearr =array();
					$agrArry_25=array();
					$agrArry_30=array();
					$agrArry_35=array();
					$agrArry_40=array();
					$agrArry_45=array();
					$agrArry_50=array();
					$agrArry_55=array();
					$agrArry_60=array();
					$agrArry_65=array();
					$agrArry_70=array();
					$agrArry_75=array();
					$agrArry_80=array();
					foreach($dataDay as $value){
						if($view_t=="gender"){
							array_push($malearr,$value->male);
							array_push($femalearr,$value->female);
							$ddw =date('d M', strtotime($value->created));
							array_push($datearr,$ddw);
							array_push($lastDate,$value->created);
						}else{
							
								array_push($agrArry_25,$value->age_25);
							
								array_push($agrArry_30,$value->age_30);
							
								array_push($agrArry_35,$value->age_35);
							
								array_push($agrArry_40,$value->age_40);
							
								array_push($agrArry_45,$value->age_45);
							
								array_push($agrArry_50,$value->age_50);
							
								array_push($agrArry_55,$value->age_55);
							
								array_push($agrArry_60,$value->age_60);
							
								array_push($agrArry_65,$value->age_65);
							
								array_push($agrArry_70,$value->age_70);
							
								array_push($agrArry_75,$value->age_75);
							
								array_push($agrArry_80,$value->age_80);
							
							$dd =date('d M', strtotime($value->created));
							array_push($datearr,$dd);
							array_push($lastDate,$value->created);
						}
					}
					
					$manArr=array();
					$colors =array();
					if($view_t=="gender"){

						if($countday<7){
							$aa=6-$countday;
							$lastDate = end($lastDate);
							for ($x = 0; $x <= $aa; $x++) {
								$a = $x+1;
								array_push($malearr,"0");
								array_push($femalearr,"0");
								$dd = date ("d M", strtotime("+$a days", strtotime($lastDate)));
								array_push($datearr,$dd);
							  }
						}
						$manArr =array(array('name'=>'Male','data'=>$malearr),array('name'=>'Female','data'=>$femalearr));
						$colors =array('#ad9052', '#f9f9f9');
					}else{
						
						if($countday<7){
							$aa=6-$countday;
							$lastDate = end($lastDate);
							for ($x = 0; $x <= $aa; $x++) {
								$a = $x+1;
								$dd = date ("d M", strtotime("+$a days", strtotime($lastDate)));
								array_push($datearr,$dd);
								array_push($agrArry_25,"0");
								array_push($agrArry_30,"0");
								array_push($agrArry_35,"0");
								array_push($agrArry_40,"0");
								array_push($agrArry_45,"0");
								array_push($agrArry_50,"0");
								array_push($agrArry_55,"0");
								array_push($agrArry_60,"0");
								array_push($agrArry_65,"0");
								array_push($agrArry_70,"0");
								array_push($agrArry_75,"0");
								array_push($agrArry_80,"0");
								
							  }
						}
						$manArr=array(
									array('name'=>'Age 18-25','data'=>$agrArry_25),
									array('name'=>'Age 25-30','data'=>$agrArry_30),
									array('name'=>'Age 30-35','data'=>$agrArry_35),
									array('name'=>'Age 35-40','data'=>$agrArry_40),
									array('name'=>'Age 40-45','data'=>$agrArry_45),
									array('name'=>'Age 45-50','data'=>$agrArry_50),
									array('name'=>'Age 50-55','data'=>$agrArry_55),
									array('name'=>'Age 55-60','data'=>$agrArry_60),
									array('name'=>'Age 60-65','data'=>$agrArry_65),
									array('name'=>'Age 65-70','data'=>$agrArry_70),
									array('name'=>'Age 70-75','data'=>$agrArry_75),
									array('name'=>'Age 75-80','data'=>$agrArry_80)
									);
						
						$colors =array('#ad9052', '#f9f9f9','#ad9052','#f9f9f9','#ad9052','#f9f9f9','#ad9052','#f9f9f9','#ad9052','#f9f9f9','#f9f9f9','#f9f9f9');
						
					}
					$data = array('status' => 'true', 'msg' => 'data views.','viewc'=>$manArr,'viewdate'=>$datearr, 'colorss'=>$colors);
				}else{
					$$viewc =array();
					$viewdate =array();
                    $lastDate =date('y-m-d');
					for ($x = 0; $x < 7; $x++) {
						$a = 6-$x;
						$dd = date ("d M", strtotime("-$a days", strtotime($lastDate)));
						array_push($viewc,"0");
						array_push($viewdate,$dd);
					  }
					$data = array('status' => 'true', 'msg' => 'data views.','viewc'=>$viewc,'viewdate'=>$viewdate, 'colorss'=>'');
				}
			}else if($_POST['data_view_type']=='dateSelect'){
				$from_date=$_POST['formDate'];
				$to_date=$_POST['toDate'];
				$dataDay = $wpdb->get_results("select * from wp_graph_managed_user_data where added_id = $user_id AND created BETWEEN '$from_date' AND '$to_date'");

				$countday =count($dataDay);
				$viewc =array();
				$viewdate =array();
				$lastDate =array();
				if(!empty($dataDay)){
					$malearr =array();
					$femalearr =array();
					$datearr =array();
					$agrArry_25=array();
					$agrArry_30=array();
					$agrArry_35=array();
					$agrArry_40=array();
					$agrArry_45=array();
					$agrArry_50=array();
					$agrArry_55=array();
					$agrArry_60=array();
					$agrArry_65=array();
					$agrArry_70=array();
					$agrArry_75=array();
					$agrArry_80=array();
					foreach($dataDay as $value){
						if($view_t=="gender"){
							array_push($malearr,$value->male);
							array_push($femalearr,$value->female);
							$ddw =date('d M', strtotime($value->created));
							array_push($datearr,$ddw);
							array_push($lastDate,$value->created);
						}else{
							
								array_push($agrArry_25,$value->age_25);
							
								array_push($agrArry_30,$value->age_30);
							
								array_push($agrArry_35,$value->age_35);
							
								array_push($agrArry_40,$value->age_40);
							
								array_push($agrArry_45,$value->age_45);
							
								array_push($agrArry_50,$value->age_50);
							
								array_push($agrArry_55,$value->age_55);
							
								array_push($agrArry_60,$value->age_60);
							
								array_push($agrArry_65,$value->age_65);
							
								array_push($agrArry_70,$value->age_70);
							
								array_push($agrArry_75,$value->age_75);
							
								array_push($agrArry_80,$value->age_80);
							
							$dd =date('d M', strtotime($value->created));
							array_push($datearr,$dd);
							array_push($lastDate,$value->created);
						}
					}
					
					$manArr=array();
					$colors =array();
					if($view_t=="gender"){

						if($countday<7){
							$aa=6-$countday;
							$lastDate = end($lastDate);
							for ($x = 0; $x <= $aa; $x++) {
								$a = $x+1;
								array_push($malearr,"0");
								array_push($femalearr,"0");
								$dd = date ("d M", strtotime("+$a days", strtotime($lastDate)));
								array_push($datearr,$dd);
							  }
						}
						$manArr =array(array('name'=>'Male','data'=>$malearr),array('name'=>'Female','data'=>$femalearr));
						$colors =array('#ad9052', '#f9f9f9');
					}else{
						
						if($countday<7){
							$aa=6-$countday;
							$lastDate = end($lastDate);
							for ($x = 0; $x <= $aa; $x++) {
								$a = $x+1;
								$dd = date ("d M", strtotime("+$a days", strtotime($lastDate)));
								array_push($datearr,$dd);
								array_push($agrArry_25,"0");
								array_push($agrArry_30,"0");
								array_push($agrArry_35,"0");
								array_push($agrArry_40,"0");
								array_push($agrArry_45,"0");
								array_push($agrArry_50,"0");
								array_push($agrArry_55,"0");
								array_push($agrArry_60,"0");
								array_push($agrArry_65,"0");
								array_push($agrArry_70,"0");
								array_push($agrArry_75,"0");
								array_push($agrArry_80,"0");
								
							  }
						}
						$manArr=array(
									array('name'=>'Age 18-25','data'=>$agrArry_25),
									array('name'=>'Age 25-30','data'=>$agrArry_30),
									array('name'=>'Age 30-35','data'=>$agrArry_35),
									array('name'=>'Age 35-40','data'=>$agrArry_40),
									array('name'=>'Age 40-45','data'=>$agrArry_45),
									array('name'=>'Age 45-50','data'=>$agrArry_50),
									array('name'=>'Age 50-55','data'=>$agrArry_55),
									array('name'=>'Age 55-60','data'=>$agrArry_60),
									array('name'=>'Age 60-65','data'=>$agrArry_65),
									array('name'=>'Age 65-70','data'=>$agrArry_70),
									array('name'=>'Age 70-75','data'=>$agrArry_75),
									array('name'=>'Age 75-80','data'=>$agrArry_80)
									);
						
						$colors =array('#ad9052', '#f9f9f9','#ad9052','#f9f9f9','#ad9052','#f9f9f9','#ad9052','#f9f9f9','#ad9052','#f9f9f9','#f9f9f9','#f9f9f9');
						
					}
					$data = array('status' => 'true', 'msg' => 'data views.','viewc'=>$manArr,'viewdate'=>$datearr, 'colorss'=>$colors);
				}else{
					$$viewc =array();
					$viewdate =array();
                    $lastDate =date('y-m-d');
					for ($x = 0; $x < 7; $x++) {
						$a = 6-$x;
						$dd = date ("d M", strtotime("-$a days", strtotime($lastDate)));
						array_push($viewc,"0");
						array_push($viewdate,$dd);
					  }
					$data = array('status' => 'true', 'msg' => 'data views.','viewc'=>$viewc,'viewdate'=>$viewdate, 'colorss'=>'');
				}
			}
		
		}else{
			$data = array('status' => 'false', 'msg' => 'Something went Wrong4.');
		}
		echo json_encode($data);
		die();
	}
