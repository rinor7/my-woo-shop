<?php
global $header_type; // required to access global variable
include("includes/headers/{$header_type}.php"); 
?>

	<main id="primary" class="site-single single-page">

	<?php include("includes/blocks/hero.php"); ?>
	
	<div class="container">
		<div class="content">
			<?php the_content(); ?>
		</div>
	</div>
		

	</main><!-- #main -->



<?php include("includes/footers/default.php");  ?>