<?php
$ms_args = array('post_type' => 'ms-plans',
                'posts_per_page' => -1
                );
// the query
$music_plans = get_posts( $ms_args );
global $wpdb;
$pmt_tbl = $wpdb->prefix . 'ms_payments';

if( isset($_GET['user']) && isset($_GET['wpdocs-save-settings']) ):
	
	$rest = $wpdb->update( 
				$pmt_tbl, 
				array( 
					'txnid' => $_GET['txn_id'],
					'payment_amount' => $_GET['payment_amount'],
					'payment_status' => $_GET['payment_status'],
					'itemid' => $_GET['plan_name'],
					'createdtime' => $_GET['payment_date'],
				), 
				array( 'id' => $_GET['user'] ), 
				array( 
					'%s',
					'%s',
					'%s',
					'%d',
					'%s',
				), 
				array( '%d' ) 
			);
	if($rest) { ?>
		<div id="message" class="updated notice is-dismissible">
			<p><strong><?php echo esc_html('Successfully updated.', 'miraculous'); ?></strong></p>
			<button type="button" class="notice-dismiss"><span class="screen-reader-text"><?php echo esc_html('Dismiss this notice.', 'miraculous'); ?></span></button>
		</div>
	<?php }

endif;

if( isset($_GET['user']) ):
	$id = $_GET['user'];
	$query = $wpdb->get_row( "SELECT * FROM `$pmt_tbl` WHERE id = $id" );

?>
<div class="wrap">
	<h1 class="wp-heading-inline"><?php echo esc_html('Edit Row', 'miraculous'); ?></h1>
	<hr class="wp-header-end">

	<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
		<h2><?php echo esc_html('Options', 'miraculous'); ?></h2>

		<table class="form-table">
			<tbody>
				<tr class="user-admin-color-wrap">
					<th class="row"><?php echo esc_html('Name', 'miraculous'); ?></th>
					<?php $name = get_the_author_meta('display_name', $query->user_id); ?>
					<td>
						<input type="hidden" name="user" value="<?php echo esc_attr($query->id); ?>">
						<input type="hidden" name="action" value="edit">
						<input type="text" name="user_name" id="user_name" value="<?php echo esc_attr($name); ?>" disabled="disabled" class="regular-text">
						<span class="description"><?php echo esc_html('Name cannot be changed.', 'miraculous'); ?></span>
					</td>
				</tr>
				<tr class="user-admin-color-wrap">
					<th class="row"><?php echo esc_html('Transaction ID', 'miraculous'); ?></th>
					<td><input type="text" name="txn_id" id="txn_id" value="<?php echo esc_attr( $query->txnid ); ?>" class="regular-text"></td>
				</tr>
				<tr class="user-admin-color-wrap">
					<th class="row"><?php echo esc_html('Payment Amount', 'miraculous'); ?></th>
					<td><input type="text" name="payment_amount" id="payment_amount" value="<?php echo esc_attr( $query->payment_amount ); ?>" class="regular-text"></td>
				</tr>
				<tr class="user-admin-color-wrap">
					<th class="row"><?php echo esc_html('Payment Status', 'miraculous'); ?></th>
					<td><input type="text" name="payment_status" id="payment_status" value="<?php echo esc_attr( $query->payment_status ); ?>" class="regular-text"></td>
				</tr>
				<tr class="user-admin-color-wrap">
					<th class="row"><?php echo esc_html('Plan Name', 'miraculous'); ?></th>
					<td>
						<select name="plan_name" id="plan_name">
							<?php foreach ($music_plans as $music_plan): ?>
								<option value="<?php echo esc_attr( $music_plan->ID ); ?>" <?php echo ($query->itemid == $music_plan->ID) ? 'selected="selected"' : ''; ?>><?php echo esc_html( $music_plan->post_title ); ?></option>
							<?php endforeach; ?>
						</select>
					</td>
				</tr>
				<tr class="user-admin-color-wrap">
					<th class="row"><?php echo esc_html('Payment Date', 'miraculous'); ?></th>
					<td><input type="text" name="payment_date" id="payment_date" value="<?php echo esc_attr( $query->createdtime ); ?>" class="regular-text"></td>
				</tr>
			</tbody>
			
		</table>
		<?php
			submit_button( 'Update Settings', 'primary', 'wpdocs-save-settings' );
		?>
	</form>
</div>
<?php endif; ?>