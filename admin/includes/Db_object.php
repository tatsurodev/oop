<?php

class Db_object
{
    public static function find_all()
    {
        global $i;

        return static::find_by_query("SELECT * FROM {$i(static::$db_table)}");
    }

    public static function find_by_id($id)
    {
        global $i;
        $the_result_array = static::find_by_query("SELECT * FROM {$i(static::$db_table)} WHERE id={$id} LIMIT 1");

        return !empty($the_result_array) ? array_shift($the_result_array) : false;
    }

    public static function find_by_query($sql)
    {
        global $database;
        $result_set = $database->query($sql);
        $the_object_array = [];

        while ($row = mysqli_fetch_array($result_set)) {
            $the_object_array[] = static::instantation($row);
        }

        return $the_object_array;
    }

    //レコードからプロパティを自動セットするメソッド
    public static function instantation($the_record)
    {
        $calling_class = static::class;
        //プロパティをセットするために新たにオブジェクト作成
        $the_object = new $calling_class();
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

    public function save()
    {
        return isset($this->id) ? $this->update() : $this->create();
    }

    public function create()
    {
        global $database, $i;
        $properties = $this->clean_properties();
        $sql = "
            INSERT INTO
                {$i(static::$db_table)} (
                    {$i(implode(',', array_keys($properties)))}
                )
            VALUES
                (
                    '{$i(implode("','", array_values($properties)))}'
                )
            ;
        ";

        if ($database->query($sql)) {
            $this->id = $database->the_insert_id();

            return true;
        }

        return false;
    }

    public function update()
    {
        global $database, $i;
        $properties = $this->clean_properties();
        $properties_pairs = [];
        foreach ($properties as $key => $value) {
            $properties_pairs[] = "{$key}='{$value}'";
        }
        $sql = "
            UPDATE
                {$i(static::$db_table)}
            SET
                {$i(implode(', ', $properties_pairs))}
            WHERE
                id = {$database->escape_string}({$this->id})
            ;
        ";

        $database->query($sql);

        return 1 === mysqli_affected_rows($database->connection) ? true : false;
    }

    public function delete()
    {
        global $database, $i;
        $sql = "
            DELETE FROM
                {$i(static::$db_table)}
            WHERE
                id = {$database->escape_string}({$this->id})
            LIMIT
                1
            ;
        ";

        $database->query($sql);

        return 1 === mysqli_affected_rows($database->connection) ? true : false;
    }

    //createで使用するプロパティのキーと値を$db_table_fieldsを使って取得する
    protected function properties()
    {
        $properties = [];
        foreach (static::$db_table_fields as $db_field) {
            if (property_exists($this, $db_field)) {
                $properties[$db_field] = $this->{$db_field};
            }
        }

        return $properties;
    }

    //createで使用するプロパティの値をエスケープする
    protected function clean_properties()
    {
        global $database;

        $clean_properties = [];

        foreach ($this->properties() as $key => $value) {
            $clean_properties[$key] = $database->escape_string($value);
        }

        return $clean_properties;
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
