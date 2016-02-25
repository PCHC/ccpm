<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-74311156-1', 'auto');
  ga('send', 'pageview');

</script>
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
