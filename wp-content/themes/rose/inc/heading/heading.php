<?php 
	global $post;
	$heading_option = get_post_meta($post->ID, 'heading_option', true);

	$status_heading = isset($heading_option['heading_custom']) ? $heading_option['heading_custom'] : 'visible';
	if($status_heading =='visible') :
		$heading = get_post_meta($post->ID, 'heading_setting', true);
		$title = get_the_title();
		$description = isset($heading['description']) ? $heading['description'] : '';
		$align = isset($heading['alignment']) ? $heading['alignment'] : 'text-left';
		$attachment_id = isset($heading['attachment_id']) ? $heading['attachment_id'] : '';
		$bg_overlay = isset($heading['bg_overlay']) ? $heading['bg_overlay'] : '';
		$bg_opacity = isset($heading['bg_opacity']) ? $heading['bg_opacity'] : '';
		$hide = isset($heading['hide']) ? $heading['hide'] : 'hidden';
		$hide_line = isset($heading['hide_line']) ? $heading['hide_line'] : '0';
		$parallax = isset($heading['parallax']) ? $heading['parallax'] : 'bg-scroll';
		$bgPosition = isset($heading['bg_position']) ? $heading['bg_position'] : 'bg-center';
		$color_title = isset($heading['color_title']) ? $heading['color_title'] : '';
		$color_description = isset($heading['color_description']) ? $heading['color_description'] : '';
		$color_line = isset($heading['color_line']) ? $heading['color_line'] : '';
		$height = isset($heading['height']) ? $heading['height'] : '';
		$font_title = isset($heading['font_title']) ? $heading['font_title'] : '';
		$font_description = isset($heading['font_description']) ? $heading['font_description'] : '';

		$param = array(
			'title'					=> $title,
			'description'			=> $description,
			'align'					=> $align,
			'hide_line'				=> $hide_line,
			'bg_img'				=> $attachment_id,
			'bg_overlay'			=> $bg_overlay,
			'bg_position'			=> $bgPosition,
			'opacity'				=> $bg_opacity,
			'parallax'				=> $parallax,
			'color_title'			=> $color_title,
			'color_description'		=> $color_description,
			'color_line'			=> $color_line,
			'height'				=> $height,
			'font_title'			=> $font_title,
			'font_description'		=> $font_description
		);

		$attribute = rose_array_to_attributes($param);
		
		?>

		<section id="banner" class="mb-50">
			<div class="container">
				<?php if(class_exists('rose_plugin_shortcode')) {
					echo do_shortcode('[rose_shortcode_banner '. $attribute .']');
				} ?>
			</div>
		</section>

	<?php endif; ?>
