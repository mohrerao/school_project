<?php

//namespace DB;
class DataLayer
{
    // Create a new connecttion
    /*host and database name*/
    private $pdo_parameters = 'mysql:host=127.0.0.1;dbname=schools';
    /*name of database user*/
    private $database_user = 'root';
    /*user database password*/
    private $user_password = '12345678';
    var $pdo_connection;
    function __construct()
    {
        // Create a new connection.
        try {
            $this->pdo_connection = new PDO($this->pdo_parameters, $this->database_user, $this->user_password);

            $this->pdo_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    // Execute random sql.
    function execute_query($query){
        $stmt = $this->pdo_connection->prepare($query,
            array(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true));
        return ($this->pdo_connection->query($stmt->queryString)->fetchAll());
    }

    // Insert new row.
    function insert($table, $values) {
        $columns = implode(', ',array_keys($values));
        foreach ($values as $key=>$value){
            $column_val[":$key"] = $value;
        }
        $col_name = implode(' , ',array_keys($column_val));
        return $this->pdo_connection->prepare("INSERT INTO $table ($columns) VALUES ($col_name)")->execute($column_val);
    }

    // Update table row by id.
    function update($table, $values) {
        foreach ($values as $key=>$value){
            $update_string_arr[] =  "$key = :$key";
            $rep_update_string_arr[":$key"] = $value;
        }
        $update_string = implode(', ', $update_string_arr);
        $this->pdo_connection->prepare("UPDATE $table SET $update_string where id = :id")->execute($rep_update_string_arr);
    }

    // Retrive table row by id.
    function retrive_data_by_id($table,$id) {
        $stmt = $this->pdo_connection->prepare("SELECT * from $table where id = $id",
            array(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true));
        return ($this->pdo_connection->query($stmt->queryString)->fetch(PDO::FETCH_ASSOC));
    }

    // Delete a row by id.
    function delete($table,$id) {
        $this->pdo_connection->prepare("DELETE FROM $table WHERE id = :id",
            array(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true))->execute(array(':id' => $id));
    }
}