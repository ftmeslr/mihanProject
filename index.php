<?php get_header(); ?>
  <!-- HeroSlider -->
  <section id="heroSlider" class="my-3 rounded10 overflow-hidden">
        <div class="container ps-0">
            <div class="row position-relative">
                <img src="<?=get_option("mfoolad_slider",get_bloginfo("template_directory")."/images/index/heroSlider.jpg"); ?>" class="w-100 h-auto">
                <div class="text position-absolute top-50 end-0 me-5 translate-middle-y">
                    <h1 class="f48 l81-39 text-white">فروشگاه تخصصی <strong class="text-red">خرید فولاد</strong></h1>
                    <p class="f14 l23-74 text-white mb-3">
                        <strong>میهن فولاد</strong>، عرضه کننده انواع فولادهای آلیاژی سردکار، گرمکار، قالب پلاستیک،<br>
                        سمانتاسیون، استیل، آهن آلات صنعتی و ...
                    </p>
                    <div class="buttons d-flex">
                        <a href="<?=get_option("mfoolad_slider_btn1_url","#"); ?>" class="text-black f14 l23-74 rounded10 bg-white px-4 py-2 ms-2"><?=get_option("mfoolad_slider_btn1_text","مشاهده محصولات"); ?></a>
                        <a href="<?=get_option("mfoolad_slider_btn2_url","#"); ?>" class="text-white f14 l23-74 rounded10 bg-red px-4 py-2 ms-2 btn-red-shadow"><?=get_option("mfoolad_slider_btn2_text","مشاهده محصولات"); ?></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- HeroSlider -->

    <!-- index priceList -->
    <section id="priceList">
        <div class="container">
            <div class="row">
                <h2 class="f32 l54-26 text-black fw-bold text-center mt-lg-4">لیست قیمت محصولات</h2>
                <span class="text-subtitle f14 l23-74 text-center d-inline-flex align-items-center w-auto m-auto">
                    <span class="icon-return ms-2"></span>
                    آخرین بروزرسانی: <span class="me-1">امروز</span>
                </span>

                <div class="d-flex align-items-start">

                    <div class="nav flex-column align-items-start white-shadow rounded10 py-2 nav-pills me-3 col-12 col-lg-2"
                        id="v-pills-tab" role="tablist" aria-orientation="vertical">
<?php
$terms = get_terms(array("taxonomy"=>"product_cat","hide_empty"=>true));
$def = 0;
foreach($terms as $t){
    echo '<button class="nav-link f15 l25-43 bg-transparent text-subtitle w-100 text-end position-relative'.(!$def ? " active" : "").'"
    id="v-tab'.$t->term_id.'" data-bs-toggle="pill" data-bs-target="#v-cont'.$t->term_id.'"
    type="button" role="tab" aria-controls="v-pills-'.$t->term_id.'" aria-selected="true">'.$t->name.'</button>';
    $def = $t->slug;
}
?>
                    </div>

                    <div class="tab-content col-12 col-lg-10 text-center" id="v-pills<?=$t->term_id; ?>-tabContent">
