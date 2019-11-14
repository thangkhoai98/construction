<?php
// Add custom Theme Functions here
function wpb_load_fa() {

    wp_enqueue_style( 'wpb-fa', get_stylesheet_directory_uri() . '/font-awesome-4.7.0/css/font-awesome.min.css' );

}

add_action( 'wp_enqueue_scripts', 'wpb_load_fa' );


//function bd_rrp_sale_price_html( $price, $product ) {
//    if ( $product->is_on_sale() ) :
//        $has_sale_text = array(
//            '<ins>' => '<br>Sale Price: <ins>',
//            '<del>' => '<del>RRP: '
//
//        );
//        $return_string = str_replace(array_keys( $has_sale_text ), array_values( $has_sale_text ), $price);
//    else :
//        $retun_string = 'RRP: ' . $price;
//    endif;
//
//    return $return_string;
//}
//add_filter( 'woocommerce_get_price_html', 'bd_rrp_sale_price_html', 100, 2 );

//function bd_sale_price_html( $price, $product ) {
//    if ( $product->is_on_sale() ) :
//        $return_string = str_replace( '<ins>', '<ins><br>Sale Price: ', $price);
//        return $return_string;
//    else :
//        return $price;
//    endif;
//}
//add_filter( 'woocommerce_get_price_html', 'bd_sale_price_html', 100, 2 );


//function wc_format_sale_price( $regular_price, $sale_price ) {
//    $price = '<del>' . ( is_numeric( $regular_price ) ? wc_price( $regular_price ) : $regular_price ) . '</del> <ins>' . ( is_numeric( $sale_price ) ? wc_price( $sale_price ) : $sale_price ) . '</ins>';
//    return apply_filters( 'woocommerce_format_sale_price', $price, $regular_price, $sale_price );
//}

add_filter('woocommerce_format_sale_price', 'ss_format_sale_price', 100, 3);
function ss_format_sale_price( $price, $regular_price, $sale_price ) {
    $output_ss_price = '<ins>' .  ( is_numeric( $sale_price ) ? wc_price( $sale_price ) : $sale_price ). '</ins> <del>' .( is_numeric( $regular_price ) ? wc_price( $regular_price ) : $regular_price )  . '</del>';
    return $output_ss_price;
}

// Change currency symbols
add_filter('woocommerce_currency_symbol', 'change_existing_currency_symbol', 10, 2);

function change_existing_currency_symbol( $currency_symbol, $currency ) {
    switch( $currency ) {
        case 'VND': $currency_symbol = 'VNĐ'; break;
    }
    return $currency_symbol;
}


// Add HREF TO TITLE
remove_action( 'woocommerce_shop_loop_item_title','woocommerce_template_loop_product_title', 10 );
add_action('woocommerce_shop_loop_item_title', 'abChangeProductsTitle', 10 );
function abChangeProductsTitle() {
    if (strlen(get_the_title()) <= 34){
        echo '<p class="name product-title"><a href="'.get_the_permalink().'">' . get_the_title(). '</a></p>';
    }else{
        echo '<p class="name product-title"><a href="'.get_the_permalink().'">' . mb_substr(get_the_title(),0,34,'UTF-8') .'...'. '</a></p>';
    }

}



add_filter('woocommerce_sale_flash','devvn_woocommerce_sale_flash', 10, 3);
function devvn_woocommerce_sale_flash($text, $post, $product){
    ob_start();
    $sale_price = get_post_meta( $product->get_id(), '_price', true);
    $regular_price = get_post_meta( $product->get_id(), '_regular_price', true);
    if (empty($regular_price) && $product->is_type( 'variable' )){
        $available_variations = $product->get_available_variations();
        $variation_id = $available_variations[0]['variation_id'];
        $variation = new WC_Product_Variation( $variation_id );
        $regular_price = $variation ->regular_price;
        $sale_price = $variation ->sale_price;
    }
    $sale = ceil(( ($regular_price - $sale_price) / $regular_price ) * 100);
    if ( !empty( $regular_price ) && !empty( $sale_price ) && $regular_price > $sale_price ) :
//        $R = floor((255*$sale)/100);
//        $G = floor((255*(100-$sale))/100);
//        $bg_style = 'background:none;background-color: rgb(' . $R . ',' . $G . ',0);';
                $bg_style = 'background:#0b97c6';
        echo apply_filters( 'devvn_woocommerce_sale_flash', '<span class="onsale" style="'. $bg_style .'">-' . $sale . '%</span>', $post, $product );
    endif;
    return ob_get_clean();
}


add_filter( 'woocommerce_get_availability', 'custom_get_availability', 1, 2);
function custom_get_availability( $availability, $_product ) {
//change text "In Stock' to 'SPECIAL ORDER'
    if($_product->is_in_stock()){
        $availability['availability']='<span class="tt">Tình trạng : </span>'.' '.__('Còn hàng','woocommerce');
    }

    //change text "Out of Stock' to 'SOLD OUT'
    if(!$_product->is_in_stock()) {
        $availability['availability']='<span class="tt">Tình trạng : </span>'. __('Hết hàng','woocommerce');
    }
    return $availability;
}


add_filter( 'woocommerce_product_single_add_to_cart_text', 'woo_custom_cart_button_text' );
function woo_custom_cart_button_text() {
    global $product;
    $cat_id = 64;

    $product->get_category_ids();
    if ( in_array( $cat_id, $product->get_category_ids() ) ) {
        return __( 'Contact us', 'woocommerce' );
    }
    else {
        return __( 'Mua ngay', 'woocommerce' );
    }
}


add_filter( 'add_to_cart_text', 'woo_custom_product_add_to_cart_text' );            // < 2.1
add_filter( 'woocommerce_product_add_to_cart_text', 'woo_custom_product_add_to_cart_text' );  // 2.1 +

function woo_custom_product_add_to_cart_text() {

    return __( 'Mua ngay', 'woocommerce' );

}



add_action( 'woocommerce_before_add_to_cart_quantity', 'ts_quantity_plus_sign' );

function ts_quantity_plus_sign() {
    echo '<label type="text" class="plus" >Số lượng</label>';
}


