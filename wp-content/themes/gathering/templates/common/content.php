<section class="wrapper white-back">
	<div class="container">
		<div class="row">
			<div class="col-12 content">
				<h1 class="page-title"><?php echo get_the_title(); ?></h1>
				<?php do_action('pk_before_content'); ?>

				<?php the_content(); ?>

				<?php do_action('pk_after_content'); ?>
			</div>
		</div>
	</div>
</section>