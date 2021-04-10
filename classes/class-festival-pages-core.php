<?php
if(!class_exists( 'Festival_Pages_Core' )){
  class Festival_Pages_Core{

    function __construct(){
      add_action('wp_enqueue_scripts', array($this, 'enqueue_all'));

      // INCLUDES
      require FESTIVAL_PAGES_CORE_PATH . '/post-types/index.php';

      //
      add_filter('single_template', [$this,'festival_template']);
    }
    public function enqueue_all(){
      wp_enqueue_script('main-script', FESTIVAL_PAGES_CORE_URL . '/dist/main.js', array(), true);
      wp_enqueue_style('main-styles', FESTIVAL_PAGES_CORE_URL . '/dist/main.css', '1.00' , 'all');
    }

    public function festival_template($single){
      global $post;
      /* Checks for single template by post type  and makes sure advanced custom fields exists*/
      if ( $post->post_type == 'festival' && function_exists('get_field') ) {
        return FESTIVAL_PAGES_CORE_PATH . 'templates/festival-template.php';
      }


      return $single;
    }
    
  }
  
  new Festival_Pages_Core();
}