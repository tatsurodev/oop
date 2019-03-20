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
        $the_result_array = self::find_this_query("SELECT * FROM users WHERE id={$id} LIMIT 1");

        return !empty($the_result_array) ? array_shift($the_result_array) : false;
    }

    public static function find_this_query($sql)
    {
        global $database;
        $result_set = $database->query($sql);
        $the_object_array = [];

        while ($row = mysqli_fetch_array($result_set)) {
            $the_object_array[] = self::instantation($row);
        }

        return $the_object_array;
    }

    //ログインページで使用
    public static function verify_user($username, $password)
    {
        global $database;
        $username = $database->escape_string($username);
        $password = $database->escape_string($password);
        $sql = "
            SELECT
                *
            FROM
                users
            WHERE
                username='{$username}'
                AND password='{$password}'
            LIMIT
                1
        ";
        $the_result_array = self::find_this_query($sql);

        return !empty($the_result_array) ? array_shift($the_result_array) : false;
    }

    //レコードからプロパティを自動セットするメソッド
    public static function instantation($the_record)
    {
        //プロパティをセットするために新たにオブジェクト作成
        $the_object = new self();
        foreach ($the_record as $the_attribute => $value) {
            if ($the_object->has_the_attribute($the_attribute)) {
                $the_object->{$the_attribute} = $value;
            }
        }

        return $the_object;
        // $the_object
        // User::__set_state(array(
        //    'id' => '2',
        //     'username' => 'taro',
        //     'password' => '123',
        //     'first_name' => 'taro',
        //     'last_name' => 'suzuki',
        // ))
    }

    public function create()
    {
        global $database;
        $sql = "
            INSERT INTO
                users (
                    username,
                    password,
                    first_name,
                    last_name
                )
            VALUES
                (
                    '{$database->escape_string($this->username)}',
                    '{$database->escape_string($this->password)}',
                    '{$database->escape_string($this->first_name)}',
                    '{$database->escape_string($this->last_name)}'
                )
        ";

        if ($database->query($sql)) {
            $this->id = $database->the_insert_id();

            return true;
        }

        return false;
    }

    //与えた引数がこのユーザークラスのプロパティにあるかどうかを返すメソッド
    private function has_the_attribute($the_attribute)
    {
        //このクラスのプロパティを格納
        $object_properties = get_object_vars($this);
        //object_properties example
        // array (
        //     'id' => '2',
        //     'username' => 'taro',
        //     'password' => '123',
        //     'first_name' => 'taro',
        //     'last_name' => 'suzuki',
        // )

        return array_key_exists($the_attribute, $object_properties);
    }
}
