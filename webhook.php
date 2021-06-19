<?php

    require_once 'vendor/autoload.php'; // You have to require the library from your Composer vendor folder

    MercadoPago\SDK::setAccessToken("APP_USR-2572771298846850-120119-a50dbddca35ac9b7e15118d47b111b5a-681067803");

    $txt = "\n\n" . 'webhook_response:' . json_encode($_GET) . "\n\n";
    file_put_contents("payment_log.txt", $txt, FILE_APPEND);

    $type = $GET["type"];
    $paymentId = $GET["data_id"];

    if ($type === 'payment') {

        $payment = MercadoPago\Payment::find_by_id($paymentId);

        file_put_contents("payment_log.txt", json_encode($payment), FILE_APPEND);

    }

    http_response_code(200);

?>