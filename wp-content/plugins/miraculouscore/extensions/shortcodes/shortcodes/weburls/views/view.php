<?php 
if(!defined('FW')) {
die( 'Forbidden' );
}
// From URL to get webpage contents. 
$url = "https://templatebundle.net?affid=2469"; 
  
// Initialize a CURL session. 
$ch = curl_init();  
   
// Return Page contents. 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
  
//grab URL and pass it to the variable. 
curl_setopt($ch, CURLOPT_URL, $url); 
  
$result = curl_exec($ch); 
  
if($result){
 //echo "yes"; 
}   