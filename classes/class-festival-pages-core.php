<?php
if(!class_exists( 'Festival_Pages_Core' )){
  class Festival_Pages_Core{

    function __construct(){
      // Post type creation
      require FESTIVAL_PAGES_CORE_PATH . '/post-types/index.php';

      // assets
      add_action('wp_enqueue_scripts', array($this, 'enqueue_all'));

      
      
      //TEMPLATE
      add_filter('single_template', [$this,'festival_template']);
      add_filter('archive_template', [$this,'festival_archive_template']);

      //ACF GROUPS REGISTER
      
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

    public function festival_archive_template($archive){
      global $post;
      /* Checks for archive template by post type  and makes sure advanced custom fields exists*/
      if ( $post->post_type == 'festival' && function_exists('get_field') ) {
        return FESTIVAL_PAGES_CORE_PATH . 'templates/festivals-template.php';
      }
      return $archive;
    }


  }//END CLASS
  
  new Festival_Pages_Core();
}
