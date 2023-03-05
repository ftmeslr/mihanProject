<?php
require_once("includes/settings.php");
add_action( 'after_setup_theme',function(){
    add_theme_support( 'woocommerce' );
    add_theme_support( 'post-thumbnails' );
});
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
    register_post_type("news",array("label"=>"اخبار","public"=>true,"has_archive"=>true,'taxonomies'=>array('post_tag','category'),"supports"=>array("title","editor","thumbnail","comments","excerpt") ));
    register_post_type("articles",array("label"=>"مقالات","public"=>true,"has_archive"=>true,'taxonomies'=>array('post_tag','category'),"supports"=>array("title","editor","thumbnail","comments","excerpt") ));
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
//Function to get like
function get_likes(){
    return "0";
}
//Get last Post updated date
function get_last_post_date($cat){
    $query = new WP_Query(array("post_type"=>"product","showposts"=>"1","product_cat"=>$cat));
    if($query->have_posts()){
        $query->the_post();
        return human_time_diff(get_the_modified_time('U'),current_time( 'U' ));
    } else {
        return "";
    }
}
//enqueue Jquery
add_action("wp_enqueue_scripts",function(){
    wp_enqueue_script('jquery');
});
//Set post types in category and tags archive page
add_action("pre_get_posts",function($query){
    if(($query->is_category() || $query->is_tag()) && $query->is_main_query()){
        $query->set("post_type",array("post","articles","news"));
    }
});
//Registe Attributes
add_action("init",function(){
    if(wc_attribute_taxonomy_id_by_name("state") == 0){
        wc_create_attribute(array(
            'slug'         => 'state',
            'name'         =>'حالت',
            'type'         => 'select',
            'order_by'     => 'menu_order',
        ));
    } if(wc_attribute_taxonomy_id_by_name("standard") == 0){
        wc_create_attribute(array(
            'slug'         => 'standard',
            'name'         =>'استاندارد',
            'type'         => 'select',
            'order_by'     => 'menu_order',
        ));
    } if(wc_attribute_taxonomy_id_by_name("dimen") == 0){
        wc_create_attribute(array(
            'slug'         => 'dimen',
            'name'         =>'ابعاد',
            'type'         => 'select',
            'order_by'     => 'menu_order',
        ));
    } if(wc_attribute_taxonomy_id_by_name("size") == 0){
        wc_create_attribute(array(
            'slug'         => 'size',
            'name'         =>'سایز',
            'type'         => 'select',
            'order_by'     => 'menu_order',
        ));
    } if(wc_attribute_taxonomy_id_by_name("tyeps") == 0){
        wc_create_attribute(array(
            'slug'         => 'tyeps',
            'name'         =>'نوع',
            'type'         => 'select',
            'order_by'     => 'menu_order',
        ));
    }
    //delete_transient( 'wc_attribute_taxonomies' );
});
?>