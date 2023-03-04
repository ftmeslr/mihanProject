<?php get_header();
global $wp_query;
$term = get_queried_object();
?>
      <!--BreadCrumb-->
     
      <div class="container">
        <nav aria-label="breadcrumb" style="direction:ltr;" class="my-4"  >
            <ol class="breadcrumb d-flex align-items-center text-subtitle justify-content-end">
                <li class="breadcrumb-item active f13" aria-current="page"><a href="<?=get_term_link($term); ?>"><?=$term->name; ?></a></li>
                <i class="icon-arrow-left f9  mx-1"></i>
                <li class="breadcrumb-item f13"><a class="text-subtitle"  href="<?php bloginfo("url"); ?>">میهن فولاد</a></li>
            </ol>
        </nav> 
    </div>
    <!--BreadCrumb-->

        <!-- blog  -->
        <section id="mainBlogs" class="my-5">
            <div class="container">
                <div class="row">
                    <div class="col-4  ">
                        <div class="bg-white white-shadow p-4 rounded10">
                            <div class="d-flex justify-content-between">
                                <p class="f1t text-red">
                                    منتخب میهن فولاد
                                </p>
                                <i class="icon-fire f20"></i>

                                </i>

                            </div>
                            <div class="d-flex flex-column">
<?php query_posts(array("showposts"=>"4","post_type"=>array("articles","news"),"tax_query"=>array(
    array("taxonomy"=>$term->taxonomy,"terms"=>array($term->term_id))
)));
while(have_posts()){ the_post(); ?>
                                <div class="d-flex my-2">
                                    <div class="image__box rounded10 ">
                                        <img class="w-100 h-100" src="<?=get_the_post_thumbnail_url($post,"thumbnail"); ?>" alt="<?php the_title(); ?>">

                                    </div>
                                    <div class="me-3">
                                        <div class="d-flex f13">
                                            <p class="my-2 p-2 rounded10 bg-gray"><?php the_time("Y m d"); ?></p>
                                            <p class="my-2 p-2"><?=get_post_meta($post->ID,"time2read",true); ?></p>
                                        </div>
                                        <p class="f15 fw-bold text-block"><?php the_title(); ?></p>
                                    </div>
                                </div>
<?php } wp_reset_query(); ?>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="w-100 bg-white white-shadow d-flex align-items-center py-3 px-2 rounded10">
                            <i class="icon-category f20 ms-2"></i>
                            <p class="f13 m-0 text-nowrap">دسته بندی</p>
                            <div class="small_line mx-2"></div>
                            <ul class="d-flex f13 p-0 w-100 mb-0 text-subtitle ">
<?php
foreach(get_terms($term->taxonomy) as $t){
    echo '<li class="mx-1 py-1 mx-2"><p class="m-0"><a href="'.get_term_link($t).'">'.$t->name.'</a></p></li>';
}
?>
                         
                            </ul>
                        </div>
<?php query_posts(array("showposts"=>"1","post_type"=>array("articles","news"),"tax_query"=>array(
    array("taxonomy"=>$term->taxonomy,"terms"=>array($term->term_id))
)));
while(have_posts()){ the_post(); ?>
                        <div class="image_blog_box mt-2 rounded10 position-relative ">
                            <img class="w-100 h-100" src="<?=get_the_post_thumbnail_url($post,"full"); ?>" alt="<?php the_title(); ?>">
                            <div class="position-absolute bottom-5 right-50">
                                <p class="fw-bold f14"><?php the_title(); ?></p>
                                <p class="f14"><?php the_excerpt(); ?></p>
                           
                                <div class="d-flex mt-2">
                                    <p class="f13 my-0 ms-3"><?php the_time("Y m d"); ?></p>

                                    <div class="d-flex align-items-center mx-2">
                                        <i class="icon-comment"></i>
                                        <p class="f13 my-0 mx-2"><?php comments_number("0","1","%"); ?> دیدگاه</p>
                                    </div>

                                    <div class="d-flex align-items-center mx-2">
                                        <i class="icon-clock"></i>
                                        <p class="f13 my-0 mx-2"><?=get_post_meta($post->ID,"time2read",true); ?></p>
                                    </div>
                                    <div class="d-flex align-items-center mx-2">
                                        <i class="icon-heart"></i>
                                        <p class="f13 my-0 mx-2"><?=get_likes(); ?> نقر پسندیدند</p>
                                    </div>
        
                                </div>
                            </div>
                       
                        </div>
<?php } wp_reset_query(); ?>
     
                       
                    </div>

                </div> 
                <div class="row mt-3">
