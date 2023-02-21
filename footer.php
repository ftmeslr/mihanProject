
        <!-- footer -->

        <footer id="footer" class="mt-3">
                <div class="d-flex col-12 bg-dark--footer p-4 text-white ">
                    <div class="col-7">
                        <div class="col-12 d-flex">
                            <div class="col-6 ps-5">
                            <div style="width:50px; height:50px">
                                <img class="w-100 h-100 rounded-circle" src="<?php bloginfo("template_directory"); ?>/images/global/logo.webp" alt="">
                            </div>
                                <p class="f14 l23-74 mt-3">میهن فولاد با 25 سال سابقه ارائه دهنده خدمات فروش <br />انواع آلیاژ و مشاوره متالوژی علمی و تجربی در زمینه<br />انتخاب فولاد می باشد.</p>
                           <div class="d-flex mt-4">
                            <div class="image_box--namad">
                                <img class="w-100" src="<?php bloginfo("template_directory"); ?>/images/global/Rectangle 52.png" alt="">
                            </div>
                            <div class="image_box--namad me-2" >
                                <img class="w-100" src="<?php bloginfo("template_directory"); ?>/images/global/Rectangle 53.png" alt="">
                            </div>
                           
                           </div>
                            </div>
                            <div class="col-3 ">
                                <p class="fw-bold mt-3">دسترسی سریع</p>
                                <ul class="list f14">
                                    <?php wp_nav_menu( array( 'items_wrap' => '%3$s',"theme_location"=>"footer_fast","container"=>"","add_li_class"=>"my-1") ); ?>
                                </ul>
                            </div>
                            <div class="col-3">
                                <p class="fw-bold mt-3">محصولات</p>
                                <ul class="list f14">
                                <?php wp_nav_menu( array( 'items_wrap' => '%3$s',"theme_location"=>"footer_products","container"=>"","add_li_class"=>"my-1") ); ?>

                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-5 d-flex flex-column align-items-end ">
                        <div>
                    <div class="image_box--contact">
                        <img class="w-100" src="<?php bloginfo("template_directory"); ?>/images/global/contact-logo.png" alt="">
                    </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <div >
                                <p class="fw-bold f28 mb-1">تماس با کارشناسان</p>
                                <p class="f16">مشاوره استعلام و سفارش</p>
                            </div>
                            <p>
                                <?php $phone = get_option("mfoolad_phone","02191306000"); ?>
                                <span class="text-red f40 fw-bold">
                                    <?=substr($phone,3); ?>
                                </span>
                                <span class="text-subtitle f40">
                                    <?=substr($phone,0,3); ?>
                                </span>
                            </p>
                        </div>
                        <div class="d-flex"> 
                            <input type="text" placeholder="شماره تماس" class="pe-2">
                            <button type="button" class="btn btn-danger f13">درخواست مشاوره</button>
                        </div>
                    </div>
                </div>

                </div>
                <div class="bg-stone-900 d-flex justify-content-between text-white f14 p-4 "> 
                    <p class="m-0">کلیه حقوق این وب سایت متعلق به گروه  <span class="fw-bold">میهن فولاد</span> می باشد. طراحی و اجرا: <span class="fw-bold">براش‌کد</span> </p>
                <div>
                    <a href="<?=get_option("mfoolad_teleg","#"); ?>"><i class="icon-telegram mx-2"></i></a>
                    <a href="<?=get_option("mfoolad_insta","#"); ?>"><i class="icon-instagram mx-2"></i></a>
                </div>
                </div>

        </footer>

        <!-- footer -->

    <?php wp_footer(); ?>
    <script src="<?php bloginfo("template_directory"); ?>/assets/js/bootstrap.min.js"></script>
    <script src="<?php bloginfo("template_directory"); ?>/assets/js/jquery.min.js"></script>
    <script src="<?php bloginfo("template_directory"); ?>/assets/js/swiper-bundle.min.js"></script>
    <script src="<?php bloginfo("template_directory"); ?>/assets/js/custom.js"></script>

</body>

</html>