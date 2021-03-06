<?php 
  global $post;
  require_once FESTIVAL_PAGES_CORE_PATH . 'templates/helpers.php';
?>

<?php wp_head(); ?>
<div class="festival__layout">
<?php back_to_main_site(); ?>
  <header class="festival__header festival__header--archive">
    <div class="festival__logo">
      <?php get_festival_logo(); ?>
    </div>
      
    <?php get_festival_navigation(null);?>
      
  </header>


   <?php 
    $carousel_aspect_ratio= get_field('carousel_image_aspect_ratio', 'option');

    $carousel_image_style= get_field("carousel_image_fit", 'option');
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
      $carousel_images = get_festival_image_collection(); 
      do_action('qm/debug',  $carousel_images);
      $slide_count = 0;
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
  </div>
</div>
<?php get_footer(); ?>
