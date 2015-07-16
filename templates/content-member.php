<section class="member-details">
  <?php get_template_part('templates/aside', 'address'); ?>
</section>
<?php the_content(); ?>
<?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
