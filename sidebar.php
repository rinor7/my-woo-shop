<?php
if ( is_active_sidebar( 'widget-6' ) && !is_product() && !is_product_category()) : ?>
	<aside id="secondary" class="widget-area" role="complementary">
		<?php dynamic_sidebar( 'widget-6' ); ?>
	</aside><!-- #secondary -->
<?php endif; ?>