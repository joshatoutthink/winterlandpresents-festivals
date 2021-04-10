<?php 
  global $post;
?>

<?php wp_head(); ?>

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


  <div class="marquee__wrapper">
    <div class="marquee">
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
    

    <div class="carousel__wrapper">
      <div class="carousel__navigation--previous">
        <button data-action="previous-slide"> < </button>
      </div>
      <div class="carousel__navigation--next">
        <button data-action="next-slide"> > </button>
      </div>
      <ul class="carousel__slides">
      <?php
        $carousel_images = get_field('carousel_images'); 
        foreach($carousel_images as $slide){
          ?>
          <div class="marquee__image">
            <img src="<?php echo $slide['image']; ?>" alt="slide image">
          </div>
          <?php
        }
      ?>  
      </ul>
    </div>
    <?php if($festival_notes = get_field('festival_notes')): ?>
      <div class="festival__notes">
        <?php echo $festival_notes; ?>
      </div>
    <?php endif; ?>
  </div>


  <div class="festival__info-wrapper">   
    <div class="festival__info--host festival__info">
      <h3>Hosted by:</h3>
      <?php echo get_field('festival_host'); ?>
    </div>
    <div class="festival__info festival__info--identity">
      <h3>Visual Identity by:</h3>
      <?php echo get_field('festival_identity'); ?>
    </div>    
    <div class="festival__info festival__info--photography">
      <h3>Visual Identity by:</h3>
      <?php echo get_field('festival_identity'); ?>
    </div>    
  </div>


<?php wp_footer(); ?>
