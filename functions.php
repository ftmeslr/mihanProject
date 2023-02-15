<?php
require_once("includes/settings.php");
add_theme_support( 'post-thumbnails' );
//Wordpress Init
add_action('init',function(){
    //Register Nav Menus
    register_nav_menus( array(
        'menu_items'=>'لینک های منوی بالا',
        'foolad_menu'=> 'منوی قیمت روز فولاد',
        'footer_fast'=> 'دسترسی سریع',
        'footer_products'=> 'منوی محصولات فوتر',
    ));
    //Registe Custom Post types + Taxonomies
    register_post_type("news",array("label"=>"اخبار","public"=>true,'taxonomies'=>array('post_tag','category'),"supports"=>array("title","editor","thumbnail","comments","excerpt") ));
    register_post_type("articles",array("label"=>"مقالات","public"=>true,'taxonomies'=>array('post_tag','category'),"supports"=>array("title","editor","thumbnail","comments","excerpt") ));
});
//Add Class Name for wpnavmenu
add_filter( 'nav_menu_link_attributes',function( $atts, $item, $args ) {
    if (property_exists($args, 'link_class')) {
      $atts['class'] = $args->link_class;
    }
    return $atts;
}, 1, 3 );
add_filter('nav_menu_css_class', function($classes, $item, $args) {
    if(isset($args->add_li_class)) {
        $classes[] = $args->add_li_class;
    }
    return $classes;
}, 1, 3);
function get_likes(){
    return "0";
}
?>