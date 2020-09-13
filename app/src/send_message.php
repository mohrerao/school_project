<?php

require "/app/app/vendor/autoload.php";

$message = New Message\Message();
$message->body = "Test Message";
$message->receiver_id = 1;
$msg_type = New Message\MessageType($_GET['message_type']);
print_r($msg_type->send_message($message));
