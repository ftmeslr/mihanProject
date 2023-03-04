<?php get_header(); 
the_post();
?>
    <!--BreadCrumb-->

    <div class="container">
      <nav aria-label="breadcrumb" style="direction: ltr" class="my-4">
        <ol class="breadcrumb d-flex align-items-center text-subtitle justify-content-end">
          <i class="icon-close f9 mx-1"></i>
          <li class="breadcrumb-item active f13" aria-current="page">
            <a href="<?=get_post_type_archive_link($post->post_type); ?>">مجله</a>
          </li>
          <i class="icon-arrow-left f9 mx-1"></i>
          <li class="breadcrumb-item f13">
            <a class="text-subtitle" href="<?php bloginfo("url"); ?>">میهن فولاد</a>
          </li>
        </ol>
      </nav>
    </div>
    <!--BreadCrumb-->
    <!-- blog  -->
    <section id="SingleBlog" class="my-5">
      <div class="container">
        <div class="col-12 bg-white white-shadow p-5" style="height: 318px">
          <p class="fw-bold f30 text-center"><?php the_title(); ?></p>

          <div class="d-flex f12 d-flex justify-content-center align-items-center">
            <div class="d-flex mx-2">
              <i class="icon-calendar-thin text-black fw-bold f14 ms-1"></i>
              <p><?php the_time("Y m d"); ?></p>
            </div>
            <div class="d-flex mx-2">
              <i class="icon-comment-thin text-black fw-bold f14 ms-1"></i>
              <p><?php comments_number("0","1","%"); ?> دیدگاه</p>
            </div>
            <div class="d-flex mx-2">
              <i class="icon-clock-thin text-black fw-bold f14 ms-1"></i>
              <p><?=get_post_meta($post->ID,"time2read",true); ?></p>
            </div>
            <div class="d-flex mx-2">
              <i class="icon-heart-thin text-black fw-bold f14 ms-1"></i>
              <p><?=get_likes(); ?> نفر پسندیدند</p>
            </div>
          </div>

          <div class="px-195">
            <div class="image_box rounded10">
              <img class="w-100 rounded10" src="<?=get_the_post_thumbnail_url($post,"full"); ?>" alt="" />
            </div>
          </div>
        </div>
        <div class="row mt-230 px-195">
          <div class="col-3">
            <div class="sticky-top">
              <div class="bg-white white-shadow px-3 py-1 f13 rounded10">
                <p class="text-red my-3 cursor-pointer">فولاد سردکار چیست؟</p>
                <p class="text-subtitle my-3 cursor-pointer">
                  مزایای فولاد سردکار
                </p>
              </div>
              <div class="bg-white white-shadow px-3 py-1 f13 rounded10 mt-3">
                <p
                  class="text-subtitle my-3 d-flex align-items-center cursor-pointer"
                >
                  <i class="icon-heart f16 ms-1"></i>
                  <span> مطلب مفیدی بود</span>
                </p>
                <p
                  class="text-subtitle my-3 d-flex align-items-center cursor-pointer"
                  onclick="window.print()"
                >
                  <i class="icon-basket f16 ms-1"></i> <span> چاپ مطلب</span>
                </p>
                <p
                  class="text-subtitle my-3 d-flex align-items-center cursor-pointer"
                  data-bs-toggle="modal"
                  data-bs-target="#exampleModal"
                  class="btn bg-green-light f13"
                  data-toggle="modal"
                  data-target="#exampleModal"
                >
                  <i class="icon-search f16 ms-1"></i>
                  <span>اشتراک گذاری مطلب</span>
                </p>
              </div>
            </div>
          </div>
          <!-- Modal -->
          <div
            class="modal fade"
            id="exampleModal"
            tabindex="-1"
            aria-labelledby="exampleModalLabel"
            aria-hidden="true"
          >
            <div
              class="modal-dialog bg-white white-shadow rounded10"
              style="width: 400px"
            >
              <div class="modal-content col-12 rounded10 p-3">
                <div
                  class="d-flex w-100 justify-content-between align-items-center mb-4"
                >
                  <p class="my-0">اشتراک گذاری</p>
                  <i class="icon-close f12"></i>
                </div>
                <div class="d-flex justify-content-between">
                  <div
                    class="d-flex align-items-center justify-content-center bg-dark-blue p-3 rounded10"
                  >
                    <i class="icon-telegram f28"></i>
                  </div>
                  <div
                    class="d-flex align-items-center justify-content-center bg-dark-blue p-3 rounded10"
                  >
                    <i class="icon-telegram f28"></i>
                  </div>
                  <div
                    class="d-flex align-items-center justify-content-center bg-dark-blue p-3 rounded10"
                  >
                    <i class="icon-telegram f28"></i>
                  </div>
                  <div
                    class="d-flex align-items-center justify-content-center bg-dark-blue p-3 rounded10"
                  >
                    <i class="icon-telegram f28"></i>
                  </div>
                  <div
                    class="d-flex align-items-center justify-content-center bg-dark-blue p-3 rounded10"
                  >
                    <i class="icon-telegram f28"></i>
                  </div>
                </div>

                <p class="f13 text-subtitle mt-5">آدرس کوتاه مطلب</p>
                <div class="position-relative">
                  <input
                    class="bg-gray rounded10 border-0 h-50 w-100 text-left"
                    type="text"
                    id="myInput"
                    style="padding-right: 70px"
                  />
                  <button
                    class="btn bg-green-light f13 position-absolute btn-abs mt-2"
                    onclick="copyText()"
                  >
                    کپی
                  </button>
                </div>
              </div>
            </div>
          </div>
          <div class="col-9">
            <?php the_content(); ?>
            <div class="d-flex f13 align-items-center text-subtitle">
              <p class="text-subtitle m-0">بخش های مرتبط:</p>
              <?php
