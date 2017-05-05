<?php

namespace Roots\Sage\Assets;

/**
 * Scripts and stylesheets
 *
 * Enqueue stylesheets in the following order:
 * 1. /theme/dist/styles/main.css
 *
 * Enqueue scripts in the following order:
 * 1. /theme/dist/scripts/modernizr.js
 * 2. /theme/dist/scripts/main.js
 */

class JsonManifest {
  private $manifest;

  public function __construct($manifest_path) {
    if (file_exists($manifest_path)) {
      $this->manifest = json_decode(file_get_contents($manifest_path), true);
    } else {
      $this->manifest = [];
    }
  }

  public function get() {
    return $this->manifest;
  }

  public function getPath($key = '', $default = null) {
    $collection = $this->manifest;
    if (is_null($key)) {
      return $collection;
    }
    if (isset($collection[$key])) {
      return $collection[$key];
    }
    foreach (explode('.', $key) as $segment) {
      if (!isset($collection[$segment])) {
        return $default;
      } else {
        $collection = $collection[$segment];
      }
    }
    return $collection;
  }
}

function asset_path($filename) {
  $dist_path = get_template_directory_uri() . DIST_DIR;
  $directory = dirname($filename) . '/';
  $file = basename($filename);
  static $manifest;

  if (empty($manifest)) {
    $manifest_path = get_template_directory() . DIST_DIR . 'assets.json';
    $manifest = new JsonManifest($manifest_path);
  }

  if (array_key_exists($file, $manifest->get())) {
    return $dist_path . $directory . $manifest->get()[$file];
  } else {
    return $dist_path . $directory . $file;
  }
}

function assets() {
  wp_enqueue_style('sage_css', asset_path('styles/main.css'), false, null);
  wp_enqueue_style('google_fonts', '//fonts.googleapis.com/css?family=Raleway:700,400', false, null);

  if (is_single() && comments_open() && get_option('thread_comments')) {
    wp_enqueue_script('comment-reply');
  }

  wp_enqueue_script('modernizr', asset_path('scripts/modernizr.js'), [], null, true);
  wp_enqueue_script('google_maps', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyC_bzQmWRwDjeBflq715-Yxk691hpDgABQ', ['jquery'], null, true);
  wp_enqueue_script('js-marker-clusterer', asset_path('scripts/js-marker-clusterer.js'), [], null, true);
  wp_enqueue_script('sage_js', asset_path('scripts/main.js'), ['jquery'], null, true);
}
add_action('wp_enqueue_scripts', __NAMESPACE__ . '\\assets', 100);

function defer_scripts($tag, $handle) {
  $scripts_to_defer = array(
    'google_maps',
    'js-marker-clusterer',
    'modernizr',
    'sage_js',
  );

  foreach( $scripts_to_defer as $defer_script ) {
    if( $defer_script === $handle) {
      return str_replace( ' src', ' defer="defer" src', $tag);
    }
  }
  return $tag;
}
add_filter( 'script_loader_tag', __NAMESPACE__ . '\\defer_scripts', 10, 2);

function async_scripts($tag, $handle) {
  $scripts_to_async = array(
  );

  foreach( $scripts_to_async as $async_script ) {
    if( $async_script === $handle) {
      return str_replace( ' src', ' async="async" src', $tag);
    }
  }
  return $tag;
}
add_filter( 'script_loader_tag', __NAMESPACE__ . '\\async_scripts', 10, 2);
