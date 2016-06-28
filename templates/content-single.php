<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class(); ?>>
    <div class="row">
      <?php if( has_post_thumbnail() ) : ?>
        <div class="col-xs-3 col-sm-4">
          <?php the_post_thumbnail(); ?>
        </div>
      <?php endif; ?>
      <div class="<?php echo ( has_post_thumbnail() ) ? 'col-xs-9 col-sm-8' : 'col-xs-12'; ?>">
        <header>
          <h1 class="entry-title"><?php the_title(); ?></h1>
          <?php get_template_part('templates/entry-meta'); ?>
        </header>
        <div class="entry-content">
          <?php the_content(); ?>
        </div>
      </div>
    </div>
  </article>
<?php endwhile; ?>
