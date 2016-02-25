<article <?php post_class(); ?>>
  <header>
    <a href="<?php the_permalink(); ?>" class="leader-thumb-link">
      <?php the_post_thumbnail('leader-thumb'); ?>
      <h2 class="entry-title"><?php the_title(); ?></h2>
      <h4><?php echo get_field('title'); ?></h4>
    </a>
  </header>
</article>
