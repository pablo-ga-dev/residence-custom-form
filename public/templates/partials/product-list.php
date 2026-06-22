<div class="rcf-products-panel" id="rcf-products-panel">
	<?php if ( ! empty( $products_by_category ) && is_array( $products_by_category ) ) : ?>
		<div class="rcf-products-list" id="rcf-products-list">
			<?php foreach ( $products_by_category as $category_group ) : ?>
				<section class="rcf-product-category"
					id="rcf-category-<?php echo esc_attr( $category_group['slug'] ?: 'uncategorized' ); ?>">
					<h3 class="rcf-product-category-title"><?php echo esc_html( $category_group['name'] ); ?></h3>
					<?php foreach ( $category_group['products'] as $product ) : ?>
						<article class="rcf-product-card" id="rcf-product-<?php echo (int) $product['id']; ?>">
							<?php if ( ! empty( $product['image'] ) ) : ?>
								<div class="rcf-product-media">
									<img src="<?php echo esc_url( $product['image'] ); ?>" class="rcf-product-image"
										alt="<?php echo esc_attr( $product['title'] ); ?>">
								</div>
							<?php endif; ?>
							<div class="rcf-product-content">
								<div class="rcf-product-info">
									<h3 class="rcf-product-title"><?php echo esc_html( $product['title'] ); ?></h3>
									<span class="rcf-product-price"><?php echo esc_html( $product['price'] ); ?>
										EUR</span>
								</div>
								<div class="rcf-product-qty" id="rcf-qty-selector-<?php echo (int) $product['id']; ?>">
									<button type="button" class="rcf-qty-button"
										aria-label="Restar unidad de <?php echo esc_attr( $product['title'] ); ?>"
										onclick="changeQty(<?php echo (int) $product['id']; ?>, -1)">-</button>
									<input type="number" name="qty[<?php echo (int) $product['id']; ?>]"
										id="rcf-input-qty-<?php echo (int) $product['id']; ?>" class="rcf-qty-input" min="0"
										value="0" data-price="<?php echo esc_attr( $product['price'] ); ?>"
										data-name="<?php echo esc_attr( $product['title'] ); ?>"
										data-id="<?php echo esc_attr( $product['id'] ); ?>">
									<button type="button" class="rcf-qty-button"
										aria-label="Añadir unidad de <?php echo esc_attr( $product['title'] ); ?>"
										onclick="changeQty(<?php echo (int) $product['id']; ?>, 1)">+</button>
								</div>
							</div>
						</article>
					<?php endforeach; ?>
				</section>
			<?php endforeach; ?>
		</div>
	<?php endif; ?>
</div>