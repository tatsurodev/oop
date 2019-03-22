<?php

class Photo extends Db_object
{
    public $photo_id;
    public $title;
    public $description;
    public $filename;
    public $type;
    public $size;
    protected static $db_table = 'photos';
    protected static $db_table_fields = ['photo_id', 'title', 'description', 'filename', 'type', 'size'];
}
