<?php
/**
 * Template Name: Full-Width Page
 */
?>

<?php while (have_posts()) : the_post(); ?>
      <?php get_template_part('templates/page', 'header'); ?>
      <div class="row">
        <div class="col-xs-12">
          <?php if( has_post_thumbnail() ) : ?>
            <div class="pull-right col-xs-4">
              <?php the_post_thumbnail(); ?>
            </div>
          <?php endif; ?>
          <?php get_template_part('templates/content', 'page'); ?>
        </div>
      </div>
  </div>
<?php endwhile; ?>
