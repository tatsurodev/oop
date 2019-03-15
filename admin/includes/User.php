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
