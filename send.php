<?php

require_once( dirname(__FILE__) . '/../../../wp-load.php' );

if( !empty( $_POST['comment1'] ) || !empty( $_POST['comment2'] ) ) {
	exit;
}

if( empty( $_POST['name'] ) || empty( $_POST['mail'] ) || empty( $_POST['message'] ) ) {
	wp_redirect( add_query_arg( 'status', 'error', site_url( 'контакты' ) ) );
	exit;
}

$to = get_option('admin_email');
$subject = 'Заявка из Вашего сайта!';

if( !empty( $_POST[ 'subject' ] ) && $_POST[ 'subject' ] ) {
	$subject = $_POST[ 'subject' ];
}

$message = $_POST[ 'message' ];
$name = $_POST['name'];
$email = $_POST['mail'];

$headers = array(
	"From: mySite <no-reply@mydomain.com>",
	"Reply-To: $name <$email>"
);

if ( wp_mail( $to, $subject, $message, $headers ) ) {
	wp_redirect( add_query_arg( 'status', 'success', site_url( 'контакты' ) ) );
	exit;
}

wp_redirect( add_query_arg( 'status', 'error-2', site_url( 'контакты' ) ) );
exit;

//if( isset( $_POST['name'] ) && $_POST['name'] && !empty( $_POST['mail'] ) && $_POST['mail'] && $_POST['message'] ) {
//	echo 'hello';
//}
?>