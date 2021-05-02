<?php 
  global $post;
  require_once FESTIVAL_PAGES_CORE_PATH . 'templates/helpers.php';
?>

<?php wp_head(); ?>
<div class="festival__layout">
<?php back_to_main_site(); ?>
  <header class="festival__header">
    <div class="festival__logo">
      <?php get_festival_logo(); ?> 
    </div>
    <?php get_festival_navigation($post); ?>
    
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
      <button data-action="previous-slide"> &larr; </button>
    </div>
    <div class="carousel__navigation--next">
      <button data-action="next-slide"> &rarr; </button>
    </div>
    <ul class="carousel__slides">
    <?php
      $carousel_images = get_field('carousel_images'); 
      $slide_count=0;
      $image_count = $image_count = is_array($carousel_images) ? count($carousel_images) : 0;
      
      foreach($carousel_images as $slide){
        $slide_state = "idle";

        if($slide_count == ($image_count - 1)){
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
     <div class="carousel__count">
       <span class="current">1</span> of <span class="total"><?php echo $image_count;?></span>
     </div> 
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
      <h3 class="info__label">Photography by:</h3>
      <div class="info__copy">
        <?php echo get_field('festival_photographer'); ?>
      </div>
    </div>    
  </div>
</div>

<?php wp_footer(); ?>
