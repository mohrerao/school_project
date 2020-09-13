<?php

namespace Message;

interface MessageInterface
{
    public function send($message_in);
}