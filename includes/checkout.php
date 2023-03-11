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
            'post_type' => "mfoolad_orders"
        );
        $pid = wp_insert_post( $my_post );
        update_post_meta($pid,"name",$_POST['name']);
        update_post_meta($pid,"phone",$_POST['phone']);
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
?>
<style>
.mfoolad * {
    box-sizing:border-box;
}
.mfoolad label {
    display:inline-block;
    width:25%;
}
.mfoolad input {
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
?>