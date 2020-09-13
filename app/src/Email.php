<?php

namespace Message;

class Email implements \Message\MessageInterface
{

    public function send($message_in)
    {
        return  $message_in->body . ' Message Sent to '. $message_in->receiver_id . ' through Email';
    }
}