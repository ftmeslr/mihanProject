<?php get_header(); ?>


    <!--BreadCrumb-->
     
    <div class="container">
        <nav aria-label="breadcrumb" class="my-4"  >
            
            <ol class="breadcrumb d-flex align-items-center text-subtitle">
                <?php woocommerce_breadcrumb(); ?>
            </ol>
        </nav>
    </div>
    <!--BreadCrumb-->

    <!--categories-->
    <div id="categories" class="mt-3">
        <div class="container">
            <div class="row">
                    <?php get_sidebar(); ?>

                    <div class="col-8">
                        <div class="w-100 bg-white white-shadow d-flex align-items-center py-3 px-2 rounded10">
                            <i class="icon-category f20 ms-2"></i>
                            <p class="f13 m-0 text-nowrap">دسته بندی</p>
                            <div class="small_line mx-2"></div>
                            <ul class="d-flex f13 justify-content-between p-0 w-100 mb-0 text-subtitle">
<?php
$current_cat = get_queried_object();
$terms = get_terms("product_cat");
foreach($terms as $t){ 
?>
                                <li class="<?=($t->term_id == $current_cat->term_id ? "activeCategoryTab" : "mx-1"); ?> py-1">
                                    <p><a href="<?=get_term_link($t); ?>"><?=$t->name;?></a></p>
                                </li>
<?php } ?>
                            </ul>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <div>
                                <p class="f20 fw-bold mb-0">قیمت <?=$current_cat->name; ?></p>
                                <div class="d-flex align-items-center">
                                    <i class="icon-return f12 ms-2"></i>
                                    <p class="text-subtitle f12 mb-0">آخرین بروزرسانی: <?=get_last_post_date($current_cat->slug); ?> پیش</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-center f12">
                                <p class="mb-0 mx-1">خروجی اکسل</p>
                                <i class="icon-excel mx-1 f20"></i>
                                <div class="small_line mx-1"></div>
                                <p  class="mb-0 mx-1">چاپ</p>
                                <i class="icon-Printer f20 mx-1"></i>
                            </div>
                        </div>
                        <div class="rounded10 w-100 text-center mt-3 tableBorder mb-4">
                            <table class="table f13 bg-white white-shadow rounded10 m-0">
                                <thead>
                                  <tr class="h-56">
                                    <th class="pb-3" scope="col">نوع</th>
                                    <th class="pb-3" scope="col">استاندارد</th>
                                    <th class="pb-3" scope="col">قیمت(<?=get_woocommerce_currency_symbol();?>)</th>
                                    <th class="pb-3" scope="col">تاریخ بروزرسانی</th>
                                    <th class="pb-3" scope="col">ثبت سفارش</th>
                                    <th class="pb-3" scope="col">نوسانات</th>
                                  </tr>
                                </thead>
                                <tbody>
<?php while(have_posts()){ the_post(); global $product; ?>
                                  <tr>
                                    <td><p class="m-0 mt-2 fw-bold"><?php the_title(); ?></p></td>
                                    <td><p class="m-0 mt-2"><?=$product->get_attribute( 'pa_standard' ); ?></p></td>
                                    <td><p class="m-0 mt-2"><?=$product->get_price(); ?></p></td>
                                    <td><p class="m-0 mt-2"><?=get_the_modified_date("Y/m/d"); ?></p></td>
                                    <td><button class="btn bg-green-light f13">افزودن به پیش فاکتور</button></td>
                                    <td class="pt-4"><a href="<?php the_permalink(); ?>"><i class="icon-chart f20"></i></a></td>
<?php } ?>
                                </tbody>
                              </table>

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


            

    <!--categories-->
<?php get_footer(); ?>