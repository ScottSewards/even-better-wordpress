<?php
add_action('wp_footer', function() {
  global $template;
  global $post;
  if($post) {
    $post_id = $post -> ID;
    $template_basename = basename($template);
    $post_meta_added = add_post_meta($post_id, 'wp_hierarchy_template', $template_basename, true);
    if(!$post_meta_added) $post_meta_updated = update_post_meta($post_id, 'wp_hierarchy_template', $template_basename);
    // echo '<pre>';
    // print_r(array(
    //   'template' => $template,
    //   'post_id' => $post_id,
    //   'template_basename/wp_hierarchy_template' => $template_basename,
    //   'post_meta_added' => $post_meta_added ? 'true' : 'false',
    //   'post_meta_updated' => $post_meta_updated ? 'true' : 'false',
    // ));
    // echo '</pre>';
    // the_meta(); // PRINT ALL CUSTOM FIELDS
  }
}, 10, 0);

// ADMIN FUNCTIONS
if(!is_admin()) return;

add_filter('manage_posts_columns', function($columns) {
  return array_merge(
    array_slice($columns, 0, 1),
    array('post-id' => 'ID'),
    array_slice($columns, 1),
  );
});
add_action('manage_posts_custom_column', function($column, $post_id) {
  switch($column) {
    case 'post-id':
      echo $post_id;
      break;
  }
}, 5, 2);

add_filter('manage_pages_columns', function($columns) {
  return array_merge(
    array_slice($columns, 0, 1),
    array('post-id' => 'ID'),
    array('page-template' => 'Template'),
    array_slice($columns, 1),
  );
});
add_action('manage_pages_custom_column', function($column, $post_id) {
  switch($column) {
    case 'post-id':
      echo $post_id;
      break;
    case 'page-template':
      $post_meta = get_post_meta($post_id, 'wp_hierarchy_template');
      echo $post_meta ? $post_meta[0] : '<a class="button-primary" href="' . get_post_permalink($post_id) . '">View to add meta</a>';
      break;
  }
}, 5, 2);

add_filter('views_edit-post', function($views) {
  $non_sticky_posts = new WP_Query(array('post_type' => 'post', 'post__not_in' => get_option('sticky_posts')));
  $anchor = '<a ';
  if(isset($_GET['show_sticky']) && $_GET['show_sticky'] == 0)
    $anchor .= 'class="current" ';
  $anchor .= 'href="' . get_site_url() . '/wp-admin/edit.php?post_type=post&show_sticky=false">Non-Sticky <span class="count">(' . $non_sticky_posts -> found_posts . ')</span></a>';
  return array_merge($views, array('non-sticky' => $anchor));
});

if(isset($_GET['show_sticky']) && $_GET['show_sticky'] == 0) {
  add_action('pre_get_posts', function($query) {
    $query -> set('post__not_in', get_option('sticky_posts'));
  });
}
