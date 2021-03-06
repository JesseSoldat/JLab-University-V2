<?php

function uni_files() {
  //SCRIPTS
  wp_enqueue_script('main_js', get_theme_file_uri('/js/scripts-bundled.js'), NULL, microtime(), true);
  //STYLES
  wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
  wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
  wp_enqueue_style('uni_main_styles', get_stylesheet_uri(), NULL, microtime());
}

add_action('wp_enqueue_scripts', 'uni_files');


function unversity_features() {
  //optional dynamic menus NOT using in this site
  register_nav_menu('headerMenuLocation', 'Header Menu Location');
  register_nav_menu('footerLocationOne', 'Footer Location One');
  register_nav_menu('footerLocationTwo', 'Footer Location Two');
  //add title for each page in the tab
  add_theme_support('title-tag');

}

add_action('after_setup_theme', 'unversity_features');

function university_adjust_queries($query) {
  //EVENTS
  if(!is_admin() AND is_post_type_archive('event') AND $query->is_main_query()) {
    $today = date('Ymd');
    $query->set('meta-key', 'event_date');
    $query->set('orderby', 'meta_value_num');
    $query->set('order', 'ASC');
    $query->set('meta_query', array(
      array(
        'key' => 'event_date',
        'compare' => '>=',
        'value' => $today,
        'type' => 'numeric'
      )
    ));
  }

  //PROGRAMS
  if(!is_admin() AND is_post_type_archive('program') AND $query->is_main_query()) {
    $query->set('posts_per_page', -1);
    $query->set('orderby', 'title');
    $query->set('order', 'ASC');
  }
}

add_action('pre_get_posts', 'university_adjust_queries');
?>