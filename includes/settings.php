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
    if(isset($_POST['saveg'])){
        foreach(array("mfoolad_logo","mfoolad_phone","mfoolad_menu_desc","mfoolad_teleg","mfoolad_insta") as $a){
            update_option($a,$_POST[$a]);
        }
    }
    if(isset($_POST['savese'])){
        $alls = [];
        for($i=0;$i<count($_POST['seller_name']);$i++){
            $alls[] = array("name"=>$_POST['seller_name'][$i],"phone"=>$_POST['seller_phone'][$i],"avatar"=>$_POST['seller_avatar'][$i]);
        }
        update_option("mfoolad_sellers",$alls);
    }
    if(isset($_POST['saves'])){
        foreach(array("mfoolad_slider","mfoolad_slider_btn1_url","mfoolad_slider_btn2_url","mfoolad_slider_btn1_text","mfoolad_slider_btn2_text") as $a){
            update_option($a,$_POST[$a]);
        }
    }
    if(isset($_POST['savei'])){
        foreach(array(
            "mfoolad_sabt_title1","mfoolad_sabt_title2","mfoolad_sabt_title3","mfoolad_sabt_title4",
            "mfoolad_sabt_desc1","mfoolad_sabt_desc2","mfoolad_sabt_desc3","mfoolad_sabt_desc4",
            "mfoolad_whymihan_video","mfoolad_whymihan_conv") as $a){
            update_option($a,$_POST[$a]);
        }
    }
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
.seller {
    width: 90%;
    margin: 10px auto;
    border: 1px solid #ccc;
    padding: 8px;
    border-radius: 8px;
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
    $("#saddrow").click(function(e){
        e.preventDefault();
        $("#sellers .keeper").append(`<div class="seller">
            <label>نام فروشنده</label>
            <input type="text" name="seller_name[]">
            <label>شماره تماس</label>
            <input type="text" name="seller_phone[]">
            <label>آواتار</label>
            <input type="text" class="filechooser ltr" name="seller_avatar[]"> 
        </div>`);
    })
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
        <button class="button button-primary" type="submit" name="saveg">ذخیره</button>
    </form>
    <form method="post" id="sellers" style="display:none">
    <div class="keeper">
<?php
foreach(get_option("mfoolad_sellers") as $s){
    echo '<div class="seller">
        <label>نام فروشنده</label>
        <input type="text" name="seller_name[]" value="'.$s['name'].'">
        <label>شماره تماس</label>
        <input type="text" name="seller_phone[]" value="'.$s['phone'].'">
        <label>آواتار</label>
        <input type="text" class="filechooser ltr" name="seller_avatar[]" value="'.(isset($s['avatar']) ? $s['avatar'] : "").'"> 
    </div>';
}
?></div>
    <button class="button button-primary" id="saddrow">افزودن</button>
    <button class="button button-primary" type="submit" name="savese">ذخیره</button>
    </form>
    <form method="post" id="slider" style="display:none">
        <label>عکس اسلایدر</label>
        <input type="text"  class="filechooser ltr" name="mfoolad_slider" value="<?=get_option("mfoolad_slider"); ?>">
        <label>لینک دکمه ی اول</label>
        <input type="text" class="ltr" name="mfoolad_slider_btn1_url" value="<?=get_option("mfoolad_slider_btn1_url"); ?>">
        <label>متن دکمه ی اول</label>
        <input type="text" name="mfoolad_slider_btn1_text" value="<?=get_option("mfoolad_slider_btn1_text"); ?>">
        <label>لینک دکمه ی دوم</label>
        <input type="text" class="ltr" name="mfoolad_slider_btn2_url" value="<?=get_option("mfoolad_slider_btn2_url"); ?>">
        <label>متن دکمه ی دوم</label>
        <input type="text" name="mfoolad_slider_btn2_text" value="<?=get_option("mfoolad_slider_btn2_text"); ?>">
        <button class="button button-primary" type="submit" name="saves">ذخیره</button>
    </form>
    <form method="post" id="index" style="display:none">
        <label>ویدئو چرا میهن فولاد</label>
        <input type="text" class="filechooser ltr" name="mfoolad_whymihan_video" value="<?=get_option("mfoolad_whymihan_video");?>">
        
        <label>ویدئو کنار تبدیل سختی</label>
        <input type="text" class="filechooser ltr" name="mfoolad_whymihan_conv" value="<?=get_option("mfoolad_whymihan_conv");?>">

        <label>عنوان برای مرحله 1 ثبت</label>
        <input type="text" name="mfoolad_sabt_title1" value="<?=get_option("mfoolad_sabt_title1"); ?>">
        <label>توضیحات برای مرحله 1 ثبت</label>
        <textarea name="mfoolad_sabt_desc1"><?=get_option("mfoolad_sabt_desc1"); ?></textarea>

        <label>عنوان برای مرحله 2 ثبت</label>
        <input type="text" name="mfoolad_sabt_title2" value="<?=get_option("mfoolad_sabt_title2"); ?>">
        <label>توضیحات برای مرحله 2 ثبت</label>
        <textarea name="mfoolad_sabt_desc2"><?=get_option("mfoolad_sabt_desc2"); ?></textarea>

        <label>عنوان برای مرحله 3 ثبت</label>
        <input type="text" name="mfoolad_sabt_title3" value="<?=get_option("mfoolad_sabt_title3"); ?>">
        <label>توضیحات برای مرحله 3 ثبت</label>
        <textarea name="mfoolad_sabt_desc3"><?=get_option("mfoolad_sabt_desc3"); ?></textarea>

        <label>عنوان برای مرحله 4 ثبت</label>
        <input type="text" name="mfoolad_sabt_title4" value="<?=get_option("mfoolad_sabt_title1"); ?>">
        <label>توضیحات برای مرحله 4 ثبت</label>
        <textarea name="mfoolad_sabt_desc4"><?=get_option("mfoolad_sabt_desc4"); ?></textarea>


        <button class="button button-primary" type="submit" name="savei">ذخیره</button>
    </form>
</div>
<?php
}
?>