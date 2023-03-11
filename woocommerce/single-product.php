<?php get_header(); the_post(); global $product;  ?>

    <!--BreadCrumb-->
     
    <div class="container">
        <nav aria-label="breadcrumb" class="my-4"  >
            <ol class="breadcrumb d-flex align-items-center text-subtitle">
                <?php woocommerce_breadcrumb(); ?>
            </ol>
        </nav>
    </div>
    <!--BreadCrumb-->
        <div class="container" id="singlePage">
            <div class="row">
                <div class="col-9 ">
                    <div class="bg-white white-shadow d-flex">
                        <div class="p-1 rounded10" style="width:318px; height:298px; ">
                            <?php the_post_thumbnail("thumbnail",array("alt"=>get_the_title())); ?>
                        </div>  


                        <div class=" w-100 p-3 ">
                        <div class="d-flex justify-content-between">
                            <p class="f20 fw-bold"><?php the_title(); ?></p>
                            <div class="bg-gray rounded10 p-2 d-flex align-items-center justify-content-center" style="width:40px; height:40px">
                                <i class="icon-save-thin f20 fw-bold"></i>
                            </div>
                        </div>
                            <p class="text-subtitle f12"><?php the_excerpt(); ?></p>
                            <form method="post">
                            <?php 
									if($product->has_child()){
                                        
                                        ?>
                                        
                                        <script>
                                            var prices = [];
                                            <?php
                                            $prices = $product->get_available_variations();
                                            foreach($prices as $price){
                                                $vals = "";
                                                foreach($price['attributes'] as $key=>$val){
                                                    //$key = substr($key,strlen("attribute_"));
                                                    if(!empty($val)){
                                                        $vals.="'".$key.'\':"'.$val.'",';
                                                    }
                                                }
                                                if(strlen($vals)>0){
                                                    $vals = substr($vals,0,-1);
                                                }
                                                echo 'prices[prices.length] = {'.$vals.',price:"'.number_format($price['display_price']).'",image:"'.$price['image']['url'].'"}'."\n";
                                            }
                                            ?>
                                        </script>
                                        <?php foreach($product->get_attributes() as $attr){
                                            if($attr['variation'] == 1){
                                                $pkey = strtolower(urlencode($attr->get_name()));
                                            ?>
                                             <div class="d-flex align-items-center"><p class="m-0 ms-2 f13"><?=wc_attribute_label($attr->get_name()); ?>: </p>
                                                
                                                <?php
                                                $def = $product->default_attributes;
                                                foreach($attr->get_options() as $op){
                                                    $val = get_term_by('id',$op,$attr->get_name());
                                                    ?>
                                                    <div class="form-check px-1" >
                                                        <input class="form-check-input" type="radio" name="attribute_<?=$pkey; ?>" id="attribute_<?=$pkey."_".$op; ?>" style="display: none" value="<?=$val->slug; ?>"<?=(isset($def[$pkey]) && $def[$pkey] == $val->slug ? " checked" : "");?>>
                                                        <label style="width:32px; height: 32px;<?=(isset($def[$pkey]) && $def[$pkey] == $val->slug ? "border:1px solid red" : "");?>" class="form-check-label rounded10 d-flex align-items-center justify-content-center bg-gray f12 cursor-pointer" for="attribute_<?=$pkey."_".$op; ?>">
                                                            <?=$val->name; ?>
                                                        </label>
                                                    </div>
                                                <?php } ?>
                                               
                                            </div>
                                        <?php } }  ?>
                                        <script>
                                            function objectLength(obj) {
                                                var result = 0;
                                                for(var prop in obj) {
                                                    if (obj.hasOwnProperty(prop)) {
                                                    // or Object.prototype.hasOwnProperty.call(obj, prop)
                                                    result++;
                                                    }
                                                }
                                                return result;
                                            }
                                            var $ = jQuery;
                                            $(function(){
                                                $(".form-check.px-1 input").change(function(){
                                                    var labs = []
                                                    $(this).parent().parent().find("label").css({width:"32px",height:"32px",border:"none"})
                                                    $(this).parent().find("label").css({"border":"1px solid red",width:"32px",height:"32px"});
                                                    
                                                    var items = $(".form-check.px-1 input:checked");
                                                    for(i=0;i<items.length;i++){
                                                        labs[labs.length] = {key:items.eq(i).attr("name"),val:items.eq(i).val()};
                                                    }
                                                    var price = 0;
                                                    for(i=0;i<prices.length;i++){
                                                        var check = true;
                                                        for(j=0;j<labs.length;j++){
                                                            if(!prices[i][labs[j].key] || prices[i][labs[j].key] != labs[j].val){
                                                                check = false;
                                                            }
                                                        }
                                                        if(check && objectLength(prices[i])-2 == labs.length ){
                                                            $(".c-gallery__img .js-gallery-img").attr("src",prices[i]['image'])
                                                            price = prices[i]['price'];
                                                            break;
                                                        }
                                                    }
                                                    
                                                    if(price){
                                                        $(".product_price").text(price);
                                                        $("#addtobasket").show();
                                                    } else {
                                                        $(".product_price").text("نامشخص");
                                                        $("#addtobasket").hide();
                                                    }
                                                });
                                            });
                                        </script>
                                        <?php } ?>
                                
                                
                            

                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex">
                                    <p class="text-subtitle m-0">
                                        قیمت:    
                                    </p>
                                    <p class="fw-bold m-0 mx-2">
                                        <span class="product_price"><?=$product->get_price(); ?></span> <span><?=get_woocommerce_currency_symbol();?></span> 
                                    </p>
                                </div>
                                <div class="d-flex">
                                    <div class="d-flex align-items-center px-2 py-1 border d-flex justify-content-center ms-2 rounded10">
                                        <p class="f12 bg-gray rounded10 p-2 text-subtitle m-0 ms-3">واحد فروش : کیلوگرم</p>
                                        <i onclick="increment()" class="icon-chevron-top-thin f6  fw-bold cursor-pointer"></i>
                                        <input id="weightWant" value="24" type="text" placeholder="234" class="border-0 text-center" style="width: 60px;">
                                        <i onclick="decrement()" class=" icon-chevron-down-thin f6 fw-bold cursor-pointer ms-2"></i>

                                    </div>
                                    <button type="button" class="btn bg-green-light f13 addtobasket" data-pid="<?=$post->ID; ?>">
                                        افزودن به پیش فاکتور
                                    </button>
                                    <!-- Button trigger modal -->
  
                                    
  
                                </div>
                            </div>
                        </form>
                        </div>
                        </div>
                </div>
                <div class="col-3 leftSideBar">
                    <div class="bg-white white-shadow p-3 rounded10" >
                        <div class="d-flex justify-content-between align-items-center f13">
                            <p>ابعاد</p>
                            <p class="fw-bold"><?=$product->get_attribute( 'pa_dimen' ); ?></p>
                        </div>
                        <div class="big_line"></div>
                        <div class="d-flex justify-content-between align-items-center f13">
                            <p>استاندارد</p>
                            <p class="fw-bold"><?=$product->get_attribute( 'pa_standard' ); ?></p>
                        </div>
                        <div class="big_line"></div>
                        <div class="d-flex justify-content-between align-items-center f13">
                            <p>حالت</p>
                            <p class="fw-bold"><?=$product->get_attribute( 'pa_state' ); ?></p>
                        </div>
                        <div class="big_line"></div>
                        <div class="d-flex justify-content-between align-items-center f13">
                            <p>سایز</p>
                            <p class="fw-bold"><?=$product->get_attribute( 'pa_size' ); ?></p>
                        </div>
                        <div class="big_line"></div>
                        <div class="d-flex justify-content-between align-items-center f13">
                            <p>نوع</p>
                            <p class="fw-bold"><?=$product->get_attribute( 'pa_tyeps' ); ?></p>
                        </div>
                    </div>
                </div>

            </div>
            <div id="categories" class="mt-3">
                        <div class="row">
            <?php get_sidebar(); ?>
        
                            <div class="col-8">
                                    <div class="bg-white white-shadow p-4 rounded10 mb-3">
                                        <p class="fw-bold">نوسانات قیمت میلگرد آجدار 28 ذوب آهن اصفهان (A3)</p>
                                        <canvas id="line-chart"></canvas>
                                        <div class="d-flex align-items-center justify-content-center w-100 mt-4">
                                                <div class="p-2 px-3 bg-red f13 timeScale bg-gray activeTimeScale cursor-pointer" id="oneWeek">
                                                    یک هفته اخیر
                                                </div>
                                                <div class="p-2 px-3 f13 timeScale bg-gray mx-3  cursor-pointer" id="oneMounth" >
                                                    یک ماه اخیر
                                                </div>
                                                <div class="p-2 px-3 f13 timeScale bg-gray  cursor-pointer" id="threeMounth">
                                                    سه ماه اخیر
                                                </div>
                                        </div>

                                    </div>

                                    
                                
                                    <div class="d-flex ">
                                        <div class="col d-flex flex-column align-items-center justify-content-center bg-white white-shadow py-4 rounded-right">
                                            <div class="bg-red rounded-circle p-2 d-flex justify-content-center align-items-center" style="width:40px; height:40px;" >
                                                <i class="icon-search text-white"></i>
                                            </div>
                                            <p class="f13 my-2 fw-bold">بررسی قیمت</p>
                                            <p class="f13 text-subtitle">متن آزمایشی یک خطی</p>
                                        </div>
                                        <div class="col d-flex flex-column align-items-center justify-content-center bg-white white-shadow py-4">
                                            <div class="bg-red rounded-circle p-2 d-flex justify-content-center align-items-center" style="width:40px; height:40px;" >
                                                <i class="icon-basket2 text-white f18"></i>
                                            </div>
                                            <p class="f13 my-2 fw-bold">افزودن به پیش فاکتور</p>
                                            <p class="f13 text-subtitle">متن آزمایشی یک خطی</p>
                                        </div>
                                        <div class="col d-flex flex-column align-items-center justify-content-center bg-white white-shadow py-4">
                                            <div class="bg-red rounded-circle p-2 d-flex justify-content-center align-items-center" style="width:40px; height:40px;" >
                                                <i class="icon-headphones text-white f18"></i>
                                            </div>
                                            <p class="f13 my-2 fw-bold">ارسال به کارشناس</p>
                                            <p class="f13 text-subtitle">متن آزمایشی یک خطی</p>
                                        </div>
                                        <div class="col d-flex flex-column align-items-center justify-content-center bg-white white-shadow py-4">
                                            <div class="bg-red rounded-circle p-2 d-flex justify-content-center align-items-center" style="width:40px; height:40px;" >
                                                <i class="icon-order4 text-white f28"></i>
                                            </div>
                                            <p class="f13 my-2 fw-bold">پرداخت فاکتور</p>
                                            <p class="f13 text-subtitle">متن آزمایشی یک خطی</p>
                                        </div>
                                        <div class="col d-flex flex-column align-items-center justify-content-center bg-white white-shadow rounded-left">
                                            <div class="bg-green-light rounded-circle p-2 d-flex justify-content-center align-items-center" style="width:40px; height:40px;" >
                                                <i class="icon-truck text-white"></i>
                                            </div>
                                            <p class="f13 my-2 fw-bold text-green">ارسال محصول</p>
                                            <p class="f13 text-subtitle">متن آزمایشی یک خطی</p>
                                        </div>
            
                                    </div>
            
                                    <div class="w-100 banner"></div>
                                    <div class="bg-white white-shadow p-4 rounded10">
                                    <div class="f13 l22">
                                        <?php the_content(); ?>
                                    </div>