<?php while(have_posts()){ the_post(); ?>
                    <div class="col-4">
                        <div class="d-flex flex-column bg-white white-shadow p-3 rounded10">
                            <div class="w-100 h-300 rounded10">
                                <img class="w-100 h-100" src="<?=get_the_post_thumbnail_url($post,"medium"); ?>" alt="<?php the_title(); ?>">

                            </div>
                            <p class="f18 fw-bold my-2"><?php the_title(); ?></p>
                            <p class="text-subtitle f12"><?php  the_excerpt(); ?> </p>
                            <div class="d-flex text-subtitle f12 my-2"">
                                <p class="f13 my-0 ms-3"><?php the_time("Y m d"); ?></p>
    
                                <div class="d-flex align-items-center mx-2 text-subtitle">
                                    <i class="icon-comment"></i>
                                    <p class="f13 my-0 mx-2"><?php comments_number("0","1","%"); ?> دیدگاه</p>
                                </div>
    
                                <div class="d-flex align-items-center mx-2 text-subtitle">
                                    <i class="icon-clock"></i>
                                    <p class="f13 my-0 mx-2"><?=get_post_meta($post->ID,"time2read",true); ?></p>
                                </div>
                                <div class="d-flex align-items-center mx-2 text-subtitle">
                                    <i class="icon-heart"></i>
                                    <p class="f13 my-0 mx-2"><?=get_likes(); ?> نقر پسندیدند</p>
                                </div>  
                            </div>
                         </div> 
                    </div>
<?php } ?>
                    
                </div>  
                 
                
            </div>
        </section>
        <!-- blog -->


        <!-- pagination-->
        <div class="section" id="pagination">
            <div class="container">
                <div class="bg-white white-shadow p-3 rounded10 d-flex align-items-center justify-content-center">
                    <?php if(function_exists("wp_pagenavi")){ wp_pagenavi(); } ?>
                    <!--
                    <div class="curdor-pointer px-3 py-2 d-flex align-items-center rounded10 pagination-btn-hover">
                        <i class="icon-arrow-right f9 ms-2"></i>
                        <p class="m-0 f14">قبلی</p>

                    </div>
                    <div class="pagination-btn rounded10 justify-content-center align-items-center d-flex">
                        <a class="m-0">1</a>
                    </div>
                    <div class="pagination-btn rounded10 justify-content-center align-items-center d-flex">
                        <a class="m-0">2</a>
                    </div>
                    <div class="pagination-btn bg-gray rounded10 justify-content-center align-items-center d-flex">
                        <a class="m-0">3</a>
                    </div>
                    <div class="pagination-btn rounded10 justify-content-center align-items-center d-flex">
                        <a class="m-0">4</a>
                    </div>
                    <div class="pagination-btn rounded10 justify-content-center align-items-center d-flex">
                        <a class="m-0">5</a>
                    </div>
                    <div class="curdor-pointer px-3 py-2 d-flex align-items-center rounded10 pagination-btn-hover">
                        <p class="m-0 f14">بعدی</p>
                        <i class="icon-arrow-left f9 me-2"></i>
                    </div>-->
                    
                </div>
            </div>
        </div>
        <!-- pagination-->


        <!--news-->
    <section id="news" class="mt-5">
        <div class="container" >
            <div class="d-flex align-items-center justify-content-between mb-3">
                <p class="fw-bold">اخبار صنعت فولاد</p>
                <button class="border-0 bg-white white-shadow px-3 py-1">               
                    <a class="f13 text-black" href="<?=get_post_type_archive_link("news"); ?>">مشاهده بیشتر </a>
                </button>
            </div>
            <div class="row">
<?php query_posts("showposts=4&post_type=news");
while(have_posts()){ the_post(); ?>
                <div class="col-3">
                    <div class="position-relative w-100 h-250 rounded10" >
                         <img class="w-100 h-100" src="<?=get_the_post_thumbnail_url($post,"medium"); ?>" alt="<?php the_title(); ?>">
                         <div class="position-absolute text-white bottom-0 p-2" >
                            <p class="bg-opacity d-inline rounded10 py-1 px-2 bg-stone f12"><?php the_time("Y m d"); ?></p>
                            <p class="f14 mt-2"><?php the_excerpt(); ?></p>

                         </div>
                    </div>
                </div>
<?php } wp_reset_query(); ?>
            </div>
        </div>
    </section>
        <!--news-->
<?php get_footer(); ?>