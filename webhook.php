<?php

    $txt = "\n\n" . 'webhook_response:' . json_encode($_GET) . "\n\n";
    file_put_contents("payment_log.txt", $txt, FILE_APPEND);

    $type = $_GET["type"];
    $paymentId = $_GET["data_id"];


    if ($type === 'payment') {

        $data = file_get_contents("https://api.mercadopago.com/v1/payments/$paymentId?access_token=APP_USR-2572771298846850-120119-a50dbddca35ac9b7e15118d47b111b5a-681067803");

        file_put_contents("payment_log.txt", $data, FILE_APPEND);

    }

    $txt = "\n\n" . json_encode($_REQUEST) . "\n\n";
    file_put_contents("payment_log.txt", $txt, FILE_APPEND);


    http_response_code(200);

?>