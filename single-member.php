<?php while (have_posts()) : the_post(); ?>
      <?php get_template_part('templates/page', 'header'); ?>
      <div class="row">
        <div class="col-xs-8 col-sm-9">
          <?php get_template_part('templates/content', 'member'); ?>

          <?php
          /**
           * Set up location map
           */
          $address = get_field('address');
          if( !empty( $address['lat'] ) && !empty( $address['lng'] ) ) :?>
            <div class="map-row">
              <div class="acf-map">
                <?php
                set_query_var( 'marker', $post );
                set_query_var( 'pincolor', get_field('pincolor') );
                get_template_part('templates/map-marker'); ?>

                <?php
                // WP_Query arguments
                $args = array (
                	'post_parent'            => get_the_ID(),
                	'post_type'              => array( 'member' ),
                  'post_status'            => array( 'publish' ),
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

        <div class="col-xs-4 col-sm-3">
          <?php
          // Set the ID to the parent's ID or current post ID if top level
          $parent_member = ( wp_get_post_parent_id( get_the_ID() ) == 0 ) ? get_the_ID() : wp_get_post_parent_id( get_the_ID() ); ?>
          <?php echo get_the_post_thumbnail($parent_member); ?>

          <?php
          // WP_Query arguments
          $args = array (
            'post_parent'            => $parent_member,
            'post_type'              => array( 'member' ),
            'post_status'            => array( 'publish' ),
            'pagination'             => false,
            'posts_per_page'         => '-1',
            'order'                  => 'ASC',
            'orderby'                => 'title',
          );

          // The Query
          $member = new WP_Query( $args );

          // The Loop
          if ( $member->have_posts() ) : ?>
            <section class="member-locations">
              <h4>Member Locations:</h4>
              <?php while ( $member->have_posts() ) : $member->the_post(); ?>
                <h5><?php the_title(); ?></h5>
                <?php get_template_part('templates/aside', 'address'); ?>
              <?php endwhile; ?>
            </section>
          <?php endif;

          // Restore original Post Data
          wp_reset_postdata();
          ?>
        </div>
      </div>

  </div>
<?php endwhile; ?>
