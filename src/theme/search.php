<?php get_header();
/*
Template Name: Search Page
*/
?>

<section class="search">
	<div class="container">
		<?php if (have_posts()) :
			$j= 0; while (have_posts()) :
				the_post();
				?>
				
		<?php $j++; endwhile;
		else :
		endif;
		?>

	</div>
</section>

<?php get_footer(); ?>