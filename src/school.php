<?php

include_once '/Users/kiran.rao/Sites/School_project/Database/DataLayer.php';

class school
{
    protected  $connection;
    protected  $data = array();

    // Load DB in construct
    public function __construct()
    {
        $this->connection = New DataLayer();
    }

    // Implements magic set
    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }

    // Implements magic get
    public function __get($name) {
        return $this->data[$name];
    }

    // Create new school.
    public function create() {
        if ($this->connection->insert('school',$this->data)) {
            return "School Created";
        }
        else {
            return "System Error. Not able to create school";
        }
    }

    // Load a particular school by id
    public function load_by_id($id) {
        $this->data = $this->connection->retrive_data_by_id('school',$id);
    }

    // Update school details
    public function update() {
        $this->connection->update('school',$this->data);
    }

    // Delete School from DB
    public function delete() {
        $this->connection->delete('school', $this->data['id']);
    }
    public function __serialize(): array
    {
        // TODO: Implement __serialize() method.
    }

}



