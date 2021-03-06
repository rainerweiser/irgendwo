<?php
/**
 * Notices admin class.
 *
 * Handles retrieving whether a particular notice has been dismissed or not,
 * as well as marking a notice as dismissed.
 *
 * @since 1.3.5
 *
 * @package Envira_Gallery
 * @author  Envira Team
 */
namespace Envira\Admin;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {

	exit;

}

/**
 * Notices admin class.
 *
 * Handles retrieving whether a particular notice has been dismissed or not,
 * as well as marking a notice as dismissed.
 *
 * @since 1.3.5
 *
 * @package Envira_Gallery
 * @author  Envira Team
 */
class Notices {

	/**
	 * Holds all dismissed notices
	 *
	 * @since 1.3.5
	 *
	 * @var array
	 */
	public $notices;

	/**
	 * Primary class constructor.
	 *
	 * @since 1.3.5
	 */
	public function __construct() {

		// Populate $notices.
		$this->notices = get_option( 'envira_gallery_notices' );
		if ( ! is_array( $this->notices ) ) {
			$this->notices = array();
		}

	}

	/**
	 * Checks if a given notice has been dismissed or not
	 *
	 * @since 1.3.5
	 *
	 * @param string $notice Programmatic Notice Name.
	 * @return bool Notice Dismissed
	 */

	public function is_dismissed( $notice, $check_transient_only = false ) {

		if ( $check_transient_only ) {

			$results = get_transient( 'eg_n_' . $notice );
			if ( $results === false || empty( $results ) ) {
				return false;
			}
		} else {

			if ( ! $check_transient && ! isset( $this->notices[ $notice ] ) ) {
				return false;
			}
		}

		return true;

	}

	/**
	 * Marks the given notice as dismissed
	 *
	 * @since 1.3.5
	 *
	 * @param string $notice Programmatic Notice Name.
	 * @return void
	 */
	public function dismiss( $notice, $seconds = false ) {

		if ( intval( $seconds ) > 0 ) {
			// use transient, because we want this to come back.
			set_transient( 'eg_n_' . $notice, time(), $seconds );
		} else {
			// use option, as nature intended.
			$this->notices[ $notice ] = true;
			update_option( 'envira_gallery_notices', $this->notices );
		}

	}


	/**
	 * Marks a notice as not dismissed
	 *
	 * @since 1.3.5
	 *
	 * @param string $notice Programmatic Notice Name.
	 * @return void
	 */
	public function undismiss( $notice ) {

		unset( $this->notices[ $notice ] );
		update_option( 'envira_gallery_notices', $this->notices );

	}

	/**
	 * Displays an inline notice with some Envira styling.
	 *
	 * @since 1.3.5
	 *
	 * @param string  $notice             Programmatic Notice Name.
	 * @param string  $title              Title.
	 * @param string  $message            Message.
	 * @param string  $type               Message Type (updated|warning|error) - green, yellow/orange and red respectively.
	 * @param string  $button_text        Button Text (optional).
	 * @param string  $button_url         Button URL (optional).
	 * @param bool    $is_dismissible     User can Dismiss Message (default: true).
	 * @param integer $transient_expires  Number of seconds transient is good for, after expires then notice re-appears - 0 means no transient, it's an option.
	 */
	public function display_inline_notice( $notice, $title, $message, $type = 'success', $button_text = '', $button_url = '', $is_dismissible = true, $seconds = false ) {

		// Check if the notice is dismissible, and if so has been dismissed.
		if ( $is_dismissible && $this->is_dismissed( $notice, true ) ) {
			// Nothing to show here, return!
			return;
		}

		// Display inline notice.
		?>
		<div class="updated envira-notice <?php echo $type . ( $is_dismissible ? ' is-dismissible' : '' ); ?>" data-seconds="<?php echo $seconds; ?>" data-notice="<?php echo $notice; ?>">
			<?php
			// Title.
			if ( ! empty( $title ) ) {
				?>
				<p class="envira-intro"><?php echo $title; ?></p>
				<?php
			}

			// Message
			if ( ! empty( $message ) ) {
				?>
				<p><?php echo $message; ?></p>
				<?php
			}

			// Button
			if ( ! empty( $button_text ) && ! empty( $button_url ) ) {
				?>
				<a href="<?php echo $button_url; ?>" target="_blank" class="button button-primary"><?php echo $button_text; ?></a>
				<?php
			}

			// Dismiss Button
			if ( $is_dismissible ) {
				?>
				<button type="button" class="notice-dismiss">
					<span class="screen-reader-text">
						<?php _e( 'Dismiss this notice', 'envira-gallery' ); ?>
					</span>
				</button>
				<?php
			}
			?>
		</div>
		<?php

	}

}