<?php
$qu = new WP_Query(array("post_type"=>"seofaq","meta_query"=>array(
    array("key"=>"type","value"=>"faq_single"),
)));
if($qu->have_posts()){
?>
                                    <div class="bg-white white-shadow mt-4 p-4 rounded10">
<?php

while($qu->have_posts()){
    $qu->the_post();
    global $post;
    $rows = get_post_meta($post->ID,"rows",true) ?: [];
    foreach($rows as $r){
        echo '<a class="rounded10 mt-2 d-flex justify-content-between align-items-center w-100 d-block f13 text-black bg-gray p-3" data-bs-toggle="collapse" href="#'.md5($r['title'].$r['text']).'" role="button" aria-expanded="false" aria-controls="'.md5($r['title'].$r['text']).'">
                <span>'.$r['title'].'</span> 
                <i class="icon-chevron-down f9"></i>
            </a>
        
            <div class="collapse" id="'.md5($r['title'].$r['text']).'">
                <div class="card card-body f12 border-0">'.$r['text'].'</div>
            </div>';
    }
}
?>
            
                                    </div>
<?php } ?>
                                
                            </div>
                        </div>
            </div>

        </div>
        </div>


        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
        <script>
            new Chart(document.getElementById("line-chart"), {
            type: 'line',
            data: {
                labels: ["10/13","10/14","10/15",'10/16','10/17',"10/39"],
                datasets: [{ 
                    data: [349450,349250,349200,349400,349200, 349300],
                    borderColor: "#F94144",
                    fill: false
                }
                ]
            },
            options: {
                title: {
                display: false,
                },
                labels:{
                    display: false
                },
                legend: {
                display: false,
                }
            }
            });

            </script>
<?php get_footer(); ?>