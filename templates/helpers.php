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
  return get_field('festival_archive_carousel', 'option');
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

function back_to_main_site(){ ?>
  <a href="<?php echo site_url(); ?>" class="back-to-site full-bleed" title="Go Back to Winterland Presents">&larr; Back to Main Site</a>
<?php }