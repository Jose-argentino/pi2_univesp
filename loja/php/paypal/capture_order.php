<?php
header("Content-Type: application/json");

require "config.php";

$order_id = $_GET["orderID"] ?? "";

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, PAYPAL_API_BASE . "/v2/checkout/orders/$order_id/capture");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Content-Type: application/json",
    "Authorization: Basic " . base64_encode(PAYPAL_CLIENT_ID . ":" . PAYPAL_SECRET)
]);

$response = curl_exec($ch);
curl_close($ch);

echo $response;
