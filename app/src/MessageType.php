<?php

namespace Message;

class MessageType
{
    private $message_type;

    /**
     * MessageType constructor.
     */
    public function __construct($message_channel)
    {
        switch ($message_channel) {
            case 'SMS':
                $this->message_type = new SMS();
                break;
            case 'EMAIL':
                $this->message_type = new Email();
                break;
            case 'NOTIFICATION':
                $this->message_type = new Notification();
                break;
        }
    }

    public function send_message($message) {
        return $this->message_type->send($message);
    }
}