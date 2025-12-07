<?php
get_header();
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