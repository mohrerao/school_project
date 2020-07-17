<?php


class Helper
{
    public function __construct()
    {
        $this->connection = New DataLayer();
    }

    public static function field_not_empty($field) {
        if (empty($field)){
            return "field {$field->name} should not be empty";
        }
    }
    public static function get_list($entity) {
        $this->connection->select()
    }
}