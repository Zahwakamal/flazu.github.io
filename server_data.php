<?php
// Import the necessary PHP libraries

// Define the payload data for the POST request
$protocol = 1;
$payload = "platform=0&protocol=$protocol&version=4.22";

// Define the headers, including the custom user agent header
$headers = array(
    "User-Agent: UbiServices_SDK_2019.Release.27_PC64_unicode_static",
    "Content-Type: application/x-www-form-urlencoded"
);

// Define the cURL options
$options = array(
    CURLOPT_URL => "https://www.growtopia1.com/growtopia/server_data.php",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_TIMEOUT => 2,
    CURLOPT_HTTPHEADER => $headers,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $payload
);

// Initialize cURL with the options
$ch = curl_init();
curl_setopt_array($ch, $options);

// Execute the cURL request and capture the response
$response = curl_exec($ch);

// Check for cURL errors and parse the response
if ($response === false) {
    echo "cURL Error: " . curl_error($ch);
} else {
    $lines = explode("\n", $response);
    $ip = $port = $meta = "";
    foreach ($lines as $line) {
        $split = explode("|", $line);
        if (count($split) < 2) {
            continue;
        }
        if ($split[0] == "server") {
            $ip = $split[1];
        } else if ($split[0] == "port") {
            $port = (int)$split[1];
        } else if ($split[0] == "meta") {
            $meta = $split[1];
        }
    }
    // Do something with the parsed data
    echo $response;

}

// Close the cURL handle
curl_close($ch);

?>