<div class="page-header">
  <h1>CCPM Leadership</h1>
</div>

<?php if (!have_posts()) : ?>
  <div class="alert alert-warning">
    <?php _e('Sorry, no results were found.', 'sage'); ?>
  </div>
  <?php get_search_form(); ?>
<?php else: ?>
  <div class="row">
    <?php while (have_posts()) : the_post(); ?>
      <div class="col-xs-6 col-sm-3 col-md-2 leadership-wrap">
        <?php get_template_part('templates/content', 'leadership'); ?>
      </div>
    <?php endwhile; ?>
  </div>
<?php endif; ?>
