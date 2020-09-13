<?php

namespace Message;

class Message {

    protected $connection;
    protected $data = array();

    // Load DB in construct
//    public function __construct()
//    {
//        $this->connection = new DataOperations();
//    }

    // Implements magic set

    public function __get($name)
    {
        return $this->data[$name];
    }

    // Implements magic get

    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }

    // Create new school.

//    public function create()
//    {
//        if ($this->connection->insert($this->body, $this->receiver_id, time())) {
//            return "Message Created";
//        } else {
//            return "System Error. Not able to create Entity";
//        }
//    }

}