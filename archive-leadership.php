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
      <div class="col-sm-2">
        <?php get_template_part('templates/content', 'leadership'); ?>
      </div>
    <?php endwhile; ?>
  </div>
<?php endif; ?>
