<?php
$post_types = get_post_types([], 'objects');
foreach($post_types as $type) {
  if(isset($type -> rewrite -> slug)) {
    // echo $type -> rewrite -> slug;
  }
}

if(isset($_POST['unstick-all-posts'])) {
  EBWP::unstick_all_posts();
}