<?php foreach($terms as $t2){ ?>
                    <div class="tab-pane fade<?=($t2->slug == $def ? " show active" : ""); ?>" id="v-cont<?=($t2->term_id);?>" role="tabpanel"
                            aria-labelledby="v-pills-<?=$t2->term_id; ?>">
                            <div class="swiper mySwiper pe-lg-3" id="priceListSwiper" dir="rtl">
                                <div class="swiper-wrapper">
<?php
query_posts(array("showposts"=>"8","post_type"=>"product","product_cat"=>$def));
while(have_posts()){ the_post();
    global $product;

?>
                                    <div class="swiper-slide bg-white white-shadow rounded10 p-3 flex-column">
                                        <div class="pic position-relative rounded10 overflow-hidden">
                                            <a href="<?php the_permalink(); ?>">
                                                <?php the_post_thumbnail("thumbnail",array("alt"=>get_the_title())); ?>
                                                <span
                                                    class="f12 l20-35 text-subtitle position-absolute z-1 start-0 bottom-0 m-2 rounded3rem bg-white py-1 px-2 d-flex align-items-center">
                                                    سایز: <span><?=$product->get_attribute( 'pa_size' ); ?></span>
                                                    <i class="icon-filter ms-1 me-2"></i>
                                                </span>
                                            </a>
                                        </div>
                                        <div class="py-2 f12 l20-35 text-subtitle w-100 text-end">
                                            ضخامت: <span><?=$product->get_attribute( 'pa_weight' ); ?></span>
                                        </div>
                                        <a href="<?php the_permalink(); ?>" class="mb-3 w-100 text-end">
                                            <div class="title f20 l33-91 text-black fw-bold transition1"><?php the_title(); ?></div>
                                        </a>
                                        <div class="icons d-flex justify-content-between align-items center w-100">
                                            <i
                                                class="icon-basket2 text-subtitle bg-gray rounded10 f18 cursor-pointer transition1 d-flex align-items-center justify-content-center"></i>
                                            <div class="priceProd d-flex align-items-center">
                                                <div class="price d-flex flex-column align-items-end ps-2">
                                                    <span class="text-black f20 l30-52 fw-bold"><?=$product->get_price(); ?></span>
                                                    <span class="f12 l20-35 text-subtitle">تومان</span>
                                                </div>
                                                <i
                                                    class="icon-priceUp text-green rounded10 f11 cursor-pointer d-flex align-items-center justify-content-center"></i>
                                            </div>
                                        </div>
                                    </div>
<?php } wp_reset_query(); ?>
                                </div>
                                <div class="swiper-button-next icon-arrow-left bg-white rounded100 white-shadow2 f12 start-0"></div>
                                <div class="swiper-button-prev icon-arrow-right bg-white rounded100 white-shadow2 f12"></div>
                            </div>
                        

                        <a href="<?=get_term_link($t2); ?>"
                            class="text-white f15 l25-43 rounded10 py-2 px-3 fw-bold transition1 d-inline-flex align-items-center w-auto my-3"
                            id="priceListFullList">
                            مشاهده همه قیمت‌های <?=$t2->name; ?>
                            <i class="icon-arrow-left me-3 f11"></i>
                        </a>
						
						</div>
                    
<?php } ?>

                        </div>
                </div>
            </div>
        </div>
    </section>
    <!-- index priceList -->

    <!-- Order steps -->
    <section id="orderSteps" class="my-5">
        <div class="container">
            <div class="row my-5 position-relative">
                <svg width="1342" height="196" viewBox="0 0 1342 196" fill="none" xmlns="http://www.w3.org/2000/svg"
                    class="position-absolute top-0 start-0 z-n1 w-100 h-100" id="orderStepsLine">
                    <path
                        d="M0.5 191.162C152.973 191.162 146.142 19.3565 287 32.5942C427.858 45.8318 385.04 191.182 540.5 175.459C695.96 159.736 621.937 24.2858 796.5 24.2858C931 24.2858 934.5 203.104 1037 191.162C1139.5 179.221 1133.37 6.88387 1189.5 1.10578C1286 -8.82857 1266.92 191.162 1323.38 191.162C1323.38 191.162 1313.27 205.956 1341.5 175.459"
                        stroke="#E08484" stroke-linecap="round" stroke-linejoin="round" stroke-dasharray="8 8" />
                </svg>
                <div class="col-6 col-lg-2 d-flex align-items-end mh-200">
                    <div id="orderStepsLabel"
                        class="bg-red text-white py-2 px-3 f18 l30-52 red-shadow d-inline-flex text-center flex-column">
                        مراحل سفارش<span class="fw-bold">مــیـهـن فـولـاد</span></div>
                </div>

                <div class="col-6 col-lg-2 d-flex flex-column align-items-center justify-content-between mh-200">
                    <div class="text d-flex flex-column">
                        <div class="textTitle f14 text-black text-center l27-13 fw-bold mb-2"><?=get_option("mfoolad_sabt_title1","بـررسی قـیمت و مـوجودیت کـالا"); ?></div>
                        <p class="textContent f11 text-subtitle l20-35 text-justify m-0">
                            <?=get_option("mfoolad_sabt_desc1","معمولا طراحان گرافیک برای صفحه‌آرایی، نخست از متن‌های آزمایشی و بی‌معنی استفاده می‌کنند تا
                            صرفا به مشتری یا صاحب کار خود نشان دهند"); ?>
                        </p>
                    </div>
                    <div
                        class="step first stepBot white-shadow d-flex align-items-center f40 l-67-83 text-black bg-white py-1 px-3 rounded3rem position-relative">
                        <span>۱</span>
                    </div>
                </div>

                <div class="col-6 col-lg-2 d-flex flex-column align-items-center justify-content-between mh-200">
                    <div
                        class="step second stepTop white-shadow d-flex align-items-center f40 l-67-83 text-black bg-white py-1 px-3 rounded3rem position-relative">
                        <span>۲</span>
                    </div>
                    <div class="text d-flex flex-column">
                        <div class="textTitle f14 text-black text-center l27-13 fw-bold mb-2">
                        <?=get_option("mfoolad_sabt_title2","افـزودن به سـبد اسـتعلام گـیری"); ?>    
                        </div>
                        <p class="textContent f11 text-subtitle l20-35 text-justify m-0">
                        <?=get_option("mfoolad_sabt_desc2","معمولا طراحان گرافیک برای صفحه‌آرایی، نخست از متن‌های آزمایشی و بی‌معنی استفاده می‌کنند تا
                            صرفا به مشتری یا صاحب کار خود نشان دهند"); ?>
                        </p>
                    </div>
                </div>

                <div class="col-6 col-lg-2 d-flex flex-column align-items-center justify-content-between mh-200">
                    <div class="text d-flex flex-column">
                        <div class="textTitle f14 text-black text-center l27-13 fw-bold mb-2">
                        <?=get_option("mfoolad_sabt_title3","ارسـال به کـارشناس فـروش و بررسی"); ?>      
                        </div>
                        <p class="textContent f11 text-subtitle l20-35 text-justify m-0">
                        <?=get_option("mfoolad_sabt_desc3","معمولا طراحان گرافیک برای صفحه‌آرایی، نخست از متن‌های آزمایشی و بی‌معنی استفاده می‌کنند تا
                            صرفا به مشتری یا صاحب کار خود نشان دهند"); ?>
                        </p>
                    </div>
                    <div
                        class="step third stepBot white-shadow d-flex align-items-center f40 l-67-83 text-black bg-white py-1 px-3 rounded3rem position-relative">
                        <span>۳</span>
                    </div>
                </div>

                <div class="col-6 col-lg-2 d-flex flex-column align-items-center justify-content-between mh-200">
                    <div
                        class="step fourth stepTop white-shadow d-flex align-items-center f40 l-67-83 text-black bg-white py-1 px-3 rounded3rem position-relative">
                        <span>۴</span>
                    </div>
                    <div class="text d-flex flex-column">
                        <div class="textTitle f14 text-black text-center l27-13 fw-bold mb-2">
                        <?=get_option("mfoolad_sabt_title4","دریـافـت و پـرداخت فـاکـتور"); ?>    
                        </div>
                        <p class="textContent f11 text-subtitle l20-35 text-justify m-0">
                        <?=get_option("mfoolad_sabt_desc4","معمولا طراحان گرافیک برای صفحه‌آرایی، نخست از متن‌های آزمایشی و بی‌معنی استفاده می‌کنند تا
                            صرفا به مشتری یا صاحب کار خود نشان دهند"); ?>                        </p>
                    </div>
                </div>

                <div class="col-6 col-lg-2 d-flex align-items-end justify-content-end mh-200">
                    <div
                        class="text-red py-2 f18 l30-52 d-inline-flex text-center flex-column">
                        <span class="fw-bold mb-3">ارسال محصول</span>
                        <div
                            class="step final stepTop red-shadow d-flex align-items-center f40 l-67-83 text-white bg-red p-2 pe-3 rounded3rem position-relative">
                            <span class="d-list-item">۵</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- why mihan :) -->
    <section id="whyMihan" class="my-5">
        <div class="container">
            <div class="d-flex col-12 mt-5">
            <div class="d-flex flex-column col-6 justify-content-center">
            <h2 class="fw-bold">چرا میهن فولاد</h2>
            <p class="text-subtitle f13 m-0">این مجموعه مفتخر است با 25 سال سابقه همراه شما عزیزان صنعتگر باشد و در کنار فروش، با سابقه 25 ساله قالب سازی می تواند مشاوره متالوژی علمی و تجربی در زمینه انتخاب فولاد به شما عزیزان ارائه نماید.
                <span id="dots">...</span><span id="more">
                    این مجموعه مفتخر است با 25 سال سابقه همراه شما عزیزان صنعتگر باشد و در کنار فروش، با سابقه 25 ساله قالب سازی می تواند مشاوره متالوژی علمی و تجربی در زمینه انتخاب فولاد به شما عزیزان ارائه نماید.
           </span>
                </p>

                <p onclick="readMore()" class="text-subtitle f13 cursor-pointer"d="myBtn">مطالعه بیشتر...</p> 

                <div class="d-flex mt-4 " >
                    <div class="d-flex bg-white align-items-center justify-content-center p-2 rounded10 ms-2 white-shadow ">
                        <i
                        class="icon-shield text-link rounded10 f24  d-flex align-items-center justify-content-center"></i>
                        <p class="my-0 mx-2 f13 fw-bold">تیم مجرب و با سابقه</p>
                    </div>
                    <div class="d-flex  align-items-center justify-content-center p-2 rounded10 mx-2 bg-white white-shadow ">
                        <i
                        class="icon-heart2 text-red rounded10 f24  d-flex align-items-center justify-content-center"></i>
                        <p class="my-0 mx-2 f13 fw-bold">کنترل کیفی محصولات</p>
                    </div>
                    <div class="d-flex align-items-center justify-content-center p-2 rounded10 me-2 bg-white white-shadow ">
                        <i
                        class="icon-license text-green rounded10 f24  d-flex align-items-center justify-content-center"></i>
                        <p class="my-0 mx-2 f13 fw-bold">تضمین بهترین قیمت</p>
                    </div>
                </div>
            </div>
            <div class="video col-6 d-flex justify-content-end object-cover">
                <video  poster="<?php bloginfo("template_directory"); ?>/images/global/video-cover.png"
                class="rounded10"
                width="542"
                height="325" controls>
                    <source src="<?=get_option("mfoolad_whymihan_video","https://archive.org/download/BigBuckBunny_124/Content/big_buck_bunny_720p_surround.mp4"); ?>" type="video/mp4">
                    Your browser does not support the video tag.
                  </video>
            </div>
            </div> 
        </div>
    </section>
    <!-- why mihan :) -->


        <!-- conversion  -->
        <section id="conversion" class="my-5">
            <div class="container">
                <div class="d-flex col-12 ">
                    <div class="col-5 ">
                        <div class="d-flex">
                            <div class="video  d-flex justify-content-end object-cover">
                                <video  poster="<?php bloginfo("template_directory"); ?>/images/global/video-cover-2.png"
                                class="rounded10"
                                width="530"
                                height="410" controls>
                                    <source src="<?=get_option("mfoolad_whymihan_conv","https://archive.org/download/BigBuckBunny_124/Content/big_buck_bunny_720p_surround.mp4"); ?>" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                        </div>
                    </div>
                    <div class="col-7">
                        <div class="col-12 d-flex">
                            <div class="col-6 ">
                        
                        <div class="d-flex flex-column align-items-end justify-content-end bg-white p-4 rounded10 ms-2 white-shadow ">
                            <div class="d-flex flex-column w-100">
                            <p class="f18 fw-bold mb-1">تبدیل سختی</p>
                            <p class="f13 text-subtitle mb-2">در جدول زیر سه مقیاس ویکرز، برینل و راکول نوشته شده است.</p>
                        </div>
                            <div class="border p-2 rounded10">
                                <p class="f12 text-subtitle l20-35 m-0">معمولاً سختی حاکی از مقاومت در برابر تغییر شکل بوده و این خاصیت در فلزات معیاری از مقاومت آنها در برابر تغییر شکل پلاستیک یا مومسان است .</p>
                            </div>
                            <div class="dropdown w-100 mt-2">
                                <button type="button" class="f13 btn border dropdown-toggle w-100 d-flex align-items-center justify-content-between bg-gray h-46" data-bs-toggle="dropdown">
                                  HB
                                </button>
                                <ul class="dropdown-menu">
                                  <li><a class="dropdown-item" href="#">Link 1</a></li>
                                  <li><a class="dropdown-item" href="#">Link 2</a></li>
                                  <li><a class="dropdown-item" href="#">Link 3</a></li>
                                </ul>
                              </div> 
                              <div class="dropdown w-100 mt-2">
                                <button type="button" class="f13 btn border dropdown-toggle w-100 d-flex align-items-center justify-content-between  h-46" data-bs-toggle="dropdown">
                                  HV
                                </button>
                                <ul class="dropdown-menu">
                                  <li><a class="dropdown-item" href="#">Link 1</a></li>
                                  <li><a class="dropdown-item" href="#">Link 2</a></li>
                                  <li><a class="dropdown-item" href="#">Link 3</a></li>
                                </ul>
                              </div> 
                              <div class="dropdown w-100 mt-2">
                                <button type="button" class="f13 btn border dropdown-toggle w-100 d-flex align-items-center justify-content-between  h-46" data-bs-toggle="dropdown">
                                  HRC
                                </button>
                                <ul class="dropdown-menu">
                                  <li><a class="dropdown-item" href="#">Link 1</a></li>
                                  <li><a class="dropdown-item" href="#">Link 2</a></li>
                                  <li><a class="dropdown-item" href="#">Link 3</a></li>
                                </ul>
                              </div> 

                              <button class="rounded10 bg-green-light f13 text-white px-4 h-46 border-0 mt-2">
                                محاسبه
                              </button>
                        </div>
                       
                    </div>
                      
                    <div class="col-6 ">
                            <div class="d-flex flex-column align-items-end justify-content-end bg-white p-4 rounded10 ms-2 white-shadow ">
                                <div class="d-flex flex-column w-100">
                                    <p class="f18 fw-bold mb-1">محاسبه وزن و ریزش </p>
                                    <p class="f13 text-subtitle">اعداد را به سانتی متر وارد نمایید</p>
                                    
                            </div>
                           
                                <div class="dropdown w-100 mt-4">
                                    <button type="button" class="f13 btn border dropdown-toggle w-100 d-flex align-items-center justify-content-between bg-gray h-46" data-bs-toggle="dropdown">
                                      محاسبه وزن تسمه
                                    </button>
                                    <ul class="dropdown-menu">
                                      <li><a class="dropdown-item" href="#">Link 1</a></li>
                                      <li><a class="dropdown-item" href="#">Link 2</a></li>
                                      <li><a class="dropdown-item" href="#">Link 3</a></li>
                                    </ul>
                                  </div> 
                                  <div class="dropdown w-100 mt-2 relative">
                                   <input  />
                                   <div class="tag">
                                    <p class="m-0">طول</p>
                                   </div>
                                  </div> 
                                  <div class="dropdown w-100 mt-2">
                                    <input  />
                                    <div class="tag">
                                     <p class="m-0">عرض</p>
                                    </div>
                                  </div> 
                                  <div class="dropdown w-100 mt-2">
                                    <input  />
                                   <div class="tag">
                                    <p class="m-0">ارتفاع</p>
                                   </div>
                                  </div> 
    
                                  <button class="rounded10 bg-green-light f13 text-white px-4 h-46 border-0 mt-2">
                                    محاسبه
                                  </button>
                            </div>
                           
                    </div>
                </div>
                    </div>
                   
                </div> 
            </div>
        </section>
        <!-- conversion -->

         <!-- Blog -->
        <section id="blog" class="my-5">
            <div class="container">
                <div class="d-flex col-12 ">
                    <div class="col-6">
                         <div class="d-flex align-items-center justify-content-between ps-4" >
                            <p class="m-0 f24 fw-bold">آخرین مقالات</p>
                            <i class="icon-arrow-left f9"></i>
                         </div>
                        <div class="d-flex flex-column align-items-start justify-content-start bg-white p-4 rounded10 ms-2 white-shadow mt-3 ">
<?php
$not = 0;
query_posts(array("showposts"=>"1","post_type"=>"articles"));
while(have_posts()){
the_post();
$not = $post->ID;
?>
                        <div class="d-flex">
                                <div class="w-100">
                                    <?php the_post_thumbnail("medium",array("alt"=>get_the_title())); ?>
                                </div>
                                <div class="d-flex flex-column me-3">
                                    <div class="d-flex f12 text-subtitle">
                                        <p ><?php the_time("Y m d"); ?></p>
                                        <i class="icon-comment f14 mx-2"></i>
                                        <p><?php comments_number("0","1","%"); ?> دیدگاه</p>
                                        <i class="icon-clock f14 mx-2"></i>
                                        <p><?=get_post_meta($post->ID,"ttr",true); ?> دقیقه</p>
                                    </div>
                                    <p class="fw-bold f15"><?php the_title(); ?></p>
                                    <p class="text-subtitle f13 l23-74"><?php the_excerpt(); ?></p>
                                    <div class="d-flex text-subtitle align-items-center">
                                        <div class="d-flex align-items-center f12">    
                                            <p class="m-0"> <?=get_likes(); ?> نفر پسندیدند</p>
                                            <i class="icon-heart f18 me-2"></i>
                                        </div>
                                        <div class="small_line bg-red mx-2"></div>
                                        <button class="button bg-stone text-white rounded10 p-2 border-0">
                                            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">مطالعه بیشتر </a>       
                                        </button>
                                    </div>
                                </div>
                            </div>
<?php } wp_reset_query(); ?>
                            <div class="big_line"></div>

                            <div class="d-flex flex-column my-2" style="height:200px; overflow-y:auto">
<?php
query_posts(array("showposts"=>"3","post_type"=>"articles","post__not_in"=>array($not)) );
while(have_posts()){
?>
                                <div class="d-flex col-12 ps-3">
                                    <div class="image_box col-2 rounded-lg">
                                        <?php the_post_thumbnail("thumbnail",array("alt"=>get_the_title()) ); ?>
                                    </div>
                                    <div class="col-10 me-2 ">
										<p class="fw-bold f14 my-1">
											<?php the_title(); ?>
										</p>
										<p class="text-subtitle f12"><?php the_excerpt(); ?></p>
									</div>
								</div>
<?php } wp_reset_query(); ?>
							</div>

                    </div>
                    </div>


                    <div class="col-6">
                        <div class="d-flex align-items-center justify-content-between ps-4">
                            <p class="m-0 f24 fw-bold">آخرین اخبار</p>
                            <i class="icon-arrow-left f9"></i>
                         </div>
                        <div class="d-flex flex-column align-items-start justify-content-start bg-white p-4 rounded10 ms-2 white-shadow mt-3 ">
                            <?php
$not = 0;
query_posts(array("showposts"=>"1","post_type"=>"news"));
while(have_posts()){
the_post();
$not = $post->ID;
?>
                        <div class="d-flex">
                                <div class="w-100">
                                    <?php the_post_thumbnail("medium",array("alt"=>get_the_title())); ?>
                                </div>
                                <div class="d-flex flex-column me-3">
                                    <div class="d-flex f12 text-subtitle">
                                        <p ><?php the_time("Y m d"); ?></p>
                                        <i class="icon-comment f14 mx-2"></i>
                                        <p><?php comments_number("0","1","%"); ?> دیدگاه</p>
                                        <i class="icon-clock f14 mx-2"></i>
                                        <p><?=get_post_meta($post->ID,"ttr",true); ?> دقیقه</p>
                                    </div>
                                    <p class="fw-bold f15"><?php the_title(); ?></p>
                                    <p class="text-subtitle f13 l23-74"><?php the_excerpt(); ?></p>
                                    <div class="d-flex text-subtitle align-items-center">
                                        <div class="d-flex align-items-center f12">    
                                            <p class="m-0"> <?=get_likes(); ?> نفر پسندیدند</p>
                                            <i class="icon-heart f18 me-2"></i>
                                        </div>
                                        <div class="small_line bg-red mx-2"></div>
                                        <button class="button bg-stone text-white rounded10 p-2 border-0">
                                            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">مطالعه بیشتر </a>       
                                        </button>
                                    </div>
                                </div>
                            </div>
<?php } wp_reset_query(); ?>
                            <div class="big_line"></div>

                            <div class="d-flex flex-column my-2" style="height:200px; overflow-y:auto">
<?php
query_posts(array("showposts"=>"3","post_type"=>"news","post__not_in"=>array($not)) );
while(have_posts()){
?>
                                <div class="d-flex col-12 ps-3">
                                    <div class="image_box col-2 rounded-lg">
                                        <?php the_post_thumbnail("thumbnail",array("alt"=>get_the_title()) ); ?>
                                    </div>
                                    <div class="col-10 me-2 ">
										<p class="fw-bold f14 my-1">
											<?php the_title(); ?>
										</p>
										<p class="text-subtitle f12"><?php the_excerpt(); ?></p>
									</div>
								</div>
<?php } wp_reset_query(); ?>
							</div>
                        

                            
				   
                </div>
            </div>
        </section>

         <!-- Blog -->
    
        <!-- Services -->
        <section id="services" class="my-5">
            <div class="container">
                <div class="row ">
                <div class="d-flex col-12">
                    <div class="col-3 d-flex flex-column justify-content-center align-items-center bg-white white-shadow rounded10 ">
                        
                        <div class="image_box">
                            <img  class="w-100" src="<?php bloginfo("template_directory"); ?>/images/global/truck 1.png" alt="">
                        </div>
                        <p class="f14">ارسال در سریع ترین زمان</p>
                    </div>
                    <div class="col-3 d-flex flex-column justify-content-center align-items-center bg-white white-shadow rounded10 ">
                        <div class="image_box">
                            <img class="w-100" src="<?php bloginfo("template_directory"); ?>/images/global/saw-machine 1.png" alt="">
                        </div>
                        <p class="f14">برشکاری در انواع ابعاد درخواستی </p>
                    </div>
                    <div class="col-3 d-flex flex-column justify-content-center align-items-center bg-white white-shadow rounded10">
                        <div class="image_box">
                            <img class="w-100" src="<?php bloginfo("template_directory"); ?>/images/global/hourglass 1.png" alt="">
                        </div>
                        <p class="f14">پاسخگویی به درخواست مشتریان در کوتاهترین زمان</p>
                    </div>
                    <div class="col-3 d-flex flex-column justify-content-center align-items-center bg-white white-shadow rounded10">
                        <div class="image_box">
                            <img class="w-100" src="<?php bloginfo("template_directory"); ?>/images/global/tech-support 1.png" alt="">
                        </div>
                        <p class="f14">ارسال در سریع ترین زمان</p>
                    </div>
                </div>
                 </div>


            </div>
        </section>
        <!-- Services -->
        

<?php get_footer(); ?>