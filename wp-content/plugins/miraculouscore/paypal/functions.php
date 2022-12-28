<?php
/**
 * Verify transaction is authentic
 *
 * @param array $data Post data from Paypal
 * @return bool True if the transaction is verified by PayPal
 * @throws Exception
 */
function verifyTransaction($data) {
    global $paypalUrl;

    $req = 'cmd=_notify-validate';
    foreach ($data as $key => $value) {
        $value = urlencode(stripslashes($value));
        $value = preg_replace('/(.*[^%^0^D])(%0A)(.*)/i', '${1}%0D%0A${3}', $value); // IPN fix
        $req .= "&$key=$value";
    }

	$ch = curl_init($paypalUrl);
	curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
	curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));
	$res = curl_exec($ch);

    if (!$res) {
        $errno = curl_errno($ch);
        $errstr = curl_error($ch);
        curl_close($ch);
        throw new Exception("cURL error: [$errno] $errstr");
    }

    $info = curl_getinfo($ch);

    // Check the http response
    $httpCode = $info['http_code'];
    if ($httpCode != 200) {
        throw new Exception("PayPal responded with http code $httpCode");
    }
    
    curl_close($ch);

    return $res === 'VERIFIED';
}

/**
 * Check we've not already processed a transaction
 *
 * @param string $txnid Transaction ID
 * @return bool True if the transaction ID has not been seen before, false if already processed
 */
function checkTxnid($txnid) {
    global $wpdb;
    update_option('miraculous_paypal_testing', "tesr");
    $tbl_pay = $wpdb->prefix. 'ms_payments';
    
    $results = $wpdb->query('SELECT * FROM `product_details` WHERE txnid = \'' . $txnid . '\'');

    if(!empty($results)){
        return $results->num_rows;
    }else{
        return true;
    }
	
}

/**
 * Add payment to database
 *
 * @param array $data Payment data
 * @return int|bool ID of new payment or false if failed
 */
function addPayment($data) {
	global $wpdb;
	$tbl_pay = $wpdb->prefix. 'ms_payments';
    
    update_option('miraculous_paypal_testing', $data);
	if (is_array($data)) {
		$m = $data['plan_validity'];
		$wpdb->insert( 
			$tbl_pay, 
			array(
				'user_id' => $data['user_id'], 
				'txnid' => $data['txn_id'], 
				'payment_amount' => $data['payment_amount'],
				'payment_status' => $data['payment_status'],
				'itemid' => $data['plan_number'],
				'monthly_download' => $data['monthly_download'],
				'monthly_upload' => $data['monthly_upload'],
				'createdtime' => date('Y-m-d H:i:s'),
				'expiretime' => date("Y-m-d H:i:s", strtotime("+$m months")),
				'remains_download' => $data['monthly_download'],
				'remains_upload' => $data['monthly_upload'],
				'extra_data' => json_encode($data),
			), 
			array(
				'%d', 
				'%s', 
				'%s',
				'%s',
				'%d',
				'%d',
				'%d',
				'%s',
				'%s',
				'%d',
				'%d',
				'%s'
			) 
		);

		return $wpdb->insert_id;
	}

	return false;
}