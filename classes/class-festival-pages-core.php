<?php
if(!class_exists( 'Festival_Pages_Core' )){
  class Festival_Pages_Core{

    function __construct(){
      add_action('wp_enqueue_scripts', array($this, 'enqueue_all'));
    }
    public function enqueue_all(){
      wp_enqueue_script('main-script', FESTIVAL_PAGES_CORE_URL . '/dist/main.js', array(), true);
      wp_enqueue_style('main-styles', FESTIVAL_PAGES_CORE_URL . '/dist/main.css', '1.00' , all);
    }
  }
  new Festival_Pages_Core();

}