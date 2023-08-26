<?php
// Plugin Name: Even Better WordPress
// Description: A utility plugin to make WordPress even better.
// Requires PHP: 7.4
// Author: Scott Sewards

if(!class_exists('EvenBetterWordPress')) {
  require_once plugin_dir_path(__FILE__) . 'functions.php';

  class EvenBetterWordPress {
    protected Array $options;

    function __constructor() {
      // $this -> options = $this -> load();
    }

    // public static function load(): array {
    //   return get_option('even_better_wordpress') ? get_option('even_better_wordpress') : array(
    //     'custom_sticky_posts' => true,
    //     'wp_admin_bar_template_name_information' => true,
    //     'wp_admin_edit_template_name_information' => true,
    //   );
    // }
    //
    // public static function save() {
    //   if(update_option('even_better', array())) {
    //     return true;
    //   } else return false;
    // }
    //
    // public function get_custom_sticky_posts_active() {
    //   return $this -> custom_sticky_posts['active'] == 1 ? true : false;
    // }
    //
    // public function set_custom_sticky_posts_active($value) {
    //   if(is_bool($value)) $this -> custom_sticky_posts['active'] = $value;
    // }


    function stick_post($post): bool {
      stick_post($post);
      return is_sticky($post -> ID);
    }

    function unstick_post($post): bool {
      unstick_post($post);
      return !is_sticky($post -> ID);
    }

    function stick_posts($posts) {
      foreach($posts as $post) stick_post($post);
    }

    function unstick_posts($posts) {
      foreach($posts as $post) unstick_post($post);
    }

    function unstick_all_posts(): bool {
      update_option('sticky_posts', []);
      return empty(get_option('sticky_posts'));
    }

    function is_sticky_post($post): bool {
      return is_sticky($post);
    }
  }

  $ebwp = new EvenBetterWordPress();

  add_action('admin_menu', function() {
    add_plugins_page('Dashboard', 'Even Better WordPress', 'read', plugin_dir_path(__FILE__) . 'dashboard.php', null, null, 80);
  });
}

register_activation_hook(__FILE__, function() {
  add_option('even_better_wordpress', array());
});
