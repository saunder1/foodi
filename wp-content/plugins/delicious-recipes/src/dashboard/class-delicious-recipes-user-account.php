<?php
/**
 * Delicious_Recipes_User_Account.
 *
 * @package Delicious_Recipes
 * @since  1.2.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * WP Delicious User Account Class.
 */
class Delicious_Recipes_User_Account {

	/**
	 * Constructor.
	 */
	public function __construct() {
	}

	/**
	 * Dashboard menus.
	 *
	 * @return array Menus.
	 */
	private static function dashboard_menus() {
		$dashboard_menus = array(
			'browse' => array(
				'menu_title'      => __( 'Browse Recipes', 'delicious-recipes' ),
				'menu_class'      => 'dr-ud_tab browse',
				'menu_content_cb' => array( __CLASS__, 'dashboard_menu_browse_recipes_tab' ),
				'priority'        => 10,
				'svg'             => delicious_recipes_get_svg( 'browse', 'dashboard', '#000000' ),
			),
			'wishlist' => array(
				'menu_title'      => __( 'Favorites', 'delicious-recipes' ),
				'menu_class'      => 'dr-ud_tab wishlist',
				'menu_content_cb' => array( __CLASS__, 'dashboard_menu_wishlist_tab' ),
				'priority'        => 20,
				'svg'             => delicious_recipes_get_svg( 'wishlist', 'dashboard', '#000000' ),
			),
			'profile' => array(
				'menu_title'      => __( 'Edit Profile', 'delicious-recipes' ),
				'menu_class'       => 'dr-ud_tab profile',
				'menu_content_cb' => array( __CLASS__, 'dashboard_menu_profile_tab' ),
				'priority'        => 30,
				'svg'             => delicious_recipes_get_svg( 'edit-profile', 'dashboard', '#000000' ),
			),
		);
		return $dashboard_menus = apply_filters( 'delicious_recipes_user_dashboard_menus', $dashboard_menus );
	}

	public static function dashboard_menu_browse_recipes_tab( $args ) {
		delicious_recipes_get_template( 'account/tab-content/browse.php', $args );
	}

	public static function dashboard_menu_wishlist_tab( $args ) {
		delicious_recipes_get_template( 'account/tab-content/wishlist.php', $args );
	}

	public static function dashboard_menu_profile_tab( $args ) {
		delicious_recipes_get_template( 'account/tab-content/account.php', $args );
	}

	/**
	 * Output of User Dashboard shortcode.
	 *
	 * @since 2.2.3
	 */
	public static function output() {

		global $wp;
		$global_toggles  = delicious_recipes_get_global_toggles_and_labels();

		if ( ! is_user_logged_in() ) {
			// After password reset, add confirmation message.
			if ( ! empty( $_GET['password-reset'] ) ) {
				?>
					<div class="delicious-recipes-success-msg"><?php esc_html_e( 'Your Password has been updated successfully. Please Log in to continue.', 'delicious-recipes' ); ?></div>
				<?php
			}

			if ( isset( $_GET['action'] ) && 'lost-pass' == $_GET['action'] ) {
				// Get lost password form.
				self::lost_password();
			}
			elseif ( isset( $_GET['register'] ) && $global_toggles['enable_user_registration'] ) {
				// Get user registration.
				delicious_recipes_get_template( 'account/form-registration.php' );
			} else {
				// Get user login.
				delicious_recipes_get_template( 'account/form-login.php' );
			}
		}
		else {
			$current_user = wp_get_current_user();
			$args['current_user'] = $current_user;
			$args['dashboard_menus'] = self::dashboard_menus();
			// Get user Dashboard.
			delicious_recipes_get_template( 'account/content-dashboard.php', $args );
		}
	}
	/**
	 * Lost password page handling.
	 */
	public static function lost_password() {
		/**
		 * After sending the reset link, don't show the form again.
		 */
		if ( ! empty( $_GET['reset-link-sent'] ) ) {
			delicious_recipes_get_template( 'account/lostpassword-confirm.php' );
			return;
			/**
			 * Process reset key / login from email confirmation link
			*/
		} elseif ( ! empty( $_GET['show-reset-form'] ) ) {
			if ( isset( $_COOKIE[ 'wp-resetpass-' . COOKIEHASH ] ) && 0 < strpos( $_COOKIE[ 'wp-resetpass-' . COOKIEHASH ], ':' ) ) {
				list( $rp_login, $rp_key ) = array_map( 'delicious_recipes_clean_vars', explode( ':', wp_unslash( $_COOKIE[ 'wp-resetpass-' . COOKIEHASH ] ), 2 ) );
				$user = self::check_password_reset_key( $rp_key, $rp_login );

				// reset key / login is correct, display reset password form with hidden key / login values
				if ( is_object( $user ) ) {

					delicious_recipes_get_template( 'account/form-reset-password.php', array(
						'key'   => $rp_key,
						'login' => $rp_login,
					) );

					return;
				}
			}
		}

		// Show lost password form by default.
		delicious_recipes_get_template( 'account/form-lostpassword.php' );
	}

