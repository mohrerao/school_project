<?php
namespace School;
use DB\DataLayer;

class Helper
{
    public static function field_not_empty($field)
    {
        if (empty($field)) {
            return "field {$field->name} should not be empty";
        }
    }

    public static function get_list($table, array $fields = [], $offset = 0, $no_of_recs = 0, $sort_order = '', $sort_field = '')
    {
        $connection = DataLayer::getInstance();
        return ($connection->select($table, $fields, $offset, $no_of_recs, $sort_order, $sort_field));
    }

    public static function get_list_by_filter_key($table, array $fields = [], array $keys, $offset = 0, $no_of_recs = 0, $sort_order = '', $sort_field = '')
    {
        $fields_str = implode(', ', $fields);
        if (!empty($keys)) {
            $key_str = '';
            foreach ($keys as $key => $value) {
                $key_str .= $key . ' = ' . $value;
                if (array_key_last($keys) != $key) {
                    $key_str .= ' AND';
                }
            }
        }
        $connection = DataLayer::getInstance();
        return ($connection->execute_query("SELECT $fields_str FROM $table WHERE $key_str"));
    }

    public static function get_field_by_id($table, $field_name, $id)
    {
        $connection = DataLayer::getInstance();
        return ($connection->select($table, [$field_name]));
    }

    public static function get_student_list(int $school_id = 0, int $class_id = 0, int $section_id = 0)
    {
        $query = "SELECT stu.id, stu.name 'Student Name', stu.parent_name 'Parent Name', stu.address Address, sec.name 'Section', cls.name 'Class', sch.name 'School'" .
            "FROM student AS stu LEFT JOIN class AS cls ON stu.class_id = cls.id " .
            "LEFT JOIN section AS sec ON stu.section_id = sec.id " .
            "LEFT JOIN school as sch ON cls.school_id = sch.id ";
        if ($school_id != 0 or $class_id != 0 or $section_id != 0) {
            $query .= "WHERE ";
            if ($school_id != 0) {
                $query .= "sch.id = $school_id ";
            }
            if ($class_id != 0) {
                if ($school_id != 0) {
                    $query .= 'AND ';
                }
                $query .= "cls.id = $class_id ";
            }
            if ($section_id != 0) {
                if ($school_id != 0 || $class_id != 0) {
                    $query .= 'AND ';
                }
                $query .= "sec.id = $section_id ";
            }
        }
        if (!empty($query)) {
            $connection = DataLayer::getInstance();
            $result = $connection->execute_query($query);
            return !empty($result) ? $result : "No Result Found";
        }
    }
}