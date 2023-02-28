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
                            <button class="btn bg-green-light rounded10 bg-green-light f13 h-46 w-100" id="addNonproducts">
                                افزودن کالا +
                            </button>
                        </div>
                    </div>
                </div> 
<script>
    var $ = jQuery;
$(function(){
    $("#addNonproducts").click(function(e){
        e.preventDefault();
        var name = $("#name").val(),number=$("#number").val(),desc = $("#description").val();
        if(name.trim() == ""){
            alert("لطفا نام محصول را وارد کنید");
            return false;
        }
        if(number.trim() == "" || isNaN(parseInt(number))){
            alert("لطفا مقدار را به عددی وارد کنید");
            return false;
        }
        AddTobasket({prod:0,title:name,count:number,desc:desc});
        alert("محصول با موفقیت به سبد خرید شما افزوده شد");
        $("#name").val("")
        $("#number").val("")
        $("#description").val("");
    })
});
</script>
                
            </div>
        </div>
        </section>
<?php get_footer(); ?>