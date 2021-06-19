<?php

    require_once 'vendor/autoload.php'; // You have to require the library from your Composer vendor folder

    MercadoPago\SDK::setAccessToken("APP_USR-2572771298846850-120119-a50dbddca35ac9b7e15118d47b111b5a-681067803"); // Either Production or SandBox AccessToken
    MercadoPago\SDK::setIntegratorId("dev_24c65fb163bf11ea96500242ac130004");

    $urlBasePath = 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}";

    // Item
    $item = new MercadoPago\Item();

    $item->id = 1234;
    $item->title = $_POST['title'];
    $item->description = 'Dispositivo móvil de Tienda e-commerce';
    $item->picture_url = $urlBasePath . ltrim($_POST['img'], '.');
    $item->quantity = 1;
    $item->unit_price = $_POST['price'];
    $item->currency_id = 'COP';

    // Pagador
    $payer = new MercadoPago\Payer();

    $payer->name = 'Lalo';
    $payer->surname = 'Landa';
    $payer->email = 'test_user_83958037@testuser.com';
    $payer->phone = array(
        'area_code' => '52',
        'number' => '5549737300',
    );
    $payer->address = array(
        'street_name' => 'Insurgentes Sur',
        'street_number' => 1602,
        'zip_code' => '03940'
    );

    // Preferencia
    $preference = new MercadoPago\Preference();

    $preference->statement_descriptor = 'Tienda e-commerce';
    $preference->external_reference = 'anfelipeloal@gmail.com';
    $preference->items = array($item);
    $preference->payer = $payer;
    $preference->payment_methods = array(
        'excluded_payment_methods' => array(
            array(
                'id' => 'amex',
            )
        ),
        'excluded_payment_types' => array(
            array(
                'id' => 'atm',
            )
        ),
        'installments' => 6,
    );

    $preference->back_urls = array(
        'success' => $urlBasePath . '/success.php',
        'failure' => $urlBasePath . '/failure.php',
        'pending' => $urlBasePath . '/pending.php',
    );

    $preference->notification_url = $urlBasePath . '/webhook.php';
    $preference->auto_return = 'approved';

    $preference->save();

    $txt = "\n\n" . 'preferecne_id:' . $preference->id . "\n";
    $txt .= 'collector_id:' . $preference->collector_id . "\n\n";
    file_put_contents("payment_log.txt", $txt, FILE_APPEND);

    echo $preference->init_point;
?>