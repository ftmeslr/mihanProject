<div class="col-4">
                        <div class=" bg-whtie white-shadow p-3 rounded10">
                            <div class="d-flex justify-content-between align-items-center mb-3 ">
                                    <p class="fw-bold m-0 f18">کارشناسان فروش</p>
                                <div class="d-flex">
                                    <div class="rounded-circle bg-stone" style="width:7px; height:7px;"></div>
                                    <div class="rounded-circle bg-red mx-2" style="width:7px; height:7px;"></div>
                                    <div class="rounded-circle bg-stone" style="width:7px; height:7px;"></div>
                                </div>
                            </div>
                            <div class="swiper mySwiper pe-lg-3 bg-white " style="padding:0px !important" id="experts" dir="rtl" >
                                <div class="swiper-wrapper bg-white">
                                <?php
$sellers = get_option("mfoolad_sellers",[]);
$def_av = get_bloginfo("template_directory").'/images/global/avatar.png';
foreach($sellers as $s){ 
?>
                                    <div class="swiper-slide bg-white white-shadow rounded10 p-3 flex-column"  style="padding:0px !important">
                                        <div class="border p-2 rounded10">
                                            <div class="w-100">
                                                <img class="w-100" src="<?=(isset($s['avatar']) ? $s['avatar'] : $def_av ); ?>" />
                                            </div>
                                            <div class="bg-gray d-flex align-items-center justify-content-between mt-2  rounded10 ">
                                                <p class="m-0 f13"><?=$s['name']; ?></p>
                                                <div class="bg-red d-flex align-items-center rounded10 p-2">
                                                    <p class="text-white m-0 f14 fw-bold"><?=$s['phone']; ?></p>
                                                    <i class="icon-phone me-2"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
<?php } ?>
                                </div>

                                <div
                                    class="swiper-button-next icon-arrow-left bg-white rounded100 white-shadow2 f12 start-0">
                                </div>
                                <div class="swiper-button-prev icon-arrow-right bg-white rounded100 white-shadow2 f12">
                                </div>
                                
                            </div>
                            
                        </div>
                        <div class=" bg-whtie white-shadow p-3 rounded10 bg-white p-4 rounded10 mt-3">
                            <p class="fw-bold f16">
                                محاسبه وزن و ریزش
                            </p>
                            <div class=" rounded10 p-1 f14 mt-4 ">

                                <div class="border nav align-items-start white-shadow rounded10 py-1 nav-pills col-12 col-lg-2 d-flex w-100 nav nav-pills nav-fill p-0 d-flex align-items-center"
                                id="v-pills-tab" role="tablist">
                                    <button
                                    class="w-auto nav-link f15 l25-43 bg-transparent text-subtitle w-100 text-end position-relative active"
                                    id="v-pills-sardkaar-tab" data-bs-toggle="pill" data-bs-target="#v-pills-sardkaar"
                                    type="button" role="tab" aria-controls="v-pills-sardkaar" aria-selected="true">فرم محاسبه وزن و ریزش</button>
                                   
                                    <button class="w-auto nav-link bg-transparent text-subtitle w-100 text-end position-relative"
                                    id="v-pills-garmkaar-tab" data-bs-toggle="pill" data-bs-target="#v-pills-garmkaar"
                                    type="button" role="tab" aria-controls="v-pills-garmkaar" aria-selected="false">
                                    فرم تبدیل سختی
                                    </button>
                                </div>
                            <div class="tab-content col-12  " id="v-pills-tabContent">
                                <div class="tab-pane fade show active" id="v-pills-sardkaar" role="tabpanel"
                                    aria-labelledby="v-pills-sardkaar-tab">
                                    <div dir="rtl">
                                        <div class="d-flex flex-column align-items-end justify-content-end rounded10  ">
                                            <div class="d-flex flex-column w-100">
                                                <p class="f13 text-subtitle my-3">اعداد را به سانتی متر وارد نمایید</p>   
                                        </div>
                                            <div class="dropdown w-100">
                                                <button type="button" class="f13 text-subtitle rounded10 border dropdown-toggle w-100 d-flex align-items-center justify-content-between bg-gray h-46" data-bs-toggle="dropdown">
                                                  محاسبه وزن تسمه
                                                </button>
                                                <ul class="dropdown-menu">
                                                  <li><a class="dropdown-item" href="#">Link 1</a></li>
                                                  <li><a class="dropdown-item" href="#">Link 2</a></li>
                                                  <li><a class="dropdown-item" href="#">Link 3</a></li>
                                                </ul>
                                              </div> 
                                              <div class="dropdown w-100 mt-2 relative">
                                               <input id="length" />
                                               <div class="tag">
                                                <p class="m-0" >طول</p>
                                               </div>
                                              </div> 
                                              <div class="dropdown w-100 mt-2">
                                                <input id="width" />
                                                <div class="tag">
                                                 <p class="m-0" >عرض</p>
                                                </div>
                                              </div> 
                                              <div class="dropdown w-100 mt-2">
                                                <input id="height" />
                                               <div class="tag">
                                                <p class="m-0" >ارتفاع</p>
                                               </div>
                                              </div> 
                                              <p class="text-red text-right f12 w-100 m-2 pe-4" id="errorForCalculateWeight"></p>
                
                                              <div class="d-flex align-items-center justify-content-between">
                                                <p class="m-0 ms-3" id="weight"></p>
                                                <button class="rounded10 bg-green-light f13 text-white px-4 h-46 border-0 mt-2" onclick="submitForCalculateWeight()">
                                                    محاسبه
                                                  </button>
                                              </div>        
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="v-pills-garmkaar" role="tabpanel"
                                    aria-labelledby="v-pills-garmkaar-tab">
                                    <div class="d-flex flex-column align-items-end justify-content-end rounded10 ">
                                        <div class="d-flex flex-column w-100">
                                        <!-- <p class="f18 fw-bold mb-1">تبدیل سختی</p> -->
                                        <p class="f13 text-subtitle my-2">در جدول زیر سه مقیاس ویکرز، برینل و راکول نوشته شده است.</p>
                                    </div>
                                        <div class="border p-2 rounded10">
                                            <p class="f12 text-subtitle l20-35 m-0">معمولاً سختی حاکی از مقاومت در برابر تغییر شکل بوده و این خاصیت در فلزات معیاری از مقاومت آنها در برابر تغییر شکل پلاستیک یا مومسان است .</p>
                                        </div>
                                        <div class="dropdown w-100 mt-2" id="mySelect" onChange="updateSelectValues()">
                                            <div class="dropdown w-100 mt-2 bg-gray border-1 rounded10 px-2">
                                                
                                                <select id="select1" id="ddlViewBy" name="one" class="dropdown-select w-100 h-46 px-2 bg-gray border-0 rounded10 f13 px-2">
                                                  <option>HB</option>
                                                  <option value="76.0">76.0</option>
                                                  <option value="80.7" >80.7</option>
                                                  <option value="85.5">85.5</option>
                                                  <option value="90.2">90.2</option>
                                                  <option value="96.0">96.0</option>
                                                  <option value="102" >102</option>
                                                  <option value="107">107</option>
                                                  <option value="114">114</option>
                                                  <option value="76.0">76.0</option>
                                                  <option value="121" >121</option>
                                                  <option value="127">127</option>
                                                  <option value="135">135</option>
                                                  <option value="143">143</option>
                                                  <option value="150" >150</option>
                                                  <option value="158">158</option>
                                                  <option value="166">166</option>
                                                  <option value="174">174</option>
                                                  <option value="182" >182</option>
                                                  <option value="191">191</option>
                                                  <option value="200">200</option>
                                                  <option value="209">209</option>
                                                  <option value="219" >219</option>
                                                  <option value="228">228</option>
                                                  <option value="238">238</option>
                                                  <option value="247" >247</option>
                                                  <option value="257">257</option>
                                                  <option value="268">268</option>
                                                  <option value="278">278</option>
                                                  <option value="289" >289</option>
                                                  <option value="299">299</option>
                                                  <option value="311">311</option>
                                                  <option value="322">322</option>
                                                  <option value="334" >334</option>
                                                  <option value="346">346</option>
                                                  <option value="358">358</option>
                                                </select>
                                            </div> 
                                          </div> 
                                          <div class="dropdown-select w-100 h-46 px-2 bg-gray border-0 rounded10 f13 px-2 mt-2  d-flex align-items-center px-3">
                                            <p class="m-0" id="test1"></p>
                                          </div>
                                         <div class="dropdown-select w-100 h-46 px-2 bg-gray border-0 rounded10 f13 px-2 mt-2 d-flex align-items-center px-3">
                                            <p class="m-0" id="test2"></p>
                                          </div>
            
                                          <p class="text-red text-right f12 w-100 m-2 pe-4" id="Traslate"></p>
                                          <button class="rounded10 bg-green-light f13 text-white px-4 h-46 border-0 mt-2">
                                            محاسبه
                                          </button>
                                    </div>
                                
                                </div>
                                </div>
                             
                            </div>
                         
                           
                        </div>
                    </div> 