	/**
	 * Retrieves a user row based on password reset key and login.
	 *
	 * @uses $wpdb WordPress Database object
	 *
	 * @param string $key Hash to validate sending user's password
	 * @param string $login The user login
	 *
	 * @return WP_User|bool User's database row on success, false for invalid keys
	 */
	public static function check_password_reset_key( $key, $login ) {
		// Check for the password reset key.
		// Get user data or an error message in case of invalid or expired key.
		$user = check_password_reset_key( $key, $login );

		if ( is_wp_error( $user ) ) {
			DEL_RECIPE()->notices->add( __( 'Error : ', 'delicious-recipes' )  . __( 'This key is invalid or has already been used. Please reset your password again if needed.', 'delicious-recipes' ), 'error' );
			return false;
		}

		return $user;
	}

	/**
	 * Handles sending password retrieval email to customer.
	 *
	 * Based on retrieve_password() in core wp-login.php.
	 *
	 * @uses $wpdb WordPress Database object
	 * @return bool True: when finish. False: on error
	 */
	public static function retrieve_password() {
		$login = sanitize_user( $_POST['user_login'] );

		if ( empty( $login ) ) {

			DEL_RECIPE()->notices->add( __( 'Error : ', 'delicious-recipes' )  . __( 'Enter an email or username.', 'delicious-recipes' ), 'error' );

			return false;

		} else {
			// Check on username first, as customers can use emails as usernames.
			$user_data = get_user_by( 'login', $login );
		}

		// If no user found, check if it login is email and lookup user based on email.
		if ( ! $user_data && is_email( $login ) && apply_filters( 'delicious_recipes_get_username_from_email', true ) ) {
			$user_data = get_user_by( 'email', $login );
		}

		$errors = new WP_Error();

		do_action( 'lostpassword_post', $errors );

		if ( $errors->get_error_code() ) {

			DEL_RECIPE()->notices->add( __( 'Error : ', 'delicious-recipes' )  . $errors->get_error_message(), 'error' );

			return false;
		}

		if ( ! $user_data ) {

			DEL_RECIPE()->notices->add( __( 'Error : ', 'delicious-recipes' )  . __( 'Invalid username or email.', 'delicious-recipes' ), 'error' );

			return false;
		}

		if ( is_multisite() && ! is_user_member_of_blog( $user_data->ID, get_current_blog_id() ) ) {
			DEL_RECIPE()->notices->add( __( 'Error : ', 'delicious-recipes' )  . __( 'Invalid username or email.', 'delicious-recipes' ), 'error' );

			return false;
		}

		// redefining user_login ensures we return the right case in the email.
		$user_login = $user_data->user_login;

		do_action( 'retrieve_password', $user_login );

		$allow = apply_filters( 'allow_password_reset', true, $user_data->ID );

		if ( ! $allow ) {

			DEL_RECIPE()->notices->add( __( 'Error : ', 'delicious-recipes' )  . __( 'Password reset is not allowed for this user.', 'delicious-recipes' ), 'error' );

			return false;

		} elseif ( is_wp_error( $allow ) ) {

			DEL_RECIPE()->notices->add( __( 'Error : ', 'delicious-recipes' )  . $allow->get_error_message(), 'error' );

			return false;
		}

		// Get password reset key (function introduced in WordPress 4.4).
		$key = get_password_reset_key( $user_data );

		// Send email notification.
		do_action( 'delicious_recipes_reset_password_notification', $user_login, $key );

		return true;
	}

	/**
	 * Handles resetting the user's password.
	 *
	 * @param object $user The user
	 * @param string $new_pass New password for the user in plaintext
	 */
	public static function reset_password( $user, $new_pass ) {
		do_action( 'password_reset', $user, $new_pass );

		wp_set_password( $new_pass, $user->ID );
		self::set_reset_password_cookie();

		wp_password_change_notification( $user );
	}

	/**
	 * Set or unset the cookie.
	 *
	 * @param string $value
	 */
	public static function set_reset_password_cookie( $value = '' ) {
		$rp_cookie = 'wp-resetpass-' . COOKIEHASH;
		$rp_path   = current( explode( '?', wp_unslash( $_SERVER['REQUEST_URI'] ) ) );

		if ( $value ) {
			setcookie( $rp_cookie, $value, 0, $rp_path, COOKIE_DOMAIN, is_ssl(), true );
		} else {
			setcookie( $rp_cookie, ' ', time() - YEAR_IN_SECONDS, $rp_path, COOKIE_DOMAIN, is_ssl(), true );
		}
	}

}
