<?php

    $txt = "\n\n" . 'webhook_response:' . json_encode($_POST) . "\n\n";
    file_put_contents("payment_log.txt", $txt, FILE_APPEND);

    http_response_code(200);

?>