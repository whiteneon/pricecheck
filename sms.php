<?php
//mail("2708494123@txt.att.net", "", "Your packaged has arrived!", "From: David Walsh <david@davidwalsh.name>\r\n");
require_once "Mail.php";

$from = "<coxinterior@gmail.com>";
$to = "<2708494123@txt.att.net>";
$subject = "Hi!";
$body = "Hi,\n\nHow are you?";

$host = "smtpout.secureserver.net";
$port = "25";
$username = "<send5@coxinterior.com>";
$password = "coxinterior";

$headers = array ('From' => $from,
		'To' => $to,
		'Subject' => $subject);
$smtp = Mail::factory('smtp',
		array ('host' => $host,
				'port' => $port,
				'auth' => true,
				'username' => $username,
				'password' => $password));

		$mail = $smtp->send($to, $headers, $body);

		if (PEAR::isError($mail)) {
			echo("<p>" . $mail->getMessage() . "</p>");
		} else {
			echo("<p>Message successfully sent!</p>");
		}

?>