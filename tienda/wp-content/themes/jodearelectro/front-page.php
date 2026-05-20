<?php
get_header();
?>

<main class="min-height">
    <section class="hero landing-section ">
        <div class="top-part">
            <div class="hero-slider">
                <div class="hero-slide hero-slide-1">
                    <div class="column">
                        <div class="slide-header">
                            <h1 class="section-title">DESCUENTOS</h2>
                            <p class="section-subtitle">DE OTOÑO</p>
                            <img src="<?php echo get_stylesheet_directory_uri() . '/assets/images/front-page/arrows.png' ?>" alt="" class="arrows">
                        </div>
                        <div class="mini-row">
                            <p class="pill">HASTA 30% OFF</p>
                            <p class="pill">SERVICIO DE <br /> INSTALACIÓN</p>
                        </div>
                    </div>
                    <div class="column">
                        <img src="<?php echo get_stylesheet_directory_uri() . '/assets/images/front-page/hero/aires.png' ?>" alt="">
                        <img src="<?php echo get_stylesheet_directory_uri() . '/assets/images/front-page/hero/white_fade.png' ?>" alt="" class="white-fade">

                    </div>
                </div>

                <div class="hero-slide hero-slide-2">
                    <div class="slide-header">
                        <div class="pill">
                            <h2 class="section-title">HERRAMIENTAS</h2>
                            <img src="<?php echo get_stylesheet_directory_uri() . '/assets/images/front-page/arrows.png' ?>" alt="" class="arrows">
                        </div>
                    </div>
                    <div class="slide-body">
                        <div class="column">
                            <img src="<?php echo get_stylesheet_directory_uri() . '/assets/images/front-page/hero/motosierra.png' ?>" alt="">
                        </div>
                        <div class="column">
                            <div class="pill pill-with-image">
                                <img class="pill-image" src="<?php echo get_stylesheet_directory_uri() . '/assets/images/front-page/hero/ronix.png' ?>" alt="">
                            </div>
                            <div class="mini-col">
                                <p class="pill">18 MESES DE GARANTÍA</p>
                                <p class="pill">ENVÍO A TODO EL PAÍS</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="hero-slide hero-slide-3">
                    <div class="slide-header">
                        <img src="<?php echo get_stylesheet_directory_uri() . '/assets/images/front-page/arrows.png' ?>" alt="" class="arrows">
                        <h2 class="section-title">CLIMATIZA TU HOGAR</h2>
                        <p class="section-subtitle">HASTA 30% OFF</p>
                    </div>
                    <div class="slide-body">
                        <div class="column">
                            <img src="<?php echo get_stylesheet_directory_uri() . '/assets/images/front-page/hero/aires_2.png' ?>" alt="">
                            <img src="<?php echo get_stylesheet_directory_uri() . '/assets/images/front-page/hero/white_fade.png' ?>" alt="" class="white-fade">
                        </div>
                        <div class="column">
                            <div class="pill pill-with-image">
                                <img class="pill-image" src="<?php echo get_stylesheet_directory_uri() . '/assets/images/front-page/hero/midea_surrey.png' ?>" alt="">
                            </div>
                            <p class="pill">CUOTAS SIN INTERES</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bottom-part">
            <div class="carousel-button left-button hidden">
                <svg aria-hidden="true" width="32" height="32" viewBox="0 0 32 32" fill="rgba(0, 0, 0, 0.9)">
                    <path d="M20.0549 6.99999L11.0596 15.9953L20.0642 25L19.0036 26.0607L8.93823 15.9953L18.9942 5.93933L20.0549 6.99999Z" fill="rgba(0, 0, 0, 0.9)"></path>
                </svg>
            </div>
            <div class="overlay"></div>

            <div class="carousel-wrapper">
                <div class="cards-container">
                    <?php

                    $items = [
                        (object) [
                            "img" => "/assets/images/front-page/cards/18.png",
                            "title" => "EN PRODUCTOS SELECCIONADOS",
                            "link" => "/30-off"
                        ],   (object) [
                            "img" => "/assets/images/front-page/cards/4.png",
                            "title" => "Representantes oficiales",
                            "subtitle" => "Conoce las herramientas manuales y motorizadas",
                            "link" => "/product-category/herramientas-hogar/"
                        ],
                        (object) [
                            "img" => "/assets/images/front-page/cards/6.png",
                            "title" => "Representantes oficiales",
                            "subtitle" => "Conoce nuestros aires SMART",
                            "link" => "/product-category/climatizacion/linea-residencial/"
                        ], 
                        (object) [
                            "img" => "/assets/images/front-page/cards/11.png",
                            "title" => "TU COMPRA PROTEGIDA",
                            "subtitle" => "CONOCE NUESTROS TERMINOS Y CONDICIONES",
                            "link" => "/privacy-policy"
                        ],
                        (object) [
                            "img" => "/assets/images/front-page/cards/15.png",
                            "title" => "EN PRODUCTOS DESTACADOS",
                        ],

                         (object) [
                            "img" => "/assets/images/front-page/cards/7.png",
                            "title" => "INGRESA A TU CUENTA",
                            "subtitle" => "DISFRUTA DE OFERTAS EXCLUSIVAS",
                            "link" => "/my-account"
                        ],
                        

                        (object) [
                            "img" => "/assets/images/front-page/cards/12.png",
                            "title" => "NUESTRAS CATEGORIAS",
                            "subtitle" => "ENCONTRA AIRES, HERRAMIENTAS Y MUCHO MÁS"
                        ],

                        (object) [
                            "img" => "/assets/images/front-page/cards/16.png",
                            "title" => "MEDIOS DE PAGO",
                            "subtitle" => "PAGA DE FORMA RÁPIDA Y SEGURA"
                        ],
                          (object) [
                            "img" => "/assets/images/front-page/cards/13.png",
                            "title" => "AIRES ACONDICIONADOS SMART",
                            "subtitle" => "DISTRIBUIDORES OFICIALES SURREY. GARANTÍA DE FABRICA",
                            "link" => "/product-category/climatizacion/linea-residencial/"
                        ],
                        (object) [
                            "img" => "/assets/images/front-page/cards/14.png",
                            "title" => "KITS DE INSTALACIÓN Y REPUESTOS DE REFRIGERACIÓN",
                            "link" => "/product-category/climatizacion/materiales-de-instalacion/"
                        ],
                        /*(object) [
                            "img" => "/assets/images/front-page/cards/5.png",
                            "title" => "ENVIOS GRATIS",
                            "subtitle" => "A TODO CABA EN COMPRAS MAYORES A $199.000"
                        ],*/
                        
                        (object) [
                            "img" => "/assets/images/front-page/cards/3.png",
                            "title" => "JUEGOS DE HERRAMIENTAS",
                            "link" => "/product-category/herramientas-para-el-hogar/herramientas-manuales/kits-herramientas-manuales/"
                        ],
                        (object) [
                            "img" => "/assets/images/front-page/cards/8.png",
                            "title" => "HERRAMIENTAS MANUALES",
                            "link" => "/product-category/herramientas-para-el-hogar/herramientas-manuales/"
                        ],
                        (object) [
                            "img" => "/assets/images/front-page/cards/10.png",
                            "title" => "HERRAMIENTAS DE JARDINERIA",
                            "link" => "/product-category/herramientas-para-el-hogar/herramientas-motorizadas/jardineria/"
                        ],
                        (object) [
                            "img" => "/assets/images/front-page/cards/2.png",
                            "title" => "SIERRAS MOTORIZADAS",
                            "link" => "/product-category/herramientas-para-el-hogar/herramientas-motorizadas/sierras-electricas/"
                        ],
                        (object) [
                            "img" => "/assets/images/front-page/cards/9.png",
                            "title" => "BATERIAS Y CARGADORES",
                            "link" => "/product-category/herramientas-hogar/herramientas-motorizadas/baterias-cargadores/"
                        ],
                        
                        
                      
                        
                        
                        
                    ];
                    foreach ($items as $item): ?>
                        <a href="<?php if (isset($item->link)) {
                                        echo esc_url($item->link);
                                    } else {
                                        echo esc_url(wc_get_page_permalink('shop'));
                                    } ?>" class="card__link">
                            <div class="card card-white">
                                <img src="<?php echo get_stylesheet_directory_uri() . $item->img; ?>" />
                                <h4><?php echo $item->title; ?></h4>
                                <?php if (isset($item->subtitle)): ?>
                                    <p><?php echo $item->subtitle; ?></p>
                                <?php endif; ?>
                            </div>
                        </a>
                    <?php
                    endforeach;
                    ?>
                </div>
            </div>
            <div class="carousel-button right-button">
                <svg aria-hidden="true" width="32" height="32" viewBox="0 0 32 32" fill="rgba(0, 0, 0, 0.9)">
                    <path d="M11.943 6.99999L20.9383 15.9953L11.9336 25L12.9943 26.0607L23.0596 15.9953L13.0036 5.93933L11.943 6.99999Z" fill="rgba(0, 0, 0, 0.9)"></path>
                </svg>

            </div>

        </div>
        <!-- <div class="canvas-container">
            <canvas id="fire-canvas"></canvas>
        </div> -->
    </section>
    <section class="landing-section categories-section">
        <div class="pill background-gradient-primary">
            <h2 class="section-title">Categorías</h2>
            <p class="section-subtitle">EN DESCUENTO</p>
        </div>
        <?php

        $taxonomy     = 'product_cat';
        $orderby      = 'name';
        $show_count   = 0;      // 1 for yes, 0 for no
        $pad_counts   = 1;      // 1 for yes, 0 for no
        $hierarchical = 1;      // 1 for yes, 0 for no  
        $title        = '';
        $empty        = 1;

        $args = array(
            'taxonomy'     => $taxonomy,
            'orderby'      => $orderby,
            'show_count'   => $show_count,
            'pad_counts'   => $pad_counts,
            'hierarchical' => $hierarchical,
            'title_li'     => $title,
            'hide_empty'   => $empty
        );
        $all_categories = get_categories($args);

        if (! $all_categories) return;

        else {

            echo '<div class="featured-categories-container">';

            foreach ($all_categories as $cat) {
                $category_id = $cat->term_id;
                $category_description = $cat->description;
                $category_name = $cat->name;

                $thumbnail_id = get_term_meta($cat->term_id, 'thumbnail_id', true);
                $image = wp_get_attachment_url($thumbnail_id);

                if ($category_description) {
                    echo '<a href="' . get_term_link($cat->slug, 'product_cat') . '" class="" >';
                    echo '<div class="card category-card background-gradient-primary">';
                    echo '<img src="' . (isset($image) ? esc_url($image) : '') . '" />';
                    echo '<h4>' . $category_name . '</h4>';
                    echo '<p>' . $category_description . '</p>';
                    echo '<img class="go-to-arrow" src="' . get_stylesheet_directory_uri() . '/assets/images/front-page/go-to.png' . '" />';
                    echo '</div>';
                    echo '</a>';
                }
            }

            echo '</div>';
        }
        ?>


    </section>
    <!-- <section class="landing-section service-section">
        <div class="pill background-purple">
            <h2 class="section-title">Instalación y Servicio Postventa</h2>
        </div>
        <div class="columns-container">
            <div class="card background-purple">
                <div class="feature background-gradient-primary">
                    <h4>CLIMATIZACIÓN</h4>
                    <p>Distribuidores oficiales SURREY y MIDEA. Garantía de Fábrica. Ofrecemos instalación con garantía de fábrica y servicio postventa.</p>
                </div>
                <div class="feature background-gradient-primary">
                    <h4>HERRAMIENTAS MANUALES</h4>

                    <p>
                        Distribuidores oficiales RONIX. Garantía de fábrica y servicios postventa. </p>
                </div>
                <div class="feature background-gradient-primary">
                    <h4>HERRAMIENTAS MOTORIZADAS</h4>
                    <p>Distribuidores oficiales RONIX. Garantía de fábrica y servicios postventa.</p>
                </div>
            </div>
            <div class="card background-purple"><img src="<?php echo get_stylesheet_directory_uri() . '/assets/images/front-page/distribuidores.png'; ?>" alt=""></div>
            <div class="card background-purple">
                <div class="pill background-gradient-primary">
                    <h2 class="section-title">Contactanos</h2>
                    <p>Hacemos cotizaciones en el instante, con stock permanente. Instalación de equipos de aire comerciales y de hogar. Venta mayorista al mejor precio garantizado</p>
                </div>
            </div>
        </div>
        
    </section>-->
    <?php

    $args = array(
        'featured' => true,
    );
    $featured_products = wc_get_products($args);

    if ($featured_products) :
        echo '<section class="landing-section sale-section">';
        echo '<img src="' . get_stylesheet_directory_uri() . '/assets/images/front-page/arrows-left.png" class="arrow-decorator arrow-decorator-left" /> ';
        echo '<div class="featured-products-slider">';
        foreach ($featured_products as $product) :
            $category = get_the_terms($product->get_id(), 'product_cat')[0];
            $description = $product->get_short_description();
            $image = wp_get_attachment_url($product->get_image_id());
            $price = $product->get_price();
            $title = $product->get_title();
            $url = $product->get_permalink();

    ?>

            <div class="featured-product-slide">
                <a href="<?php echo $url; ?>">
                    <div class="featured-product-item">
                        <img src="<?php echo $image; ?>" style="max-width: 350px;" />
                        <h4><?php echo $title; ?></h4>
                        <p><?php echo $description; ?></p>

                        <?php if ($price) {
                            echo '<p class="price">' .  html_entity_decode(strip_tags(wc_price($price))) . '</p>';
                        } ?>
                        <button>Ver detalle</button>
                    </div>
                </a>
                <div class="featured-product-category">
                    <p>JODEAR TIENDA</p>
                    <a href="<?php echo get_term_link($category->slug, 'product_cat'); ?>">Cliquea acá para conocer más <?php echo $category->name; ?></a>
                </div>
            </div>
    <?php endforeach;
        echo '</div>';
        echo '<img src="' . get_stylesheet_directory_uri() . '/assets/images/front-page/arrows-right.png" class="arrow-decorator arrow-decorator-right" />';
        echo '</section>';

    endif;
    ?>
    <section class="landing-section about-us-section">
        <div class="pill background-gradient-primary">
            <h2 class="section-title">¿Quiénes somos?</h2>
        </div>
        <div class="columns-container">
            <div class="about-us-text">
                <?php
                $the_slug = 'nosotros';
                $args = array(
                    'name'           => $the_slug,
                    'post_type'      => 'post',
                    'post_status'    => 'publish',
                    'posts_per_page' => 1
                );
                $my_posts = get_posts($args);
                if ($my_posts) :
                    echo apply_filters('the_content', $my_posts[0]->post_content);
                endif;
                ?>
            </div>
            <div class="representantes">
                <div class="card background-purple representantes-card"><img src="<?php echo get_stylesheet_directory_uri() . '/assets/images/front-page/distribuidores.png'; ?>" alt=""></div>
            </div>
        </div>
    </section>
    <section class="landing-section about-us-section about-us-section__services">
        <div class="pill background-gradient-primary">
            <h2 class="section-title">Servicio de Instalación y Posventa</h2>
        </div>
        <div class="columns-container">
            <div class="about-us-text">
                <?php
                $the_slug = 'servicio';
                $args = array(
                    'name'           => $the_slug,
                    'post_type'      => 'post',
                    'post_status'    => 'publish',
                    'posts_per_page' => 1
                );
                $my_posts = get_posts($args);
                if ($my_posts) :
                    echo apply_filters('the_content', $my_posts[0]->post_content);
                endif;
                ?>
            </div>
           <div class="representantes">
    <div class="card  background-gradient-primary representantes-card" 
         style="display:flex; justify-content:center; border-radius:20px; overflow:hidden;">

        <a href="https://www.jodear.com.ar" 
           target="_blank"
           class="servicio-pill"
           style="
                text-align:center;
                padding:35px 50px;
                display:block;
                width:100%;
                text-decoration:none;
           ">

            <span class="servicio-titulo"
                  style="
                    font-size:30px;
                    font-weight:900;
                    color:#ffffff;
                    text-transform:uppercase;
                    letter-spacing:1.5px;
                    display:block;
                    text-shadow: 0 6px 18px rgba(0,0,0,0.35);
                  ">
                PÁGINA DE SERVICIO
            </span>

            <span class="servicio-sub"
                  style="
                    display:block;
                    margin-top:10px;
                    font-size:17px;
                    font-weight:600;
                    color:#ffffff;
                    opacity:0.9;
                  ">
                Hacé clic para más información
            </span>

        </a>

    </div>
</div>
            <div class="contact-us-mobile card background-purple">
                <div class="pill background-gradient-primary">
                    <h2 class="section-title">Contactanos</h2>
                    <p>Hacemos cotizaciones en el instante, con stock permanente. Instalación de equipos de aire comerciales y de hogar. Venta mayorista al mejor precio garantizado</p>
                </div>
            </div>
        </div>
    </section>

</main>

<?php

get_footer();

?>