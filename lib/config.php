<?php

namespace Roots\Sage\Config;

use Roots\Sage\ConditionalTagCheck;

/**
 * Enable theme features
 */
add_theme_support('soil-clean-up');         // Enable clean up from Soil
add_theme_support('soil-nav-walker');       // Enable cleaner nav walker from Soil
add_theme_support('soil-relative-urls');    // Enable relative URLs from Soil
add_theme_support('soil-nice-search');      // Enable nice search from Soil
add_theme_support('soil-jquery-cdn');       // Enable to load jQuery from the Google CDN

/**
 * Configuration values
 */
if (!defined('WP_ENV')) {
  // Fallback if WP_ENV isn't defined in your WordPress config
  // Used in lib/assets.php to check for 'development' or 'production'
  define('WP_ENV', 'production');
}

if (!defined('DIST_DIR')) {
  // Path to the build directory for front-end assets
  define('DIST_DIR', '/dist/');
}

if (!defined('GOOGLE_BROWSER_API_KEY')) {
  // Google Maps API Key
  define('GOOGLE_BROWSER_API_KEY', 'AIzaSyB8pzJ7H9yq8UyNvLChfrMxXCJsFLOOTNA');
}

if (!defined('GOOGLE_SERVER_API_KEY')) {
  define('GOOGLE_SERVER_API_KEY', 'AIzaSyDjoG2gVj5uFc4kYTR7skbxwcCPbkSxIWY');
}

/**
 * Define which pages shouldn't have the sidebar
 */
function display_sidebar() {
  static $display;

  if (!isset($display)) {
    $conditionalCheck = new ConditionalTagCheck(
      /**
       * Any of these conditional tags that return true won't show the sidebar.
       * You can also specify your own custom function as long as it returns a boolean.
       *
       * To use a function that accepts arguments, use an array instead of just the function name as a string.
       *
       * Examples:
       *
       * 'is_single'
       * 'is_archive'
       * ['is_page', 'about-me']
       * ['is_tax', ['flavor', 'mild']]
       * ['is_page_template', 'about.php']
       * ['is_post_type_archive', ['foo', 'bar', 'baz']]
       *
       */
      [
        'is_404',
        'is_front_page',
        'is_page',
        ['is_page_template', 'template-custom.php'],
        ['is_singular', ['member', 'leadership']],
        ['is_post_type_archive', ['member', 'leadership']],
      ]
    );

    $display = apply_filters('sage/display_sidebar', $conditionalCheck->result);
  }

  return $display;
}
