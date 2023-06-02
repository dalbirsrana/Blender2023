<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package blender2023
 */

class GoogleRecaptcha {
    /* Google recaptcha API url */
    private $google_url = "https://www.google.com/recaptcha/api/siteverify";
    private $secret = '';
 
    public function VerifyCaptcha($response)
    {
        $url = $this->google_url."?secret=".$this->secret."&response=".$response;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_TIMEOUT, 15);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, TRUE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, TRUE); 
        $curlData = curl_exec($curl);
 
        curl_close($curl);
 
        $res = json_decode($curlData, TRUE);

        if ($res['success'] == true && $res['score'] >= 0.5 && $res['action'] == 'submit') {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}

function check_email_address($email) {

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        return false;
    }
}

function set_form(){

	// Google Recaptcha
	$recaptcha_failure = true;	
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		$response = $_POST['g-recaptcha-response'];
		if(!empty($response)) {
			$cap = new GoogleRecaptcha();
			$verified = $cap->VerifyCaptcha($response);
			if($verified) {
				$recaptcha_failure = false;
			} 
		}
	} 

	$output = "{}";

	// Process form
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {

		//Check for Errors
		if ($recaptcha_failure) { 		
			$errors['recaptcha'] = 'ERROR'; 
			$output = '{"SUCCESS":"false","CONFIRMATION":"reCAPTCHA Error"}';
		} elseif ( empty($_POST['email']) ) {
			$output = '{"SUCCESS":"false","CONFIRMATION":"Please enter an email address"}';
			$errors['email'] = 'ERROR';
		} elseif ( preg_match('(.ru)', $_POST['email'] ) === 1) {
			$errors['email'] = 'ERROR';
            $output = '{"SUCCESS":"false", "CONFIRMATION":"Please enter a valid email"}';
		} elseif( preg_match('(htt|sex|naked|nude|chat|klicksen|profil)', $_POST['name'] ) === 1) {
			$errors['name'] = 'ERROR';
            $output = '{"SUCCESS":"false", "CONFIRMATION":"Please enter a valid name"}';
		} else {
            if ( check_email_address( $_POST['email'] ) ) {
            } else {
				$errors['email'] = 'ERROR';
			    $output = '{"SUCCESS":"false", "CONFIRMATION":"Please enter a valid email address"}';
            }
        }


		if (empty($errors)) {  // Success

			$name = sanitize_text_field( $_POST['name'] );
			$email = sanitize_email ( $_POST['email'] );

			$message = "Subscription Request - Omni Quality Living. <br><br>";
			$message .= "Name: " . $name . "<br>";
			$message .= "Email: " . $email;
		
			// $admin = get_option('admin_email');

			$to = "info@blendermedia.com";
			// $to = "dalbir@blendermedia.com";
			$subject = "Subscription Request from Omni Quality Living: " . $email;
			$headers = array('Content-Type: text/html; charset=UTF-8', 'From: ' . $name . '<donotreply@blendermedia.com>');
		
			if ( wp_mail($to, $subject, $message, $headers) ) {
				$output = '{"SUCCESS":"true","CONFIRMATION":"Thank you! You will receive a confirmation email shortly."}';
			} else { 
				echo '{"SUCCESS":"false","CONFIRMATION":"Error sending email"}';
			}
		
			// Interface with Lyris
			// $fields['name'] = $_POST['name'];
			// $fields['email'] = $_POST['email'];
			// $fields['list'] = '';
			// //$fields['confirm'] = 'none';
			// //$fields['showconfirm'] = 'F';

			// //print_r($fields);

			// foreach($fields as $key => $val) {
				// $post_variables .= $key.'='.$val.'&';
			// }

			// $post_variables = substr($post_variables,0,-1);
			// $ch = curl_init('http://dissemination.blendermedia.com:81/subscribe/subscribe.tml');

			// curl_setopt($ch, CURLOPT_POST, 1);
			// curl_setopt($ch, CURLOPT_POSTFIELDS, $post_variables);
			// curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			// $data = curl_exec($ch);
			// curl_close($ch);

		} else {

		}


	}  
	else 
	{ 
        $output = '{"SUCCESS":"false","CONFIRMATION":"ERROR"}'; 
    }

	echo $output;
	die();
}



// THE AJAX ADD ACTIONS
add_action( 'wp_ajax_set_form', 'set_form' );    //execute when wp logged in
add_action( 'wp_ajax_nopriv_set_form', 'set_form'); //execute when logged out
