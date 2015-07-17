<div class="page-header">
  <h1>CCPM Members</h1>
</div>

<?php if (!have_posts()) : ?>
  <div class="alert alert-warning">
    <?php _e('Sorry, no results were found.', 'sage'); ?>
  </div>
  <?php get_search_form(); ?>
<?php else: ?>
  <?php get_template_part('templates/members-map'); ?>
<?php endif; ?>
