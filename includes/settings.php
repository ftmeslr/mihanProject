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
function mfoolad_settings(){
update_option("mfoolad_sellers",array(
    array("name"=>"تست","phone"=>"09121112233"),
    array("name"=>"فلانی","phone"=>"90123332211"),
));
}
?>