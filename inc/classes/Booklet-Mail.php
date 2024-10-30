<?php 

class Booklet_Mail{
	
	function __construct(){
		;
		add_action( 'publish_restaurant-booking', array( $this, 'booklet_mail' ), 10,2 );	
		
	}

	public function booklet_mail( $ID, $post ){
		$opt = get_option('booklet_option_name');
		$name = esc_html( get_bloginfo('name') );
		$email = esc_html( $opt['booklet_from_email'] );
		
		
		$restName = get_post_meta( $post->ID, '_booklate_rest_name', true );
		$restDate = get_post_meta( $post->ID, '_booklate_rest_date', true );
		$restTime = get_post_meta( $post->ID, '_booklate_rest_time', true );
		$restEmail = get_post_meta( $post->ID, '_booklate_rest_email', true );
		$subject = "Reservation Confirmation";
		$message = 'Hello '.$restName.', Your reservation has been confirmed. Your reservation date is '.$restDate.' and time '.$restTime.'. Thanks for your reservation.';
		
		$headers [] = '';
        $headers [] = 'Content-Type: text/html; charset=UTF-8';
		$headers[] .= 'From: '.$name.' <'.$email.'>'."\r\n";
		
		wp_mail( $restEmail, $subject, $message, $headers  );
	}
	
}

$mail = new Booklet_Mail();