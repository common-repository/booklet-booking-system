<?php
class Booklet_RestBookingFormdata{
	
	public $datas;
	public $success;
	
	// constructor
	function __construct(){
	
	}
	
	public function get_form_data(){
		
		$ok = true;
				
		if( empty( $_POST['rest_name'] ) ){
			$ok = false;
			return $ok;
		}
		if( empty( $_POST['rest_time'] ) ){
			$ok = false;
			return $ok;
		}
		if( empty( $_POST['rest_date'] ) ){
			$ok = false;
			return $ok;
		}
		if( empty( $_POST['rest_persion'] ) ){
			$ok = false;
			return $ok;
		}
		if( empty( $_POST['rest_table'] ) ){
			$ok = false;
			return $ok;
		}
		if( empty( $_POST['rest_phone'] ) ){
			$ok = false;
			return $ok;
		}
		if( empty( $_POST['rest_email'] ) ){
			$ok = false;
			return $ok;
		}
		if( empty( $_POST['rest_address'] ) ){
			$ok = false;
			return $ok;
		}
		
		$date = $_POST['rest_date'];
		$time = $_POST['rest_time'];
		$persion = $_POST['rest_persion'];
		$table = $_POST['rest_table'];
		$name = $_POST['rest_name'];
		$phone = $_POST['rest_phone'];
		$email = $_POST['rest_email'];
		$address = $_POST['rest_address'];
		
		if( $ok == true ){
			
					
		$formData = array(
		
			'date' 		=> $date,
			'time' 		=> $time,
			'persion'   => $persion,
			'table' 	=> $table,
			'name' 		=> $name,
			'phone' 	=> $phone,
			'email' 	=> $email,
			'address' 	=> $address
		);
		
		$this->datas = $formData;
			
		}else{
			return false;
		}

	}
	
	public function booklet_insert_query(){

		if( !isset( $_POST['booklet_rest_formData_nonce'] ) ){
			return;
		}
		
		if( !wp_verify_nonce( $_POST['booklet_rest_formData_nonce'], 'booklet_rest_formData' ) ){
			return;
		}
	
		$args = array(
			'post_status' => 'draft',
			'post_type'   => 'restaurant-booking',
			'post_title'  => $this->datas['name'],
		);
				
		
		$formData = $this->datas;
		if( is_array( $formData ) ){
			
			$post_id = wp_insert_post( $args );
			
			if( $post_id ){
				
				foreach( $formData as $key => $getdata ){
					update_post_meta( $post_id, '_booklate_rest_'.$key, $getdata );
				}
			
			}
			
			
		if( $post_id ){
			return 'Success';
		}else{
			return 'faile';
		}
			
			
		
		}
				
	}
	
	
	public function get_success( $success ){
		
	}
	
	public function set_success(){
		
		return $this->success;
	}
	
	
		
}
