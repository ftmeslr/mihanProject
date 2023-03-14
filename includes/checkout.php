<?php
$url_final = "http://127.0.0.1/wp/final/";
add_action("init",function(){
    register_post_type("mfoolad_orders",array(
        "public"=>false,
        "show_ui"=>true,
        "label"=>"سفارشات",
    ));
});
add_action("wp_ajax_final_checkout","final_checkout");
add_action("wp_ajax_nopriv_final_checkout","final_checkout");
function final_checkout(){
    global $url_final;
    if(empty($_POST['name']) || empty($_POST['phone']) ){ die(json_encode(array("result"=>"0"))); }
    $basket = json_decode(str_replace('\"','"',$_COOKIE['mfoolad_basket']),true);
    $rows = [];
    foreach($basket as $b){
        $prod = false;
        if($b['prod'] != "0"){ 
            $prod = wc_get_product($b['prod']); $price+= $prod->get_price() * $b['count'];
        }
        $row = [];
        $row['title'] = ($b['prod'] == "0" ? $b['title'] : get_the_title($b['prod']));
        $out = [];
        foreach($b['attrs'] as $a){
            $out[] = array("title"=>wc_attribute_label(substr($a['key'],10)),"value"=>$a['val']);
        }
        $row['attr'] = $out;
        $row['count'] = $b['count'];
        $row['price'] = ($b['prod'] != "0" ? $prod->get_price() : "-");
        $row['count'] = $b['count'];
        $row['desc'] = ($b['prod'] == "0" ? $b['desc'] : "-");
        $row['prod'] = $b['prod'];
        $rows[] = $row;
    }
    if(!empty($rows)){
        $my_post = array(
            'post_title'    => "سفارشات ".$_POST['name'],
            'post_content'  => $_POST['desc'],
            'post_author'   => 1,
            'post_status'   => "publish",
            'post_type' => "mfoolad_orders"
        );
        $pid = wp_insert_post( $my_post );
        update_post_meta($pid,"name",$_POST['name']);
        update_post_meta($pid,"phone",$_POST['phone']);
        update_post_meta($pid,"stats","0");
        update_post_meta($pid,"rows",$rows);

        unset($_COOKIE['mfoolad_basket']);
        setcookie('mfoolad_basket', null, -1,'/'); 

        echo json_encode(array("result"=>"1","url"=>$url_final));
        
    } else {
        echo json_encode(array("result"=>"-1"));
    }
    die();
}
add_action("add_meta_boxes",function(){
    add_meta_box( 'orders_box',"اطلاعات خریدار", 'orderbox_callback', 'mfoolad_orders' );
    add_meta_box( 'ordersp_box',"سبد خرید", 'orderboxp_callback', 'mfoolad_orders' );
});
function orderbox_callback(){
    global $post;
    $stats = get_post_meta($post->ID,"stats",true);
?>
<style>
.mfoolad * {
    box-sizing:border-box;
}
.mfoolad label {
    display:inline-block;
    width:25%;
}
.mfoolad input , .mfoolad select {
    width:74%;
    margin-top:5px;
}
.mfoolad .order {
    border:1px solid #ccc;
    margin:10px auto;
    padding:8px;
}
.mfoolad .order ul {
    padding:5px 25px;
}
.mfoolad .order  li {
    list-style-type:circle;
}
</style>
<div class="mfoolad">
    <label>نام و نام خانوادگی</label>
    <input type="text" value="<?=get_post_meta($post->ID,"name",true); ?>">
    <label>شماره تماس</label>
    <input type="text" value="<?=get_post_meta($post->ID,"phone",true); ?>">
    <label>وضهیت سفارش</label>
    <select name="stats">
        <option value="0"<?=(!$stats ? " selected" : "");?>>درحال انتظار</option>
        <option value="1"<?=($stats == "1" ? " selected" : "");?>>در انتظار پرداخت</option>
        <option value="2"<?=($stats == "2" ? " selected" : "");?>>تایید شده</option>
        <option value="3"<?=($stats == "3" ? " selected" : "");?>>ارسال شده</option>
        <option value="4"<?=($stats == "4" ? " selected" : "");?>>تحویل داده شده</option>
    </select>
</div>
<?php
}
function orderboxp_callback(){
    global $post;
    $rows = get_post_meta($post->ID,"rows",true) ?: [];
    echo '<div class="mfoolad">';
    foreach($rows as $r){
        echo '
<div class="order">
    <p>نام محصول : '.$r['title'].'</p>
    <p>تعداد : '.$r['count'].'</p>
    <p>قیمت هر واحد : '.$r['price'].'</p>
    <p>قیمت کل : '.(is_numeric($r['price']) && is_numeric($r['count']) ? $r['price'] * $r['count'] : "0").'</p>';
    if(!empty($r['attr'])){
        echo '<ul class="attrs">';
        foreach($r['attr'] as $r){
            echo '<li>'.$r['title'].' : '.$r['value'].'</li>';
        }
        echo '</ul>';
    }
    echo '<p>'.(isset($r['desc']) ? $r['desc'] : "").'</p>';
    
echo '</div>';
    }
    echo '</div>';
}
add_action("save_post",function(){
    global $post;
    if(get_post_type($post) != "mfoolad_orders"){ return false; }
    update_post_meta($post->ID,"stats",$_POST['stats']);
});
add_filter( 'manage_edit-mfoolad_orders_columns',function($columns) {
    unset($columns['cb']); 
    unset($columns['author']);
    unset($columns['date']);

    $columns['stats'] = "وضعیت سفارش";
    $columns['date'] = "تاریخ";
    return $columns;
});
add_action( 'manage_mfoolad_orders_posts_custom_column' ,function( $column, $post_id ) {
    if($column == "stats"){
        $stats = get_post_meta($post_id,'stats',true);
        $txt = "درحال انتظار";
        if($stats == "1"){ $txt = "در انتظار پرداخت"; } 
        if($stats == "2"){ $txt = "تایید شده"; } 
        if($stats == "3"){ $txt = "ارسال شده"; }
        if($stats == "4"){ $txt = "تحویل داده شده"; }
        echo $txt;
    }
}, 10, 2 );
add_filter( 'manage_edit-mfoolad_orders_sortable_columns',function( $columns ) {        
    $columns['stats'] = 'stats';
    return $columns;
});
add_action("pre_get_posts",function($query){
    if( ! is_admin() ){ return false; }
    global $pagenow;
    $orderby = $query->get( 'orderby');
        
    if($orderby == "stats" ) {
        $query->set('meta_key','stats');
        $query->set('orderby','meta_value_num');
    }
    if ( 'edit.php' === $pagenow ) {
		if ( isset( $_GET['set_stats'] ) && $_GET['set_stats'] != "-1" ) {
			$meta_query = array(
				array(
					'key' => 'stats',
					'value' => $_GET['set_stats'],
					'compare' => '='
				)
			);
			$query->set( 'meta_query', $meta_query );
		}
	}
});
add_action( 'manage_posts_extra_tablenav',function() {
    $screen = get_current_screen();
    if($screen->id != 'edit-mfoolad_orders'){ return false; }
	?>
	<form method="GET">
        <select name="set_stats">
            <option value="-1"<?=(isset($_GET['set_stats']) && $_GET['set_stats'] == "-1" ? " selected" : ""); ?>>همه</option>
            <option value="0"<?=(isset($_GET['set_stats']) && $_GET['set_stats'] == "0" ? " selected" : ""); ?>>درحال انتظار</option>
            <option value="1"<?=(isset($_GET['set_stats']) && $_GET['set_stats'] == "1" ? " selected" : ""); ?>>در انتظار پرداخت</option>
            <option value="2"<?=(isset($_GET['set_stats']) && $_GET['set_stats'] == "2" ? " selected" : ""); ?>>تایید شده</option>
            <option value="3"<?=(isset($_GET['set_stats']) && $_GET['set_stats'] == "3" ? " selected" : ""); ?>>ارسال شده</option>
            <option value="4"<?=(isset($_GET['set_stats']) && $_GET['set_stats'] == "4" ? " selected" : ""); ?>>تحویل داده شده</option>
        </select>	
        <input type="submit" class="button action" value="صافی">
    </form>
	<?php
})
?>