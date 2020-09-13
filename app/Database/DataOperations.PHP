<?php
namespace DB;
use PDO;

class DataOperations {
    private $db_conn;

    public function __construct()
    {
        $db_instance = DataLayer::getInstance();
        $this->db_conn = $db_instance->getConnection();
    }

    // Execute random sql.
    function execute_query($query)
    {
        $stmt = $this->db_conn['mysql']->prepare($query,
            array(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true));
        return ($this->db_conn['mysql']->query($stmt->queryString)->fetchAll(PDO::FETCH_ASSOC));
    }

    // Insert new row.
    function insert($table, $values)
    {
        $columns = implode(', ', array_keys($values));
        foreach ($values as $key => $value) {
            $column_val[":$key"] = $value;
        }
        $col_name = implode(' , ', array_keys($column_val));
        return $this->db_conn['mysql']->prepare("INSERT INTO $table ($columns) VALUES ($col_name)")->execute($column_val);
    }

    // Update table row by id.
    function update($table, $values)
    {
        foreach ($values as $key => $value) {
            $update_string_arr[] = "$key = :$key";
            $rep_update_string_arr[":$key"] = $value;
        }
        $update_string = implode(', ', $update_string_arr);
        return $this->db_conn['mysql']->prepare("UPDATE $table SET $update_string where id = :id")->execute($rep_update_string_arr);
    }

    // Retrive table row by id.
    function retrive_data_by_id($table, $id)
    {
        $stmt = $this->db_conn['mysql']->prepare("SELECT * from $table where id = $id",
            array(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true));
        return ($this->db_conn['mysql']->query($stmt->queryString)->fetch(PDO::FETCH_ASSOC));
    }

    // Retrive table row by id.
    function retrive_data_by_fields($table, $fields)
    {
        foreach ($fields as $key=>$value){
            $conditions .= $key ." = '". $value ."'";
               if (!(array_key_last($fields) == $key)) {
                   $conditions .= ' AND ';
               }
        }
        $stmt = $this->db_conn['mysql']->prepare("SELECT * from {$table} where {$conditions}",
            array(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true));
        return ($this->db_conn['mysql']->query($stmt->queryString)->fetch(PDO::FETCH_ASSOC));
    }

    // Delete a row by id.
    function delete($table, $id)
    {
        return ($this->db_conn['mysql']->prepare("DELETE FROM $table WHERE id = :id",
            array(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true))->execute(array(':id' => $id)));
    }

    // Get records from a table
    function select($table, $fields, $offset, $no_of_records, $sort_order, $sort_field)
    {
        // Create SQL query
        $token_array[':table'] = $table;
        if (!empty($fields)) {
            $fields_str = implode(', ', $fields);
            $query = "SELECT $fields_str FROM $table ";
        } else {
            $query = "SELECT * FROM :table ";
        }
        if (!empty($sort_order) && !empty($sort_field)) {
            $token_array [':sort_order'] = $sort_order;
            $token_array [':sort_field'] = $sort_field;
            switch ($sort_order) {
                case 'ASC':
                    $query .= "ORDER BY :sort_field ASC";
                    break;
                case 'DESC':
                    $query .= "ORDER BY :sort_field DESC";
                    break;
                default:
                    $query .= "ORDER BY :sort_field ASC";
                    break;
            }
        }
        if (!empty($no_of_records)) {
            $token_array [':no_of_records'] = $no_of_records;
            $query .= "LIMIT :no_of_records";
        }
        if (!empty($offset)) {
            $token_array [':offset'] = $offset;
            $query .= "OFFSET :offset";
        }
        $stmt = $this->db_conn['mysql']->prepare($query,
            array(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true));
        return ($this->db_conn['mysql']->query($stmt->queryString)->fetchAll(PDO::FETCH_ASSOC));
    }

    function setRedisCache($key, $value) {
            $this->db_conn['redis']->set($key, $value);
    }
    function getRedisCache($key){
        return $this->db_conn['redis']->get($key);
    }
    function purgeRedisCache() {
        $this->db_conn['redis']->flushAll();
    }

}
