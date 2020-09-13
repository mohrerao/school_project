<?php

namespace User;

use DB\DataOperations;

class User
{
    public static function validate_login($user_name, $password) {
        $connection = new DataOperations();
        $user = $connection->retrive_data_by_fields('users', ['username'=>$user_name, 'password'=>$password]);
        if (sizeof($user) > 0){
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_email'] = $user['emailid'];
        }
    }
}