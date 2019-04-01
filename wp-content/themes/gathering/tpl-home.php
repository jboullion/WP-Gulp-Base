<?php
	/* Template Name: Homepage Template */
	get_header(); 
	the_post();

	pk_set('fields', get_fields());
?>
<div id="home-page" class="page">
	<?php get_template_part('templates/common/content'); ?>
</div>
<?php 
	get_footer();