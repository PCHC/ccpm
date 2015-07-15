<?php while (have_posts()) : the_post(); ?>
      <?php get_template_part('templates/page', 'header'); ?>
      <div class="row">
        <div class="col-xs-10 col-sm-6 col-xs-offset-1 <?php echo ( has_post_thumbnail() ) ? 'col-sm-offset-1' : 'col-sm-offset-3'; ?>">
          <?php get_template_part('templates/content', 'member'); ?>
        </div>
        <?php if( has_post_thumbnail() ) : ?>
          <div class="hidden-xs col-sm-4">
            <?php the_post_thumbnail(); ?>
          </div>
        <?php endif; ?>
      </div>

      <?php $address = get_field('address');
      if( !empty( $address['lat'] ) && !empty( $address['lng'] ) ) :?>
        <div class="row map-row">
          <div class="acf-map">
            <?php
            set_query_var( 'marker', $post );
            get_template_part('templates/map-marker'); ?>

            <?php
            // WP_Query arguments
            $args = array (
            	'post_parent'            => get_the_ID(),
            	'post_type'              => array( 'member' ),
            	'pagination'             => false,
            	'posts_per_page'         => '-1',
            	'order'                  => 'ASC',
            	'orderby'                => 'title',
            );

            // The Query
            $member = new WP_Query( $args );

            // The Loop
            if ( $member->have_posts() ) {
            	while ( $member->have_posts() ) {
            		$member->the_post();
                set_query_var( 'marker', $post );
                get_template_part('templates/map-marker');
              }
            }

            // Restore original Post Data
            wp_reset_postdata();
            ?>

          </div>
        </div>
      <?php endif; ?>

  </div>
<?php endwhile; ?>
