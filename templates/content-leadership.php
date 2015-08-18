<article <?php post_class(); ?>>
  <header>
    <a href="<?php the_permalink(); ?>" class="leader-thumb-link">
      <?php the_post_thumbnail('leader'); ?>
      <h2 class="entry-title"><?php the_title(); ?></h2>
    </a>
  </header>
  <div class="entry-summary">
    <?php the_excerpt(); ?>
  </div>
</article>
