<?php
  $address = get_field('address');
  if( !empty( $address['lat'] ) && !empty( $address['lng'] ) ) : ?>

<div class="marker" data-lat="<?php echo $address['lat']; ?>" data-lng="<?php echo $address['lng']; ?>" data-pincolor="<?php echo $pincolor; ?>">
  <h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
  <p><?php echo $address['address']; ?></p>
</div>

<?php endif; ?>
