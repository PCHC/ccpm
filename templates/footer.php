<footer class="content-info" role="contentinfo">
  <div class="container">
    <?php dynamic_sidebar('sidebar-footer'); ?>
    <div class="row">
      <div class="col-xs-6">
        <p class="text-muted text-left">&copy; <?php echo strftime('%Y'); ?> <?php echo bloginfo('name'); ?></p>
      </div>
      <div class="col-xs-6">
        <p class="text-muted text-right"><?php echo get_theme_mod('main_address'); ?></p>
      </div>
    </div>
  </div>
</footer>
