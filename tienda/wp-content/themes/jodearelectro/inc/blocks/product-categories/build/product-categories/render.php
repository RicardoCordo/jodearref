<?php

global $wp_query, $post;

$taxonomy     = 'product_cat';
$orderby      = 'name';
$show_count   = 1;      // 1 for yes, 0 for no
$pad_counts   = 1;      // 1 for yes, 0 for no
$hierarchical = 1;      // 1 for yes, 0 for no  
$title        = '';
$empty        = 1;


if (is_tax('product_cat')) {

	/* $this->current_cat   = $wp_query->queried_object;
			$this->cat_ancestors = get_ancestors( $this->current_cat->term_id, 'product_cat' ); */

	$selected_cat = $wp_query->queried_object;

	$args2 = array(
		'taxonomy'     => $taxonomy,
		'child_of'     => 0,
		'parent'       => $selected_cat->term_id,
		'orderby'      => $orderby,
		'show_count'   => $show_count,
		'pad_counts'   => $pad_counts,
		'hierarchical' => $hierarchical,
		'title_li'     => $title,
		'hide_empty'   => $empty
	);
	$sub_cats = get_categories($args2);
	if ($sub_cats) {
		echo '<h3 class="wp-block-heading" style="margin-top: 0; margin-bottom: 0;">Subcategoría</h3><ul>';
		foreach ($sub_cats as $sub_category): ?>
			<li>
				<a href="<?php echo get_term_link($sub_category->slug, 'product_cat'); ?>"> <?php echo $sub_category->name ?></a>
			</li>

	<?php endforeach;
		echo '</ul>';
	}
} else if (is_shop()) {
	$args = array(
		'taxonomy'     => $taxonomy,
		'orderby'      => $orderby,
		'parent'       => 0,
		'show_count'   => $show_count,
		'pad_counts'   => $pad_counts,
		'hierarchical' => $hierarchical,
		'title_li'     => $title,
		'hide_empty'   => $empty
	);
	$all_categories = get_categories($args);
	$selected_category_id = false;
	?>
	<script>
		function handleChange(event) {
			window.location.href = event.value
		}
	</script>
	<h3 class="wp-block-heading" style="margin-top: 0; margin-bottom: 0;">Categoría</h3>
	<ul>
		<li><a href="<?php echo esc_html(wc_get_page_permalink('shop')); ?>">Todos</a></li>
		<?php

		foreach ($all_categories as $cat) {
			$category_id = $cat->term_id;

			echo '<li><a href="' . get_term_link($cat->slug, 'product_cat') . '"';

			echo '>' . $cat->name . '</a> </li>';
		}
		?>

	</ul>

<?php }

?>