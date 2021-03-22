<?php
/**
 * Envira Gallery Rest Class.
 *
 * @since 1.8.5
 *
 * @package Envira Gallery
 * @author  Envira Gallery Team <support@enviragallery.com>
 */

namespace Envira\Frontend;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {

	exit;

}

use Envira\Frontend\Shortcode;

/**
 * Rest Class for envira.
 */
class Rest {

	/**
	 * Class Constructor
	 *
	 * @since 1.8.5
	 */
	public function __construct() {
		add_action( 'rest_api_init', array( $this, 'register_post_meta' ) );

	}

	/**
	 * Helper Method to register Envira gallery Meta
	 *
	 * @since 1.8.5
	 *
	 * @return void
	 */
	public function register_post_meta() {

		register_rest_field(
			'envira',
			'gallery_data',
			array(
				'get_callback'    => array( $this, 'get_gallery_data' ),
				'update_callback' => array( $this, 'update_gallery_data' ),
			)
		);

	}

	/**
	 * Rest API callback to get gallery data.
	 *
	 * @param [type] $object Post Object.
	 * @param [type] $field_name Rest Field Name.
	 * @param [type] $request Rest Request.
	 * @return array
	 */
	public function get_gallery_data( $object, $field_name, $request ) {

		$data = get_post_meta( $object['id'], '_eg_gallery_data', true );

		$i      = 0;
		$images = array();

		if ( isset( $data['gallery'] ) && is_array( $data['gallery'] ) ) {
			foreach ( $data['gallery'] as $id => $item ) {

				// Skip over images that are pending (ignore if in Preview mode).
				if ( isset( $item['status'] ) && 'pending' === $item['status'] && ! is_preview() ) {
					continue;
				}

				$imagesrc     = envira_get_image_src( $id, $item, $data, false, false );
				$item['src']  = $imagesrc;
				$item['id']   = $id;
				$images[ $i ] = $item;

				$i++;
			}
			$data['gallery'] = $images;

		}

		// Allow the data to be filtered before it is stored and used to create the gallery output.
		$data = apply_filters( 'envira_gallery_pre_data', $data, $object['id'] );
		return $data;

	}

	/**
	 * Rest API updater callback.
	 *
	 * @since 1.8.5
	 *
	 * @param array  $value Value to update.
	 * @param object $object Post Object.
	 * @param string $field_name Meta field name.
	 * @return array
	 */
	public function update_gallery_data( $value, $object, $field_name ) {

		$gallery_data           = get_post_meta( $object->ID, '_eg_gallery_data', true );
		$gallery_data['config'] = wp_parse_args( $value['config'], $gallery_data['config'] );

		// Flush gallery cache.
		envira_flush_gallery_caches( $object->ID );

		return update_post_meta( $object->ID, '_eg_gallery_data', $gallery_data );
	}

}
