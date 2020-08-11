<?php

namespace School;
use DB\DataLayer;
//include_once '/Users/kiran.rao/Sites/School_project/Database/DataLayer.php';

class EntityBase
{
    protected $connection;
    protected $data = array();

    // Load DB in construct
    public function __construct()
    {
        $this->connection = DataLayer::getInstance();
    }

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

    public function create($entity_name)
    {

        if ($this->connection->insert($entity_name, $this->data)) {
            return "$entity_name Created";
        } else {
            return "System Error. Not able to create Entity";
        }
    }

    // Load a particular school by id
    public function load_by_id($entity, $id)
    {
        $result = $this->connection->retrive_data_by_id($entity, $id);
        if (!empty($result)) {
            $this->data = $result;
            $msg = "Success";
        } else {
            $msg = "Invalid School id / School id doesnot exist";
        }
        return $msg;
    }

    // Update school details
    public function update($entity)
    {
        $status = $this->connection->update($entity, $this->data);
        if ($status) {
            return "Updated $entity";
        } else {
            return "Invalid $entity id / $entity id does not exist";
        }
    }

    // Delete School from DB
    public function delete($entity)
    {
        $status = $this->connection->delete($entity, $this->data['id']);
        if ($status) {
            return "Deleted $entity";
        } else {
            return "Invalid $entity id / $entity id does not exist";
        }
    }

    public function __serialize(): array
    {
        // TODO: Implement __serialize() method.
    }

}



