<?php
// WP_Query arguments
$args = array (
	'post_type'              => array( 'member' ),
  'post_status'            => array( 'publish' ),
	'pagination'             => false,
  'post_parent'            => 0,
	'posts_per_page'         => '-1',
	'order'                  => 'ASC',
	'orderby'                => 'title',
);

// The Query
$members = new WP_Query( $args );

// The Loop
if ( $members->have_posts() ) : ?>
<div class="container">
	<div class="row map-row">
		<div class="acf-map">
		<?php while ( $members->have_posts() ) : $members->the_post();
			set_query_var( 'marker', $post );
			get_template_part('templates/map-marker');
		endwhile; ?>
		</div>
	</div>
</div>
<?php endif;

// Restore original Post Data
wp_reset_postdata();
?>
