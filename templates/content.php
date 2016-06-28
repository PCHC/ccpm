<article <?php post_class('media'); ?>>
  <?php if( has_post_thumbnail() ) : ?>
    <div class="media-left media-top">
      <a href="#">
        <?php the_post_thumbnail('thumbnail'); ?>
      </a>
    </div>
  <?php endif; ?>
  <div class="media-body">
    <header>
      <h2 class="media-heading"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
      <?php get_template_part('templates/entry-meta'); ?>
    </header>
    <div class="entry-summary">
      <?php the_excerpt(); ?>
    </div>
  </div>
</article>
