<?php 
//team metabox
if(!function_exists('drivic_team_metabox')){
	function drivic_team_metabox(){

		// Start with an underscore to hide fields from custom fields list
		$prefix = '__drivic__';

		/**
		* Initiate the metabox
		*/

		$cmb = new_cmb2_box( array(
			'id'			=> 'drivic_team_metabox',
			'title'			=> esc_html__( 'Our team Metabox', 'drivic' ),
			'object_types'	=> array('team'), // post type
			'context'		=> 'normal',
			'priority'		=> 'high',
			'show_names'	=> true
		) );
		// custom field start 
		$cmb->add_field( array(
			'name'			=> esc_html__( 'Designation', 'drivic' ),
			'desc'			=> esc_html__( 'add Your Designation', 'drivic' ),
			'default'	    => esc_html__( 'Instructor', 'drivic' ),
			'id'			=> $prefix . 'designation',
			'type'			=> 'text',
			'show_on_cb'	=> 'team_hide_if_no_cats',
		) );
		// custom field start 
		$cmb->add_field( array(
			'name'			=> esc_html__( 'Description', 'drivic' ),
			'desc'			=> esc_html__( 'add Your Description', 'drivic' ),
			'default'	    => esc_html__( 'Integer dis ads se purus sollicitudin dapibus et vivamus pharetra sit integer dictum in dise natoque an mus quis in. Facilisis inceptos nec, potenti nostra aenean lacinia varius semper ant nullam nulla primis placerat facilisis. Netus lorem rutrum arcu dignissim at sit morbi phasellus nascetur eget urna potenti', 'drivic' ),
			'id'			=> $prefix . 'description',
			'type'			=> 'textarea',
			'show_on_cb'	=> 'team_hide_if_no_cats',
		) );


		// custom field start 
		$cmb->add_field( array(
			'name'			=> esc_html__( 'Email', 'drivic' ),
			'desc'			=> esc_html__( 'Add Your Email', 'drivic' ),
			'default'	    => esc_html__( 'jhon-harison@panthar.com', 'drivic' ),
			'id'			=> $prefix . 'email',
			'type'			=> 'text',
			'show_on_cb'	=> 'team_hide_if_no_cats',
		) );
		// custom field start 
		$cmb->add_field( array(
			'name'			=> esc_html__( 'Number', 'drivic' ),
			'desc'			=> esc_html__( 'Add Your Number', 'drivic' ),
			'default'	    => esc_html__( '+0 123 456 895', 'drivic' ),
			'id'			=> $prefix . 'number',
			'type'			=> 'text',
			'show_on_cb'	=> 'team_hide_if_no_cats',
		) );

		// custom field start 
		$cmb->add_field( array(
			'name'			=> esc_html__( 'Facebook', 'drivic' ),
			'desc'			=> esc_html__( 'Add Your Facebook Url', 'drivic' ),
			'id'			=> $prefix . 'facebook',
			'type'			=> 'text',
			'show_on_cb'	=> 'team_hide_if_no_cats',
			'default'		=> esc_html__( '#', 'drivic' )
		) );
		// custom field start 
		$cmb->add_field( array(
			'name'			=> esc_html__( 'twitter', 'drivic' ),
			'desc'			=> esc_html__( 'Add Your twitter Url', 'drivic' ),
			'id'			=> $prefix . 'twitter',
			'type'			=> 'text',
			'show_on_cb'	=> 'team_hide_if_no_cats',
			'default'		=> esc_html__( '#', 'drivic' )
		) );
		// custom field start 
		$cmb->add_field( array(
			'name'			=> esc_html__( 'linkedin', 'drivic' ),
			'desc'			=> esc_html__( 'Add Your linkedin Url', 'drivic' ),
			'id'			=> $prefix . 'linkedin',
			'type'			=> 'text',
			'show_on_cb'	=> 'team_hide_if_no_cats',
			'default'		=> esc_html__( '#', 'drivic' )
		) );
		// custom field start 
		$cmb->add_field( array(
			'name'			=> esc_html__( 'pinterest', 'drivic' ),
			'desc'			=> esc_html__( 'Add Your pinterest Url', 'drivic' ),
			'id'			=> $prefix . 'pinterest',
			'type'			=> 'text',
			'show_on_cb'	=> 'team_hide_if_no_cats'
		) );
		// custom field start 
		$cmb->add_field( array(
			'name'			=> esc_html__( 'instagram', 'drivic' ),
			'desc'			=> esc_html__( 'add Your instagram Url', 'drivic' ),
			'id'			=> $prefix . 'instagram',
			'type'			=> 'text',
			'show_on_cb'	=> 'team_hide_if_no_cats',
			'default'		=> esc_html__( '#', 'drivic' )
		) );

	}
}
add_action( 'cmb2_admin_init', 'drivic_team_metabox' );