foreach(get_the_tags() as $tag){
  echo '<a href="'.get_term_link($tag).'" class="bg-gray px-3 rounded50 mx-2 cursor-pointer text-black py-1">'.$tag->name.'</a>';
}
              ?>
            </div>
          </div>
        </div>
        <div class="d-flex w-100 mt-3 px-195">
          <i class="icon-comment-thin f40"></i>
          <div class="d-flex flex-column">
            <p class="f17 my-0">
              <span class="text-red mx-2"><?php comments_number("0","1","%"); ?></span>نظر ارسال شده است
            </p>
            <p class="text-subtitle mx-2 f14">
              نظر خود را در مورد مطلب <?php the_title(); ?> 
              بنویسید
            </p>
          </div>
        </div>
        <div class="px-195">
          <textarea
            name="comment"
            id=""
            cols="30"
            rows="10"
            class="rounded10 border bg-gray p-2 f13 w-100"
          ></textarea>
          <div class="row mt-3">
            <div class="col-5">
              <input
                type="text"
                name="name"
                class="rounded10 border bg-gray h-46 w-100 px-2 f13"
                placeholder="نام شما"
              />
            </div>
            <div class="col-5">
              <input
                type="text"
                name="family"
                class="col-5 rounded10 border bg-gray h-46 w-100 px-2 f13"
                placeholder="نام شما"
              />
            </div>
            <div class="col-2">
              <button
                class="rounded10 bg-green-light f13 text-white px-4 h-46 border-0 w-100"
              >
                ارسال نظر
              </button>
            </div>
          </div>
          <div
            class="bg-white white-shadow rounded10 p-3 mt-3 f14 cursor-pointer"
          >
            <div class="row d-flex justify-content-between align-items-center">
              <div class="col-6 d-flex">
                <img
                  style="width: 47px; height: 47px"
                  src="./images/global/avatar.png"
                  alt=""
                />
                <div class="d-flex flex-column w-100 mx-2">
                  <p class="f14 fw-bold my-1">حمید راد</p>
                  <p class="text-subtitle f12">1 اسفند 1401</p>
                </div>
              </div>
              <div class="d-flex col-6 justify-content-end align-items-center">
                <p class="m-0">2</p>
                <i class="icon-heart me-2"></i>
                <p class="m-0 me-3">پاسخ</p>
                <i class="icon-heart me-2"></i>
              </div>
            </div>
            <p class="mt-4 f14 text-subtitle">
              لورم ایپسوم یا طرح‌نما (به انگلیسی: Lorem ipsum) به متنی آزمایشی و
              بی‌معنی در صنعت چاپ، صفحه‌آرایی و طراحی گرافیک گفته می‌شود.
            </p>
          </div>
          <div class="pe-5 cursor-pointer">
            <div
              class="bg-white white-shadow rounded10 p-3 mt-3 f14 border border-danger border-right"
            >
              <div
                class="row d-flex justify-content-between align-items-center"
              >
                <div class="col-6 d-flex">
                  <img
                    style="width: 47px; height: 47px"
                    src="./images/global/avatar.png"
                    alt=""
                  />
                  <div class="d-flex flex-column w-100 mx-2">
                    <p class="f14 fw-bold my-1">حمید راد</p>
                    <p class="text-subtitle f12">1 اسفند 1401</p>
                  </div>
                </div>
                <div
                  class="d-flex col-6 justify-content-end align-items-center"
                >
                  <p class="m-0">2</p>
                  <i class="icon-heart me-2"></i>
                  <p class="m-0 me-3">پاسخ</p>
                  <i class="icon-heart me-2"></i>
                </div>
              </div>
              <p class="mt-4 f14 text-subtitle">
                لورم ایپسوم یا طرح‌نما (به انگلیسی: Lorem ipsum) به متنی آزمایشی
                و بی‌معنی در صنعت چاپ، صفحه‌آرایی و طراحی گرافیک گفته می‌شود.
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- blog -->
<?php get_footer(); ?>