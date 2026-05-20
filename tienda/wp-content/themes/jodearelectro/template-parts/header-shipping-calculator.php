<?php
if(is_cart() || is_checkout()) {
	return;
}

$nonce = wp_create_nonce('wc_store_api');
?>


<form class="woocommerce-shipping-calculator" id="jodear-shipping-calculator" action="/dev/wp-json/wc/store/v1/cart/update-customer" method="post">

	<section class="shipping-calculator-form jodear-header-shipping-calculator" id="shipping-calculator-form" style="display:none;">

		<?php if (apply_filters('woocommerce_shipping_calculator_enable_state', true)) : ?>
			<p class="form-row form-row-wide" id="shipping_address_state_field">
				<?php
				$current_cc = WC()->customer->get_shipping_country();
				$current_r  = WC()->customer->get_shipping_state();
				$states     = WC()->countries->get_states($current_cc);

				if (is_array($states) && empty($states)) {
				?>
					<input type="hidden" name="shipping_address_state" id="shipping_address_state" />
				<?php
				} elseif (is_array($states)) {
				?>
					<span>
						<label for="shipping_address_state">Provincia</label>
						<select name="shipping_address_state" class="state_select" id="shipping_address_state">
							<option value=""><?php esc_html_e('Select an option&hellip;', 'woocommerce'); ?></option>
							<?php
							foreach ($states as $ckey => $cvalue) {
								echo '<option value="' . esc_attr($ckey) . '" ' . selected($current_r, $ckey, false) . '>' . esc_html($cvalue) . '</option>';
							}
							?>
						</select>
					</span>
				<?php
				} else {
				?>
					<label for="shipping_address_state">Provincia</label>
					<input type="text" class="input-text" value="<?php echo esc_attr($current_r); ?>" name="shipping_address_state" id="shipping_address_state" />
				<?php
				}
				?>
			</p>
		<?php endif; ?>

		<?php if (apply_filters('woocommerce_shipping_calculator_enable_city', true)) : ?>
			<p class="form-row form-row-wide" id="shipping_address_city_field">
				<label for="shipping_address_city">Ciudad</label>
				<input type="text" class="input-text" value="<?php echo esc_attr(WC()->customer->get_shipping_city()); ?>" name="shipping_address_city" id="shipping_address_city" />
			</p>
		<?php endif; ?>

		<?php if (apply_filters('woocommerce_shipping_calculator_enable_postcode', true)) : ?>
			<p class="form-row form-row-wide" id="shipping_address_postcode_field">
				<label for="shipping_address_postcode">Código Postal</label>
				<input type="text" class="input-text" value="<?php echo esc_attr(WC()->customer->get_shipping_postcode()); ?>" name="shipping_address_postcode" id="shipping_address_postcode" />
			</p>
		<?php endif; ?>

		<p><button id="jodear_shipping_calculator_submit_button" type="submit" name="calc_shipping" value="1" class="button<?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?>"><?php esc_html_e('Update', 'woocommerce'); ?></button></p>
		<?php wp_nonce_field('woocommerce-shipping-calculator', 'woocommerce-shipping-calculator-nonce'); ?>
	</section>
</form>

<?php
$customer = WC()->session->get('customer');
if ($customer) {

	$city = $customer['city'];
	$postcode = $customer['postcode'];
	if ($city && $postcode) {
		echo sprintf('<div class="jodear-ship jodear-ship-to" ><span class="dashicons dashicons-location"></span><p>Enviar a<br> %s, %s.</p></div>', $city, $postcode);
	} else {
		echo '<div class="jodear-ship jodear-ship-to" ><span class="dashicons dashicons-location"></span><p>Ingresa tu domicilio</p></div>';
	}
}
else {
	echo '<div class="jodear-ship" ><span class="dashicons dashicons-location"></span><p>Envíos<br>a todo el país.</p></div>';
}
?>
<script>
	const jodear_shipping_calculator = document.querySelector('#jodear-shipping-calculator')
	const jodear_shipping_calculator_form = document.querySelector('.jodear-header-shipping-calculator')
	if (jodear_shipping_calculator) {

		const jodear_ship_to = document.querySelector('.jodear-ship-to');
		if (jodear_ship_to) {
			jodear_ship_to.addEventListener('click', () => {
				if (jodear_shipping_calculator_form.offsetParent) {
					jodear_shipping_calculator_form.style.display = 'none';
				} else {
					jodear_shipping_calculator_form.style.display = 'block'
				}
			})
		}
		jodear_shipping_calculator.addEventListener('submit', async (event) => {
			event.preventDefault()

			const shipping_address_state = document.querySelector('#shipping_address_state').value;
			const shipping_address_city = document.querySelector('#shipping_address_city').value;
			const shipping_address_postcode = document.querySelector('#shipping_address_postcode').value;
			const submit_button = document.querySelector('#jodear_shipping_calculator_submit_button')


			submit_button.classList.add('loading')
			const res = await fetch('/wp-json/wc/store/v1/cart/update-customer', {
				method: 'POST',
				body: JSON.stringify({
					billing_address: {
						city: shipping_address_city,
						state: shipping_address_state,
						postcode: shipping_address_postcode,
						country: 'AR',
					},
					shipping_address: {
						city: shipping_address_city,
						state: shipping_address_state,
						postcode: shipping_address_postcode,
						country: 'AR',
					},
					cache: 'no-store'
				}),
				headers: {
					'Nonce': "<?php echo $nonce; ?>",
					'Content-Type': 'application/json'
				}
			})
			submit_button.classList.remove('loading')
			if (res.status && res.status == 200) {

				const json = await res.json()
				window.location.reload()
			}


		})
	}
</script>