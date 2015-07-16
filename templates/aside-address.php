<?php $address = get_field('address'); if(!empty($address)) : ?>
  <address>
    <?php echo $address['address']; ?>
    <?php echo !empty( get_field( 'phone' ) ) ? '<br><span class="glyphicon glyphicon-phone" aria-hidden="true"></span> ' . get_field('phone') : ''; ?>
    <?php echo !empty( get_field( 'website' ) ) ? '<br><span class="glyphicon glyphicon-globe" aria-hidden="true"></span> <a target="_blank" href="http://'.get_field('website').'">' . get_field('website') . '</a>' : ''; ?>
  </address>
<?php endif; ?>
