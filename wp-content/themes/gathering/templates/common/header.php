<?php 
	$options = pk_get('options');
?>
<section id="header" class="">
	<div id="logo">
		<a href="/">
			<img class="desktop" src="<?php echo $options['logo']['url']; ?>" data-rjs="2" alt="<?php bloginfo('name'); ?>" />
		</a>
	</div>
	<div id="tagline">
		<?php echo get_bloginfo('description'); ?>
	</div>
	<nav id="main-navigation" role="navigation">
		<ul id="menu-main-navigation-menu" class="navbar-nav navbar-expand">
			<?php 
				//, 'walker'=>new Bootstrap_Dropdown_Walker_Texas_Ranger

				$menu_args = array(
					'container'=>false, 
					'depth'=>2, 
					'menu'=>2, 
					'items_wrap' => '%3$s'
				);

				wp_nav_menu($menu_args); 
			?>
			<li class="sign-up"><a href="#">SIGN UP</a></li>
			<li class="login"><a href="#">LOGIN</a></li>
		</ul>
	</nav>
	<div class="clearfix"></div>
</section>