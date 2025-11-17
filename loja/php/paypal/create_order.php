<?php
header("Content-Type: application/json");

require "config.php";

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, PAYPAL_API_BASE . "/v2/checkout/orders");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Content-Type: application/json",
    "Authorization: Basic " . base64_encode(PAYPAL_CLIENT_ID . ":" . PAYPAL_SECRET)
]);

$body = [
    "intent" => "CAPTURE",
    "purchase_units" => [[
        "amount" => [
            "currency_code" => "BRL",
            "value" => "20.00"
        ]
    ]]
];

curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body));

$response = curl_exec($ch);
curl_close($ch);

echo $response;
