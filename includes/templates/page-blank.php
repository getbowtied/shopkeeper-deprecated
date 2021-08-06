<?php
/*
Template Name: Blank
*/
?>

<?php get_header(); ?>

<div class="blank-page full-width-page page-title-hidden">

	<?php while ( have_posts() ) : the_post(); ?>

	    <div class="entry-content">
	        <?php the_content(); ?>
	    </div>

	<?php endwhile; ?>
	
</div>

<?php get_footer(); ?>
