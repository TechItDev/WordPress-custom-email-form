<?php

add_action( 'admin_post_nopriv_contact_form', 'process_contact_form' );

add_action( 'admin_post_contact_form', 'process_contact_form' );

function process_contact_form(){

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	GLOBAL $wpdb;

	$params = $_POST;

        $params['contact_full_name'] = preg_replace("/[^a-zA-Z ]+/", "",filter_var(strip_tags($params['contact_full_name']), FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH ));
        $params['contact_email'] = filter_var(strip_tags($params['contact_email']), FILTER_SANITIZE_EMAIL);

        $params['contact_message'] =htmlspecialchars(($params['contact_message']), ENT_QUOTES);

	
	
 

	/*create table if not exists*/

	$table_name = $wpdb->prefix.'custom_contact_form';

	$query = $wpdb->prepare( 'SHOW TABLES LIKE %s', $wpdb->esc_like( $table_name ) );

	if ( ! $wpdb->get_var( $query ) == $table_name ) {

		$sql = "CREATE TABLE {$table_name} (
		id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		contact_full_name VARCHAR(255) NOT NULL,
		contact_email VARCHAR(255) NOT NULL,
		contact_message VARCHAR(1200) NOT NULL,
		created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
	)";

	if($wpdb->query($sql)){
		submitsForm($table_name,$params);
	}


}else{
	submitsForm($table_name,$params);
}

/*create table if not exists*/


die;

}

}

function submitsForm($table_name, $params){

	GLOBAL $wpdb;

	$curTime = date('Y-m-d H:i:s');

	$query = "INSERT INTO {$table_name}(contact_full_name, contact_email, contact_message, created_at) VALUES('{$params['contact_full_name']}','{$params['contact_email']}','{$params['contact_message']}', '{$curTime}')"; 

	if($wpdb->query($query)){
		wp_redirect($params['base_page'].'?success=1'); 
	}else{
		wp_redirect($params['base_page'].'?error=1'); 
	}
}


$full_name = isset( $_POST['contact_full_name']);
$mail = isset( $_POST['contact_email']);
$message = isset ( $_POST['contact_message']);



function my_phpmailer_example( $phpmailer ) {
	$phpmailer->isSMTP();     
	$phpmailer->Host = 'mail.techitdev.com';
	$phpmailer->SMTPAuth = true; // Ask it to use authenticate using the Username and Password properties
	$phpmailer->Port = 587;
	$phpmailer->SMTPSecure = 'tls';
	$phpmailer->Username = 'info@techitdev.com';
	$phpmailer->Password = 'teChit$890*dev';
	$phpmailer->SMTPDebug = 0;
	$phpmailer->From = "info@techitdev.com";
	$phpmailer->FromName = "Your Kawsar";
}
add_action( 'phpmailer_init', 'my_phpmailer_example' );


// Send an email to the WordPress administrator if there are no validation errors
if ( empty( $validation_messages ) ) {

    $to    = 'info@techitdev.com';
    $subject = 'New message from ' . $full_name;
    $message = $message . ' - The email address of the customer is: ' . $full_name . $mail;
	// $headers = array('Content-Type: text/html; charset=UTF-8');


    wp_mail( $to, $subject, $message, );

    $success_message = esc_html__( 'Your message has been successfully sent.', 'techitdev' );

}



// __ Work Perfactly ___//
// function my_phpmailer_example( $phpmailer ) {
//     $phpmailer->isSMTP();     
//     $phpmailer->Host = 'smtp.gmail.com';
//     $phpmailer->SMTPAuth = true; // Ask it to use authenticate using the Username and Password properties
// 	$phpmailer->Port = 587;
// 	$phpmailer->SMTPSecure = 'tls';
//     $phpmailer->Username = 'kaws01717@gmail.com';
//     $phpmailer->Password = 'iclggdliwavgeppy';
// 	$phpmailer->SMTPDebug = 0;
//     $phpmailer->From = "kaws01717@gmail.com";
//     $phpmailer->FromName = "Your Kawsar";
// }
// add_action( 'phpmailer_init', 'my_phpmailer_example' );

// wp_mail( 'contact.mkawsar@gmail.com', 'TSL-0', '0-TSL' );
// __ Work Perfactly ___//





// __ Work Perfactly  2 ___//
// function my_phpmailer_example( $phpmailer ) {
//     $phpmailer->isSMTP();     
//     $phpmailer->Host = 'mail.techitdev.com';
//     $phpmailer->SMTPAuth = true; // Ask it to use authenticate using the Username and Password properties
// 	$phpmailer->Port = 587;
// 	$phpmailer->SMTPSecure = 'tls';
//     $phpmailer->Username = 'info@techitdev.com';
//     $phpmailer->Password = 'teChit$890*dev';
// 	$phpmailer->SMTPDebug = 0;
//     $phpmailer->From = "info@techitdev.com";
//     $phpmailer->FromName = "Your Kawsar";
// }
// add_action( 'phpmailer_init', 'my_phpmailer_example' );

// wp_mail( 'contact.mkawsar@gmail.com', 'TSL-TC', '0-TSL' );


// __ Work Perfactly 2 ___//








// function send_contact_email(){
// 	$contact_full_name = filter_var($_POST['contact_full_name'], FILTER_SANITIZE_STRING);
// 	$contact_email = filter_var($_POST['contact_email'], FILTER_SANITIZE_EMAIL);
// 	$contact_message = filter_var($_POST['contact_message'], FILTER_SANITIZE_STRING);

	


// 	$to = 'info@techitdev.com';
// 	$subject= 'Test Mail';
// 	$body= 'The customer details: <br/><br/>';

// 	if( !empty($contact_email)){
// 		$body = 'Name:' .$contact_full_name. '<br>';
// 		$body = 'Email:' .$contact_email. '<br>';
// 		$body = 'Message:' .$contact_message. '<br>';
// 	}
// 		$headers = array('Content-Type: text/html; charset=UTF-8');

// 		$emailSent = wp_mail($to, $subject, $body, $headers);

// 		print $emailSent;
// 		exit;
	
// }
// add_action('wp_ajax_nopriv_send_contact_email', 'send_contact_email');




// $to = 'info.techitdev@gmail.com';
// $subject = 'The subject';
// $body = 'The email body content';
// $headers = array('Content-Type: text/html; charset=UTF-8');

// wp_mail( $to, $subject, $body, $headers );


// 	//   Recipients
// 	$mail->From = "info@techitdev.com";
// 	$mail->FromName = "TeckIT Dev Kawsar";


//    //Content
//     $mail->isHTML(true);                                  //Set email format to HTML
//     $mail->Subject = 'Here is the subject';
//     $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
//     $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

//     $mail->send();
//     echo 'Message has been sent';
// } catch (Exception $e) {
//     echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
// }




