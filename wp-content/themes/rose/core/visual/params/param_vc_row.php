<?php 
	$attribute = array(
		'type' => 'colorpicker',
		'heading'		=> esc_html__('Background overlay', 'rose'),
		'param_name'	=> 'bg_overlay',
		'description'	=> esc_html__('Add background overlay color for this row', 'rose'),
		'value'	=>		'',
		'weight' => 200
	);

	vc_add_param('vc_row', $attribute);

	if ( !function_exists('wiloke_get_list_of_terms') )
	{
		function wiloke_vc_get_list_of_terms($settings, $value)
		{
			$param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
			$taxonomy   = isset($settings['taxonomy']) ? $settings['taxonomy'] : '';

			$multiple   = isset($settings['is_multiple']) && $settings['is_multiple'] == true ? 'multiple' : '';

			if ( !is_array($value) )
			{
				$value = explode(',', $value);
			}

			$aTerms   = get_terms($taxonomy);

			ob_start();
			if ( !empty($aTerms) || !is_wp_error($aTerms) )
			{
				?>
				<select name="<?php echo esc_attr($param_name); ?>" class="wpb_vc_param_value <?php echo esc_attr($param_name); ?>" <?php echo esc_attr($multiple); ?>>
					<?php
						foreach ( $aTerms as $aTerm )
						{
							if ( in_array($aTerm->term_id, $value) )
							{
								$selected = 'selected';
							}else{
								$selected = '';
							}

							?>
								<option <?php echo esc_attr($selected); ?> value="<?php echo esc_attr($aTerm->term_id); ?>"><?php echo esc_html($aTerm->name); ?></option>

							<?php
						}
					?>
				</select>
				<?php
			}else{
				esc_html_e('There  are no categories', 'rose');
			}

			$output = ob_get_clean();
			return $output;
		}

		vc_add_shortcode_param('wiloke_get_list_of_terms', 'wiloke_vc_get_list_of_terms');
	}
