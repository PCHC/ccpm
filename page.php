<?php while (have_posts()) : the_post(); ?>
      <?php get_template_part('templates/page', 'header'); ?>
      <div class="row">
        <div class="col-xs-10 col-sm-6 col-xs-offset-1 <?php echo ( has_post_thumbnail() ) ? 'col-sm-offset-1' : 'col-sm-offset-3'; ?>">
          <?php get_template_part('templates/content', 'page'); ?>
        </div>
        <?php if( has_post_thumbnail() ) : ?>
          <div class="hidden-xs col-sm-4">
            <?php the_post_thumbnail(); ?>
          </div>
        <?php endif; ?>
      </div>
  </div>
<?php endwhile; ?>
