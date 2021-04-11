
<?php
function create_post_type_festival() {
  register_post_type( 'festival',
    array(
      'labels' => array(
        'name' => __( 'Festival' ),
        'singular_name' => __( 'Festivals' )
      ),
      'public' => true,
      'has_archive' => true,
      'rewrite' => array('slug' => 'festivals'),
      'show_in_rest'       => true,
                'rest_base'          => 'festivals',
                'rest_controller_class' => 'WP_REST_Posts_Controller',
      'supports' => array( 'title', 'editor', 'custom-fields' )
    )
  );
  
  if( function_exists('acf_add_options_page') ) {
    
    acf_add_options_sub_page(array(
        'page_title'     => 'Festival Options',
        'menu_title'    => 'Festival Options',
        'parent_slug'    => 'edit.php?post_type=festival',
    ));

}
}
create_post_type_festival();



// add_filter('single_template', 'my_custom_template');

// function my_custom_template($single) {

//     global $post;

//     /* Checks for single template by post type */
//     if ( $post->post_type == 'festival' ) {
        
//             return plugin_dir_path(dirname( __FILE__) ) . 'templates/app.php';
       
//     }

//     return $single;

// }                                                 