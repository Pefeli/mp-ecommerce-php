<?php

    require_once 'vendor/autoload.php';

    MercadoPago\SDK::setAccessToken("APP_USR-2572771298846850-120119-a50dbddca35ac9b7e15118d47b111b5a-681067803");

    $webhookNotification = file_get_contents('php://input',true);

    switch($_POST["type"]) {
        case "payment":
            $payment = MercadoPago\Payment::find_by_id($_REQUEST["id"]);
            break;
        case "plan":
            $plan = MercadoPago\Plan::find_by_id($_REQUEST["id"]);
            break;
        case "subscription":
            $plan = MercadoPago\Subscription::find_by_id($_REQUEST["id"]);
            break;
        case "invoice":
            $plan = MercadoPago\Invoice::find_by_id($_REQUEST["id"]);
            break;
    }

    file_put_contents('webhookResponse.json',$webhookNotification);


    http_response_code(200);

?>