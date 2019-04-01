<?php 
	$options = pk_get('options');
?>
<section id="footer" class="wrapper no-print">
	<div class="container">

		<div class="row">
			<div class="col-12 col-sm-6 col-lg-3 details">
				<div class="logo">
					<a href="/">
						<img class="desktop" src="<?php echo $options['logo']['url']; ?>" data-rjs="2" alt="<?php bloginfo('name'); ?>" />
					</a>
				</div>
				<div class="social">
					<?php echo pk_antispam_email($options['email'], '<i class="fas fa-envelope-open" aria-hidden="true"></i>' ); ?>
					<a class="facebook" href="<?php echo $options['facebook_url']; ?>" target="_blank"><i class="fab fa-facebook-f" aria-hidden="true"></i></a>
				</div>
				
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-12 copyright">
			&copy;<?php echo date('Y').' '.get_bloginfo('name'); ?>. All rights reserved.
		</div>
	</div>
</section>