<?php

function jodear_header_logo() {
    
    echo '<div><img src="' . esc_url( get_stylesheet_directory_uri() . '/assets/images/logo_white.png') . '" alt="JODEAR" class="jodear-logo"></div>';
}


function jodear_header_ship_to()
{
    get_template_part('template-parts/header-shipping-calculator');
}


function jodear_primary_navigation()
{
?>
    <nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e('Primary Navigation', 'storefront'); ?>">
        <button id="site-navigation-menu-toggle" class="menu-toggle" aria-controls="site-navigation" aria-expanded="false">
            <img style="height: 50px;" src="<?php echo get_stylesheet_directory_uri() . '/assets/images/burger.png' ?>" />
        </button>
        <?php
        wp_nav_menu(
            array(
                'theme_location'  => 'primary',
                'container_class' => 'primary-navigation',
            )
        );

        wp_nav_menu(
            array(
                'theme_location'  => 'handheld',
                'container_class' => 'handheld-navigation',
            )
        );
        ?>
    </nav><!-- #site-navigation -->
<?php
}

function jodear_header_row_open() {
    echo '<div class="header-row">';
}
function jodear_header_row_close() {
    echo '</div>';
}



add_action('jodear_header', 'jodear_header_row_open', 0);
add_action('jodear_header', 'jodear_header_logo', 3);
add_action('jodear_header', 'storefront_product_search', 5);
add_action('jodear_header', 'jodear_header_ship_to', 10);
add_action('jodear_header', 'storefront_header_cart', 15);
add_action('jodear_header', 'jodear_header_row_close', 20);
add_action('jodear_header', 'jodear_header_row_open', 25);
add_action('jodear_header', 'jodear_primary_navigation', 30);
add_action('jodear_header', 'jodear_header_row_close', 35);




function jodear_toggle_filters_button()
{
    echo '<button class="wc-block-product-filters__open-overlay argytec" data-wp-on--click="actions.openOverlay"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M10 17.5H14V16H10V17.5ZM6 6V7.5H18V6H6ZM8 12.5H16V11H8V12.5Z" fill="currentColor"></path></svg><span>Filtrar</span></button></div>';
}
function jodear_ordering_filter_wrapper()
{
    echo '<div class="jodear-ordering-wrapper">';
}
add_action('woocommerce_before_shop_loop', 'jodear_toggle_filters_button', 11);


add_action('woocommerce_before_shop_loop', 'jodear_ordering_filter_wrapper', 10);

/**
 * Replace the home link URL
 */
add_filter('woocommerce_breadcrumb_home_url', 'woo_custom_breadrumb_home_url', 20);
function woo_custom_breadrumb_home_url()
{
    return wc_get_page_permalink('shop');
}

function mobile_whatsapp_anchor_callback()
{
    echo '<a href="https://wa.me/5491136980638?text=Hola%20Tienda%20Jodear" target="_blank" rel="noopener noreferrer">WhatsApp</a>';
}

add_filter('storefront_handheld_footer_bar_links', 'jk_remove_handheld_footer_links');
function jk_remove_handheld_footer_links($links)
{
    unset($links['my-account']);

    $new_links = array(
        'whatsapp' => array(
            'priority' => 10,
            'callback' => 'mobile_whatsapp_anchor_callback',
        ),
    );

    $links = array_merge($new_links, $links);

    return $links;
}
require(get_stylesheet_directory() . '/inc/blocks/product-categories/product-categories.php');

remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail');

add_action('woocommerce_before_shop_loop_item_title', 'jodear_template_loop_product_thumbnail');

function jodear_template_loop_product_thumbnail()
{
    global $product;
    $image = wp_get_attachment_url($product->get_image_id());

    if ($image) {

        echo '<div style="width: 100%; max-width: 324px; aspect-ratio: 1/1; background-color: white; display: flex; justify-content: center; align-items: center; margin: 0 auto 1.618em; border-radius: 3px;"><img src="' . $image . '" style="width: 100%; margin: 0;"/></div>';
    } else {
        echo $product->get_image();
    }
}


?>