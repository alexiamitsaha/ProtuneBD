<?php
if ( ! class_exists( 'WP_List_Table' ) ) {
	require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
}
require dirname( __FILE__ ) . '/miraculous-users-list.php';

add_action( 'admin_menu', 'miraculous_user_list_menu' );
function miraculous_user_list_menu() {
	add_submenu_page( 'edit.php?post_type=ms-plans', __( 'Manage Users' ), __( 'Manage Users' ), 'manage_options', '', 'miraculous_user_list_callback' );
}

function miraculous_user_list_callback() {
	// Create an instance of our package class.
	$list_table = new Miraculous_Users_List_Table();

	// Fetch, prepare, sort, and filter our data.
	?>
	<form method="get" class="user-form-listing">
	    <input type="hidden" name="post_type" value="ms-plans" />
        <input type="hidden" name="page" value="<?php echo $_REQUEST['page']; ?>" />
        <?php $list_table->prepare_items();
        $list_table->search_box('Search', 'search');
        include dirname( __FILE__ ) . '/views/users-list.php'; ?>
    </form>
	<?php
}