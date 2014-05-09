<?php
/**
 * Form builder for 'Comment Settings' configuration page.
 */
function commentsSettingsForm() {
	$values = get_option( GIGYA__SETTINGS_COMMENTS );
	$form   = array();

	$form['on'] = array(
			'type'  => 'checkbox',
			'label' => __( 'Enable Gigya Comments' ),
			'value' => _gigParamDefaultOn( $values, 'on' )
	);

	$form['rating'] = array(
			'type'  => 'checkbox',
			'label' => __( 'Rating & Reviews mode' ),
			'value' => _gigParam( $values, 'rating', 0 ),
			'desc'  => __( 'Checking this button will change the mode of the Comment plugin to Rating & Reviews. Please make sure that the Category ID defined below is set to Rating & Reviews mode in Gigya platform.' )
	);

	$form['categoryID'] = array(
			'type'  => 'text',
			'label' => __( 'Category ID' ),
			'value' => _gigParam( $values, 'categoryID', '' ),
			'desc'  => __( "Copy the ID under 'Comments category name' from Gigya platform." )
	);

	$form['position'] = array(
			'type'    => 'select',
			'options' => array(
					'under' => __( 'Under Post' ),
					'none'  => __( 'None' )
			),
			'label'   => __( 'Set the position of the Comments in a post page' ),
			'value'   => _gigParam( $values, 'position', 'under' ),
			'desc'    => sprintf( __( 'You can also add and position Gigya Comments using the %s settings page.' ), '<a href="' . admin_url( 'widgets.php' ) . '">' . __( 'Widgets' ) . '</a>' )
	);

	$form['advanced'] = array(
			'type'  => 'textarea',
			'label' => __( "Additional Parameters (advanced)" ),
			'value' => _gigParam( $values, 'advanced', '' ),
			'desc'  => sprintf( __( 'Enter valid %s. See list of available:' ), '<a class="gigya-json-example" href="javascript:void(0)">' . __( 'JSON format' ) . '</a>' ) . ' <a href="http://developers.gigya.com/020_Client_API/030_Comments/comments.showCommentsUI" target="_blank">' . __( 'parameters' ) . '</a>'
	);

	echo _gigya_form_render( $form, GIGYA__SETTINGS_COMMENTS );
}