<?php
/*
Plugin Name: Formulario de Pedido Único - Menaki Style
Description: Listado de packs por categoría con foto, selector de cantidad, formulario y resumen flotante con la identidad corporativa de Menaki. Correo HTML premium incluido.
Version: 1.2
Author: Crear & Co
*/

if ( ! defined( 'ABSPATH' ) ) exit;

function render_pedido_menaki_style() {
    if ( ! class_exists( 'WooCommerce' ) ) {
        return '<p style="color:red;">Este shortcode requiere que WooCommerce esté activo.</p>';
    }

    // Procesar envío de pedido personalizado (Blindado para PHP 8)
    if ( $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['enviar_pedido_menaki']) ) {
        $nombre     = sanitize_text_field($_POST['nombre'] ?? '');
        $telefono   = sanitize_text_field($_POST['telefono'] ?? '');
        $email      = sanitize_email($_POST['email'] ?? '');
        $mensaje    = sanitize_textarea_field($_POST['mensaje'] ?? ''); // <--- Recogemos el mensaje de forma segura
        $cantidades = $_POST['qty'] ?? array();
        
        $lineas_html = "";
        $total_pedido = 0;

        if ( is_array($cantidades) ) {
            foreach ( $cantidades as $prod_id => $qty ) {
                $qty = intval($qty);
                if ( $qty > 0 ) {
                    $product = wc_get_product($prod_id);
                    if ( $product ) {
                        $precio = $product->get_price();
                        $subtotal = $precio * $qty;
                        $total_pedido += $subtotal;
                        
                        $precio_limpio = number_format($subtotal, 2, ',', '.') . ' €';
                        
                        $lineas_html .= "
                        <tr>
                            <td style='padding: 12px; border-bottom: 1px solid #e2e8f0; font-size: 14px; font-family: sans-serif; color: #0A0A0A;'>{$product->get_name()}</td>
                            <td style='padding: 12px; border-bottom: 1px solid #e2e8f0; font-size: 14px; font-family: sans-serif; color: #0A0A0A; text-align: center; font-weight: bold;'>x{$qty}</td>
                            <td style='padding: 12px; border-bottom: 1px solid #e2e8f0; font-size: 14px; font-family: sans-serif; color: #494470; text-align: right; font-weight: bold;'>{$precio_limpio}</td>
                        </tr>";
                    }
                }
            }
        }

        if ( $total_pedido > 0 ) {
            $to = "alfonso.calzada@benowu.com";
            $subject = '=?UTF-8?B?' . base64_encode('Nuevo Pedido Web Menaki - ' . $nombre) . '?=';
            
            $logo_url = "http://menaki.test/wp-content/uploads/2025/02/Logo-Menaki-Blanco.png";
            $total_final_formateado = number_format($total_pedido, 2, ',', '.') . ' €';

            $body = "
            <div style='background-color: #f6f6f6; padding: 40px 20px; font-family: sans-serif;'>
                <div style='max-width: 600px; margin: 0 auto; background-color: #ffffff; border: 1px solid #0A0A0A; box-shadow: 6px 6px 0px #494470;'>
                    
                    <div style='background-color: #494470; padding: 25px; text-align: center;'>
                        <img src='{$logo_url}' alt='Menaki Logo' style='max-width: 130px; height: auto; display: inline-block;'>
                    </div>
                    
                    <div style='padding: 30px;'>
                        <div style='margin-bottom: 25px;'>
                            <table style='width: 100%;'>
                                <tr>
                                    <td style='vertical-align: middle;'>
                                        <h2 style='color: #494470; margin: 0; font-size: 22px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px;'>Nueva Reserva</h2>
                                    </td>
                                    <td style='text-align: right; vertical-align: middle;'>
                                        <div style='display: inline-block; border: 2px dashed #e56e18; color: #e56e18; padding: 6px 12px; font-weight: 800; font-size: 11px; text-align: center; text-transform: uppercase;'>
                                            MENAKI 2026<br><span style='font-size: 9px; letter-spacing: 1px;'>Verificado</span>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        
                        <div style='background-color: #fcf0e6; padding: 20px; border-left: 4px solid #e56e18; margin-bottom: 30px;'>
                            <h3 style='margin: 0 0 12px 0; font-size: 15px; color: #494470; text-transform: uppercase; letter-spacing: 0.5px;'>Datos del Estudiante / Cliente</h3>
                            <p style='margin: 5px 0; font-size: 14px;'><strong>Nombre:</strong> {$nombre}</p>
                            <p style='margin: 5px 0; font-size: 14px;'><strong>Teléfono:</strong> {$telefono}</p>
                            <p style='margin: 5px 0; font-size: 14px;'><strong>Email:</strong> {$email}</p>
                            " . ( !empty($mensaje) ? "<p style='margin: 10px 0 5px 0; font-size: 14px; border-top: 1px solid #e56e18; padding-top: 10px;'><strong>Nota/Mensaje:</strong><br>" . nl2br(esc_html($mensaje)) . "</p>" : "" ) . "
                        </div>
                        
                        <table style='width: 100%; border-collapse: collapse; margin-bottom: 25px;'>
                           <thead>
                               <tr style='background-color: #f8fafc;'>
                                   <th style='padding: 12px; text-align: left; font-size: 12px; color: #718096; text-transform: uppercase; border-bottom: 2px solid #0A0A0A;'>Pack / Producto</th>
                                   <th style='padding: 12px; text-align: center; font-size: 12px; color: #718096; text-transform: uppercase; border-bottom: 2px solid #0A0A0A;'>Cantidad</th>
                                   <th style='padding: 12px; text-align: right; font-size: 12px; color: #718096; text-transform: uppercase; border-bottom: 2px solid #0A0A0A;'>Total</th>
                               </tr>
                           </thead>
                           <tbody>
                               {$lineas_html}
                           </tbody>
                        </table>
                        
                        <div style='text-align: right; margin-top: 25px; padding-top: 15px; border-top: 1px solid #0A0A0A;'>
                            <p style='font-size: 16px; margin: 0; font-weight: 600; color: #0A0A0A;'>TOTAL PRESUPUESTO: <span style='color: #e56e18; font-size: 24px; font-weight: 800; margin-left: 10px;'>{$total_final_formateado}</span></p>
                        </div>
                    </div>
                    
                    <div style='background-color: #fcf0e6; padding: 15px; text-align: center; font-size: 12px; color: #494470; border-top: 1px solid #e2e8f0; font-weight: bold;'>
                        Menaki &copy; 2026 - Todo lo que necesitas, en un solo pack.
                    </div>
                </div>
            </div>";

            $headers = array();
            $headers[] = 'Content-Type: text/html; charset=UTF-8';
            $headers[] = 'From: Menaki Web <no-reply@menaki.test>';

            wp_mail($to, $subject, $body, $headers);

            return '<div style="background:#fcf0e6; color:#e56e18; padding:30px; border: 2px solid #e56e18; border-radius:12px; text-align:center; font-family:\'Manrope\', sans-serif;">
                        <h3 style="margin: 0 0 10px 0; font-weight:700;">¡Tu pedido se ha procesado con éxito!</h3>
                        <p>Gracias por confiar en Menaki, ' . esc_html($nombre) . '. Nos pondremos en contacto contigo de inmediato.</p>
                    </div>';
        } else {
            echo '<p style="color:#e56e18; text-align:center; font-weight:bold; font-family:\'Manrope\', sans-serif; margin-top: 15px;">Por favor, añade al menos un pack a tu pedido.</p>';
        }
    }

    ob_start();
    ?>
    
    <style>
        .menaki-checkout-root { display: flex; flex-wrap: wrap; gap: 40px; font-family: 'Manrope', sans-serif; color: #0A0A0A; margin: 20px 0; }
        .menaki-main-col { flex: 2; min-width: 320px; }
        .menaki-side-col { flex: 1; min-width: 300px; background: #ffffff; padding: 30px; border: 1px solid #0A0A0A; position: sticky; top: 120px; height: max-content; box-shadow: 8px 8px 0px #494470; }
        .menaki-cat-block { margin-bottom: 40px; }
        .menaki-cat-title { font-size: 24px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; color: #494470; border-bottom: 2px solid #e56e18; padding-bottom: 8px; margin-bottom: 25px; }
        .menaki-prod-card { display: flex; align-items: center; gap: 20px; background: #fdfdfd; padding: 15px; margin-bottom: 15px; border: 1px solid #e2e8f0; border-radius: 8px; transition: border-color 0.2s; }
        .menaki-prod-card:hover { border-color: #494470; }
        .menaki-prod-img { width: 80px; height: 80px; object-fit: cover; border-radius: 6px; border: 1px solid #0A0A0A; }
        .menaki-prod-details { flex-grow: 1; }
        .menaki-prod-title { font-size: 16px; font-weight: 600; margin: 0 0 5px 0; text-transform: uppercase; }
        .menaki-prod-price { color: #494470; font-weight: 700; font-size: 15px; }
        .menaki-qty-selector { display: flex; align-items: center; border: 1px solid #0A0A0A; border-radius: 4px; overflow: hidden; }
        .menaki-qty-btn { background: #f4f4f4; border: none; width: 32px; height: 35px; font-size: 18px; cursor: pointer; font-weight: bold; transition: background 0.2s; }
        .menaki-qty-btn:hover { background: #e2e8f0; }
        .menaki-qty-input { width: 40px; height: 35px; border: none; border-left: 1px solid #0A0A0A; border-right: 1px solid #0A0A0A; text-align: center; font-size: 14px; font-weight: 600; }
        .menaki-qty-input::-webkit-outer-spin-button, .menaki-qty-input::-webkit-inner-spin-button { -webkit-appearance: none; margin: 0; }
        .menaki-customer-box { margin-top: 40px; background: #fcf0e6; padding: 25px; border: 1px solid #0A0A0A; }
        .menaki-customer-box h3 { margin-top: 0; color: #494470; font-weight: 700; text-transform: uppercase; font-size: 18px; }
        .menaki-form-field { margin-bottom: 15px; }
        .menaki-form-field label { display: block; font-size: 14px; font-weight: 600; margin-bottom: 6px; }
        .menaki-form-field input { width: 100%; padding: 10px 14px; border: 1px solid #0A0A0A; font-family: inherit; background: #fff; }
        .menaki-btn-submit { background: #494470; color: #fff; width: 100%; padding: 14px; border: 1px solid #0A0A0A; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; cursor: pointer; transition: all 0.2s; }
        .menaki-btn-submit:hover { background: #e56e18; transform: translateY(-2px); }
    </style>

    <form id="menaki-onepage-form" method="post" action="">
        <div class="menaki-checkout-root">
            
            <div class="menaki-main-col">
                <?php
                $categories = get_terms( array( 'taxonomy' => 'product_cat', 'hide_empty' => true ) );
                foreach ( $categories as $cat ) {
                    $args = array(
                        'post_type' => 'product',
                        'posts_per_page' => -1,
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'product_cat',
                                'field'    => 'term_id',
                                'terms'    => $cat->term_id,
                            ),
                        ),
                    );
                    $products = new WP_Query( $args );

                    if ( $products->have_posts() ) {
                        echo '<div class="menaki-cat-block">';
                        echo '<h2 class="menaki-cat-title">' . esc_html( $cat->name ) . '</h2>';

                        while ( $products->have_posts() ) {
                            $products->the_post();
                            global $product;
                            
                            $img_url = get_the_post_thumbnail_url( get_the_ID(), 'medium' ) ?: wc_placeholder_img_src();
                            $price = $product->get_price();
                            $prod_id = get_the_ID();
                            ?>
                            <div class="menaki-prod-card">
                                <img src="<?php echo esc_url( $img_url ); ?>" class="menaki-prod-img" alt="<?php the_title(); ?>">
                                <div class="menaki-prod-details">
                                    <h3 class="menaki-prod-title"><?php the_title(); ?></h3>
                                    <span class="menaki-prod-price"><?php echo strip_tags(wc_price( $price )); ?></span>
                                </div>
                                <div class="menaki-qty-selector">
                                    <button type="button" class="menaki-qty-btn" onclick="changeQty(<?php echo $prod_id; ?>, -1)">-</button>
                                    <input type="number" name="qty[<?php echo $prod_id; ?>]" id="input-qty-<?php echo $prod_id; ?>" class="menaki-qty-input" min="0" value="0" data-price="<?php echo esc_attr( $price ); ?>" data-name="<?php echo esc_attr( get_the_title() ); ?>">
                                    <button type="button" class="menaki-qty-btn" onclick="changeQty(<?php echo $prod_id; ?>, 1)">+</button>
                                </div>
                            </div>
                            <?php
                        }
                        echo '</div>';
                        wp_reset_postdata();
                    }
                }
                ?>

                <div class="menaki-customer-box">
                    <h3>Información de entrega</h3>
                    <div class="menaki-form-field"><label></label><input type="text" name="nombre" required placeholder="Nombre y Apellidos *"></div>
                    <div class="menaki-form-field"><label></label><input type="tel" name="telefono" required placeholder="Teléfono de Contacto *"></div>
                    <div class="menaki-form-field"><label></label><input type="email" name="email" required placeholder="Correo electrónico*"></div>
                    <div class="menaki-form-field"><label></label><input type="text" name="direccion" placeholder="Mensaje"></div>
                </div>
            </div>

            <div class="menaki-side-col">
                <h3 style="margin-top:0; font-weight:700; text-transform:uppercase; color:#494470;">Tu Configuración</h3>
                <div id="menaki-summary-items">
                    <p style="color: #777; font-size: 14px;">No has seleccionado ningún pack todavía.</p>
                </div>
                <hr style="border:0; border-top:1px dashed #0A0A0A; margin:20px 0;">
                <div style="display: flex; justify-content: space-between; font-weight: 700; font-size: 20px; margin-bottom: 25px;">
                    <span>TOTAL:</span>
                    <span id="menaki-summary-total" style="color:#0A0A0A;">0.00€</span>
                </div>
                <button type="submit" name="enviar_pedido_menaki" class="menaki-btn-submit">Reservar mi Pack</button>
            </div>

        </div>
    </form>

    <script>
    function changeQty(id, delta) {
        const input = document.getElementById('input-qty-' + id);
        let val = parseInt(input.value) || 0;
        val += delta;
        if (val < 0) val = 0;
        input.value = val;
        input.dispatchEvent(new Event('input', { bubbles: true }));
    }

    document.addEventListener('DOMContentLoaded', function() {
        const qtyInputs = document.querySelectorAll('.menaki-qty-input');
        const summaryItems = document.getElementById('menaki-summary-items');
        const summaryTotal = document.getElementById('menaki-summary-total');

        function updateMenakiCalculator() {
            let html = '';
            let total = 0;
            let hasItems = false;

            qtyInputs.forEach(input => {
                const qty = parseInt(input.value) || 0;
                if (qty > 0) {
                    const price = parseFloat(input.getAttribute('data-price')) || 0;
                    const name = input.getAttribute('data-name');
                    const subtotal = price * qty;
                    total += subtotal;
                    hasItems = true;

                    html += `<div style="display:flex; justify-content:space-between; margin-bottom:12px; font-size:14px;">
                        <span style="font-weight:500;">${name} <strong>(x${qty})</strong></span>
                        <span style="font-weight:700; color:#494470;">${subtotal.toFixed(2)}€</span>
                    </div>`;
                }
            });

            if (!hasItems) {
                summaryItems.innerHTML = '<p style="color: #777; font-size: 14px;">No has seleccionado ningún pack todavía.</p>';
            } else {
                summaryItems.innerHTML = html;
            }
            summaryTotal.textContent = total.toFixed(2) + '€';
        }

        qtyInputs.forEach(input => {
            input.addEventListener('input', updateMenakiCalculator);
        });
    });
    </script>
    <?php
    return ob_get_clean();
}
add_shortcode('pedido_pagina_unica', 'render_pedido_menaki_style');