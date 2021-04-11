<?php 
  global $post;
  require_once FESTIVAL_PAGES_CORE_PATH . 'templates/helpers.php';
?>

<?php wp_head(); ?>
<div class="festival__layout">
  <header class="festival__header festival__header--archive">
    <div class="festival__logo">
      <?php get_festival_logo(); ?>
    </div>
      
    <?php get_festival_navigation(null);?>
      
  </header>


  <div class="carousel__wrapper">
    <div class="carousel__navigation--previous">
      <button data-action="previous-slide"> < </button>
    </div>
    <div class="carousel__navigation--next">
      <button data-action="next-slide"> > </button>
    </div>
    <ul class="carousel__slides">
    <?php
      $carousel_images =  get_festival_image_collection(); 
      $slide_count=0;

      $image_count = is_array($carousel_images) ? count($carousel_images) : 0;
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
       <span class="current">1</span> / <span class="total"><?php echo $image_count;?></span>
     </div> 
    <?php if($festival_notes = get_field('festival_notes')): ?>
        <div class="festival__notes">
          <?php echo $festival_notes; ?>
        </div>
      <?php endif; ?>
  </div>
</div>
<?php wp_footer(); ?>
