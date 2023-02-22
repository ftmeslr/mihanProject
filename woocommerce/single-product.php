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
                                                foreach($attr->get_options() as $op){
                                                    //print_r($attr);
                                                    $val = get_term_by('id',$op,$attr->get_name());
                                                    ?>
                                                    <div class="form-check px-1" >
                                                        <input class="form-check-input" type="radio" name="attribute_<?=$pkey; ?>" id="attribute_<?=$pkey."_".$op; ?>" style="display: none" value="<?=$val->slug; ?>">
                                                        <label style="width:32px; height: 32px;" class="form-check-label rounded10 d-flex align-items-center justify-content-center bg-gray f12 cursor-pointer" for="attribute_<?=$pkey."_".$op; ?>">
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
                                    <button id="addtobasket" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn bg-green-light f13" data-toggle="modal" data-target="#exampleModal">
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
                                        <p class="fw-bold f16">خرید آنلاین میلگرد</p>
                                        میلگرد میانه، یکی از محصولات بسیار پرکاربرد کارخانه فولاد آذربایجان شهر میانه است. این مجتمع، میلگردهای خود را با استاندارد A1، A2، A3 و A4 در سایزهای مختلف 8 تا 32 تولید و در بازار عرضه می کند. به دلیل اینکه میلگرد از محصولات فولادی بسیار بااهمیت در صنایع مختلف علی الخصوص ساختمان سازی است، اطلاع از قیمت روز میلگرد میانه به عنوان یکی از مقاطع فولادی مرغوب و باکیفیت بازار برای فعالین این حوزه اهمیت دارد.
                                        
                                        <p class="fw-bold f14 my-1">
                                        قیمت میلگرد میانه امروز
                                        </p>
                                        قیمت میلگرد میانه، بر اساس پارامترهای مشخصی که در بازار آهن تعریف شده است، مشخص می شود. وزن و سایز هر میلگرد، اثر بسیار زیادی بر نرخ این محصول دارد، مثلا قیمت میلگرد میانه سایز 18 از سایز 14 این کارخانه بیشتر است. بیشتر پیمانکاران پروژه های عمرانی غرب و شمال غرب کشور از این محصولات بخاطر کیفیت بالایی که دارند استفاده می کنند و به همین دلیل برای برآورد بودجه نهایی خود، لازم دارند تا قیمت امروز میلگرد میانه را داشته باشند.
                                        طبق نظر کارشناسان:
                                     
                                        <p class="fw-bold f14 my-1">
                                            قیمت روز میلگرد میانه 
                                        </p>
                                                              بهای میلگرد میانه، به‌دلیل پرکاربرد بودن این محصول، به‌صورت روزانه بروزرسانی می شود. این محصول فولادی که در سایزهای متنوع 10 تا 32 و در استانداردهای مختلف A2، A3، A4 در کارخانه فولاد آذربایجان تولید می‌شود، کیفیت بسیار بالایی دارد و در بازار آهن بسیار پرفروش است؛ به همین علت اطلاع از قیمت روز میلگرد میانه برای خریداران و مصرف کنندگان این مقطع اهمیت بسیار بالایی دارد تا بتوانند برای بودجه نهایی پروژه های خود تصمیم گیری درستی داشته باشند.                        </div>
                                    </div>
            
                                    <div class="bg-white white-shadow mt-4 p-4 rounded10">
            
                                    <a class="rounded10 d-flex justify-content-between align-items-center w-100 d-block f13 text-black bg-gray p-3" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                      <span>برای محاسبه و تعیین قیمت میلگرد میانه، به چه فاکتورهایی توجه می‌شود؟</span> 
                                      <i class="icon-chevron-down f9"></i>
                                    </a>
                                 
                                    <div class="collapse" id="collapseExample">
                                        <div class="card card-body f12 border-0">
                                            لورم ایپسوم یا طرح‌نما (به انگلیسی: Lorem ipsum) به متنی آزمایشی و بی‌معنی در صنعت چاپ، صفحه‌آرایی و طراحی گرافیک گفته می‌شود. لورم ایپسوم یا طرح‌نما (به انگلیسی: Lorem ipsum) به متنی آزمایشی و بی‌معنی در صنعت چاپ، صفحه‌آرایی و طراحی گرافیک گفته می‌شود.                        
                                        </div>
                                    </div>
            
                                    <a class="rounded10 mt-2 d-flex justify-content-between align-items-center w-100 d-block f13 text-black bg-gray p-3" data-bs-toggle="collapse" href="#collapseExample2" role="button" aria-expanded="false" aria-controls="collapseExample2">
                                        <span>برای محاسبه و تعیین قیمت میلگرد میانه، به چه فاکتورهایی توجه می‌شود؟</span> 
                                        <i class="icon-chevron-down f9"></i>
                                      </a>
                                   
                                      <div class="collapse" id="collapseExample2">
                                          <div class="card card-body f12 border-0">
                                              لورم ایپسوم یا طرح‌نما (به انگلیسی: Lorem ipsum) به متنی آزمایشی و بی‌معنی در صنعت چاپ، صفحه‌آرایی و طراحی گرافیک گفته می‌شود. لورم ایپسوم یا طرح‌نما (به انگلیسی: Lorem ipsum) به متنی آزمایشی و بی‌معنی در صنعت چاپ، صفحه‌آرایی و طراحی گرافیک گفته می‌شود.                        
                                          </div>
                                      </div>
            
                                      <a class="rounded10 mt-2 d-flex justify-content-between align-items-center w-100 d-block f13 text-black bg-gray p-3" data-bs-toggle="collapse" href="#collapseExample3" role="button" aria-expanded="false" aria-controls="collapseExample3">
                                        <span>برای محاسبه و تعیین قیمت میلگرد میانه، به چه فاکتورهایی توجه می‌شود؟</span> 
                                        <i class="icon-chevron-down f9"></i>
                                      </a>
                                   
                                      <div class="collapse" id="collapseExample3">
                                          <div class="card card-body f12 border-0">
                                              لورم ایپسوم یا طرح‌نما (به انگلیسی: Lorem ipsum) به متنی آزمایشی و بی‌معنی در صنعت چاپ، صفحه‌آرایی و طراحی گرافیک گفته می‌شود. لورم ایپسوم یا طرح‌نما (به انگلیسی: Lorem ipsum) به متنی آزمایشی و بی‌معنی در صنعت چاپ، صفحه‌آرایی و طراحی گرافیک گفته می‌شود.                        
                                          </div>
                                      </div>
            
                                    </div>
        
                                
                            </div>
                        </div>
            </div>

        </div>
<!-- Modal -->
<div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="d-flex modal-content d-flex col-12 flex-row  rounded10">
                                                <div class="col-5 p-4">
                                                    <div class="text-subtitle">اطلاعات سفارش درخواستی</div>
                                                    <div class="big_line"></div>
                                                    <p class="text-subtitle f13"> نام محصول:</p>
                                                    <p class="fw-bold f13"> میلگرد آجدار 28 ذوب آهن اصفهان (A3)</p>
                                                    <p class="text-subtitle f13"> مشخصات محصول:</p>
                                                    <div class="d-flex align-items-center justify-content-between f13">
                                                        <div class="d-flex align-items-center ">
                                                            <p >سایز:</p>
                                                            <p class="fw-bold">28</p>
                                                        </div>

                                                        <div class="d-flex align-items-center ">
                                                            <p >وزن:</p>
                                                            <p class="fw-bold">10</p>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-center justify-content-between f13">
                                                        <div class="d-flex align-items-center ">
                                                            <p >استاندارد:</p>
                                                            <p class="fw-bold">A3</p>
                                                        </div>

                                                        <div class="d-flex align-items-center ">
                                                            <p >میزان:</p>
                                                            <p class="fw-bold">100 کیلوگرم</p>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-center justify-content-between f13">
                                                        <div class="d-flex align-items-center ">
                                                            <p >مبلغ پیش فاکتور:</p>
                                                            <p class="fw-bold">A3</p>
                                                        </div>

                                                    </div>

                                                    <button class="w-100 bg-dark text-white border-0 h-46 rounded10">ویرایش سفارش</button>
                                                </div>
                                                <div class="col-7 bg-gray p-4 rounded10">
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <p class="f20 m-0">افزودن به پیش فاکتور</p>
                                                        <i class="f12 icon-close"></i>
                                                    </div>
                            
                                                    <div class="d-flex flex-column">
                                                        <label class="f13 text-subtitle mt-3 mb-1" for="name">نام و نام خانوادگی</label>
                                                        <input name="name" id="name" type="text" class="rounded10 border bg-gray h-46">
                                                    </div>
                                                    <div class="d-flex flex-column">
                                                        <label class="f13 text-subtitle  mt-3 mb-1" for="tel">شماره تماس</label>
                                                        <input name="tel" id="tel" type="text" class="rounded10 border bg-gray h-46" >
                                                    </div>
                                                    <div class="d-flex flex-column">
                                                        <label class="f13 text-subtitle mt-3 mb-1" for="description">توضیحات</label>
                                                        <textarea name="description" id="description" type="text" class="rounded10 border bg-gray "> </textarea>
                                                    </div>

                                                    <div class="d-flex justify-content-between align-items-center mt-3">
                                                        <p class="m-0 f12 text-subtitle">پس از ثبت پیش فاکتور، همکاران ما با شما تماس خواهند گرفت</p>
                                                        <button class="bg-green-light border-0 text-white f13 px-2 h-46 rounded10">ثبت پیش فاکتور</button>
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