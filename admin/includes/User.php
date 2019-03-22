<?php

class User extends Db_object
{
    public $id;
    public $username;
    public $password;
    public $first_name;
    public $last_name;
    protected static $db_table = 'users';
    //createメソッドで使用するプロパティを配列にして格納
    protected static $db_table_fields = ['username', 'password', 'first_name', 'last_name'];

    //ログインページで使用
    public static function verify_user($username, $password)
    {
        global $database, $i;
        $username = $database->escape_string($username);
        $password = $database->escape_string($password);
        $sql = "
            SELECT
                *
            FROM
                {$i(self::$db_table)}
            WHERE
                username='{$username}'
                AND password='{$password}'
            LIMIT
                1
        ";
        $the_result_array = self::find_by_query($sql);

        return !empty($the_result_array) ? array_shift($the_result_array) : false;
    }
}
