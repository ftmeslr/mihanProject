<?php
if ( ! empty( $breadcrumb ) ) {
	foreach ( $breadcrumb as $key => $crumb ) {

        if($key == 0){
            echo '<li class="breadcrumb-item active f13" aria-current="page">میهن فولاد</li>';
        } else {
			echo '<li class="breadcrumb-item f13"><a class="text-subtitle" href="' . esc_url( $crumb[1] ) . '">' . esc_html( $crumb[0] ) . '</a></li>';
        }

		if ( sizeof( $breadcrumb ) !== $key + 1 ) {
			echo '<i class="icon-arrow-left f9  mx-1"></i>';
		}
	}


}
?>