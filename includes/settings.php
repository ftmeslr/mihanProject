<?php
add_action("admin_menu",function(){
    add_submenu_page(
        'themes.php',
        'تنظیمات قالب',
        'تنظیمات قالب',
        'manage_options',
        'mfoolad_settings',
        'mfoolad_settings',
    );
});
add_action( 'admin_enqueue_scripts', function( $hook_suffix ) {
    wp_enqueue_media();  
});
function mfoolad_settings(){

?>
<style>
.tabs {
    width: 80%;
    margin: 100px auto 0px auto;
    background: #fff;
    padding: 8px;
}
.tabs a {
    text-decoration:none;
    display:inline-block;
    padding:8px;
    color:#000;
    border:1px solid transparent;
    box-shadow:none;
}
.tabs a.active {
    border-color:#ccc;
}
.content {
    width: 80%;
    background: #fff;
    margin: 10px auto 0px auto;
    padding: 8px;
}
.content form label {
    width:30%;
    display:inline-block;
}
.content form input , .content form textarea {
    width:65%;
    display:inline-block;
    margin-top:5px;
}
.content form input.ltr , , .content form textarea.ltr {
    direction:ltr;
    text-align:left;
}
</style>
<script>
var inp = null;
var frame = null;
var $ = jQuery;
$(function(){
    frame = wp.media({
      title: 'انتخاب فایل',
      button: {
        text: 'انتخاب'
      },
      multiple: false  
    });
    frame.on( 'select', function() {
      var attachment = frame.state().get('selection').first().toJSON();
      if(inp != null){
        inp.val(attachment.url)
      }
    });
    $(document).on("click",".filechooser",function(){
        inp = $(this);
        frame.open();
    });
    $(".tabs a").click(function(e){
        e.preventDefault();
        var el = $(this).attr("href").substr(1);
        if($("#"+el).length > 0){
            $(".tabs a.active").removeClass("active");
            $(".content form").hide();
            $("#"+el).show();
            $(this).addClass("active");
        }
    });
});
</script>
<div class="tabs">
    <a href="#glob" class="active">تنظیمات کلی</a>
    <a href="#sellers">فروشندگان</a>
    <a href="#slider">اسلایدر</a>
    <a href="#index">صفحه اصلی</a>
</div>
<div class="content">
    <form method="post" id="glob">
        <label>لوگو</label>
        <input type="text" class="filechooser ltr" name="mfoolad_logo" value="<?=get_option("mfoolad_logo"); ?>">
        <label>شماره تماس</label>
        <input type="text" class="ltr" name="mfoolad_phone" value="<?=get_option("mfoolad_phone"); ?>">

        <label>آدرس تلگرام</label>
        <input type="text" class="ltr" name="mfoolad_teleg" value="<?=get_option("mfoolad_teleg"); ?>">
        <label>آدرس اینستاگرام</label>
        <input type="text" class="ltr" name="mfoolad_insta" value="<?=get_option("mfoolad_insta"); ?>">

        <label>توضیحات داخل منو</label>
        <textarea name="mfoolad_menu_desc"><?=get_option("mfoolad_menu_desc"); ?></textarea>

    </form>
    <form method="post" id="sellers" style="display:none">

    </form>
    <form method="post" id="slider" style="display:none">
        
    </form>
    <form method="post" id="index" style="display:none">
        
    </form>
</div>
<?php
}
?>