<?php
/**
 * Product Categories Widget - Collapsible Version
 * 
 * Displays collapsible product categories with expand/collapse buttons
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get product categories
$terms = get_terms( array(
	'taxonomy'   => 'product_cat',
	'hide_empty' => true,
	'parent'     => 0, // Only get parent categories
) );

if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
	?>
	<div class="widget woocommerce widget_product_categories">
		<h2 class="widgettitle"><?php esc_html_e( 'Product Categories', 'woocommerce' ); ?></h2>
		<ul class="product-categories-list">
			<?php
			foreach ( $terms as $term ) {
				// Get child categories
				$children = get_terms( array(
					'taxonomy'   => 'product_cat',
					'hide_empty' => true,
					'parent'     => $term->term_id,
				) );

				$has_children = ! empty( $children ) && ! is_wp_error( $children );
				$term_link = get_term_link( $term->term_id, 'product_cat' );

				?>
				<li class="product-category-item <?php echo $has_children ? 'has-children' : ''; ?>">
					<div class="category-header">
						<?php if ( $has_children ) : ?>
							<button class="category-toggle" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle category', 'woocommerce' ); ?>">
								<svg class="toggle-icon" xmlns="http://www.w3.org/2000/svg" width="12.828" height="7.414" viewBox="0 0 12.828 7.414">
									<path id="Vector" d="M0,0,5,5l5-5" transform="translate(1.414 1.414)" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
								</svg>
							</button>
						<?php else : ?>
							<span class="category-spacer"></span>
						<?php endif; ?>
						
						<a href="<?php echo esc_url( $term_link ); ?>" class="category-link">
							<?php echo esc_html( $term->name ); ?>
							<span class="product-count">(<?php echo esc_html( $term->count ); ?>)</span>
						</a>
					</div>

					<?php if ( $has_children ) : ?>
						<ul class="subcategories-list" style="display: none;">
							<?php
							foreach ( $children as $child ) {
								// Get grandchild categories
								$grandchildren = get_terms( array(
									'taxonomy'   => 'product_cat',
									'hide_empty' => true,
									'parent'     => $child->term_id,
								) );

								$has_grandchildren = ! empty( $grandchildren ) && ! is_wp_error( $grandchildren );
								$child_link = get_term_link( $child->term_id, 'product_cat' );

								?>
								<li class="subcategory-item <?php echo $has_grandchildren ? 'has-children' : ''; ?>">
									<div class="category-header">
										<?php if ( $has_grandchildren ) : ?>
											<button class="category-toggle sub-toggle" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle subcategory', 'woocommerce' ); ?>">
												<svg class="toggle-icon" xmlns="http://www.w3.org/2000/svg" width="12.828" height="7.414" viewBox="0 0 12.828 7.414">
													<path id="Vector" d="M0,0,5,5l5-5" transform="translate(1.414 1.414)" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
												</svg>
											</button>
										<?php else : ?>
											<span class="category-spacer"></span>
										<?php endif; ?>
										
										<a href="<?php echo esc_url( $child_link ); ?>" class="category-link">
											<?php echo esc_html( $child->name ); ?>
											<span class="product-count">(<?php echo esc_html( $child->count ); ?>)</span>
										</a>
									</div>

									<?php if ( $has_grandchildren ) : ?>
										<ul class="subsubcategories-list" style="display: none;">
											<?php
											foreach ( $grandchildren as $grandchild ) {
												$grandchild_link = get_term_link( $grandchild->term_id, 'product_cat' );
												?>
												<li class="subsubcategory-item">
													<div class="category-header">
														<span class="category-spacer"></span>
														<a href="<?php echo esc_url( $grandchild_link ); ?>" class="category-link">
															<?php echo esc_html( $grandchild->name ); ?>
															<span class="product-count">(<?php echo esc_html( $grandchild->count ); ?>)</span>
														</a>
													</div>
												</li>
												<?php
											}
											?>
										</ul>
									<?php endif; ?>
								</li>
								<?php
							}
							?>
						</ul>
					<?php endif; ?>
				</li>
				<?php
			}
			?>
		</ul>
	</div>

	<script>
	// Collapsible categories functionality
	document.addEventListener( 'DOMContentLoaded', function() {
		const toggleButtons = document.querySelectorAll( '.category-toggle' );
		
		toggleButtons.forEach( function( button ) {
			button.addEventListener( 'click', function( e ) {
				e.preventDefault();
				
				const categoryHeader = this.closest( '.category-header' );
				const categoryItem = this.closest( 'li' );
				const sublist = categoryItem.querySelector( '.subcategories-list, .subsubcategories-list' );
				
				if ( sublist ) {
					const isExpanded = this.getAttribute( 'aria-expanded' ) === 'true';
					
					this.setAttribute( 'aria-expanded', ! isExpanded );
					this.classList.toggle( 'collapsed' );
					
					if ( isExpanded ) {
						sublist.style.display = 'none';
					} else {
						sublist.style.display = 'block';
					}
				}
			} );
		} );
	} );
	</script>
	<?php
}
?>
