<?php if( is_active_sidebar( 'widgets-bottom' ) ) : ?>
  <div class="container" role="document">
    <div class="row widgets-bottom">
      <?php dynamic_sidebar('widgets-bottom'); ?>
    </div>
  </div>
<?php endif; ?>
