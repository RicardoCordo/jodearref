<?php

require(get_stylesheet_directory() . '/inc/template_functions.php');

//SCRIPTS 

function load_scripts() {
    wp_enqueue_style('dashicons');

    wp_enqueue_script(
        'theme-main-js',
        get_stylesheet_directory_uri() . '/inc/js/main.js'
    );

    wp_enqueue_style(
        'animations-css',
        get_stylesheet_directory_uri() . '/inc/css/animations.css',
        array('storefront-style','storefront-woocommerce-style','storefront-child-style')
    );

    wp_enqueue_style(
        'front-page-styles-hero',
        get_stylesheet_directory_uri() . '/inc/css/front-page/hero.css',
        array('storefront-style','storefront-woocommerce-style','storefront-child-style'),
        '1.0.4'
    );

    wp_enqueue_style(
        'ecommerce-styles',
        get_stylesheet_directory_uri() . '/inc/css/woocommerce.css',
        array('storefront-style','storefront-woocommerce-style','storefront-child-style'),
        '6.8.5'
    );

    wp_enqueue_script(
        'animations-js',
        get_stylesheet_directory_uri() . '/inc/js/animations.js'
    );
}
add_action('wp_enqueue_scripts', 'load_scripts');


//SOPORTE THEME 

function add_block_template_part_support() {
    add_theme_support('block-template-parts');
}
add_action('after_setup_theme', 'add_block_template_part_support');



//REMOVER ACCIONES THEME 

function jodear_remove_actions() {

    $priority = has_action('woocommerce_before_shop_loop','storefront_woocommerce_pagination');
    remove_action('woocommerce_before_shop_loop','storefront_woocommerce_pagination',$priority);

    $priority_footer = has_action('storefront_footer','storefront_credit');
    remove_action('storefront_footer','storefront_credit',$priority_footer);
}
add_action('wp_loaded', 'jodear_remove_actions');


//CHECKBOX PRECIO OFERTA 

add_action('woocommerce_product_options_pricing', function() {
    woocommerce_wp_checkbox(array(
        'id' => '_mostrar_precio_anterior',
        'label' => 'Mostrar precio anterior (tachado)',
        'description' => 'Tildar para mostrar el precio normal tachado junto al rebajado.'
    ));
});

add_action('woocommerce_process_product_meta', function($post_id) {
    $value = isset($_POST['_mostrar_precio_anterior']) ? 'yes' : 'no';
    update_post_meta($post_id, '_mostrar_precio_anterior', $value);
});


// MOSTRAR PRECIOS

add_filter('woocommerce_get_price_html', function($price, $product) {

    if (is_admin()) return $price;

    $mostrar = get_post_meta($product->get_id(), '_mostrar_precio_anterior', true);

    // Si el checkbox NO está tildado → mostrar solo precio normal
    if ($mostrar !== 'yes') {
        return wc_price($product->get_regular_price());
    }

    // Si está tildado → comportamiento normal de WooCommerce (tachado + oferta)
    return $price;

}, 10, 2);

add_filter('woocommerce_product_get_price', 'jodear_force_regular_price', 10, 2);
add_filter('woocommerce_product_get_sale_price', 'jodear_force_regular_price', 10, 2);

function jodear_force_regular_price($price, $product) {

    $mostrar = get_post_meta($product->get_id(), '_mostrar_precio_anterior', true);

    if ($mostrar !== 'yes') {
        return $product->get_regular_price();
    }

    return $price;
}
//TEXTO BOTONES CARRITO 


add_filter('woocommerce_product_single_add_to_cart_text', function() {
    return 'Comprar';
});

add_filter('woocommerce_product_add_to_cart_text', function() {
    return 'Comprar';
});



//  OCULTAR DESCUENTOS CARRITO 

add_action('woocommerce_before_calculate_totals', function($cart) {

    if (is_admin() && !defined('DOING_AJAX')) return;

    foreach ($cart->get_cart() as $cart_item) {

        $product = $cart_item['data'];
        $product_id = $product->get_id();

        $mostrar = get_post_meta($product_id, '_mostrar_precio_anterior', true);

        // Si el checkbox NO está tildado → usar precio normal
        if ($mostrar !== 'yes') {
            $regular_price = $product->get_regular_price();
            $product->set_price($regular_price);
        }
    }

});


