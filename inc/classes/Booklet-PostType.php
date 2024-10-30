<?php
class Booklet_PostType{
	
	private $name;
	private $singular;
	private $pular;
	private $args;
	
	function __construct( $name, $title= array(), $args = array() ){
		
		// Post type initialization
		add_action( 'init', array( $this, 'booklet_post_type' ) );
		
		// variable value assign 
		$this->name = $name;
		$this->pular = $title['pular'];
		$this->singular = $title['singular'];
		$this->args = $args;


	}

	// register post type
	public  function booklet_post_type(){
			
			$bwbsp_pular    = esc_html( $this->pular );
			$bwbsp_singular = esc_html( $this->singular );
			
			$labels = array(
				'name'               => sprintf( esc_html__( '%s', 'booklet' ), $bwbsp_pular ),
				'singular_name'      => sprintf( esc_html__( '%s', 'booklet' ), $bwbsp_singular ),
				'menu_name'          => sprintf( esc_html__( '%s', 'booklet' ), $bwbsp_pular ),
				'name_admin_bar'     => sprintf( esc_html__( '%s', 'booklet' ), $bwbsp_singular ),
				'new_item'           => sprintf( esc_html__( 'New %s', 'booklet' ), $bwbsp_singular ),
				'edit_item'          => sprintf( esc_html__( 'Edit %s', 'booklet' ), $bwbsp_singular ),
				'view_item'          => sprintf( esc_html__( 'View %s', 'booklet' ), $bwbsp_singular ),
				'all_items'          => sprintf( esc_html__( 'All %s', 'booklet' ), $bwbsp_pular ),
				'search_items'       => sprintf( esc_html__( 'Search %s', 'booklet' ), $bwbsp_pular ),
				'parent_item_colon'  => esc_html_x( 'Parent '.$bwbsp_pular.':', 'booklet' ),
				'not_found'          => esc_html_x( 'No '.$bwbsp_pular.' found.', 'booklet' ),
				'not_found_in_trash' => esc_html_x( 'No '.$bwbsp_pular.' found in Trash.', 'booklet' )
			);

			$args = array_merge( 
				array(
					'labels'             => $labels,
					'public'             => true,
					'publicly_queryable' => true,
					'menu_icon' 		 => 'dashicons-admin-site',
					'show_ui'            => true,
					'show_in_menu'       => true,
					'query_var'          => true,
					'rewrite'            => array( 'slug' => $this->name ),
					'capability_type'    => 'post',
					'has_archive'        => true,
					'hierarchical'       => false,
					'supports'           => array('title')
				),
				$this->args
			
			);
			
			register_post_type( $this->name, $args );
			
			
		}	
	
}
