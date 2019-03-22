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
        $the_result_array = self::find_this_query($sql);

        return !empty($the_result_array) ? array_shift($the_result_array) : false;
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
                {$i(self::$db_table)} (
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
                {$i(self::$db_table)}
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
                {$i(self::$db_table)}
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
        foreach (self::$db_table_fields as $db_field) {
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
}