// BOTÓN WHATSAPP RESERVAS (SINGLE)


add_action('woocommerce_single_product_summary', function() {

    global $product;
    if (!$product) return;

    if ($product->get_stock_status() === 'onbackorder') {

        remove_action('woocommerce_single_product_summary','woocommerce_template_single_add_to_cart',30);

        echo '<div class="producto-reserva-whatsapp" style="margin-top:20px;">';
        echo '<p style="font-weight:600;margin-bottom:10px;">
                Este producto puede ser reservado, comunicate con nosotros
              </p>';

        echo '<a href="https://wa.me/5491136980638?text=Hola%20quiero%20reservar%20el%20producto%20'
            . urlencode(get_the_title()) .
            '" target="_blank"
            style="display:inline-flex;align-items:center;gap:8px;text-decoration:none;">';

        echo '<img src="https://tienda.jodear.com.ar/wp-content/uploads/2025/11/whatsapp-logo.png"
                style="width:28px;height:28px;" />';

        echo '<span style="font-weight:600;">Contactar por WhatsApp</span>';
        echo '</a>';
        echo '</div>';
    }

}, 25);


// BOTÓN WHATSAPP EN TIENDA 

add_filter('woocommerce_loop_add_to_cart_link', function($button, $product) {

    if ($product->get_stock_status() === 'onbackorder') {

        $link = 'https://wa.me/5491136980638?text=Hola%20quiero%20reservar%20el%20producto%20'
                . urlencode($product->get_name());

        return '<a href="'.esc_url($link).'" target="_blank" class="button"
                style="background:#25D366;border-color:#25D366;">
                Reservar por WhatsApp
                </a>';
    }

    return $button;

}, 10, 2);


//BADGE OFERTA PERSONALIZADO 


add_filter('woocommerce_sale_flash', 'jodear_controlar_badge_oferta', 10, 3);
function jodear_controlar_badge_oferta($html, $post, $product) {

    $mostrar = get_post_meta($product->get_id(), '_mostrar_precio_anterior', true);

    if ($mostrar !== 'yes') return '';

    return $html;
}


//OCULTAR PRODUCTOS SIN STOCK 

add_action('woocommerce_product_query', function($q) {

    $meta_query = $q->get('meta_query');
    if (!$meta_query) $meta_query = [];

    $meta_query[] = array(
        'key' => '_stock_status',
        'value' => 'outofstock',
        'compare' => '!='
    );

    $q->set('meta_query', $meta_query);
});

add_action('woocommerce_product_query', function($q) {

    if (!is_admin() && get_query_var('off30') == 1) {

        $meta_query = $q->get('meta_query');
        if (!$meta_query) $meta_query = [];

        $meta_query[] = array(
            'key' => '_30_off',
            'value' => 'yes',
            'compare' => '='
        );

        $q->set('meta_query', $meta_query);
    }

});

// CHECKBOX 30% OFF
add_action('woocommerce_product_options_pricing', function() {
    woocommerce_wp_checkbox(array(
        'id' => '_30_off',
        'label' => 'Producto 30% OFF',
        'description' => 'Marcar si este producto pertenece a la sección 30% OFF'
    ));
});

add_action('woocommerce_process_product_meta', function($post_id) {
    $value = isset($_POST['_30_off']) ? 'yes' : 'no';
    update_post_meta($post_id, '_30_off', $value);
});

// REWRITE URL /30-off
add_action('init', function() {
    add_rewrite_rule(
        '^30-off/?$',
        'index.php?post_type=product&off30=1',
        'top'
    );
});

// Registrar query var
add_filter('query_vars', function($vars) {
    $vars[] = 'off30';
    return $vars;
});

// CAMBIO DE NOMBRE , ORDEN DE PRECIO, CRUMBS Y CARTEL 30%OFF

add_filter('pre_get_document_title', function($title) {
    if (get_query_var('off30') == 1) {
        return 'Productos con 30% OFF | JODEAR';
    }
    return $title;
});

add_action('woocommerce_product_query', function($q) {

    if (get_query_var('off30') == 1) {
        $q->set('orderby', 'meta_value_num');
        $q->set('meta_key', '_price');
        $q->set('order', 'ASC');
    }

});

