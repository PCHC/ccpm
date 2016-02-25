<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class(); ?>>
    <div class="row">
      <div class="col-xs-3 col-sm-4">
        <?php the_post_thumbnail(); ?>
      </div>
      <div class="col-xs-9 col-sm-8">
        <header>
          <h1 class="entry-title"><?php the_title(); ?></h1>
          <h4><?php echo get_field('title'); ?></h4>
        </header>
        <div class="entry-content">
          <?php the_content(); ?>
        </div>
      </div>
    </div>
  </article>
<?php endwhile; ?>
