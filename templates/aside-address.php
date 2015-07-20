<?php $address = get_field('address'); if(!empty($address)) : ?>
  <address>
    <?php echo $address['address']; ?>
    <?php if( get_field( 'phone' ) ) {
      echo '<br><span class="glyphicon glyphicon-phone" aria-hidden="true"></span> ' . get_field('phone');
    } ?>
    <?php if( get_field( 'website' ) ) {
      echo '<br><span class="glyphicon glyphicon-globe" aria-hidden="true"></span> <a target="_blank" href="http://'.get_field('website').'">' . get_field('website') . '</a>';
    } ?>
  </address>
<?php endif; ?>
