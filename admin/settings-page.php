<?php
/**
 * Ann Click - Settings Page
 */

 // exit if file is called directly
if (!defined('ABSPATH')) {
    exit;
}

// display the plugin settings page
function ann_click_display_settings_page() {

	global $wpdb;
	$table_click = $wpdb->prefix . 'ann_click';
    $table_type = $wpdb->prefix . 'ann_click_type';
	
	// check if user is allowed access
	if ( ! current_user_can( 'manage_options' ) ) return;
	?>

	<div class="wrap">

		<h1><?php echo esc_html__(get_admin_page_title(), 'ann-click'); ?></h1>

		<select name="type" id="typeChange">
			<option value="admin.php?page=<?php echo $_GET['page'] . "&ann_type=0&ann_page=0"; ?>">all</option>
			<?php
			$query_type = "SELECT * FROM {$table_type} ORDER BY id_type ASC;";
			$items_type = $wpdb->get_results($query_type, OBJECT);
			foreach ($items_type as $type) : ?>
				<option value="admin.php?page=<?php echo $_GET['page'] . "&ann_type=" . $type->id_type .  "&ann_page=0"; ?>" <?php if ($_GET['ann_type'] == $type->id_type) echo 'selected="selected"'; ?>><?php echo $type->name; ?></option>
			<?php endforeach; ?>
		</select>

		<?php
		if(empty($_GET['ann_type']) || $_GET['ann_type'] == 0) {
			$query = "SELECT click.post_id, SUM(click.qty) qtyClick, ctype.name, click.dates, post.post_title, post.guid 
					  FROM {$table_click} AS click 
					  JOIN {$table_type} AS ctype ON ( ctype.id_type = click.id_type ) 
					  JOIN {$wpdb->prefix}posts AS post ON ( post.ID = click.post_id ) 
					  GROUP BY click.post_id, click.id_type
					  ORDER BY qtyClick DESC;";
		} else {
			$query = "SELECT click.post_id, SUM(click.qty) qtyClick, ctype.name, click.dates, post.post_title, post.guid 
					  FROM {$table_click} AS click 
					  JOIN {$table_type} AS ctype ON ( ctype.id_type = click.id_type ) 
					  JOIN {$wpdb->prefix}posts AS post ON ( post.ID = click.post_id )
					  WHERE click.id_type = {$_GET['ann_type']}
					  GROUP BY click.post_id, click.id_type
					  ORDER BY qtyClick DESC;";
		}
		// echo $query;
		$items = $wpdb->get_results($query, ARRAY_N);

		$ann_page = (empty($_GET['ann_page']) ? 1 : $_GET['ann_page']);

		$param = array("ann_page" => $ann_page, "url" => $_GET['page'], "ann_type" => $_GET['ann_type']);
		$pages = pagination($param, $items);
		// echo "<pre>"; print_r($pages); echo "</pre>";
		// echo "<pre>"; print_r($items); echo "</pre>";
		?>

		<?php if(count($items) > 0) : ?>

			<table class="wp-list-table widefat fixed posts ann-click" cellspacing="0">
				<thead>
					<tr>
						<th>ID</th>
						<th>Type</th>
						<th>Item</th>
						<th>Clicks</th>
					</tr>
				</thead>
				<tbody>
					<?php
					for ($i = $pages[0]['ann_actual']; $i < ($ann_page * $pages[0]['ann_qty']); $i++) :
						if (isset($items[$i][0])) :
						?>
						<tr>
							<td><a href="<?php echo get_bloginfo('wpurl'); ?>/wp-admin/post.php?post=<?php echo $items[$i][0]; ?>&action=edit"><?php echo $items[$i][0]; ?></a></td>
							<td><?php echo $items[$i][2]; ?></td>
							<td><?php echo $items[$i][4]; ?></td>
							<td><?php echo $items[$i][1]; ?></td>
						</tr>
					<?php endif; endfor; ?>
				</tbody>
			</table>

			<?php for ($g = 0; $g < count($pages); $g++) echo $pages[$g]['ann_print']; ?><br /><br />

		<?php endif; ?>
		
	</div>
	
	<?php
}