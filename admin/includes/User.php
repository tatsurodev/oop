<?php

class User
{
    public $id;
    public $username;
    public $password;
    public $first_name;
    public $last_name;

    public static function find_all_users()
    {
        return self::find_this_query('SELECT * FROM users');
    }

    public static function find_user_by_id($id)
    {
        $result_set = self::find_this_query("SELECT * FROM users WHERE id={$id} LIMIT 1");

        return mysqli_fetch_array($result_set);
    }

    public static function find_this_query($sql)
    {
        global $database;
        $result_set = $database->query($sql);

        return $result_set;
    }

    public static function instantation($find_user)
    {
        $the_object = new self();
        $the_object->id = $find_user['id'];
        $the_object->username = $find_user['username'];
        $the_object->password = $find_user['password'];
        $the_object->first_name = $find_user['first_name'];
        $the_object->last_name = $find_user['last_name'];

        return $the_object;
    }
}
