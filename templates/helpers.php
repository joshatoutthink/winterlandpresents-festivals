<?php

function get_festival_navigation($post){
  ?>
  <nav class="festival__navigation">
    <?php
    $festivals = get_posts([
      'post_type' => 'festival',
      'posts_per_page' => 10,
      'order' => 'ASC'
    ]);
    foreach($festivals as $festival){
      $id = $festival->ID;
      $festival_link = get_permalink($id);
      $festival_title = $festival->post_title;
      $is_current_festival = $post ? $id == $post->ID : false;
      ?>
      <div class="link <?php if($is_current_festival) echo "current-pages"; ?> ">
        <a href="<?php echo $festival_link; ?>"><?php echo $festival_title; ?></a>
      </div>
      <?php
    }
    ?>
    </nav>
  <?php
}

function get_festival_image_collection(){
  $festivals = get_posts([
      'post_type' => 'festival',
      'posts_per_page' => 10,
    ]);
  
  $image_collection = [];
  foreach($festivals as $festival){
    $carousel_images = get_field('carousel_images', $festival->ID);
    if(is_array($carousel_images)){
      $image_collection = array_merge($image_collection, $carousel_images);
    }
    unset($carousel_images);
  }
  shuffle($image_collection);
  return $image_collection;
}

function get_festival_logo(){
  if(!function_exists('get_field')) return;
  $image = get_field('festival_logo', 'option');
  ?>
  <a href="/festivals">
    <img src="<?php echo $image; ?>" alt="Winterland Presents logo">
  </a>
  <?php
}