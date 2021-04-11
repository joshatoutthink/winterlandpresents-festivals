<?php 
  global $post;
?>

<?php wp_head(); ?>
<div class="festival__layout">
  <header class="festival__header">
    <div class="festival__logo">
      <img src="<?php echo get_field('festival_logo'); ?>" alt="festival logo">
    </div>

    <nav>
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
      ?>
      <div class="link <?php if($id == $post->ID) echo 'current-festival';  ?> ">
        <a href="<?php echo $festival_link; ?>"><?php echo $festival_title; ?></a>
      </div>
      <?php
    }
    ?>
    </nav>
    <h2 class="festival__year">
      <?php echo get_field('festival_year'); ?>
    </h2>
  </header>


  <marquee class="marquee__wrapper full-bleed">
    <div class="__marquee">
      <?php
      $marquee_images = get_field('marquee_images'); 
      foreach($marquee_images as $marquee_item){
        ?>
        <div class="marquee__image">
          <img src="<?php echo $marquee_item['image']; ?>" alt="marquee image">
        </div>
        <?php
      }
      ?>
    </div>
  </marquee>

  <?php 
    $carousel_aspect_ratio= get_field('carousel_image_aspect_ratio');
    do_action('qm/debug', $carousel_aspect_ratio);
    $carousel_image_style= get_field("carousel_image_fit");
    $settings = [
      'carousel-aspect-ratio' => $carousel_aspect_ratio,
      'carousel-image-style'=> $carousel_image_style,
    ];
    $carousel_slide_custom_properties = "";
    foreach($settings as $key=>$setting){
      $carousel_slide_custom_properties .= " --".$key.": ".$setting.";";
    }

  ?>
  <div class="carousel__wrapper" style="<?php echo $carousel_slide_custom_properties;?>">
    <div class="carousel__navigation--previous">
      <button data-action="previous-slide"> < </button>
    </div>
    <div class="carousel__navigation--next">
      <button data-action="next-slide"> > </button>
    </div>
    <ul class="carousel__slides">
    <?php
      $carousel_images = get_field('carousel_images'); 
      $slide_count=0;
      foreach($carousel_images as $slide){
        $slide_state = "idle";

        if($slide_count == (count($carousel_images) - 1)){
          $slide_state = "previous";
        } elseif($slide_count == 1){
          $slide_state = "next";
        } elseif($slide_count == 0){
          $slide_state = "active";
        }
        ?>
        <li class="carousel__slide" data-slide-id="<?php echo $slide_count;?>" data-state="<? echo $slide_state;?>">
          <img src="<?php echo $slide['image']; ?>" alt="slide image">
        </li>
        <?php
        $slide_count++;
      }
    ?>  
    </ul>

    <?php if($festival_notes = get_field('festival_notes')): ?>
        <div class="festival__notes">
          <?php echo $festival_notes; ?>
        </div>
      <?php endif; ?>
  </div>
  
    

  <div class="festival__info-wrapper">   
    <div class="festival__info--host festival__info">
      <h3 class="info__label">Hosted by:</h3>
      <div class="info__copy">
        <?php echo get_field('festival_host'); ?>
      </div>
    </div>
    <div class="festival__info festival__info--identity">
      <h3 class="info__label">Visual Identity by:</h3>
      <div class="info__copy">
        <?php echo get_field('festival_identity'); ?>
      </div>
    </div>    
    <div class="festival__info festival__info--photography">
      <h3 class="info__label">Visual Identity by:</h3>
      <div class="info__copy">
        <?php echo get_field('festival_identity'); ?>
      </div>
    </div>    
  </div>
</div>

<?php wp_footer(); ?>
