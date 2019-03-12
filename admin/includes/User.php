<?php

class User
{
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
}
