<?php 
	$fields = pk_get('fields');
	$options = pk_get('options');
	
	if(! empty($fields['featured_image'])){
		$featured_image = $fields['featured_image']['url'];
	}else{
		$featured_image = $options['default_featured_image']['url'];
	}
?>
<section class="wrapper no-print setup-background" id="featured" style="background-image: url(<?php echo $featured_image; ?>);"></section>