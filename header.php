<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php wp_title(" - "); ?></title>
    <link href="<?php bloginfo("template_directory"); ?>/assets/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?php bloginfo("template_directory"); ?>/assets/css/swiper-bundle.min.css">
    <link rel="stylesheet" href="<?php bloginfo("template_directory"); ?>/style.css" />
    <?php wp_head(); ?>
</head>

<body dir="rtl" class="bg-main">

    <!-- header -->
    <header class="mt-3">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-9 col-xl-10">
                    <div class="col-12 bg-white white-shadow rounded10 px-3 py-4 d-flex align-items-center">

                        <div class="col-12 col-md-1">
                            <a href="<?php bloginfo("url"); ?>" title="میهن فولاد" class="logo">
                                <img src="<?=get_option("mfoolad_logo",get_bloginfo("template_directory")."/images/global/logo.webp"); ?>" alt="لوگو" class="img-fluid">
                            </a>
                        </div>
 
                        <div class="col-12 col-md-9 d-flex">
                            <div id="mainSubmenu" class="position-relative">
                                <span class="f15 l25-43 fw-bold cursor-pointer d-flex align-items-center">قیمت روز
                                    فولاد</span>
                                <div id="submenu" class="position-absolute z-3 bg-white rounded10 white-shadow2">

                                    <div class="col-12 d-flex">
                                        <ul id="submenuTabs" class="d-flex flex-column p-3 list-unstyled m-0">
<?php
$locations = get_nav_menu_locations();
if(isset($locations["foolad_menu"])){
    $menu = wp_get_nav_menu_object($locations["foolad_menu"]);
    if($menu){
        $items = wp_get_nav_menu_items( $menu->term_id, array( 'update_post_term_cache' => false ) );
        foreach($items as $i){
            if($i->menu_item_parent == 0){
                $parent = $i->ID;
                echo '<li href="'.$i->url.'" class="f13 l22 text-black p-2 rounded10 cursor-pointer position-relative"> '.$i->title.' <ul class="child position-absolute">';
                foreach($items as $t){
                    if($t->menu_item_parent == $parent){
                        echo '<li class="subItem"><a href="'.$t->url.'">'.$t->title.'</a></li>';
                    }
                }
                echo '</ul></li>';
            }
        }
    }
}
?>
                                            
                                                
                                                    
                                                    
                                        </ul>
                                    </div>

                                    <div class="col-12 text-justify d-flex align-items-start" id="catDesc">
                                        <p class="w-75 text-subtitle f11 l18-65 m-0 p-3">
                                            <?=get_option("mfoolad_menu_desc","فولاد سردکار (Cold Work Tool Steel) یکی از انواع فولاد است که درصد کربن
                                            بالایی دارد و با مقدار کمی از سایر عناصر آلیاژ شده است که برخی از آن ها
                                            عبارتند از تنگستن، منگنز، کروم و مولیبدن.که برای ساخت ابزارهایی همچون
                                            ابزارهای دستی و ماشینی کاملا مناسب است. سختی، مقاومت به سایش و قابلیت بازگشت
                                            شکل در دمای بالا، از ویژگی های بارز این نوع فولاد هستند."); ?>
                                        </p>
                                        <img src="<?php bloginfo("template_directory"); ?>/images/global/submenu-steel.jpg" alt="فولاد گرمکار" class="w-25 pt-3"
                                            draggable="false">
                                    </div>

                                </div>
                            </div>
                            <nav id="mainNav" class="f14 l23-74">
                                <?=strip_tags(wp_nav_menu( array( 'items_wrap' => '%3$s',"theme_location"=>"menu_items","container"=>"","echo"=>false,'link_class'=>"text-black px-2 transition2") ),'<a>'); ?>
                            </nav>
                        </div>

                        <div class="col-12 col-md-2">
                            <ul class="mainIcons p-0 m-0 d-flex list-unstyled justify-content-end">
                                <li class="text-black f18 cursor-pointer icon-search ms-3 position-relative"
                                    id="searchIcon">
                                    <div id="searchIconTrigger"
                                        class="position-absolute w-100 h-100 top-0 bottom-0 end-0 start-0"></div>
                                    <form method="get" action="<?php bloginfo("url"); ?>"
                                        class="position-absolute top-100 bg-white rounded10 white-shadow2 py-2 cursor-auto z-3">
                                        <label for="s" class="position-relative w-100">
                                            <input type="text" placeholder="جستجوی کالا ..." id="s" name="s"
                                                class="s text-subtitle f12 l20-35 border-0 w-100 py-2 px-3">
                                        </label>
                                    </form>
                                </li>
                                <li class="text-black f18 cursor-pointer icon-basket ms-3"></li>
                                <li class="text-black f18 cursor-pointer icon-user"></li>
                            </ul>
                        </div>

                    </div>
                </div>
                <div class="col-12 col-lg-3 col-xl-2 bg-white white-shadow rounded10 position-relative"
                    id="headContact">
                    <?php $phone = get_option("mfoolad_phone","۰۲۱۹۱۳۰۶۰۰۰"); ?>
                    <a href="tel:<?=$phone; ?>" class="d-flex align-items-center justify-content-around flex-column"
                        title="تماس با میهن فولاد">
                        <div class="col-12 d-flex align-items-center px-1 px-lg-2 px-xl-1 justify-content-evenly pt-3">
                            <span class="f13 l22 text-black">مشاوره و استعلام سفارش</span>
                            <span class="bg-red rounded100 p-2 d-flex align-items-center justify-content-center">
                                <i class="icon-phone f18"></i>
                            </span>
                        </div>

                        <span class="f28 l47-48 text-gray d-flex flex-row-reverse">
                            <?=mb_substr($phone,0,3); ?><span class="fw-bold text-red ps-2"><?=mb_substr($phone,3); ?></span>
                        </span>
                    </a>

                    <div class="col-12 bg-white white-shadow2 position-absolute z-2 end-0 p-2 rounded10 transition2"
                        id="headAssistants">
                        <div class="text-normal f14 l23-74 text-center py-3">
                            کارشناسان میهن فولاد
                        </div>
                        <ul class="m-0 p-0 list-unstyled" id="assistantItems">
<?php
$sellers = get_option("mfoolad_sellers",[]);
$def_av = get_bloginfo("template_directory").'/images/global/avatar.png';
foreach($sellers as $s){
    echo '<li class="transition1 px-2 rounded10">
        <a href="tel:'.$s['phone'].'" class="d-flex align-items-center">
            <img src="'.(isset($s['avatar']) ? $s['avatar'] : $def_av ).'" alt="'.$s['name'].'" class="h-auto">
            <div class="text p-2">
                <div class="phone f14 l23-74 text-normal">'.$s['phone'].'</div>
                <div class="assistantName f13 l22 text-subtitle">'.$s['name'].'</div>
            </div>
        </a>
    </li>';
}
?>

                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </header>
    <!-- header  -->