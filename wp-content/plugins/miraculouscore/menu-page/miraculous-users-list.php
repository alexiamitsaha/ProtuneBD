<?php
class Miraculous_Users_List_Table extends WP_List_Table {

	public function __construct() {
		// Set parent defaults.
		parent::__construct( array(
			'singular' => 'user',     // Singular name of the listed records.
			'plural'   => 'users',    // Plural name of the listed records.
			'ajax'     => false,       // Does this table support ajax?
		) );
	}

	public function display_data() {
		global $wpdb;
		$user_data = array();
		$pmt_tbl = $wpdb->prefix . 'ms_payments';
		if(isset($_GET['s']) && $_GET['s'] != ''){
		    $allusers = get_users( array('search' => $_GET['s']) );
		    $user_ids = array();
		    foreach($allusers as $users){
		        $user_ids[] = $users->ID;
		    }
		    $str_ids = implode(',', $user_ids);
		    $user_query = $wpdb->get_results("SELECT * FROM $pmt_tbl WHERE user_id in($str_ids)");
		}else{
		    $user_query = $wpdb->get_results("SELECT * FROM $pmt_tbl");
		}

		if($user_query) {
			foreach ($user_query as $users) {
				$name = get_the_author_meta('display_name', $users->user_id);
				$email = get_the_author_meta('user_email', $users->user_id);
				$plan_name = '<a href="'.get_edit_post_link( $users->itemid ).'">'. get_the_title($users->itemid) .'</a>';
                $extra_data = json_decode($users->extra_data);
                $payment_currency = '';
                if(function_exists('miraculous_currency_symbol')){
                    if(!empty($extra_data->payment_currency)){
                        $payment_currency = miraculous_currency_symbol($extra_data->payment_currency);
                    }
                    else{
                        if (function_exists('fw_get_db_settings_option')):  
                            $miraculous_theme_data = fw_get_db_settings_option();     
                        endif;
                        $currency = '';
                        if(!empty($miraculous_theme_data['currency'])):
                            $currency = $miraculous_theme_data['currency'];
                        endif;
                        $payment_currency = miraculous_currency_symbol($currency);
                    }
                }
				$user_data[] = array('ID' => $users->id, 'title' => $name, 'email' => $email, 'txn_id' => $users->txnid, 'payment_amount' => $payment_currency.number_format($users->payment_amount, 2), 'payment_status' => $users->payment_status, 'itemid' => $plan_name, 'createdtime' => $users->createdtime);
			}
		}
		
		return $user_data;
	}

	public function no_items() {
	  _e( 'No users avaliable.', 'users' );
	}

	public function get_columns() {
		$columns = array(
			'cb' => '<input type="checkbox" />',   
			// Render a checkbox instead of text.
			'title'    => _x( 'Name', 'Column label' ),
			'email'    => _x( 'Email', 'Column label' ),
			'txn_id'   => _x( 'Transaction Id', 'Column label' ),
			'payment_amount' => _x( 'Amount', 'Column label' ),
			'payment_status' => _x( 'Status', 'Column label' ),
			'itemid' => _x( 'Plan Name', 'Column label' ),
			'createdtime' => _x( 'Date', 'Column label' ),
		    );
        return $columns;
	}

	protected function get_sortable_columns() {
		$sortable_columns = array(
			'title'    => array( 'title', false ),
			'email'   => array( 'email', false )
		);

		return $sortable_columns;
	}

	protected function column_default( $item, $column_name ) {
		switch ( $column_name ) {
			case 'title':
			case 'email':
			case 'txn_id':
			case 'payment_amount':
			case 'payment_status':
			case 'itemid':
			case 'createdtime':
				return $item[ $column_name ];
			default:
				return print_r( $item, true ); // Show the whole array for troubleshooting purposes.
		}
	}

	protected function column_cb( $item ) {
		return sprintf(
			'<input type="checkbox" name="%1$s[]" value="%2$s" />',
			$this->_args['singular'],  // Let's simply repurpose the table's singular label ("user").
			$item['ID']                // The value of the checkbox should be the record's ID.
		);
	}

	protected function column_title( $item ) {
		$page = wp_unslash( $_REQUEST['page'] ); // WPCS: Input var ok.

		// Build edit row action.
		$edit_query_args = array(
			'page'   => $page,
			'action' => 'edit',
			'user'  => $item['ID'],
		);

		$actions['edit'] = sprintf(
			'<a href="%1$s">%2$s</a>',
			esc_url( wp_nonce_url( add_query_arg( $edit_query_args, 'admin.php' ), 'edituser_' . $item['ID'] ) ),
			_x( 'Edit', 'row action' )
		);

		// Build delete row action.
		$delete_query_args = array(
			'page'   => $page,
			'action' => 'delete',
			'user'  => $item['ID'],
		);

		$actions['delete'] = sprintf(
			'<a href="%1$s">%2$s</a>',
			esc_url( wp_nonce_url( add_query_arg( $delete_query_args, 'admin.php' ), 'deleteuser_' . $item['ID'] ) ),
			_x( 'Delete', 'row action' )
		);

		// Return the title contents.
		return sprintf( '%1$s %2$s',
			$item['title'],
			$this->row_actions( $actions )
		);
	}

	protected function get_bulk_actions() {
		$actions = array(
			'delete' => _x( 'Delete', 'bulk action', 'miraculous' ),
		);

		return $actions;
	}


	protected function process_bulk_action() {
		// Detect when a bulk action is being triggered.
		global $wpdb;
		$pmt_tbl = $wpdb->prefix . 'ms_payments';
		if ( 'delete' === $this->current_action() ) {
			foreach ($_GET as $value) {
				$wpdb->delete( $pmt_tbl, array( 'id' => $_GET['user'] ), array( '%d' ) );
			}
		}

		// Edit when a bulk action is being triggered.
		if ( 'edit' === $this->current_action() ) {
			$this->single_row_edit();
			//wp_die( 'Items edited (or they would be if we had items to edit)!' );
		}
	}

	function single_row_edit() {
		require dirname( __FILE__ ) . '/user-edit.php';
		wp_die();
	}

	function prepare_items() {
		global $wpdb; //This is used only if making any database queries

		/*
		 * First, lets decide how many records per page to show
		 */
		
		$per_page = 20;
        $columns  = $this->get_columns();
		$hidden   = array();
		$sortable = $this->get_sortable_columns();

		$this->_column_headers = array( $columns, $hidden, $sortable );

		$this->process_bulk_action();

		$data = $this->display_data();

		usort( $data, array( $this, 'usort_reorder' ) );

		$current_page = $this->get_pagenum();

		$total_items = count( $data );

		$data = array_slice( $data, ( ( $current_page - 1 ) * $per_page ), $per_page );

		$this->items = $data;

		$this->set_pagination_args( array(
			'total_items' => $total_items,                     // WE have to calculate the total number of items.
			'per_page'    => $per_page,                        // WE have to determine how many items to show on a page.
			'total_pages' => ceil( $total_items / $per_page ), // WE have to calculate the total number of pages.
		) );
	}

	protected function usort_reorder( $a, $b ) {
		// If no sort, default to title.
		$orderby = ! empty( $_REQUEST['orderby'] ) ? wp_unslash( $_REQUEST['orderby'] ) : 'title'; 

		// If no order, default to asc.
		$order = ! empty( $_REQUEST['order'] ) ? wp_unslash( $_REQUEST['order'] ) : 'asc'; 

		// Determine sort order.
		$result = strcmp( $a[ $orderby ], $b[ $orderby ] );

		return ( 'asc' === $order ) ? $result : - $result;
	}
}
