<?php

/**
 * @file
 * GigyaRaasSet.php
 * General RaaS settings.
 */
class GigyaRaasSet {

	public function __construct() {

		// Get settings variables.
		$this->global_options = get_option( GIGYA__SETTINGS_GLOBAL );
		$this->login_options  = get_option( GIGYA__SETTINGS_LOGIN );

	}

	/**
	 * This is Gigya login AJAX callback
	 */
	public function init() {

		// Load custom Gigya login script.
		wp_enqueue_script( 'gigya_raas_js', GIGYA__PLUGIN_URL . 'features/raas/gigya_raas.js' );
		wp_enqueue_style( 'gigya_raas_css', GIGYA__PLUGIN_URL . 'features/raas/gigya_raas.css' );

		// Parameters to be sent to the DOM.
		$params = array(

			// Ajax action.
				'actionRaas'              => 'gigya_raas',
				'redirect'                => user_admin_url(),

			// Screen set.
				'raasWebScreen'           => _gigParam( $this->login_options['raas_web_screen'], 'Login-web' ),
				'raasMobileScreen'        => _gigParam( $this->login_options['raas_mobile_screen'], 'Mobile-login' ),
				'raasLoginScreen'         => _gigParam( $this->login_options['raas_login_screen'], 'gigya-login-screen' ),
				'raasRegisterScreen'      => _gigParam( $this->login_options['raas_register_screen'], 'gigya-register-screen' ),
				'raasProfileWebScreen'    => _gigParam( $this->login_options['raas_profile_web_screen'], 'Profile-web' ),
				'raasProfileMobileScreen' => _gigParam( $this->login_options['raas_profile_mobile_screen'], 'Profile-mobile' ),

			// Override links.
				'raasOverrideLinks'       => _gigParam( $this->login_options['raas_override_links'], 1 ),

			// Embed DIVs.
				'raasLoginDiv'            => _gigParam( $this->login_options['raas_login_div'], 'loginform' ),
				'raasRegisterDiv'         => _gigParam( $this->login_options['raas_register_div'], 'registerform' ),
				'raasProfileDiv'          => _gigParam( $this->login_options['raas_profile_div'], 'profile-page' )
		);

		// Load params to be available on client-side script.
		wp_localize_script( 'gigya_raas_js', 'gigyaRaasParams', $params );

	}
}