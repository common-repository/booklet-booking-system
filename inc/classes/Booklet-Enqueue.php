<?php
class Booklet_Enqueue{
	
	// constructor
	function __construct(){
		
		// wp enqueue
		if( !is_admin() ){
			add_action( 'wp_enqueue_scripts', array( $this,'booklet_wp_enqueue' ) );
		}
		
		// admin enqueue
		if( is_admin() ){
		add_action( 'admin_enqueue_scripts', array( $this,'booklet_admin_enqueue' ) );	
		}
		

	}
	
	// wp enqueue
	public function booklet_wp_enqueue(){
		
		wp_enqueue_style( 'wickedpicker.min', plugins_url( '../../css/wickedpicker.min.css', __FILE__ ), array() );
			
		wp_enqueue_style( 'jquery-ui', plugins_url( '../../css/jquery-ui.css', __FILE__ ), array() );
		
		wp_enqueue_style( 'booklet-min', plugins_url( '../../css/booklet.css', __FILE__ ), array() );
		
		wp_enqueue_script( 'booklet-min', plugins_url( '../../js/booklet-min.js', __FILE__ ), array('jquery','jquery-ui-datepicker'), true );
		
		wp_enqueue_script( 'wickedpicker.min', plugins_url( '../../js/wickedpicker.min.js', __FILE__ ), array('jquery'), true );
		
	}
	
	// admin enqueue
	public function booklet_admin_enqueue(){
		
		wp_enqueue_style( 'wickedpicker.min', plugins_url( '../../css/wickedpicker.min.css', __FILE__ ), array() );
		
		wp_enqueue_style( 'booklet-admin', plugins_url( '../../css/admin.css', __FILE__ ), array() );
		
		wp_enqueue_style( 'jquery-ui', plugins_url( '../../css/jquery-ui.css', __FILE__ ), array() );
				
		wp_enqueue_script( 'booklet-min', plugins_url( '../../js/booklet-min.js', __FILE__ ), array('jquery','jquery-ui-datepicker'), true );
		
		wp_enqueue_script( 'wickedpicker.min', plugins_url( '../../js/wickedpicker.min.js', __FILE__ ), array('jquery'), true );
		
	}

	
}

$enqueue = new Booklet_Enqueue();

