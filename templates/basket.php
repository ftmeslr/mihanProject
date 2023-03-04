<?php
/*
template name: Basket
*/
get_header();
?>


        <section id="inquiry" class="my-5">
            <div class="container">
                

                <div class="d-flex row g-0 bg-white white-shadow p-4 rounded10  mt-3">
                    <div class="rounded10 w-100 text-center mt-3 tableBorder mb-4">
                        <table class="table f13 bg-white white-shadow rounded10 m-0">
                            <thead>
                              <tr class="h-56">
                                <th class="pb-3" scope="col">ردیف</th>
                                <th class="pb-3" scope="col">نام کالا</th>
                                <th class="pb-3" scope="col">واحد</th>
                                <th class="pb-3" scope="col">مقدار </th>
                                <th class="pb-3" scope="col">مبلغ واحد (<?=get_woocommerce_currency_symbol();?>)</th>
                                <th class="pb-3" scope="col">مبلغ کل (<?=get_woocommerce_currency_symbol();?>)</th>
                                <th class="pb-3" scope="col">توضیحات</th>
                                <th class="pb-3" scope="col">حذف<th>
                              </tr>
                            </thead>
                            <tbody>
<?php
$basket = json_decode(str_replace('\"','"',$_COOKIE['mfoolad_basket']),true);
$i = 1;
$price = 0;
foreach($basket as $b){
    $prod = false;
    if($b['prod'] != "0"){ 
        $prod = wc_get_product($b['prod']); $price+= $prod->get_price() * $b['count'];
        
    }
?>
                            <tr>
                                <td><p class="m-0 my-3 fw-bold"><?=$i; ?></p></td>
                                <td><p class="m-0 my-3 "><?=($b['prod'] == "0" ? $b['title'] : get_the_title($b['prod']));?></p>
                                <?php if(isset($b['attrs'])){ ?><p>(
<?php
    $out = [];
    foreach($b['attrs'] as $a){
        $out[] = wc_attribute_label(substr($a['key'],10))." : ".$a['val'];
    }
    echo implode(" - ",$out);
?>
                                )</p> <?php } ?>
                                </td>
                                <td><p class="m-0 my-3">کیلوگرم</p></td>
                                <td><p class="m-0 my-3"><?=$b['count']; ?></p></td>
                                <td><p class="m-0 my-3"><?=($b['prod'] != "0" ? $prod->get_price() : "-"); ?></p></td>
                                <td><p class="m-0 my-3"><?=($b['prod'] != "0" ? $prod->get_price() * $b['count'] : "-"); ?></p></td>
                                <td><p class="m-0 my-3"><?=($b['prod'] == "0" ? $b['desc'] : "-"); ?></p></td>
                                <td class="pt-4  cursor-pointer"><i class="icon-close f12 ">  </i></td>
                            </tr>
<?php $i+=1; } ?>
                            </tbody>
                          </table>

                    </div>
                <div class="row f13 ps-0">
                    <div class="col-4 d-flex justify-content-between ">
                        جمع کل : 
                        <span class="d-flex text-subtitle">
                            <?=number_format($price); ?> <?=get_woocommerce_currency_symbol();?>
                            <div class="small_line me-3"></div>

                        </span>
                    </div>

                    <div class="col-4 justify-content-between p-0">
                        <div class=" d-flex justify-content-between">
                            مبلغ قابل پرداخت: 
                            <span class="text-subtitle">
                                <?=number_format($price); ?> <?=get_woocommerce_currency_symbol();?>
                            </span>
                        </div>
                        <div class="col-4 d-flex w-100 mt-4">
                            <button class="btn bg-green-light rounded10 bg-green-light f13 h-46 w-100" data-bs-toggle="modal" data-bs-target="#exampleModal">
                              صدور پیش فاکتور  
                            </button>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        </section>
    <!-- Modal -->
<div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="d-flex modal-content d-flex col-12 flex-row  rounded10">
                                                
                                                <div class="col-12 bg-gray p-4 rounded10">
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
<?php get_footer(); ?>