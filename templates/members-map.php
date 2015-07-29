<?php
// WP_Query arguments
$membersargs = array (
	'post_type'              => array( 'member' ),
  'post_status'            => array( 'publish' ),
	'pagination'             => false,
  'post_parent'            => 0,
	'posts_per_page'         => '-1',
	'order'                  => 'ASC',
	'orderby'                => 'title',
);

// The Query
$members = new WP_Query( $membersargs );

// The Loop
if ( $members->have_posts() ) : ?>
<div class="container main-map-container">
	<div class="row">
		<div class="map-row col-xs-10 col-sm-6 col-xs-offset-1">
			<div class="acf-map">
			<?php while ( $members->have_posts() ) : $members->the_post();
				set_query_var( 'pincolor', get_field('pincolor') );
				get_template_part('templates/map-marker');

				$args = array (
					'post_type'              => array( 'member' ),
				  'post_status'            => array( 'publish' ),
					'pagination'             => false,
				  'post_parent'            => get_the_ID(),
					'posts_per_page'         => '-1',
					'order'                  => 'ASC',
					'orderby'                => 'title',
				);

				// The Query
				$member_locations = new WP_Query( $args );

				if( $member_locations->have_posts() ) :
					while( $member_locations->have_posts() ) : $member_locations->the_post();
						set_query_var( 'marker', $post );
						get_template_part('templates/map-marker');
					endwhile;
				endif;
				//wp_reset_postdata();

			endwhile; ?>
			</div>
		</div>
		<div class="col-xs-10 col-sm-4 col-xs-offset-1 col-sm-offset-0 main-map-listing">
			<?php

			// The Query
			$memberslist = new WP_Query( $membersargs );

			// The Loop
			if ( $memberslist->have_posts() ) : ?>
				<?php while ( $memberslist->have_posts() ) : $memberslist->the_post(); ?>
					<?php $pincolor = get_field( 'pincolor' );

					// Get subpages
					$memberslocationslistargs = array (
						'post_type'              => array( 'member' ),
						'post_status'            => array( 'publish' ),
						'pagination'             => false,
						'post_parent'            => get_the_ID(),
						'posts_per_page'         => '-1',
						'order'                  => 'ASC',
						'orderby'                => 'title',
					);

					// Subpages Query
					$member_locations_list = new WP_Query( $memberslocationslistargs ); ?>

					<div class="main-map-listing-item" style="background: <?php echo $pincolor; ?>">
						<div class="well well-sm">
							<p>
								<?php if( $member_locations_list->have_posts() ) : ?>
									<a class="pull-right" role="button" data-toggle="collapse" href="#collapse-<?php echo get_the_ID(); ?>" aria-expanded="false" aria-controls="collapseExample" aria-label="Expand">
									  <span class="glyphicon glyphicon-list" aria-hidden="true"></span>
									</a>
								<?php endif; ?>
								<a href="<?php the_permalink(); ?>"><strong><?php the_title(); ?></strong></a><br>
								<small class="text-muted"><?php echo get_field('address')['address']; ?></small>
							</p>

							<?php
							if( $member_locations_list->have_posts() ) : ?>
								<div class="collapse" id="collapse-<?php echo get_the_ID(); ?>">
								<?php while( $member_locations_list->have_posts() ) : $member_locations_list->the_post(); ?>
										<div class="row">
											<p class="col-xs-11 col-xs-offset-1">
												<?php the_title(); ?><br>
												<small class="text-muted"><?php echo get_field('address')['address']; ?></small>
											</p>
										</div>
								<?php endwhile; ?>
								</div>
							<?php endif;
							?>

						</div>
					</div>
				<?php endwhile; ?>
			<?php endif; ?>
		</div>
	</div>
</div>
<?php endif;

// Restore original Post Data
wp_reset_postdata();
?>
