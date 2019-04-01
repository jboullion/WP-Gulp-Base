<?php 
	get_header(); 
	the_post(); 

	pk_set('fields', get_fields());
?>

<div id="member-page" class="page">
	<?php get_template_part('templates/common/featured'); ?>
	
	<section class="wrapper white-back">
		<div class="container">
			<div class="row">
				<?php get_template_part('templates/members/info'); ?>
				<?php get_template_part('templates/members/content'); ?>
			</div>
		</div>
	</section>

</div>

<?php 
get_footer();