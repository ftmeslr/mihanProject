<?php
//Seo Panel + Faq
add_action("init",function(){
    register_post_type("seofaq",array(
        "public"=>false,
        "show_ui"=>true,
        "label"=>"سئو و سوالات متداول",
        "supports"=>array("title"),
    ));
});
add_action("add_meta_boxes",function(){
    add_meta_box( 'seo_box',"اطلاعات", 'seobox_callback', 'seofaq' );
});
function seobox_callback(){
    global $post;
    $type = get_post_meta($post->ID,"type",true);
?>
<style>
.mfoolad label {
    width:25%;
    display:inline-block;
}
.mfoolad input , .mfoolad select {
    width:73%;
    margin-top:8px;
}
.mfoolad textarea {
    width:98.5%;
    margin:10px auto;
}
.mfoolad * {
    box-sizing: border-box;
}
.mfoolad .faq .row {
    width:95%;
    border:1px solid #ccc;
    padding:8px;
    margin:10px auto;
    border-radius:8px;
}
.mfoolad .faq input {
    width:98.5%;
}
</style>
<script>
var $ = jQuery;
$(function(){
    $("select[name='type']").change(function(){
        var val = $(this).val();
        if(val == "text_archive"){
            $("textarea[name='text']").show();
            $(".mfoolad .faq").hide();
        } else {
            $("textarea[name='text']").hide();
            $(".mfoolad .faq").show();
        }
    });
    $("#addfaq").click(function(e){
        e.preventDefault();
        $(".mfoolad .faq .keeper").append(`
            <div class="row">
                <input type="text" name="faq_name[]" placeholder="عنوان">
                <textarea name="faq_text[]" placeholder="متن"></textarea>
                <button class="dell">حذف</button>
            </div>
        `);
    });
    $(document).on("click",".faq .dell",function(e){
        e.preventDefault();
        $(this).parent().remove();
    });
});
</script>
<div class="mfoolad">
<label>نوع</label>
<select name="type">
    <option value="text_archive"<?=($type == "text_archive" ? " selected" : "");?>>متن داخل آرشیو</option>
    <option value="faq_archive"<?=($type == "faq_archive" ? " selected" : "");?>>سوالات متداول آرشیو</option>
    <option value="faq_single"<?=($type == "faq_single" ? " selected" : "");?>>سوالات متداول صفحه محصولات</option>
</select>
<label for="cat">دسته بندی</label>
<?php wp_dropdown_categories(array("taxonomy"=>"product_cat","name"=>"cat","hide_empty"=>false,"selected"=>get_post_meta($post->ID,"cat",true))); ?>
<textarea name="text" <?=($type && $type != "text_archive" ? ' style="display:none" ' : "");?> placeholder="متن را اینجا بنویسید"><?=get_post_meta($post->ID,"text",true); ?></textarea>
<div class="faq" <?=(!$type || $type == "text_archive" ? ' style="display:none" ' : "");?>>
    <div class="keeper">
<?php
$rows = get_post_meta($post->ID,"rows",true) ?: [];
foreach($rows as $row){
    echo '<div class="row">
        <input type="text" name="faq_name[]" value="'.$row['title'].'">
        <textarea name="faq_text[]">'.$row['text'].'</textarea>
        <button class="dell">حذف</button>
    </div>';
}
?>
    </div>
<button id="addfaq">افزودن</button>
</div>
</div>
<?php
}
add_action("save_post",function(){
    global $post;
    if(get_post_type($post) != "seofaq"){ return false; }
    foreach(array("type","cat","text") as $a){
        update_post_meta($post->ID,$a,$_POST[$a]);
    }
    if(is_array($_POST['faq_name'])){
        $rows = [];
        for($i=0;$i<count($_POST['faq_name']);$i++){
            $rows[] = array("title"=>$_POST['faq_name'][$i],"text"=>$_POST['faq_text'][$i]);
        }
        update_post_meta($post->ID,"rows",$rows);
    }
});
?>