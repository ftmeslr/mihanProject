<?php
/*
template name: estelam
*/
get_header();
?>


        <section id="inquiry" class="my-5">
            <div class="container">
                <div class="d-flex row g-0 justify-content-center bg-white white-shadow p-4 rounded10  ">
                    <p class="fw-bold f18 my-2">استعلام قیمت از طریق انتخاب کالا</p>
                    <p class="f13 my-0">نام و مقدار کالا های مورد نظرتان را وارد کنید و با افزودن کالا ها به لیست، پیش فاکتور بسازید و آنرا دریافت کنید.</p>
                    <div class="row">
                        <div class="col-4">
                            <div class="dropdown w-100 mt-2 relative">
                                <label class="f13 text-subtitle mt-3 mb-1" for="name">نام کالا</label>
                                <input id="name" />
                            </div> 
                        </div>
                        <div class="col-4">
                            <div class="dropdown-100 mt-2 relative">
                                <label class="f13 text-subtitle mt-3 mb-1" for="number">مقدار / تعداد</label>
                                <input id="number" />
                            </div> 
                        </div>
                     
                     
                        <div class="col-4">
                            <div class="d-flex flex-column">
                                <label class="f13 text-subtitle mt-3 mb-1" for="description">توضیحات</label>
                                <textarea name="description" id="description" type="text" class="rounded10 border bg-gray p-2 f13"> </textarea>
                            </div>
                        </div>
                        <div class="col-12 mt-3 d-flex align-items-end">
                            <button class="btn bg-green-light rounded10 bg-green-light f13 h-46 w-100" onclick="addProduct()">
                                افزودن کالا +
                            </button>
                        </div>
                    </div>
                </div> 

                <div class="d-flex row g-0 bg-white white-shadow p-4 rounded10  mt-3">
                    <div class="rounded10 w-100 text-center mt-3 tableBorder mb-4">
                        <table class="table f13 bg-white white-shadow rounded10 m-0">
                            <thead>
                              <tr class="h-56">
                                <th class="pb-3" scope="col">ردیف</th>
                                <th class="pb-3" scope="col">نام کالا</th>
                                <th class="pb-3" scope="col">واحد</th>
                                <th class="pb-3" scope="col">مقدار </th>
                                <th class="pb-3" scope="col"> مبلغ واحد (ریال)</th>
                                <th class="pb-3" scope="col">مبلغ واحد با ارزش افزوده</th>
                                <th class="pb-3" scope="col">مبلغ کل (ريال)</th>
                                <th class="pb-3" scope="col">حذف<th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td><p class="m-0 my-3 fw-bold">1</p></td>
                                <td><p class="m-0 my-3 "> تبدیل "5*"6*"8 درزدار </p></td>
                                <td><p class="m-0 my-3">265,140</p></td>
                                <td><p class="m-0 my-3">(قیمت قبل :12,460,000)</p></td>
                                <td><p class="m-0 my-3">(قیمت قبل :12,460,000)</p></td>
                                <td><p class="m-0 my-3">(قیمت قبل :12,460,000)</p></td>
                                <td><p class="m-0 my-3">(قیمت قبل :12,460,000)</p></td>
                                <td class="pt-4  cursor-pointer"><i class="icon-close f12 ">  </i></td>
                            </tbody>
                          </table>

                    </div>
                <div class="row f13 ps-0">
                    <div class="col-4 d-flex justify-content-between ">
                        جمع کل : 
                        <span class="d-flex text-subtitle">
                            200000000 تومان
                            <div class="small_line me-3"></div>

                        </span>
                    </div>
                    <div class="col-4 d-flex justify-content-between">
                        جمع کل به حروف: 
                        <span class="d-flex text-subtitle">
                            دویست ملیون تومان
                            <div class="small_line me-3"></div>

                        </span>
                    </div>
                    <div class="col-4 justify-content-between p-0">
                        <div class=" d-flex justify-content-between">
                            مبلغ قابل پرداخت: 
                            <span class="text-subtitle">
                                دویست ملیون تومان
                            </span>
                        </div>
                        <div class="col-4 d-flex w-100 mt-4">
                            <button class="btn bg-green-light rounded10 bg-green-light f13 h-46 w-100" onclick="addProduct()">
                              صدور پیش فاکتور  
                            </button>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        </section>
<?php get_footer(); ?>