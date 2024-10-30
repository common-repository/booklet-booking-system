<?php

class Booklet_BookingForm{
	
	public $title;
	public $subtitle;
	
	// constructor
	function __construct( $title, $subtitle ){
		
		$this->title = $title;
		$this->subtitle = $subtitle;
		
	}
	
	// booking form
	public function booklet_frontbooking_form(){

		if( isset( $_POST['rest_sub'] ) ){
			
			$sendFormData = new Booklet_RestBookingFormdata();
			$error = $sendFormData->get_form_data();
			$success = $sendFormData->booklet_insert_query();

		}
		?>
			<div class="booklet-rest-form">
				<div class="form-header">
				<?php 
				
				// title
				if( $this->title ){
					echo '<h2>'.esc_html( $this->title ).'</h2>';
				}
				if( $this->subtitle ){
					echo '<h4>'.esc_html( $this->subtitle ).'</h4>';
				}
				
				
				if( isset( $error ) && $error == false  ){
					
					echo '<div class="booklet-error">Please check your data. Any field cannot be empty.</div>';
				}
				
				if( isset( $success ) ){
					echo '<div class="booklet-success"> Your reservation has been submitted successfully. We will confirm you soon by mail.</div>';
				}
				
				?>
				</div>
				
				<form action="" method="post">
				<?php 
				wp_nonce_field( 'booklet_rest_formData', 'booklet_rest_formData_nonce' );
				?>
				<!-- End test fields -->
					<div class="form-left-content">	
						<div class="field-row">
							<label><?php esc_html_e( 'Date', 'booklet' ); ?></label>
							<input type="text" id="datepicker" class="control-field" name="rest_date" required />
						</div>
						
						<div class="field-row">
							<label><?php esc_html_e( 'Time', 'booklet' ); ?></label>
							<input type="text" class="timepicker" name="rest_time" required />
						</div>
						
						<div class="field-row">
							<label><?php esc_html_e( 'Persion', 'booklet' ); ?></label>
							<input type="text" class="control-field" name="rest_persion" required />
						</div>
						
						<div class="field-row">
							<label><?php esc_html_e( 'Table', 'booklet' ); ?></label>
							<input type="text" class="control-field" name="rest_table" required />
						</div>
					</div>
					
					<div class="form-right-content">
						<div class="field-row">
							<label><?php esc_html_e( 'Name', 'booklet' ); ?></label>
							<input type="text" class="control-field" name="rest_name" required />
						</div>
						
						<div class="field-row">
							<label><?php esc_html_e( 'Email', 'booklet' ); ?></label>
							<input type="text" class="control-field" name="rest_email" required />
						</div>
						
						<div class="field-row">
							<label><?php esc_html_e( 'Phone', 'booklet' ); ?></label>
							<input type="text" class="control-field" name="rest_phone" required />
						</div>
				
						<div class="field-row">
							<label><?php esc_html_e( 'Address', 'booklet' ); ?></label>
							<input type="text" class="control-field" name="rest_address" required />
						</div>
					</div>
					
					<div class="btn-row">
						<input type="submit" class="control-btn" name="rest_sub" value="Booking" />
					</div>
					
				</form>
			</div>
		<?php
		
	}

}

