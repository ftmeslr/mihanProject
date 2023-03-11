<?php
add_filter( 'query_vars', function( $query_vars ) {
    $query_vars[] = 'toexcel';
    $query_vars[] = 'print';
    return $query_vars;
} );
add_action("pre_get_posts",function($q){
    if($q->get("toexcel") || $q->get("print")){
        $cat = $q->get("toexcel");
        if($q->get("print")){ $cat = $q->get("print"); }
        $qu = new WP_Query(array("showposts"=>"-1","post_type"=>"product","tax_query"=>array(
            array("taxonomy"=>"product_cat","terms"=>array($cat))
        )));
        if($q->get("toexcel")){
            header("Content-Type: application/vnd.ms-excel; charset=utf-8");
            header("Content-disposition: attachment; filename=export_".$q->get("toexcel").".xls");
            echo "\xEF\xBB\xBF";
        }
        if($q->get("print")){
            echo '<style>
            body {
                direction:rtl;
            }
            table {
                width:100%;
                font:12px tahoma;
            }
            table td {
                border:1px solid #ccc;
                padding:5px;
            }
            table tbody tr:nth-child(even){
                background:#efefef;
            }
            </style>';
        }
        echo '<table><thead><tr><td>نام کالا</td><td>قیمت</td><td>آخرین بروزرسانی</td></tr></thead><tbody>';
        while($qu->have_posts()){
            $qu->the_post();
            global $post,$product;
            echo '<tr><td>'.get_the_title()."</td><td>".$product->get_price()."</td><td>".get_the_modified_date("Y/m/d")."</td></tr>";
        }
        echo '</tbody></table>';
        echo '
        <script>
            window.print();
        </script>
        ';
        die();
    }
});
?>