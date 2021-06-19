<?php

    $json = file_get_contents('php://input');
    // Converts it into a PHP object

    $logFile = fopen("log_mp_json.txt", 'a') or die("Error creando archivo");
    fwrite($logFile, print_r($json, true));
    fclose($logFile);

    require_once 'vendor/autoload.php';
    MercadoPago\SDK::setAccessToken("APP_USR-2572771298846850-120119-a50dbddca35ac9b7e15118d47b111b5a-681067803");

    if ($_GET["topic"] == "payment") {

        $payment = MercadoPago\Payment::find_by_id($_GET["id"]);
        $merchant_order = MercadoPago\MerchantOrder::find_by_id($payment->order->id);

        //guardo en un archivo payment
        $logFile = fopen("log_payment.txt", 'a') or die("Error creando archivo");
        fwrite($logFile, print_r($payment, true));
        fclose($logFile);

        //guardo en un archivo merchant_order
        $logFile = fopen("log_merchant.txt", 'a') or die("Error creando archivo");
        fwrite($logFile, print_r($merchant_order, true));
        fclose($logFile);
    }

    ob_clean();

    http_response_code(200);

?>