add_filter('woocommerce_get_breadcrumb', function($crumbs) {

    if (get_query_var('off30') == 1) {
        $crumbs[count($crumbs)-1][0] = '30% OFF';
    }

    return $crumbs;

});
add_action('woocommerce_before_shop_loop', function() {

    if (get_query_var('off30') != 1) return;

    echo '<div style="
        background:#000;
        color:#fff;
        padding:30px;
        text-align:center;
        margin-bottom:30px;
        border-radius:12px;
    ">
        <h1 style="margin:0;font-size:32px;">🔥 30% OFF</h1>
        <p style="margin:10px 0 0;">
            Aprovechá nuestras ofertas exclusivas por tiempo limitado
        </p>
    </div>';

}, 5);

// BUSCAR PRODUCTOS POR SKU
add_filter('posts_search', function($search, $wp_query) {

    global $wpdb;

    if (is_admin() || !$wp_query->is_search()) {
        return $search;
    }

    // Solo en productos
    if (!isset($wp_query->query_vars['post_type']) || $wp_query->query_vars['post_type'] !== 'product') {
        return $search;
    }

    $search_term = $wp_query->query_vars['s'];

    if (!$search_term) return $search;

    // Agregar búsqueda por SKU
    $search .= $wpdb->prepare(
        " OR EXISTS (
            SELECT 1 FROM {$wpdb->postmeta}
            WHERE {$wpdb->postmeta}.post_id = {$wpdb->posts}.ID
            AND {$wpdb->postmeta}.meta_key = '_sku'
            AND {$wpdb->postmeta}.meta_value LIKE %s
        )",
        '%' . $wpdb->esc_like($search_term) . '%'
    );

    return $search;

}, 10, 2);




//AGREGADO DE PESO POR LAS DUDAS AIRES

add_filter('woocommerce_product_get_weight', function($weight, $product) {

    if (!empty($weight)) return $weight;

    $product_id = $product->get_id();

    if (
        has_term('climatizacion', 'product_cat', $product_id) ||
        has_term(['linea-residencial','ventana','multisplit','portatiles','split'], 'product_cat', $product_id)
    ) {
        return 35; // peso promedio aire acondicionado
    }

    return 1; // resto de productos livianos

}, 10, 2);

// ENVIO A COORDINAR AIRES
// ENVÍOS INTELIGENTES (AIRE vs NORMAL vs MIXTO)

add_filter('woocommerce_package_rates', function($rates, $package) {

    $hay_aire = false;

    foreach ($package['contents'] as $item) {
        $product = $item['data'];

        if (
            has_term('climatizacion', 'product_cat', $product->get_id()) ||
            has_term(['linea-residencial','ventana','multisplit','portatiles','split'], 'product_cat', $product->get_id())
        ) {
            $hay_aire = true;
            break;
        }
    }

    // 🟢 Si NO hay aire → aseguramos que haya métodos
    if (!$hay_aire) {

        if (empty($rates)) {
            $rates['fallback'] = new WC_Shipping_Rate(
                'fallback',
                'Envío disponible al finalizar la compra',
                0,
                [],
                'fallback'
            );
        }

        return $rates;
    }

    // 🔵 Si hay aire → SOLO coordinar
    $rates = [];

    $rates['coordinar'] = new WC_Shipping_Rate(
        'coordinar',
        'Envío a coordinar con el vendedor',
        0,
        [],
        'custom_shipping'
    );

    return $rates;

}, 999, 2);

//CARTEL DE ENVIOA  COORDINAR POR PESO Y TAMAÑO:
add_action('woocommerce_single_product_summary', function() {

    global $product;

    if (
        has_term('climatizacion', 'product_cat', $product->get_id())
    ) {
        echo '<p style="color:#000;font-weight:600;">
        🚚 Este producto se envía a coordinar por su tamaño y peso.
        </p>';
    }

}, 25);

add_filter('woocommerce_cart_shipping_method_full_label', function($label, $method) {

    if (stripos($method->label, 'coordinar') !== false) {

        $label = 'Envío a coordinar (te informamos el costo por WhatsApp)';

    }

    return $label;

}, 10, 2);

add_filter('woocommerce_package_rates', function($rates, $package) {

    foreach ($rates as $rate_id => $rate) {

        if (stripos($rate->label, 'coordinar') !== false) {

            $rates[$rate_id]->cost = 0.01;
            $rates[$rate_id]->taxes = [];
        }
    }

    return $rates;

}, 1000, 2);

