<?php

namespace School;
use Elasticsearch\ClientBuilder;
use DB\DataOperations;



class EntityBase
{
    protected $connection;
    protected $data = array();
    protected $client;
    // Load DB in construct
    public function __construct()
    {
        $this->connection = new DataOperations();
        $this->client = ClientBuilder::create()->build();
        $_SESSION['user_id'] = 1;
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
        if (!empty($_SESSION['user_id'])){
            if ($this->connection->insert($entity_name, $this->data)) {
                $this->update_log($entity_name, 'Insert');
                return "$entity_name Created";
            } else {
                return "System Error. Not able to create Entity";
            }
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
            $msg = "Invalid School id / School id does not exist";
        }
        return $msg;
    }

    // Update school details
    public function update($entity)
    {
        $status = $this->connection->update($entity, $this->data);
        if ($status) {
            $this->update_log($entity, 'Update');
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
            $this->update_log($entity, 'Delete');
            return "Deleted $entity";
        } else {
            return "Invalid $entity id / $entity id does not exist";
        }
    }

    public function __serialize(): array
    {
        // TODO: Implement __serialize() method.
    }

    private function update_log($entity_type, $transaction_type){
        $params = [
            'index' => 'audit_logs',
            'id'    => $entity_type .'_'. time(),
            'body'  => [
                'uid'=>$_SESSION['user_id'],
                'entity' => $entity_type,
                'data' => json_encode($this->data),
                'transaction' => $transaction_type,
                'time' => time(),
            ],
        ];
        try {
            $this->client->index($params);
        }
        catch (\Exception $e){
           // echo("Could not record log");
        }
        $this->connection->insert('log', ['uid'=>$_SESSION['user_id'], 'entity' => $entity_type, 'data' => json_encode($this->data), 'transaction' => $transaction_type]);
    }
}



