<?php
  $address = get_field('address');
  if( !empty( $address['lat'] ) && !empty( $address['lng'] ) ) : ?>

<div class="marker" data-lat="<?php echo $address['lat']; ?>" data-lng="<?php echo $address['lng']; ?>" data-pincolor="<?php echo $pincolor; ?>">
  <?php $member_parent = $post->post_parent;
  if( $member_parent != 0 ) : ?>
    <h5><a href="<?php echo get_the_permalink( $member_parent ); ?>"><?php echo get_the_title( $member_parent ); ?></a></h5>
    <p><strong><?php the_title(); ?></strong></p>
  <?php else : ?>
    <h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
  <?php endif; ?>
  <p><?php echo $address['address']; ?></p>
</div>

<?php endif; ?>
