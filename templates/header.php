<header class="banner" role="banner" id="mainHeader">
  <div class="container">
    <div class="mobile-nav-topbar">
      <a class="brand" href="<?= esc_url(home_url('/')); ?>"><span><?php bloginfo('name'); ?></span></a>
      <span class="mainNavigation-toggle glyphicon glyphicon-menu-hamburger visible-xs-block" data-toggle="collapse" data-target="#mainNavigation" aria-expanded="false" aria-controls="mainNavigation"></span>
    </div>
    <nav role="navigation" id="mainNavigation" class="collapse">
      <?php
      if (has_nav_menu('primary_navigation')) :
        wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav']);
      endif;
      ?>
    </nav>
  </div>
</header>
