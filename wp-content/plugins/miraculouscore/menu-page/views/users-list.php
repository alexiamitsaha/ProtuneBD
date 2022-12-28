<div class="wrap">
	<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
    <form id="users-filter" method="get">
		<!-- For plugins, we also need to ensure that the form posts back to our current page -->
		<input type="hidden" name="page" value="<?php echo esc_attr($_REQUEST['page']); ?>" />
		<!-- Now we can render the completed list table -->
		<?php $list_table->display() ?>
	</form>
</div>
