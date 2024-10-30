<?php
class Booklet_RestaurantMeta{
	
	public $post_type;
	
	// constructor
	function __construct( $type ){
		
		$this->post_type = $type;

		
		if( is_admin() ){
			add_action( 'load-post.php', array( $this,'booklet_restaurant_init_meta' ) );
			add_action( 'load-post-new.php', array( $this,'booklet_restaurant_init_meta' ) );
		}
		

	}

	public function booklet_restaurant_init_meta(){
		add_action( 'add_meta_boxes', array($this, 'booklet_restaurant_meta_box') );
		add_action('save_post', array( $this, 'booklet_restaurant_meta_save') );
	}
	
	// add meta box
	public function booklet_restaurant_meta_box(){
		add_meta_box(
			'restaurant_booking_info',
			'Booking Information',
			array($this, 'booklet_restaurant_meta_fields'),
			$this->post_type,
			'normal',
			'high'
		);
	}
	
	// meta fields
	public function booklet_restaurant_meta_fields( $post ){
			
	wp_nonce_field('booklet_restaurant_inner_meta', 'booklet_restaurant_meta_nonce');
	
	$restName = get_post_meta( $post->ID, '_booklate_rest_name', true );
	$restDate = get_post_meta( $post->ID, '_booklate_rest_date', true );
	$restTime = get_post_meta( $post->ID, '_booklate_rest_time', true );
	$restPersion = get_post_meta( $post->ID, '_booklate_rest_persion', true );
	$restTable = get_post_meta( $post->ID, '_booklate_rest_table', true );
	$restPhone = get_post_meta( $post->ID, '_booklate_rest_phone', true );
	$restEmail = get_post_meta( $post->ID, '_booklate_rest_email', true );
	$restAddress = get_post_meta( $post->ID, '_booklate_rest_address', true );
	
	?>
	<div class="fields-row">
		<label for="rest_name"><?php esc_html_e( 'Name', 'booklate' ); ?></label>
		<input type="text" name="rest_name" id="rest_name" value="<?php echo esc_html( $restName ); ?>" />
	</div>
	<div class="fields-row">
		<label for="rest_date"><?php esc_html_e( 'Date', 'booklate' ); ?></label>
		<input type="text" name="rest_date" id="datepicker" value="<?php echo esc_html( $restDate ); ?>" />
	</div>
	<div class="fields-row">
		<label for="rest_time"><?php esc_html_e( 'Time', 'booklate' ); ?></label>
		<input type="text" name="rest_time" id="rest_time" class="timepicker" value="<?php echo esc_html( $restTime ) ?>" />
	</div>
	<div class="fields-row">
		<label for="rest_persion"><?php esc_html_e( 'Persion', 'booklate' ); ?></label>
		<input type="number" name="rest_persion" id="rest_persion" value="<?php echo esc_html( $restPersion ); ?>" />
	</div>
	<div class="fields-row">
		<label for="rest_table"><?php esc_html_e( 'Table', 'booklate' ); ?></label>
		<input type="number" name="rest_table" id="rest_table" value="<?php echo esc_html( $restTable ); ?>" />
	</div>
	<div class="fields-row">
		<label for="rest_phone"><?php esc_html_e( 'Phone', 'booklate' ); ?></label>
		<input type="text" name="rest_phone" id="rest_phone" value="<?php echo esc_html( $restPhone ); ?>" />
	</div>
	<div class="fields-row">
		<label for="rest_email"><?php esc_html_e( 'Email', 'booklate' ); ?></label>
		<input type="email" name="rest_email" id="rest_email" value="<?php echo esc_html( $restEmail ); ?>" />
	</div>
	<div class="fields-row">
		<label for="rest_address"><?php esc_html_e( 'Address', 'booklet' ); ?></label>
		<input type="text" name="rest_address" id="rest_address" value="<?php echo esc_html( $restAddress ); ?>" />
	</div>
	
	<?php
	
	}
	
	
	// meat data save
	public function booklet_restaurant_meta_save( ){
		
		// Check if our nonce is set.
        if ( ! isset( $_POST['booklet_restaurant_meta_nonce'] ) ) {
            return;
        }
 
        $nonce = $_POST['booklet_restaurant_meta_nonce'];
 
        // Verify that the nonce is valid.
        if ( ! wp_verify_nonce( $nonce, 'booklet_restaurant_inner_meta' ) ) {
            return;
        }
		global $post;
        /*
         * If this is an autosave, our form has not been submitted,
         * so we don't want to do anything.
         */
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return;
        }
 
        // Check the user's permissions.
        if ( 'page' == $_POST['post_type'] ) {
            if ( ! current_user_can( 'edit_page', $post_id ) ) {
                return;
            }
        } else {
            if ( ! current_user_can( 'edit_post', $post_id ) ) {
                return;
            }
        }
 
		  // Sanitize the user input.
        $restName = sanitize_text_field( $_POST['rest_name'] );
        $restDate = sanitize_text_field( $_POST['rest_date'] );
        $restTime = sanitize_text_field( $_POST['rest_time'] );
        $restPersion = sanitize_text_field( $_POST['rest_persion'] );
        $restTable = sanitize_text_field( $_POST['rest_table'] );
        $restPhone = sanitize_text_field( $_POST['rest_phone'] );
        $restEmail = sanitize_text_field( $_POST['rest_email'] );
        $restAddress = sanitize_text_field( $_POST['rest_address'] );
		
		
		update_post_meta( $post->ID, '_booklate_rest_name', $restName );
		update_post_meta( $post->ID, '_booklate_rest_date', $restDate );
		update_post_meta( $post->ID, '_booklate_rest_time', $restTime );
		update_post_meta( $post->ID, '_booklate_rest_persion', $restPersion );
		update_post_meta( $post->ID, '_booklate_rest_table', $restTable );
		update_post_meta( $post->ID, '_booklate_rest_phone', $restPhone );
		update_post_meta( $post->ID, '_booklate_rest_email', $restEmail );
		update_post_meta( $post->ID, '_booklate_rest_address', $restAddress );
	
	}
	
	
}

